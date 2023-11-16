<?php

namespace CodingMs\Modules\Domain\Model\Traits;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2019 Thomas Deuling <typo3@coding.ms>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use CodingMs\Modules\Domain\Model\FrontendUserGroup;
use DateTime;
use Exception;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

trait ToCsvArrayTrait
{
    /**
     * Convert record data to CSV row
     *
     * @param array<string, mixed> $list
     * @return array<string, mixed>
     * @throws Exception
     */
    public function toCsvArray(array $list=[]): array
    {
        $array = [];
        foreach ($list['fields'] as $key=>$options) {
            // Try to catch non-existing class methods
            try {
                if ((int)$options['hideInExport'] === 1) {
                    continue;
                }
                $array[$key] = '';
                //
                if (isset($options['exportGetter'])) {
                    //
                    // Cell has a special defined getter for the data
                    $firstMethod = $this->checkMethod($this, $options['exportGetter']);
                    $array[$key] = $this->$firstMethod();
                } else {
                    //
                    // Cell should use the default getter for the data
                    $keyParts = explode('.', $key);
                    if (count($keyParts)==2) {
                        $firstMethod = $this->checkMethod($this, $keyParts[0]);
                        $object = $this->$firstMethod();
                        // Is a lazy object?!
                        if ($object instanceof LazyLoadingProxy) {
                            $object = $object->_loadRealInstance();
                        }
                        $secondMethod = $this->checkMethod($object, $keyParts[1]);
                        $array[$key] = $this->$firstMethod()->$secondMethod();
                    } elseif (count($keyParts)==1) {
                        $firstMethod = $this->checkMethod($this, $keyParts[0]);
                        $array[$key] = $this->$firstMethod();
                    }
                }
                //
                // Format value
                switch ($options['format']) {
                    case 'DateTime':
                        if ($array[$key] instanceof DateTime) {
                            $array[$key] = $array[$key]->format($options['dateFormat']);
                        }
                        break;
                    case 'FrontendUser/Group':
                        $userGroups = [];
                        /** @var FrontendUserGroup $userGroup */
                        foreach ($this->getUsergroup() as $userGroup) {
                            $userGroups[] = $userGroup->getTitle();
                        }
                        $array[$key] = implode(', ', $userGroups);
                        break;
                    default:
                        $array[$key] = strip_tags($array[$key]);
                }
            }
            //
            // Non-existing class methods found?!
            catch (Exception $e) {
                // Write the exception message into the cell
                $message = 'Error in settings.' . $list['id'] . '.fields.' . str_replace('.', '_', $key) . "\n";
                $array[$key] = $message . $e->getMessage();
            }
        }
        return $array;
    }
}
