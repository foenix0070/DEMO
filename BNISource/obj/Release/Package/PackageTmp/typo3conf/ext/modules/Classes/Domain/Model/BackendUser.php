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
use CodingMs\AdditionalTca\Domain\Model\Traits\ModificationDateTrait;
use CodingMs\Modules\Domain\Model\Traits\CheckMethodTrait;
use CodingMs\Modules\Domain\Model\Traits\ToCsvArrayTrait;
use TYPO3\CMS\Beuser\Domain\Model\BackendUser as BackendUserParent;

/**
 * Backend user
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class BackendUser extends BackendUserParent
{
    use CheckMethodTrait;
    use ToCsvArrayTrait;
    use CreationDateTrait;
    use ModificationDateTrait;
    use DisableTrait;
}
