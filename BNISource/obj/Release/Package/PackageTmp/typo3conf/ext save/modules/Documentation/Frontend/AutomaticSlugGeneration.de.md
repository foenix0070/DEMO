# Automatische Erstellung sprechender URLs

Um bei jedem Speichern automatisch eine sprechende URL zu erstellen oder auch zu aktualisieren benötigst Du die folgende Konfiguration:

```typo3_typoscript
plugin.tx_openimmopro.settings.forms.immobilie {
	# ...
	table = tx_openimmo_domain_model_immobilie
	#
	# Slug handling
	slug {
		# Enable auto generation for slugs
		active = 1
		# Database field for slug
		field = slug
		# Auto generate slug by using this fields
		fields = name,uid
	}
    # ...
}
```

Diese funktioniert sowohl in der Erstellungs-Form als auch in der Bearbeitungs-Form.
