# JavaScript-Events

Generell können die vorhandenen JavaScript Events wie folgt schnell im TypoScript verwendet werden:

```typo3_typoscript
plugin.tx_fluidform.settings.forms.callBack {
	finisher {
		javascript < plugin.tx_fluidform.presets.finisher.javascript
		javascript.functions {
			# After successfully sent, but before displaying the success message
			beforeSuccess (
				ga('send', 'event', 'Forms', 'Submit', 'Kontaktformular');
			)
		}
	}
}
```

Folgende Events sind vorhanden:

*	onInitialize
*	onSend
*	beforeSuccess
*	afterSuccess
*	beforeError
*	afterError

## Senden-Button bei Klick deaktivieren

Du kannst den Senden-Button mit folgendem TypoScript deaktivieren, um mehrfach Absendungen des Formulars zu verhindern:

```typo3_typoscript
plugin.tx_fluidform.settings.forms.callBack {
    finisher {
        javascript < plugin.tx_fluidform.presets.finisher.javascript
        javascript.functions {
          onSend (
            jQuery('.tx-fluid-form .btn[type="submit"]').prop('disabled', true);
          )
          beforeSuccess (
            jQuery('.tx-fluid-form .btn[type="submit"]').prop('disabled', false);
          )
          beforeError (
            jQuery('.tx-fluid-form .btn[type="submit"]').prop('disabled', false);
          )
        }
    }
}
```
