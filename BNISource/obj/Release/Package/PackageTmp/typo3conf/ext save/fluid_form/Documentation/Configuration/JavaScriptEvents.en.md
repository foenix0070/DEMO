# JavaScript-Events

Basically all events can be used quickly by TypoScript:

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

The following events are available:

*	onInitialize
*	onSend
*	beforeSuccess
*	afterSuccess
*	beforeError
*	afterError

## Disable send button on click

In order to disable the submit button on send to prevent multiple sends, use the following TypoScript:

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
