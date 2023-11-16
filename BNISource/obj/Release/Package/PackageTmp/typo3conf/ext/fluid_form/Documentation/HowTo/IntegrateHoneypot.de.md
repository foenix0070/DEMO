# Wie kann ein Honeypot integriert werden

Füge einfach ein Hidden-Feld in deiner Form hinzu, welches als *required* markiert ist und einen *Empty* Validator bekommt.

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic.fieldsets.complete.fields {
	required < plugin.tx_fluidform.presets.fields.honeypot
}
```
