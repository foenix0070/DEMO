# Datensätze löschen

In dieser Anleitung wollen wir ein Frontend-Management für Immobilien in einer Erweiterung integrieren. Unsere Eckdaten sind dabei:

*   **Extension-Key:** openimmo
*   **Objekt-Name:** Immobilie


## Löschen von Datensätzen

Das Löschen von Datensätzen erfolgt aus der Liste heraus. Die Konfiguration für den Löschen-Button muss wie folgt aussehen:

```typo3_typoscript
plugin.tx_openimmopro.settings.lists.immobilie {
    # ...
	actions {
		delete {
			label =
			title = Delete this object
			action = Delete
			iconIdentifier = actions-delete
			confirmation = Really delete this object?!
		}
	}
}
```

Damit die Datensätze als gelöscht markiert werden können, benötigt das Objekt-Model die Methoden `getDeleted` und `setDeleted`:

```php
class Immobilie extends AbstractEntity
{

    /**
     * @var bool
     */
    protected $deleted = true;

    /**
     * @return bool
     */
    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

}
```

Zusätzlich muss im TCA das *deleted* Feld definiert werden:

```php
$GLOBALS['TCA']['tx_extension_domain_model_object'] = [
    'columns' => [
        'deleted' => [
            'exclude' => false,
            'label' => 'deleted',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'Record is deleted'
                    ]
                ],
            ],
        ],
    ],
];
```
