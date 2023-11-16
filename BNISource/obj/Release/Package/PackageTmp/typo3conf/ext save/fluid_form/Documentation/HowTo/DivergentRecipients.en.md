# Divergent recipients depending select box value

A select box with options 0/1 decide, who will receive the mail. Option 0 will send the mail to the default recipient, option 1 will be caught by the following condition:

```typo3_typoscript
[globalVar = GP:tx_fluidform_form|form-footer-complete-customer = 1]
	plugin.tx_fluidform.settings.forms.callBack.finisher.mail.to.0.email = info@test.de
[global]
```

You can use other values or alternative TypOScript conditions as well.
