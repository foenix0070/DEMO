# Vorbefüllen eines Hidden-Feld mit einem News-Titel o.ä.

Verwende ein Hidden-Feld mit dem Wert `ValueFromTypoScript`. Der Wert bekommt einen Marker-Namen zugewiesen, welcher den erforderlichen Daten-String enthält.

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

Der Marker kann wie gewöhnlich mit einem `RECORD` TypoScript object befüllt werden:

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
