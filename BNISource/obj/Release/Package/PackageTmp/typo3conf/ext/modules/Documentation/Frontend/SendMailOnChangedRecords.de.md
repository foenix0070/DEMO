# E-Mail versenden wenn Datensätze angepasst werden

Wenn es erforderlich ist, dass Du neue oder veränderte Datensätze prüfen musst, kannst Du Dir eine Mail schicken lassen, wenn Datensätze gespeichert werden. Die erreichst Du mit der folgenden Konfiguration:


```typo3_typoscript
plugin.tx_openimmopro.settings.forms.immobilie {
	#
	# Notify admin about inserted/updated records
	mailOnSave {
		# Enable notification mail on saving records
		active = 0
		subject = Record address saved on www.coding.ms
		fromEmail = typo3@coding.ms
		toEmail = typo3@coding.ms
	}
}
```

Diese funktioniert sowohl in der Erstellungs-Form als auch in der Bearbeitungs-Form.
