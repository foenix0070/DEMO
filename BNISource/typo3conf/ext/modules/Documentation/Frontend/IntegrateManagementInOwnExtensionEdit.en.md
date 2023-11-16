# Editing records

This guide covers how to add frontend management for real estate records to an extension. The key parameters are:

*   **Extension-Key:** openimmo
*   **Object-Name:** Immobilie

## Editing records

The form used to edit data records is defined in TypoScript.

**Configuration/TypoScript/Frontend/Library/frontend.form.immobilie.typoscript**
```typo3_typoscript
plugin.tx_openimmopro.settings.forms.immobilie {
	table = tx_openimmo_domain_model_immobilie
	#
	# Slug handling
	slug {
		# Enable auto generation for slugs
		active = 1
		# Database field for slug
		field = slug
		# Auto generate slug by using this fields
		fields = title,uid
	}
	#
	# Notify admin about inserted/updated records
	mailOnSave {
		# Enable notification mail on saving records
		active = 0
		subject = Record address saved on www.coding.ms
		fromEmail = typo3@coding.ms
		toEmail = typo3@coding.ms
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
	fieldsets {
		general < plugin.tx_modules.presets.fieldsets.normal
		general {
			label = General
			fields {
				hidden < plugin.tx_modules.presets.fields.checkboxHidden
				objekttitel < plugin.tx_modules.presets.fields.input
				objekttitel {
					label = Title
					placeholder = Title...
					required = 1
					validation {
						NotEmpty = Please enter a title
					}
				}
				objektnrExtern < plugin.tx_modules.presets.fields.input
				objektnrExtern {
					label = Objectno. (external)
					# Display field as readonly
					readonly = 1
					# Because we've a readonly field, we don't need a validation
				}
				slug < plugin.tx_modules.presets.fields.inputSlug
				slug {
					table = tx_openimmo_domain_model_immobilie
				}
			}
		}

		buttons < plugin.tx_modules.presets.fieldsets.buttons
		buttons {
			fields {
				submit < plugin.tx_modules.presets.fields.submit
				cancelAndBackToListButton < plugin.tx_modules.presets.fields.cancelAndBackToListButton
			}
		}
	}
}
```

The logic is contained in the corresponding *editAction* function, as shown below:

```php
class ImmobilieController extends FrontendBaseController
{

    /**
     * @throws Exception
     */
    public function editAction() {
        $this->prepareAction();
        if($this->request->hasArgument('submit')) {
            // Read selectbox/checkboxes values from relations without select/check values
            $this->form = $this->prepareFormArray($this->form, $this->object, false);
            // Start validation of the form data
            $this->form = $this->validationService->validateForm($this->form, $this->request->getArguments(), $this->object);
            // Validation was successful?
            if ($this->form['valid'] === 0) {
                $this->addFlashMessage($this->form['messages']['error']['savingFailed'], $this->form['messages']['error']['title'], FlashMessage::ERROR);
            }
            else {
                $this->persistFormObject($this->form, $this->object);
                $this->addFlashMessage($this->form['messages']['success']['successfullySaved'], $this->form['messages']['success']['title'], FlashMessage::OK);
            }
        }
        else {
            // Pre fill object values
            $this->form = $this->objectValuesIntoFormArray($this->form);
            // Read selectbox/checkboxes values from relations and select/check values
            $this->form = $this->prepareFormArray($this->form, $this->object);
        }
        //
        $this->view->assign('formUid', 'immobilie-object');
        $this->view->assign('form', $this->form);
        $this->view->assign('frontendUser', $this->frontendUser);
        $this->view->assign('object', $this->object);
    }

}
```

The edit funtion validates user input against your configuration and updates the record. For display in the frontend you will then need the following Fluid template:

**Resources/Private/Templates/Frontend/Immobilie/Edit.html**
```xml
<div xmlns="http://www.w3.org/1999/xhtml" lang="en"
	 xmlns:f="http://typo3.org/ns/fluid/ViewHelpers"
	 xmlns:modules="http://typo3.org/ns/CodingMs/Modules/ViewHelpers">
	<f:layout name="Frontend"/>
	<f:section name="Main">

		<f:flashMessages />

		<f:form action="edit" method="post" arguments="{object: object}" enctype="multipart/form-data">

			<f:if condition="{f:count(subject: form.tabs)}">
				<f:then>

					<ul class="nav nav-tabs" data-invalid-tab-class="alert-danger is-invalid">
						<f:for each="{form.tabs}" as="tab" key="tabKey" iteration="tabIterator">
							<f:if condition="{tabIterator.isFirst}">
								<f:then>
									<li class="nav-item active">
										<a class="nav-link" data-toggle="tab" href="#{formUid}-{tabKey}">{tab.label}</a>
									</li>
								</f:then>
								<f:else>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#{formUid}-{tabKey}">{tab.label}</a>
									</li>
								</f:else>
							</f:if>
						</f:for>
					</ul>

					<div class="tab-content">
						<f:for each="{form.tabs}" as="tab" key="tabKey" iteration="tabIterator">
							<f:if condition="{tabIterator.isFirst}">
								<f:then>
									<div class="tab-pane active" id="{formUid}-{tabKey}">
										<div class="row">
											<f:for each="{tab.fieldsets}" as="tabFieldset">
												<f:for each="{form.fieldsets}" as="fieldset" key="fieldsetKey">
													<f:if condition="{tabFieldset} == {fieldsetKey}">
														<f:render section="Fieldset" arguments="{_all}" />
													</f:if>
												</f:for>
											</f:for>
										</div>
									</div>
								</f:then>
								<f:else>
									<div class="tab-pane" id="{formUid}-{tabKey}">
										<div class="row">
											<f:for each="{tab.fieldsets}" as="tabFieldset">
												<f:for each="{form.fieldsets}" as="fieldset" key="fieldsetKey">
													<f:if condition="{tabFieldset} == {fieldsetKey}">
														<f:render section="Fieldset" arguments="{_all}" />
													</f:if>
												</f:for>
											</f:for>
										</div>
									</div>
								</f:else>
							</f:if>
						</f:for>
					</div>

					<div class="row">
						<f:for each="{form.fieldsets}" as="fieldset" key="fieldsetKey">
							<f:if condition="{fieldset.type} == 'Button'">
								<f:render section="Fieldset" arguments="{_all}" />
							</f:if>
						</f:for>
					</div>

				</f:then>
				<f:else>

					<div class="row">
						<f:for each="{form.fieldsets}" as="fieldset" key="fieldsetKey">
							<f:render section="Fieldset" arguments="{_all}" />
						</f:for>
					</div>

				</f:else>
			</f:if>

		</f:form>

	</f:section>

	<f:section name="Fieldset">
		<f:if condition="{fieldset.type} != ''">
			<f:then>
				<f:render partial="Fieldset/{fieldset.type}" section="{fieldset.section}" arguments="{_all}" />
			</f:then>
			<f:else>
				<f:debug title="Invalid configuration in {fieldsetKey}">{fieldset}</f:debug>
			</f:else>
		</f:if>
	</f:section>
</div>
```

After completing this step you can now edit objects using a frontend user login.
