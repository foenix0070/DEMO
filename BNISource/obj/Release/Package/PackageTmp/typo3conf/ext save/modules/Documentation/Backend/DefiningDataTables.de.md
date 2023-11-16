# Definieren von Datentabellen

Die Definition einer Datentabelle für das Backend kann einfach mit TypoScript vorgenommen werden.

Beispiele sind in folgenden Erweiterungen zu finden:

*   EXT:modules für Frontend- und Backend-Benutzer und Gruppen
*   EXT:questions für FAQ-Fragen und Kategorien
*   EXT:glossaries für Glossar-Einträge und Kategorien



>	**Achtung:**
>
>	Stell sicher, dass dieses TypoScript durch eine `ext_typoscript_setup.txt` Datei definiert ist,
>	damit diese Definitionen immer verfügbar sind!

```typo3_typoscript
module.tx_yourextensionkey {
	settings {
		lists {

			downloadFileCollection {
				# Id of the backend module list - just take the parent key
				id = internalNotes
				# table defines the database table name for the records of this list.
				table = sys_note
				# Module identifier
				module = web_InternalNotesInternalNotes
				# Plugin identifier
				plugin = InternalNotes
				# sortingField defines the field, which should be used as default sorting
				sortingField = subject
				# sortingOrder defines the default sorting order for the default sorting field
				sortingOrder = asc
				# The limit defines, how many record should be displayed on each page
				limit = 20
				# Show `Column selector` widget within list,
				# you can show/hide columns for table list using this widget
				columnSelector = 1
				# Define the default fields/columns of a list
				# these fields/columns will be displayed when the list is first initialized or the user reset his UC
				columnDefault = name, label, user
				# Fields/columns of the data table
				fields {
					# Define the fields/columns of your table
				}
				# Actions for each row of the data table
				actions {
					# Define the actions for your table rows
				}
			}
			# Define more data tables in the same way
			aSecondTable {
				# ...
			}
		}
	}
}
```

## Definieren von Tabellenfeldern


Der Field Key wird in Kleinbuchstaben geschrieben und stellt den Getter-Name einer Model-Eigenschaft dar!


```typo3_typoscript
module.tx_yourextensionkey {
	settings {
		lists {
			tableIdentifier {
				fields {
					title {
						format = Plain
						sortable = 1
					}
					email {
						format = Email
						sortable = 1
					}
					image {
						format = Image
					}
					hidden {
						format = Boolean
						sortable = 1
						# Requires following translations:
						# tx_modules_label.boolean_true = yes
						# tx_modules_label.boolean_false = no
					}
					description {
						format = PlainEditable
						sortable = 1
						crop = 30
					}
					creationUser {
						format = BackendUser/Username
					}
					creationDate {
						format = DateTime
						sortable = 1
						sortingField = crdate
						dateFormat = d.m.Y H:i
					}
				}
			}
		}
	}
}
```

Mögliche Ausgangsformate sind


| Parameter/Format | Plain | PlainEditable | DateTime | Email | Boolean | Image | Custom |
| ---------------- |-------|---------------|----------|-------|---------|-------|--------|
| sortable         | x     | x             | x        | x     | x       | -     | ?      |
| sortingField     | x     | x             | x        | x     | x       | -     | ?      |
| hideInExport     | x     | x             | x        | x     | x       | x     | ?      |
| exportGetter     | x     | x             | x        | x     | x       | x     | ?      |
| dateFormat       | -     | -             | x        | -     | -       | -     | ?      |
| crop             | x     | x             | -        | -     | -       | -     | ?      |

*	`sortable` - Deaktiviert die Sortierung der Spalte, boolscher Wert dargestellt durch 0/1.
*	`sortingField` - Überschreibt den Tabellen-Spaltennamen für die Sortierung, falls dieser vom Konfigurations-Key abweicht (siehe Beispiel zum `creationDate`).
*	`hideInExport` - Deaktiviert die Spalte im CSV-Export, boolscher Wert dargestellt durch 0/1.
*	`exportGetter` - Definiert den Domain-Model Getter-Namen für die CSV-Exportzelle (ohne vorangestelltes `get`).
*	`dateFormat` - DateFormat ist ein PHP Datums-Format Pattern.
*	`crop` - Crop ist ein Integer-Value und schneidet den Zellinhalt nach der definierten Anzahl von Zeichen ab.


## Definieren von Tabellenaktionen

Die Tabellenaktionen werden im `Actions` Node definiert. In diesem Node kannst Du die Action für jede Tabellenzeile definieren.

Dies könnte wie folgt aussehen:

```typo3_typoscript
actions {
	# The action key is the identifier.
	# This key is used additionally for the translation key for the column title.
	edit {
		action = Edit
		# Translation keys
		# tx_modules_label.list_topic_action_edit = Edit topic
	}
	inactiveActive {
		action = InactiveActive
		# Invert the value (for example for hidden field usage)
		invertState = 0
		# Translation keys
		# tx_modules_label.list_topic_action_inactive = Activate topic
		# tx_modules_label.list_topic_action_active = Deactivate topic
	}
	hideShow {
		action = HideShow
		# Translation keys
		# tx_modules_label.list_topic_action_hide = Hide topic
		# tx_modules_label.list_topic_action_show = Show topic
	}
	disableEnable {
		action = DisableEnable
		# Translation keys
		# tx_modules_label.list_frontend_user_action_enable = Enable frontend user
		# tx_modules_label.list_frontend_user_action_disable = Disable frontend user
	}
	delete {
		action = Delete
		# Data field of the record, where a label is store.
		# This label is used for the security question in the modal.
		subjectField = title
		# Translation keys
		# tx_modules_label.list_topic_action_delete_title = Delete this topic?
		# tx_modules_label.list_topic_action_delete_content = Are you sure you want to delete the topic `%1$s`?
		# tx_modules_label.list_topic_action_delete_cancel = Cancel
	}
}
```


## Übersetzungen

Das Definieren von Übersetzungen für die Datentabellen funktioniert folgendermaßen:

```typo3_typoscript
module.tx_yourextensionkey {
	_LOCAL_LANG {
		default {
			#
			tx_downloadmanager_label.backend_filter = Filter
			tx_downloadmanager_label.backend_filter_submit = refresh

			# Message, if there are no records in the table
			tx_modules_label.list_download_file_collection_no_entries = No download file collections found

			# Table header title
			tx_modules_label.list_download_file_collection_header = Download file collection

			# Table header columns
			# Each identifier is build like:
			# tx_modules_label.list_ + list id underscored + _col_ + field key
			tx_modules_label.list_download_file_collection_col_title = Title
			tx_modules_label.list_download_file_collection_col_actions = Actions

			tx_modules_label.list_download_file_collection_action_edit = Edit download file collection
			tx_modules_label.list_download_file_collection_action_hide = Hide download file collection
			tx_modules_label.list_download_file_collection_action_show = Show download file collection
		}
		de {
			# German translation
			tx_modules_label.list_download_file_collection_no_entries = Es konnten keine Download-Datei-Dateisammlung gefunden werden
			tx_modules_label.list_download_file_collection_header = Download-Dateisammlung
			tx_modules_label.list_download_file_collection_col_title = Titel
			tx_modules_label.list_download_file_collection_col_actions = Aktionen
			tx_modules_label.list_download_file_collection_action_edit = Download-Dateisammlung bearbeiten
		}
	}
}

```

## Nutzung von Erstellungsbenutzer, Datum oder Änderungsdatum

Wenn Du den Erstellungsbenutzer, das Erstellungsdatum oder das Änderungsdatum eines Standard-TYPO3-Datensatzes verwenden möchtest, musst Du die Extbase-Felder zuordnen:

In TYPO3 9 oder geringer in `yourextensionkey/ext_typoscript_setup`:

```typo3_typoscript
config.tx_extbase.persistence.classes {

	CodingMs\Newsletters\Domain\Model\Topic.mapping {
		tableName = tx_newsletters_domain_model_topic
		recordType =
		columns {
			crdate.mapOnProperty = creationDate
			tstamp.mapOnProperty = modificationDate
			cruser_id.mapOnProperty = creationUser
		}
	}

}
```

In TYPO3 10 oder höher in `yourextensionkey/Configuration/Extbase/Persistence/Classes.php`:

```php
<?php

declare(strict_types=1);

return [
	\CodingMs\Questions\Domain\Model\Question::class => [
		'tableName' => 'tx_questions_domain_model_question',
		'properties' => [
			'creationDate' => [
				'fieldName' => 'crdate'
			],
			'modificationDate' => [
				'fieldName' => 'tstamp'
			],
			'creationUser' => [
				'fieldName' => 'cruser'
			],
		],
	],
];
```
