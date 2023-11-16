# Automatic user-friendly URLs

To automatically create or update a user-friendly URL each time you save, use the following configuration:

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

This works for both create and edit forms.
