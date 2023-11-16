# How to integrate a Captcha

Just insert a Captcha field as following.

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic.fieldsets.complete.fields {
	captcha < plugin.tx_fluidform.presets.fields.captcha
}
```
