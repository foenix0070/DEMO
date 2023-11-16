# Erstelle ein einfaches Formular

Dies ist ein *How-To* das Dir zeigt, wie ein einfaches Kontakt-Formular definiert werden kann. Du musst nur ein wenig Setup-TypoScript hinzufügen, optional ein paar TypoScript-Konstanten für eine Konfiguration und das Formular mit Hilfe von Page-TypoScript im Backend auswählbar machen.

## TypoScript-Setup

Die komplette Definition des Formulars wir mit dem folgenden Setup-TypoScript gemacht:

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactSmall < plugin.tx_fluidform.presets.forms.default
plugin.tx_fluidform.settings.forms.contactSmall {
	configuration {
		ajax = 1
	}
	# Fields
	fieldsets {
		complete < plugin.tx_fluidform.presets.fieldsets.normalWithoutLabel
		complete {
			fields {
				message < plugin.tx_fluidform.presets.fields.textarea
				message {
					required = 1
					label = Nachricht
					placeholder =
					validation {
						NotEmpty = Bitte füllen Sie dieses Feld aus
					}
				}
				name < plugin.tx_fluidform.presets.fields.inputName
				name {
					required = 1
					label = Name
					placeholder =
					validation {
						NotEmpty = Bitte geben Sie Ihren Namen ein
					}
				}
				email < plugin.tx_fluidform.presets.fields.inputEmail
				email {
					required = 1
					label = E-Mailadresse
					placeholder =
					validation {
						NotEmpty = Bitte geben Sie Ihre E-Mailadresse ein
						Email = Bitte geben Sie eine gültige E-Mailadresse ein
					}
				}
				required < plugin.tx_fluidform.presets.fields.honeypot
			}
		}
		buttons < plugin.tx_fluidform.presets.fieldsets.buttons
		buttons {
			fields {
				submit < plugin.tx_fluidform.presets.fields.submit
				submit {
					css.class.field = btn btn-primary
					value = Senden
				}
			}
		}
	}
	# Finisher
	finisher {
		database < plugin.tx_fluidform.presets.finisher.database
		database {
			active = {$themes.configuration.extension.fluid_form.contactSmall.database.active}
			storagePid = {$themes.configuration.extension.fluid_form.contactSmall.database.storagePid}
		}
		mail < plugin.tx_fluidform.presets.finisher.mail
		mail {
			active = 1
			from {
				name = {$themes.configuration.extension.fluid_form.contactSmall.mail.from.name}
				email = {$themes.configuration.extension.fluid_form.contactSmall.mail.from.email}
			}
			to {
				0 {
					name = {$themes.configuration.extension.fluid_form.contactSmall.mail.to.0.name}
					email = {$themes.configuration.extension.fluid_form.contactSmall.mail.to.0.email}
				}
			}
		}
	}
	# Messages
	messages {
		successfullySent {
			title = Anfrage wurde erfolgreich verschickt!
			message = Wir werden uns in Kürze mit Ihnen in Verbindung setzen.
		}
		validationFailed {
			title = Fehler beim Versenden!
			message = Bitte füllen Sie die erforderlichen Felder aus.
		}
	}
}
```



## TypoScript-Konstanten

Für eine bessere Konfiguration kannst du einige TypoScript-Konstanten definieren:

```typo3_typoscript
# customcategory=form=LLL:EXT:fluid_form/Resources/Private/Language/locallang.xlf:tx_fluidform_constants.category
themes.configuration.extension.fluid_form {
	# customsubcategory=form_contact_small=Small contact form
	contactSmall {
		mail {
			from {
				# cat=form/form_contact_small/100; type=string; label= Mail from: Name from the sender
				name = Fluid-Form
				# cat=form/form_contact_small/110; type=string; label= Mail from: Email from the sender
				email = fluid-form@t3co.de
			}
			to {
				0 {
					# cat=form/form_contact_small/200; type=string; label= Mail to: Name from the receiver
					name = Fluid form
					# cat=form/form_contact_small/210; type=string; label= Mail to: Email from the receiver
					email = fluid-form-to0@t3co.de
				}
			}
		}
		database {
			# cat=form/form_contact_small/300; type=options[0,1]; label= Activate saving mails in database
			active = 0
			# cat=form/form_contact_small/310; type=int+; label= Storage container mails in database
			storagePid = 0
		}
	}
}
```



## Page-TypoScript (tsconfig)

Abschließend muss mit folgendem Page-TypoScript das Formular im Backend auswählbar gemacht werden:

```typo3_typoscript
# Available forms
forms {
	contactSmall = This is out small form
}
```
