<?php

namespace CodingMs\Modules\Hook;

use CodingMs\Modules\Domain\DataTransferObject\BackendUserGroupPermission;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Hook: TCA Manipulation
 */
final class TableConfigurationArrayHook implements SingletonInterface
{
    /**
     * ItemsProcFunc: Filter configured backend user groups based on Custom Options
     *
     * @param  array  $parameters
     * @todo itemsProcFunc is not after all items are generated.. therefor this hook is not available since TYPO3 9.x.
     * @see https://forge.typo3.org/issues/85622
     */
    public function filterConfiguredBackendGroups(array $parameters): void
    {
        $items = &$parameters['items'] ?? [];

        if (static::getBackendUserAuthentication()->isAdmin()) {
            return;
        }

        if ($items === []) {
            return;
        }

        $selectedItems = GeneralUtility::intExplode(',', $parameters['row'][$parameters['field']], true);
        $options = [];
        foreach ($items as $key => $item) {
            // Get id from option
            [$label, $id, $icon] = $item;
            $id = (int)$id;
            // Add to $options when group if user
            $options = $this->addGroupBasedOnUserAccess($options, $selectedItems, $id, $label, $icon);
        }

        // Only apply when there are any items filtered. Fallback on default items!
        if (!empty($options)) {
            $items = $options;
        }
    }

    /**
     * Workaround to manually add groups for TCA field based on current user
     *
     * @param  array  $parameters
     */
    public function addGroupsForUser(array $parameters): void
    {
        /** @var DeletedRestriction $deletedRestriction */
        $deletedRestriction = GeneralUtility::makeInstance(DeletedRestriction::class);
        $items = &$parameters['items'] ?? [];
        $queryBuilder = static::getQueryBuilderForTable('be_groups');
        $queryBuilder->getRestrictions()->add($deletedRestriction);

        $query = $queryBuilder->select('uid', 'title')
            ->from('be_groups')
            ->orderBy('title');

        $result = $query->execute();
        while ($row = $result->fetch()) {
            $items[] = [$row['title'], $row['uid'], 'status-user-group-backend'];
        }

        // Now go to the original ItemsProcFunc functionality
        $this->filterConfiguredBackendGroups($parameters);
    }

    /**
     * @param  array  $items
     * @param  array  $selected
     * @param  int  $id
     * @param  string  $label
     * @param  string|null  $icon
     * @return array
     */
    protected function addGroupBasedOnUserAccess(
        array $items,
        array $selected,
        int $id,
        string $label,
        ?string $icon = null
    ): array {
        // If user has access, just add to items and return as intended
        if (BackendUserGroupPermission::hasAccessToGroup($id)) {
            $items[] = [$label, $id, $icon];

            return $items;
        }

        // If its one of the already selected and we don't have access. We still need to show it or the user
        // can unconsciously remove the group.
        // @TODO The user can still delete the group. Hook DataHandler should prevent this.
        if (in_array($id, $selected, true)) {
            $items[] = ['_hidden_ ' . $label, $id, $icon];

            return $items;
        }

        // If none, just return the already parsed items
        return $items;
    }

    /**
     * @return BackendUserAuthentication
     */
    protected static function getBackendUserAuthentication(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    /**
     * Get QueryBuilder without any default restrictions
     *
     * @param  string  $table
     * @return QueryBuilder
     */
    protected static function getQueryBuilderForTable(string $table): QueryBuilder
    {
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable($table);
        // Remove all restrictions
        $queryBuilder->getRestrictions()->removeAll();
        return $queryBuilder;
    }
}
