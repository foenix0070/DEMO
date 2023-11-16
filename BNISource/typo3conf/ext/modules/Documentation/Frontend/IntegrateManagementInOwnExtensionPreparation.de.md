# Vorbereitung

In dieser Anleitung wollen wir ein Frontend-Management für Immobilien in einer Erweiterung integrieren. Unsere Eckdaten sind dabei:

*   **Extension-Key:** openimmo
*   **Objekt-Name:** Immobilie



## Vorbereitungen

Folgende Punkte müssen vorbereitet werden:

*   Frontend-Controller erstellen
*   Plugin integrieren
*   TypoScript Konfiguration bereitstellen
*   Datenmodel anpassen
*   Repository anpassen
*   Einrichtung im TYPO3



### Frontend-Controller erstellen

Es muss ein Frontend-Controller bereitgestellt werden, welcher die Actions *prepare, list, edit und create* bereitstellt. Dieser Controller erbt von `\CodingMs\Modules\Controller\FrontendController` als `FrontendBaseController`. Hierin muss u.a. auch die Zugriffs-Restriktion stattfinden. Dieser Controller sollte am besten den Namen des Objektes bekommen, welches mit diesem bearbeitet wird - daher heißt er hier `ImmobilieController`.

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




### Plugin integrieren

Es muss ein Plugin integriert werden, über welches später die Bearbeitung stattfindet.

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



### TypoScript Konfiguration bereitstellen

Da die hauptsächliche Konfiguration via TypoScript stattfindet, muss hier auch ein statisches Template bereitgestellt werden. Dafür erstellen wir die folgende Verzeichnisstruktur:

```text
openimmo_pro/Configuration/TypoScript/Frontend/
openimmo_pro/Configuration/TypoScript/Frontend/Library/
openimmo_pro/Configuration/TypoScript/Frontend/Translation/
```

Im Verzeichnis `Configuration/TypoScript/Frontend/` wird eine Datei `setup.typoscript` mit dem folgenden Inhalt erstellt:

```typo3_typoscript
<INCLUDE_TYPOSCRIPT: source="DIR:EXT:openimmo_pro/Configuration/TypoScript/Frontend/Library/" extensions="typoscript">
<INCLUDE_TYPOSCRIPT: source="DIR:EXT:openimmo_pro/Configuration/TypoScript/Frontend/Translation/" extensions="typoscript">
```

Bereitgestellt wird das statische Template dann durch eine Einbindung in der *ext_tables.php*:

**ext_tables.php**
```php
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'openimmo_pro',
    'Configuration/TypoScript/Frontend',
    'Openimmo-Pro - Frontend management'
);
```

Damit Deine Fluid-Templates später auch Partials von der Modules-Erweiterung verwenden können, musst Du die Fluid-Template-Pfad in der bereits bestehende Definition hinzufügen:

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

Wir haben dies jeweils im Knoten mit dem Index 100 gemacht.



### Datenmodel anpassen

Da unsere Datensätze nur mit einen gültigen Frontend-Benutzer bearbeitet werden können, müssen wir ein Feld bzw. eine Eigenschaft für den Frontend-Benutzer hinzufügen.

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



### Repository anpassen

Damit unser Controller alle notwendigen Aktionen ausführen kann, müssen ein paar Methoden am `ImmobilieRepository` hinzugefügt werden. Hierbei handelt es sich um eine Methode für die Liste und um eine Methode um einen Datensatz abzurufen. Wichtig dabei ist, dass diese immer den aktuellen Frontend-Benutzer mit abfragen!

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



### Einrichtung im TYPO3

Nachdem diese Anpassungen im TYPO3 verfügbar sind, erstellst Du eine geschütze Seite, auf der nur Frontend-Benutzer mit entsprechender Berechtigung zugriff drauf haben. Hier platzierst Du das gerade erstellte Plugin und erstellst zusätzlich ein Erweiterungs-Template. In diesem TypoScript-Template wählst Du die statischen Templates `Frontend-Basics (modules)` und `Openimmo-Pro - Frontend management (openimmo_pro)` aus.

In diesem Template können später auch Anpassungen speziell für Dein jeweiliges Webseit-Projekt vorgenommen werden. Im nächsten Abschnitt erfahrst Du, wie Du mit ein wenig TypoScript eine Bearbeitungs-Liste konfigurieren kannst.
