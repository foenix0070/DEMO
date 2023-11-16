<?php
namespace Imaya\BNI\Domain\Repository;

use Doctrine\DBAL\Connection;
use Imaya\BN\Domain\Model\ProductCategory;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class PortfolioRepository extends Repository
{
    /**
     * @var string
     */
    protected $table = 'tt_content';

    /**
     * @var array
     */
    protected $defaultOrderings = [
        'sorting' => QueryInterface::ORDER_ASCENDING,
    ];

    /**
     * Find all portfolios by category uid
     *
     * @param int $categoryUid
     * @return array
     */
    public function findByCategoryUid($categoryUid)
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable($this->table);
        $queryBuilder
            ->select('*')
            ->from($this->table)
            ->where(
                $queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter('portfolio_item', \PDO::PARAM_STR))
            )
            ->andWhere(
                $queryBuilder->expr()->eq('sys_language_uid', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
            )
            ->andWhere(
                $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($this->getPid(), \PDO::PARAM_INT))
            )
            ->andWhere(
                $queryBuilder->expr()->eq('tx_myextension_category', $queryBuilder->createNamedParameter($categoryUid, \PDO::PARAM_INT))
            )
            ->orderBy('sorting', 'ASC');
        $statement = $queryBuilder->execute();
        $rows = $statement->fetchAll();
        $portfolios = [];
        foreach ($rows as $row) {
            $portfolio = new \Imaya\BNI\Domain\Model\Portfolio();
            $portfolio->fromArray($row);
            $portfolios[] = $portfolio;
        }
        return $portfolios;
    }

    /**
     * Get the current page id
     *
     * @return int
     */
    protected function getPid()
    {
        return (int)($GLOBALS['TSFE']->id ?: $GLOBALS['TSFE']->rootLine[0]['uid']);
    }

    /**
     * Get the connection pool
     *
     * @return \TYPO3\CMS\Core\Database\ConnectionPool
     */
    protected function getConnectionPool()
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
