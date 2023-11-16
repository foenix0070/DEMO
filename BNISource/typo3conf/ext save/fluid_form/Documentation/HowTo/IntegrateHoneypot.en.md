# How to integrate a Honeypot

Just insert a hidden field, which is marked as *required* and add the *Empty* validator.

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic.fieldsets.complete.fields {
	required < plugin.tx_fluidform.presets.fields.honeypot
}
```

