# Eine Liste mit Datensätzen anlegen

In dieser Anleitung wollen wir ein Frontend-Management für Immobilien in einer Erweiterung integrieren. Unsere Eckdaten sind dabei:

*   **Extension-Key:** openimmo
*   **Objekt-Name:** Immobilie


## Datensatz-Liste erstellen

Für eine Datensatz-Liste benötigst Du Setup-TypoScript Konfiguration, welche wie folgt aussehen kann:

**Configuration/TypoScript/Frontend/Library/frontend.list.immobilie.typoscript**
```typo3_typoscript
plugin.tx_openimmopro.settings.lists.immobilie {
	#
	# Default sorting of the list
	sortingField = objektnr_extern
	sortingOrder = desc
	#
	# Limit for items used by the pagination
	limit = 20
	#
	# Max items of this object - 0 means no limit
	# If the amount of items is reached, the creation button will be hidden
	# and it's no longer possible to create more items!
	maxItems = 0
	#
	# Messages in list handling
	messages {
		info {
			# Displayed when no objects/entries are available
			noEntries = No objects found
			# Information message when max items are configured
			amountOfEntries = %1$d of %2$d objects created
		}
		success {
			# Title for all success messages
			title = Success
			objectActivated = Object is now activated!
			objectDeactivated = Object is now deactivated!
			objectDeleted = Object is now deleted!
		}
		error {
			# Title for all error messages
			title = Error
			# Error message when max items are reached
			maxItemsReached = Your maximum amount of objects reached!
		}
	}
	#
	# Configuration of the header
	header {
		#
		# Headline above the list
		title = Objects
		#
		# Additional action buttons above the list
		actions {
			#
			# Each action button gets a unique key
			create {
				# Label of the action button
				label = Create
				# Title on mouse over
				title = Create a new objects
				# Action, which is called on the related FrontendController
				action = Create
				# Icon identifier
				iconIdentifier = actions-document-new
			}
		}
	}
	#
	# Configuration of the list columns
	# Each configuration node represents a column
	fields {
		#
		# The node key corresponds with a getter of the display object (DB field)
		objekttitel {
			label = Title
			format = Plain
			sortable = 1
		}
		objektnrExtern {
			label = Objectno. (external)
			format = Plain
			sortable = 1
		}
	}
	actions {
		edit {
			label =
			title = Edit this object
			action = Edit
			iconIdentifier = actions-document-open
		}
		show {
			label =
			title = Show this object in frontend
			action = Show
			controller = Bookings
			pageUid = {$themes.configuration.pages.bookings.details}
			extensionName = bookings
			pluginName = BookingObject
			parameter = bookingObject
			iconIdentifier = actions-document-view
		}
		hidden {
			# Model muss hidden property/getter/setter haben
			# Des Weiteren TCA entry
			action = Hidden
			label {
				hide =
				show =
			}
			title {
				hide = Deactivate object
				show = Activate object
			}
			iconIdentifier {
				hide = actions-edit-hide
				show = actions-edit-unhide
			}
		}
		delete {
			# Model muss deleted property/getter/setter haben
			label =
			title = Delete this object
			action = Delete
			iconIdentifier = actions-delete
			confirmation = Really delete this object?!
		}
	}
}
```

Die zugehörige *listAction*, welche die Liste verarbeitet sieht wie folgt aus:

```php
class ImmobilieController extends FrontendBaseController
{

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
        if($this->request->hasArgument('sortingField')) {
            $this->list['sortingField'] = trim($this->request->getArgument('sortingField'));
        }
        if($this->request->hasArgument('sortingOrder')) {
            $sortingOrder = trim($this->request->getArgument('sortingOrder'));
            $this->list['sortingOrder'] = ($sortingOrder === 'desc') ? 'desc' : 'asc';
        }
        if($this->request->hasArgument('offset')) {
            $this->list['offset'] = (int)$this->request->getArgument('offset');
        }
        if($this->request->hasArgument('limit')) {
            $this->list['limit'] = (int)$this->request->getArgument('limit');
        }
        //
        $this->list['pid'] = $this->pageUid;
        $immobilies = $this->objectRepository->findAllForFrontendList($this->list);
        $this->list['countAll'] = $this->objectRepository->findAllForFrontendList($this->list, true);
        //
        $this->view->assign('list', $this->list);
        $this->view->assign('immobilies', $immobilies);
        $this->view->assign('frontendUser', $this->frontendUser);
    }

}
```

In dieser Action werden die Sortierungs- und Paginations-Parameter verarbeitet und dann das Ergebnis abgerufen. Für die Ausgabe im Frontend benötigst Du dann noch das folgende Fluid-Template:

**Resources/Private/Templates/Frontend/Immobilie/List.html**
```xml
<div xmlns="http://www.w3.org/1999/xhtml" lang="en"
	 xmlns:f="http://typo3.org/ns/fluid/ViewHelpers"
	 xmlns:modules="http://typo3.org/ns/CodingMs/Modules/ViewHelpers">
	<f:layout name="Frontend"/>
	<f:section name="Main">

		<f:flashMessages />
		<f:render partial="Table/Table" arguments="{list: list, data: immobilies}" />

	</f:section>
</div>
```

Nach diesem Schritt sollte Deine Liste bereits funktionieren.


