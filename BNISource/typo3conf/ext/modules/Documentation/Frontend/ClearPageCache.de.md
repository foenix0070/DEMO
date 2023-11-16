# Frontend-Cache leeren

Es kann vorkommen, dass Du den Frontend-Cache bestimmter Seiten leeren musst, wenn Du neue Objekte erstellst und vorhandene Objekte bearbeitest. Die erreichst Du mit der folgenden Konfiguration:


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

Diese funktioniert sowohl in der Erstellungs-Form als auch in der Bearbeitungs-Form.
