<?php

namespace CodingMs\Modules\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Thomas Deuling <typo3@coding.ms>, coding.ms
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Frontend invitation code repository
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class InvitationCodeRepository extends Repository
{
    /**
     * @param array $filter
     * @param bool $count
     * @return array|QueryResultInterface|int
     */
    public function findAllForBackendList(array $filter = [], $count = false)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->getQuerySettings()->setRespectStoragePage(false);
        //
        if (isset($filter['searchWord']) && $filter['searchWord'] !== '') {
            $constraintsSearchWord = [];
            $constraintsSearchWord[] = $query->like('code', '%' . $filter['searchWord'] . '%');
            $constraintsSearchWord[] = $query->like('first_name', '%' . $filter['searchWord'] . '%');
            $constraintsSearchWord[] = $query->like('last_name', '%' . $filter['searchWord'] . '%');
            $query->matching(
                $query->logicalOr($constraintsSearchWord)
            );
        }
        if (!$count) {
            if (isset($filter['sortingField']) && $filter['sortingField'] != '') {
                if ($filter['sortingOrder'] == 'asc') {
                    $query->setOrderings([$filter['sortingField'] => QueryInterface::ORDER_ASCENDING]);
                } else {
                    if ($filter['sortingOrder'] == 'desc') {
                        $query->setOrderings([$filter['sortingField'] => QueryInterface::ORDER_DESCENDING]);
                    }
                }
            }
            if ((int)$filter['limit'] > 0) {
                $query->setOffset((int)$filter['offset']);
                $query->setLimit((int)$filter['limit']);
            }
            return $query->execute();
        }
        return $query->execute()->count();
    }
}
