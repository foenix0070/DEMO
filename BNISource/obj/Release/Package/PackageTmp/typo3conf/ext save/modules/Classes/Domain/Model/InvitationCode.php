<?php

namespace CodingMs\Modules\Domain\Model;

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

use TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Frontend user invitation codes
 */
class InvitationCode extends AbstractEntity
{
    /**
     * @var string
     */
    protected $code = '';

    /**
     * @var bool
     */
    protected bool $used = false;

    /**
     * @var ?\DateTime
     */
    protected ?\DateTime $usedAt = null;

    /**
     * @var ObjectStorage<FrontendUserGroup>
     */
    protected $usergroups;

    /**
     * @var string
     */
    protected string $firstName = '';

    /**
     * @var string
     */
    protected string $lastName = '';

    /**
     * @var string
     */
    protected string $company = '';

    /**
     * @var ?\DateTime
     */
    protected ?\DateTime $starttime;

    /**
     * @var ?\DateTime
     */
    protected ?\DateTime $endtime;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return bool
     */
    public function isUsed(): bool
    {
        return $this->used;
    }

    /**
     * @param bool $used
     */
    public function setUsed(bool $used): void
    {
        $this->used = $used;
    }

    /**
     * @return ?\DateTime
     */
    public function getUsedAt(): ?\DateTime
    {
        return $this->usedAt;
    }

    /**
     * @param \DateTime $usedAt
     */
    public function setUsedAt(\DateTime $usedAt): void
    {
        $this->usedAt = $usedAt;
    }

    /**
     * @return ObjectStorage
     */
    public function getUsergroups(): ?ObjectStorage
    {
        return $this->usergroups;
    }

    /**
     * @param ObjectStorage $usergroups
     */
    public function setUsergroups(ObjectStorage $usergroups): void
    {
        $this->usergroups = $usergroups;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    /**
     * @return ?\DateTime
     */
    public function getStarttime(): ?\DateTime
    {
        return $this->starttime;
    }

    /**
     * @param \DateTime $starttime
     */
    public function setStarttime(\DateTime $starttime): void
    {
        $this->starttime = $starttime;
    }

    /**
     * @return ?\DateTime
     */
    public function getEndtime(): ?\DateTime
    {
        return $this->endtime;
    }

    /**
     * @param \DateTime $endtime
     */
    public function setEndtime(\DateTime $endtime): void
    {
        $this->endtime = $endtime;
    }
}
