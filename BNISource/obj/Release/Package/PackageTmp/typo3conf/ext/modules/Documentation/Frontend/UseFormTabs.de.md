# Formulare mit Tabs

Um die Bearbeitungs-Formular mit Tabs darzustellen, benötigst Du nur einen Tab-Konfigurationsknoten. Darin enthalten ist je ein Knoten für einen Tab welcher ein Label und die darin enthaltenen Fieldsets:

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

## Fehlerbehandlung

Das Frontend-Management ist in der Lage Tabs die einen Fehler enthalten entsprechend rot zu hinterlegen. Hierfür muss im `ul` der Tabs ein Data-Attribut mit dem Namen `data-invalid-tab-class` angegeben werden.

```html
<ul class="nav nav-tabs" data-invalid-tab-class="alert-danger is-invalid">
```


## Edit Fluid-Template

Ein Fluid-Template für die Edit-Action könnte somit wie folgt aussehen:

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
