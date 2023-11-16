# Neue Datensätze anlegen

In dieser Anleitung wollen wir ein Frontend-Management für Immobilien in einer Erweiterung integrieren. Unsere Eckdaten sind dabei:

*   **Extension-Key:** openimmo
*   **Objekt-Name:** Immobilie

## Erstellen von Datensätzen

Das Formular für die Erstellung von Datensätzen wird mit TypoScript definiert. Hierbei sollten alle Felder enthalten sein, die das Objekt mindestens benötigt. Z.B. sollte das *Slug* Feld enthalten sein.

**Configuration/TypoScript/Frontend/Library/frontend.form.immobilieCreate.typoscript**
```typo3_typoscript
plugin.tx_openimmopro.settings.forms.immobilieCreate {
	table = tx_openimmo_domain_model_immobilie
	#
	# Define a storage page uid, where the new records are stored
	storagePid = {$themes.configuration.container.openimmo}
	#
	# Slug handling
	slug {
		# Enable auto generation for slugs
		active = 1
		# Database field for slug
		field = slug
		# Auto generate slug by using this fields
		fields = name,uid
	}
	#
	# Default values, only processed by creation
	defaults {
		#
		# New records should be invisible
		hidden = 1
		# New records are not deleted
		# Ensure you've created the deleted property/getter/setter in your model!
		deleted = 0
	}
	messages {
		error {
			title = Error
			savingFailed = Please check your data.
		}
		success {
			title = Success
			successfullySaved = Your data was successfully saved.
		}
	}
	#
	# Each form can have multiple fieldsets
	fieldsets {
		#
		# Create a usual fieldset by initializing with a preset
		general < plugin.tx_modules.presets.fieldsets.normal
		general {
			label = General
			#
			# Each fieldset can have multiple fields
			fields {
				# Initialize field with default input
				objekttitel < plugin.tx_modules.presets.fields.input
				objekttitel {
					label = Title
					placeholder = Title...
					# Mark field as required
					required = 1
					validation {
						# Add the NonEmpty validator with custom message
						NotEmpty = Please enter a title
					}
				}
				objektnrExtern < plugin.tx_modules.presets.fields.input
				objektnrExtern {
					label = Objectno. (external)
					placeholder = 0815
					required = 1
					validation {
						NotEmpty = Please enter an objectnumber (external)
					}
				}
				# Initialize slug field
				slug < plugin.tx_modules.presets.fields.inputSlug
				slug {
					# Define the table for validate the slug
					table = tx_openimmo_domain_model_immobilie
				}
			}
		}
		#
		# Define some buttons below the form
		buttons < plugin.tx_modules.presets.fieldsets.buttons
		buttons {
			fields {
				# Insert the predefined submit button
				submit < plugin.tx_modules.presets.fields.submit
				submit {
					# Assign a custom label
					label = Create
				}
				# Insert the predefined cancel-and-back-to-list button
				cancelAndBackToListButton < plugin.tx_modules.presets.fields.cancelAndBackToListButton
			}
		}
	}
}
```

Die zugehörige *createAction*, welche die Logik zum Erstellen bereitstellt sieht wie folgt aus:

```php
class ImmobilieController extends FrontendBaseController
{

    /**
     * @throws StopActionException
     * @throws IllegalObjectTypeException
     * @throws Exception
     * @noinspection PhpUnused
     */
    public function createAction() {
        $this->prepareAction();
        //
        // Check if max items are reached
        $this->list['countAll'] = $this->objectRepository->findAllForFrontendList($this->list, true);
        if($this->list['countAll'] >= $this->list['maxItems'] && $this->list['maxItems'] > 0) {
            $this->addFlashMessage($this->list['messages']['error']['maxItemsReached'], $this->list['messages']['error']['title'], FlashMessage::ERROR);
            $this->forward('list');
        }
        if($this->request->hasArgument('submit')) {
            // Start validation of the form data
            $this->form = $this->validationService->validateForm($this->form, $this->request->getArguments());
            // Validation was successful?
            if ($this->form['valid'] === 0) {
                $this->addFlashMessage($this->form['messages']['error']['savingFailed'], $this->form['messages']['error']['title'], FlashMessage::ERROR);
            }
            else {
                $object = $this->objectManager->getEmptyObject(Immobilie::class);
                //
                // Set defaults
                if(isset($this->form['defaults']) && count($this->form['defaults']) > 0) {
                    foreach($this->form['defaults'] as $defaultName => $defaultValue) {
                        $setter = 'set' . ucfirst($defaultName);
                        if (method_exists($object, $setter)) {
                            $object->$setter($defaultValue);
                        }
                        else {
                            throw new Exception('Setter \'' . $setter . '\' not found!');
                        }
                    }
                }
                $object->setFrontendUser($this->frontendUser);
                if((int)$this->form['storagePid'] > 0) {
                    $object->setPid((int)$this->form['storagePid']);
                }
                else {
                    throw new Exception('Define a storagePid for saving your records!');
                }
                $this->persistCreateFormObject($this->form, $object);
                $this->addFlashMessage(
                    $this->form['messages']['success']['successfullySaved'],
                    $this->form['messages']['success']['title'],
                    FlashMessage::OK
                );
                $this->forward('list');
            }
        }
        $this->view->assign('formUid', 'immobilie-object');
        $this->view->assign('form', $this->form);
        $this->view->assign('frontendUser', $this->frontendUser);
        $this->view->assign('object', $this->object);
    }

}
```

In dieser Action werden die Eingaben entsprechend Deiner Konfiguration validiert, der Default-Wert gesetzt und der aktuelle Frontend-Benutzer zugewiesen. Für die Ausgabe im Frontend benötigst Du dann noch das folgende Fluid-Template:

**Resources/Private/Templates/Frontend/Immobilie/Create.html**
```xml
<div xmlns="http://www.w3.org/1999/xhtml" lang="en"
	 xmlns:f="http://typo3.org/ns/fluid/ViewHelpers"
	 xmlns:modules="http://typo3.org/ns/CodingMs/Modules/ViewHelpers">
	<f:layout name="Frontend"/>
	<f:section name="Main">

		<f:flashMessages />

		<f:form action="create" method="post">
			<f:for each="{form.fieldsets}" as="fieldset" key="fieldsetKey">
				<f:if condition="{fieldset.type} != ''">
					<f:then>
						<f:render partial="Fieldset/{fieldset.type}" section="{fieldset.section}" arguments="{_all}" />
					</f:then>
					<f:else>
						<f:debug title="Invalid configuration in {fieldsetKey}">{fieldset}</f:debug>
					</f:else>
				</f:if>
			</f:for>
		</f:form>

	</f:section>
</div>
```

Nach diesem Schritt solltest Du in der Lage sein, Objekte mit dem angemeldeten Frontend-Benutzer zu erstellen.
