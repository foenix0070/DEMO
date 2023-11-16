# Backend-Modul

Die Fluid-Form Erweiterung bietet ein Backend-Modul zur Übersicht der vorhandenen Mails und Anfragen. Damit das Backend-Modul auf einem Daten-Container lesen kann, muss der Container in den Seiten-Einstellungen beim Feld *Contains plugin* den Wert *Fluid Form mails* ausgewählt haben.

## Mail-Filter

*   **Date from/to:** Grenzt einen Zeitraum ein. Standardmäßig ist dies die letzte Woche.
*   **Storage:** Hier wird der Daten-Container ausgewählt, in dem die Mails liegen. Wenn Du auf mehrere Daten-Container Zugriff hast, kannst Du hier einfach zwischen diesen wechseln.
*   **Form:** Hier kann das Formular ausgewählt werden, von dem die Mails angezeigt werden sollen.
*   **Search word:** Das Freitext-Suchfeld sucht automatisch in allen Feldern die *name* oder *mail* in ihrem `fieldKey` haben.

## Listen-Spalten

Da das Backend-Modul auf der Modules Erweiterung basiert, können die Listen-Spalten im Modul einfach via TypoScript angepasst werden. D.h. Du kannst einfach in verschiedenen Containern oder Seitenzweigen andere Informationen anzeigen.

Dabei werden die grundsätzlichen möglichen Felder definiert und konfiguriert. Wenn dann zwischen verschiedenen Formularen im Modul gewechselt wird, wird geprüft welche der Felder auch im Formular vorkommen - überflüssige werden dynamisch entfernt.

Eine Konfiguration für Felder kann wie folgt aussehen:

```typo3_typoscript
module.tx_fluidform {
	settings {
		lists {
			mails {
				fields {
					applicationAs {
						format = Form/Field
						sortable = 1
					}
					name {
						format = Form/Field
						sortable = 1
					}
					phone {
						format = Form/Field
						sortable = 1
					}
					email {
						format = Form/Field
						sortable = 1
					}
				}
			}
		}
	}
	# Language values for modules list
	_LOCAL_LANG {
		default {
			tx_modules_label.list_mails_col_application_as = Application as
			tx_modules_label.list_mails_col_name = Name
			tx_modules_label.list_mails_col_phone = Phone
			tx_modules_label.list_mails_col_email = Email
		}
		de {
			tx_modules_label.list_mails_col_application_as = Bewerbung als
			tx_modules_label.list_mails_col_name = Name
			tx_modules_label.list_mails_col_phone = Telefon
			tx_modules_label.list_mails_col_email = Email
		}
	}
}
```
