# Abweichende Empfänger abhängig von einem Select-Box Wert

Eine Select-Box mit den optionen 0/1 entscheidet darüber, wer die Mail empfängt. Option 0 sendet die Mail an den Standard-Empfänger, Option 1 an den abweichenden:

```typo3_typoscript
[globalVar = GP:tx_fluidform_form|form-footer-complete-customer = 1]
	plugin.tx_fluidform.settings.forms.callBack.finisher.mail.to.0.email = info@test.de
[global]
```

Hier kann natürlich auch mit anderen Wert oder alternativen TypoScript-Conditions gearbeitet werden.
