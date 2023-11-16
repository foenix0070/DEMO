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

use CodingMs\AdditionalTca\Domain\Model\Traits\CreationDateTrait;
use CodingMs\AdditionalTca\Domain\Model\Traits\DisableTrait;
use CodingMs\AdditionalTca\Domain\Model\Traits\EndtimeTrait;
use CodingMs\AdditionalTca\Domain\Model\Traits\ModificationDateTrait;
use CodingMs\AdditionalTca\Domain\Model\Traits\StarttimeTrait;
use CodingMs\Modules\Domain\Model\Traits\CheckMethodTrait;
use CodingMs\Modules\Domain\Model\Traits\ToCsvArrayTrait;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser as FrontendUserParent;

/**
 * Frontend user
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FrontendUser extends FrontendUserParent
{
    use CheckMethodTrait;
    use ToCsvArrayTrait;
    use CreationDateTrait;
    use ModificationDateTrait;
    use DisableTrait;
    use StarttimeTrait;
    use EndtimeTrait;

    /**
     * @var string
     */
    protected $gender = '';

    /**
     * @var \DateTime
     */
    protected $birthday;

    /**
     * @var string
     */
    protected $mobile = '';

    /**
     * @var string
     */
    protected $hash = '';

    /**
     * @var bool
     */
    protected $termsConfirmed = false;

    /**
     * @var bool
     */
    protected $privacyConfirmed = false;

    /**
     * @var bool
     */
    protected $disclaimerConfirmed = false;

    /**
     * @var bool
     */
    protected $newsletter = false;

    /**
     * @var string
     */
    protected $profession = '';

    /**
     * @var string
     */
    protected $maritalStatus = '';

    /**
     * @var int
     */
    protected $children = 0;

    /**
     * @var string
     */
    protected $recordType = '';

    /**
     * @var string
     */
    protected $bankAccountOwnerName = '';

    /**
     * @var string
     */
    protected $bankAccountBankName = '';

    /**
     * @var string
     */
    protected $bankAccountBic = '';

    /**
     * @var string
     */
    protected $bankAccountIban = '';

    /**
     * @var string
     */
    protected $accountingType = '';

    /**
     * @var string
     */
    protected $vatNumber = '';

    /**
     * @return array<string, string>
     */
    public function getEmailNameArray(): array
    {
        return [$this->getEmail() => $this->getName()];
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getBirthdayAsString()
    {
        if (isset($this->birthday)) {
            return $this->birthday->format('Y-m-d H:i:s');
        }
        return '';
    }

    /**
     * @return int
     */
    public function getYearOfBirth()
    {
        $year = (int)date('Y');
        if ($this->birthday instanceof \DateTime) {
            $year = (int)$this->birthday->format('Y');
        }
        return $year;
    }

    /**
     * @param mixed $birthday
     * @throws \Exception
     */
    public function setBirthday($birthday)
    {
        if (is_string($birthday)) {
            // YYYY-MM-DD
            $dateValues = explode('-', $birthday);
            $year = (int)$dateValues[0];
            $month = (int)$dateValues[1];
            $day = (int)$dateValues[2];
            $valueTimestamp = mktime(0, 0, 0, $month, $day, $year);
            if (!($this->birthday instanceof \DateTime)) {
                $this->birthday = new \DateTime();
            }
            $this->birthday->setTimestamp($valueTimestamp);
        } elseif ($birthday instanceof \DateTime) {
            $this->birthday = $birthday;
        } else {
            throw new \Exception('Unknown birthday format!');
        }
    }

    /**
     * @param int $year
     * @throws \Exception
     */
    public function setYearOfBirth($year)
    {
        $valueTimestamp = mktime(0, 0, 0, 1, 1, $year);
        if (!($this->birthday instanceof \DateTime)) {
            $this->birthday = new \DateTime();
        }
        $this->birthday->setTimestamp($valueTimestamp);
    }

    /**
     * Returns the age of the frontend user
     * @return int
     * @throws \Exception
     */
    public function getAge()
    {
        $age = 0;
        if ($this->birthday instanceof \DateTime) {
            $now = new \DateTime();
            $difference = $now->diff($this->birthday);
            $age = $difference->y;
        }
        return $age;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return bool
     */
    public function getTermsConfirmed()
    {
        return $this->termsConfirmed;
    }

    /**
     * @return bool
     */
    public function isTermsConfirmed()
    {
        return $this->termsConfirmed;
    }

    /**
     * @param bool $termsConfirmed
     */
    public function setTermsConfirmed($termsConfirmed)
    {
        $this->termsConfirmed = $termsConfirmed;
    }

    /**
     * @return bool
     */
    public function getPrivacyConfirmed()
    {
        return $this->privacyConfirmed;
    }

    /**
     * @return bool
     */
    public function isPrivacyConfirmed()
    {
        return $this->privacyConfirmed;
    }

    /**
     * @param bool $privacyConfirmed
     */
    public function setPrivacyConfirmed($privacyConfirmed)
    {
        $this->privacyConfirmed = $privacyConfirmed;
    }

    /**
     * @return bool
     */
    public function getDisclaimerConfirmed()
    {
        return $this->disclaimerConfirmed;
    }

    /**
     * @return bool
     */
    public function isDisclaimerConfirmed()
    {
        return $this->disclaimerConfirmed;
    }

    /**
     * @param bool $disclaimerConfirmed
     */
    public function setDisclaimerConfirmed($disclaimerConfirmed)
    {
        $this->disclaimerConfirmed = $disclaimerConfirmed;
    }

    /**
     * @return bool
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * @return bool
     */
    public function isNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * @param bool $newsletter
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param string $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @param string $maritalStatus
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    /**
     * @return int
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param int $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @return string
     */
    public function getRecordType(): string
    {
        return $this->recordType;
    }

    /**
     * @param string $recordType
     */
    public function setRecordType(string $recordType): void
    {
        $this->recordType = $recordType;
    }

    /**
     * @return string
     */
    public function getBankAccountOwnerName(): string
    {
        return $this->bankAccountOwnerName;
    }

    /**
     * @param string $bankAccountOwnerName
     */
    public function setBankAccountOwnerName(string $bankAccountOwnerName): void
    {
        $this->bankAccountOwnerName = $bankAccountOwnerName;
    }

    /**
     * @return string
     */
    public function getBankAccountBankName(): string
    {
        return $this->bankAccountBankName;
    }

    /**
     * @param string $bankAccountBankName
     */
    public function setBankAccountBankName(string $bankAccountBankName): void
    {
        $this->bankAccountBankName = $bankAccountBankName;
    }

    /**
     * @return string
     */
    public function getBankAccountBic(): string
    {
        return $this->bankAccountBic;
    }

    /**
     * @param string $bankAccountBic
     */
    public function setBankAccountBic(string $bankAccountBic): void
    {
        $this->bankAccountBic = $bankAccountBic;
    }

    /**
     * @return string
     */
    public function getBankAccountIban(): string
    {
        return $this->bankAccountIban;
    }

    /**
     * @param string $bankAccountIban
     */
    public function setBankAccountIban(string $bankAccountIban): void
    {
        $this->bankAccountIban = $bankAccountIban;
    }

    /**
     * @return string
     */
    public function getAccountingType(): string
    {
        return $this->accountingType;
    }

    /**
     * @param string $accountingType
     */
    public function setAccountingType(string $accountingType): void
    {
        $this->accountingType = $accountingType;
    }

    /**
     * @return string
     */
    public function getVatNumber(): string
    {
        return $this->vatNumber;
    }

    /**
     * @param string $vatNumber
     */
    public function setVatNumber(string $vatNumber): void
    {
        $this->vatNumber = $vatNumber;
    }
}
