# Backend Module

The Fluid Form extension includes a backend module that provides an overview of emails and enquiries. In order for the backend module to read in a data container, the container must have *Fluid Form mails* selected in the *Contains plugin* field in the page settings.

## Email Filter

*   **Date from/to:** Time period. By default, this is the previous week.
*   **Storage:** The data container in which the emails are located. If you have access to several data containers, you can easily switch between them here.
*   **Form:** Select the form to be used for displaying the emails.
*   **Search word:** Searches through all fields with *name* or *mail* in their `fieldKey`.

## List columns

As the Backend module is based on the Modules extension, the list columns can easily be adapted as required using TypoScript, i.e. you can display different information in different containers or subbranches.

The basic fields are pre-defined and configured. If you switch between different forms in the module, a check is carried out to determine which of the fields appear in that form. Unnecessary fields are dynamically removed.

One possible field configuration looks as follows:

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
