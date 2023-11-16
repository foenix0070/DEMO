<?php

namespace CodingMs\FluidForm\Domain\Session;

use TYPO3\CMS\Core\SingletonInterface;

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

/**
 * Session Handling
 *
 * @license www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 * Version: 1.2.0
 * ChangeLog:
 * *    restorFromSession returned always an error - in case of errors too.
 */
class SessionHandler implements SingletonInterface
{
    /**
     * Return stored session data
     * @param string $extension
     * @return array Session data
     */
    public function restoreFromSession($extension = 'fluid_form')
    {
        $session = [];
        if (isset($GLOBALS['TSFE']->fe_user)) {
            $sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_' . $extension);
            $unserialized = unserialize($sessionData);
            if (is_array($unserialized)) {
                $session = $unserialized;
            }
        }
        return $session;
    }

    /**
     * Write session data
     * @param array|object $object any serializable object to store into the session
     * @param string $extension
     * @return SessionHandler this
     */
    public function writeToSession($object, $extension = 'fluid_form')
    {
        if (isset($GLOBALS['TSFE']->fe_user)) {
            $sessionData = serialize($object);
            $GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_' . $extension, $sessionData);
            $GLOBALS['TSFE']->fe_user->storeSessionData();
        }
        return $this;
    }

    /**
     * Clean up session
     * @param string $extension
     * @return SessionHandler this
     * @noinspection PhpUnused
     */
    public function cleanUpSession($extension = 'fluid_form')
    {
        if (isset($GLOBALS['TSFE']->fe_user)) {
            $GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_' . $extension, null);
            $GLOBALS['TSFE']->fe_user->storeSessionData();
        }
        return $this;
    }
}
