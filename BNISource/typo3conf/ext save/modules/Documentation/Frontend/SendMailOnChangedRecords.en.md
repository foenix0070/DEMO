# Automatic email after records have been edited

If data records need to be checked after they have been edited an automatic email can be sent on saving of data records. This is configured as follows:


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

This works for both create and edit forms.
