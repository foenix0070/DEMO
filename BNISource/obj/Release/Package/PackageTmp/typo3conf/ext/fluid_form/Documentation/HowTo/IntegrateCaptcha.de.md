# Wie kann ein Captcha integriert werden

Füge einfach ein Captcha-Feld wie folgt hinzu:

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic.fieldsets.complete.fields {
    captcha < plugin.tx_fluidform.presets.fields.captcha
}
```
