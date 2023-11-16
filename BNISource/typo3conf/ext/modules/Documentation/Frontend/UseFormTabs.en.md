# Forms with tabs

To display an edit form with tabs create a tab configuration node containing tab nodes for each tab with associated label and fieldsets.

```typo3_typoscript
plugin.tx_openimmopro.settings.forms.immobilie {
	# ...
	tabs {
		general {
			label = General
			fieldsets = general,location,geoCoordinates,freitexte
		}
		pricesArea {
			label = Prices & Area
			fieldsets = prices,area
		}
		kontaktperson {
			label = Contact
			fieldsets = kontaktperson, infrastruktur
		}
		categorization {
			label = Categorization
			fieldsets = marketingMethod,usage,property
		}
	}
    # ...
}
```

## Error handling

The frontend management system can highlight tabs containing errors in red. To set this up add a `data-invalid-tab-class` data attribute to the tab `ul` .

```html
<ul class="nav nav-tabs" data-invalid-tab-class="alert-danger is-invalid">
```


## Fluid template for edit

An example Fluid template for the edit action looks as follows:

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
