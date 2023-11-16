# Clear Frontend Cache 

You may have to empty specific pages out of the frontend cache when you create new objects or edit existing objects. Use the following configuration:

```typo3_typoscript
plugin.tx_openimmopro.settings.forms.immobilie {
	# ...
	#
	# Clear pages on saving
	# 0 -> No cache will be cleared
	# 3 -> Only page cache with uid 3 will be cleared
	# 3,4 -> Page cache with uid 3 and 4 will be cleared
	clearCachePages = {$themes.configuration.pages.address.list},{$themes.configuration.pages.address.detail}
    # ...
}
```

This works for both create and edit forms.
