# Prefill hidden field with News-Title or similar data

Use a hidden field with section `ValueFromTypoScript`. The value field contains a marker name, in which the required Data string is written:

```typo3_typoscript
fields {
	objekttitle < plugin.tx_fluidform.presets.fields.hidden
	objekttitle {
		label = Immobilie
		section = ValueFromTypoScript
		value = lib.openimmo.objekttitel
	}
}
```

The marker can be filled as usual by a TypoScript `RECORD` object:

```typo3_typoscript
lib.openimmo.objekttitel = COA
lib.openimmo.objekttitel {
	wrap = This is the title:|
	10 = RECORDS
	10 {
		# id des template-records
		source = {GP:tx_openimmo_immobilie|immobilie}
		source.insertData = 1
		tables = tx_openimmo_domain_model_immobilie
		conf.tx_openimmo_domain_model_immobilie >
		conf.tx_openimmo_domain_model_immobilie = TEXT
		conf.tx_openimmo_domain_model_immobilie.field = objekttitel
	}
}
```
