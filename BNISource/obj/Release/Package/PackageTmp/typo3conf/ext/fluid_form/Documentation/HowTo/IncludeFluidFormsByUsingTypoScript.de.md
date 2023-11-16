# Fluid-Forms mit TypoScript einbinden

Der folgende Setup-TypoScript generiert einen Marker zur Einbindung:

```typo3_typoscript
# First, configure the form
plugin.tx_fluidform.settings.forms.callBack.configuration.addQueryString = 1
# In case of using TYPO3 < 7.6
# includeLibs.tx_extbase_dispatcher = EXT:extbase/class.tx_extbase_dispatcher.php
# Afterwards, write into marker
lib.form.callBack = USER_INT
lib.form.callBack {
	userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
	extensionName = FluidForm
	pluginKey = Form
	pluginName = Form
	vendorName = CodingMs
	controller = FluidForm
	action = show
	view < plugin.tx_fluidform.view
	persistence < plugin.tx_fluidform.persistence
	settings < plugin.tx_fluidform.settings
	settings {
		# Select a form, from the defined ones!
		form = callBack
		# Set a unique identifier
		formUid = footer
	}
}
```

Verwendung des Markers im TypoScript:

```xml
<f:cObject typoscriptObjectPath="lib.form.callBack" />
```
