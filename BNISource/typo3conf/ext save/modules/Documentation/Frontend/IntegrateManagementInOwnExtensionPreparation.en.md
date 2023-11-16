# Preperations

This guide covers how to add frontend management for real estate records to an extension. The key parameters are:

*   **Extension-Key:** openimmo
*   **Object-Name:** Immobilie



## Before you add frontend management

Make sure you have done the following:

*   Create Frontend Controller
*   Integrate Plugin
*   Configure TypoScript
*   Modify data model
*   Modify repository
*   Set up in TYPO3



### Create frontend controller

You will need a frontend controller with  *prepare, list, edit und create* actions. The controller is derived from `\CodingMs\Modules\Controller\FrontendController` as `FrontendBaseController`. The class is responsible for things such as access control. The name of the controller should have the same name as the object which it is responsible for - in this case `ImmobilieController`.

**Classes/Controller/Frontend/ImmobilieController.php**
```php
<?php

namespace CodingMs\OpenimmoPro\Controller\Frontend;

use CodingMs\Openimmo\Domain\Model\Immobilie;
use CodingMs\Openimmo\Domain\Repository\ImmobilieRepository;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use CodingMs\Modules\Controller\FrontendController as FrontendBaseController;
use Exception;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;

/**
 * Immobilie Controller
 * @noinspection PhpUnused
 */
class ImmobilieController extends FrontendBaseController
{

    /**
     * @var Immobilie
     */
    protected $object = null;

    /**
     * @var ImmobilieRepository
     */
    protected $objectRepository;

    /**
     * @param ImmobilieRepository $objectRepository
     * @noinspection PhpUnused
     */
    public function injectObjectRepository(ImmobilieRepository $objectRepository)
    {
        $this->objectRepository = $objectRepository;
    }

    /**
     * @throws NoSuchArgumentException
     * @throws StopActionException
     */
    protected function prepareAction()
    {
        parent::prepareAction();
        $action = $this->request->getControllerActionName();
        //
        $this->list = $this->settings['lists']['immobilie'];
        $this->list['limit'] = $this->list['limit'] ?? 0;
        $this->list['offset'] = $this->list['offset'] ?? 0;
        $this->list['maxItems'] = $this->list['maxItems'] ?? 0;
        if($action === 'create') {
            $this->form = $this->settings['forms']['immobilieCreate'];
        }
        else {
            $this->form = $this->settings['forms']['immobilie'];
        }
        //
        // On this actions an object is required!
        if(in_array($action, $this->objectRequiredActions)) {
            if ($this->frontendUser->getUid() !== $this->object->getFrontendUser()->getUid()) {
                $this->addFlashMessage('Object not found (code:3)', 'Error', FlashMessage::ERROR);
                $this->forward('list');
            }
        }
        $this->list['frontendUser'] = $this->frontendUser;
    }

    /**
     * action list
     *
     * @return void
     * @throws NoSuchArgumentException
     * @throws StopActionException
     */
    public function listAction()
    {
        $this->prepareAction();
        // ...
    }

    /**
     * @throws Exception
     */
    public function editAction() {
        $this->prepareAction();
        // ...
    }

    /**
     * @throws StopActionException
     * @throws IllegalObjectTypeException
     * @throws Exception
     * @noinspection PhpUnused
     */
    public function createAction() {
        $this->prepareAction();
        // ...
    }

    /**
     * @param $key
     * @param array $arguments
     * @return NULL|string
     */
    protected function translate($key, $arguments = [])
    {
        return LocalizationUtility::translate($key, 'OpenimmoPro', $arguments);
    }

}
```




### Integrate a plugin

You will need to integrate a plugin which will do the processing.


**ext_tables.php**
```php
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'OpenimmoPro',
    'FrontendImmobilie',
    'Openimmo - Management'
);
```

**ext_localconf.php**
```php
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'OpenimmoPro',
    'FrontendImmobilie',
    ['Frontend\Immobilie' => 'list,create,edit,activate,deactivate,duplicate,delete'],
    ['Frontend\Immobilie' => 'list,create,edit,activate,deactivate,duplicate,delete']
);
```



### Configure TypoScript

The main configuration is in TypoScript so you will need to provide a static TypoScript template for the plugin. Set up the directory structure as follows:

```text
openimmo_pro/Configuration/TypoScript/Frontend/
openimmo_pro/Configuration/TypoScript/Frontend/Library/
openimmo_pro/Configuration/TypoScript/Frontend/Translation/
```

Create a file `setup.typoscript` in the `Configuration/TypoScript/Frontend/` directory containing the following:

```typo3_typoscript
<INCLUDE_TYPOSCRIPT: source="DIR:EXT:openimmo_pro/Configuration/TypoScript/Frontend/Library/" extensions="typoscript">
<INCLUDE_TYPOSCRIPT: source="DIR:EXT:openimmo_pro/Configuration/TypoScript/Frontend/Translation/" extensions="typoscript">
```

Link in the static template in *ext_tables.php*:

**ext_tables.php**
```php
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'openimmo_pro',
    'Configuration/TypoScript/Frontend',
    'Openimmo-Pro - Frontend management'
);
```

Add the Fluid template path to the existing TypoScript definition so that your Fluid templates can use Partials from the Modules extension:

```typo3_typoscript
plugin.tx_openimmopro {
	view {
		templateRootPaths {
			100 = EXT:modules/Resources/Private/Templates/
			200 = EXT:openimmo/Resources/Private/Templates/
			250 = EXT:openimmo_pro/Resources/Private/Templates/
			300 = {$plugin.tx_openimmo.view.templateRootPath}
			400 = {$themes.resourcesPrivatePath}Extensions/Openimmo/Templates/
		}
		partialRootPaths {
			100 = EXT:modules/Resources/Private/Partials/
			200 = EXT:openimmo/Resources/Private/Partials/
			250 = EXT:openimmo_pro/Resources/Private/Partials/
			300 = {$plugin.tx_openimmo.view.partialRootPath}
			400 = {$themes.resourcesPrivatePath}Extensions/Openimmo/Partials/
		}
		layoutRootPaths {
			100 = EXT:modules/Resources/Private/Layouts/
			200 = EXT:openimmo/Resources/Private/Layouts/
			250 = EXT:openimmo_pro/Resources/Private/Layouts/
			300 = {$plugin.tx_openimmo.view.layoutRootPath}
			400 = {$themes.resourcesPrivatePath}Extensions/Openimmo/Layouts/
		}
	}
}
```

In the example above the paths have been added as nodes with an index of 100



### Modify the data model

The data records can only be edited by a valid frontend user so we need to add a field/property for frontend user.

**Configuration/TCA/tx_openimmo_domain_model_immobilie.php**
```php
$GLOBALS['TCA']['tx_openimmo_domain_model_immobilie'] = [
    // ...
    'types' => [
        '1' => [
            'showitem' => '..., frontend_user',
        ],
    ],
    // ...
    'columns' => [
        // ...
        'frontend_user' => [
            'exclude' => 0,
            'label' => $lll . '.frontend_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'foreign_table' => 'fe_users',
                'size' => '1',
                'maxitems' => '1',
                'minitems' => '0',
                'eval' => 'int',
            ],
        ],
    ],
];
```

**Classes/Domain/Model/Immobilie.php**
```php
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

class Immobilie extends AbstractEntity
{

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $frontendUser = null;

    /**
     * Returns the frontend user
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    public function getFrontendUser(): ?FrontendUser
    {
        return $this->frontendUser;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $frontendUser
     */
    public function setFrontendUser(FrontendUser $frontendUser) : void
    {
        $this->frontendUser = $frontendUser;
    }

    /**
     * @var bool
     */
    protected $deleted = true;

    /**
     * @return bool
     */
    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @var boolean
     */
    protected $hidden;

    /**
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

}
```

**ext_tables.sql**
```sql
CREATE TABLE tx_openimmo_domain_model_immobilie (
    # ...
	frontend_user int(11) DEFAULT '0' NOT NULL,
    # ...
}
```



### Modify the repository

We need to add methods to the `ImmobilieRepository` so that our controller is able to execute the actions. We need a method for the list and a method to call up a record. The current frontend user must always be included in the query!

**Classes/Domain/Repository/ImmobilieRepository.php**
```php
class ImmobilieRepository extends Repository
{

    /**
     * @param array $filter
     * @param boolean $count
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface|int
     */
    public function findAllForFrontendList(array $filter = [], $count = false)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->getQuerySettings()->setRespectStoragePage(true);
        $constraints = [];
        $constraints[] = $query->equals('frontendUser', $filter['frontendUser']->getUid());
        $query->matching($constraints[0]);
        if (!$count) {
            if (isset($filter['sortingField']) && $filter['sortingField'] !== '') {
                if ($filter['sortingOrder'] === 'asc') {
                    $query->setOrderings([$filter['sortingField'] => QueryInterface::ORDER_ASCENDING]);
                } else {
                    if ($filter['sortingOrder'] === 'desc') {
                        $query->setOrderings([$filter['sortingField'] => QueryInterface::ORDER_DESCENDING]);
                    }
                }
            }
            if ((int)$filter['limit'] > 0) {
                $query->setOffset((int)$filter['offset']);
                $query->setLimit((int)$filter['limit']);
            }
            return $query->execute();
        } else {
            return $query->execute()->count();
        }
    }

    /**
     * @param int $uid
     * @return object
     */
    public function findByIdentifierFrontend(int $uid, int $frontendUser)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->getQuerySettings()->setRespectStoragePage(true);
        $constraints = [];
        $constraints[] = $query->equals('uid', $uid);
        $constraints[] = $query->equals('frontendUser', $frontendUser);
        $query->matching($query->logicalAnd($constraints));
        return $query->execute()->getFirst();
    }

}
```



### Set up in TYPO3

When these changes have been made create a protected page in TYPO3 that can only be accessed by frontend users with the correct permissions. Place the plugin you have just created on this page and create a new extension template. In the extension template select `Frontend-Basics (modules)` and `Openimmo-Pro - Frontend management (openimmo_pro)` as static templates.

You can use this extension template to make any other necessary modifications to your website project. The next section will show you how you can use minimal TypoScript to configure a list of records.
