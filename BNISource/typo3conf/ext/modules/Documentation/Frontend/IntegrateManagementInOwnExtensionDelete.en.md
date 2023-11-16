# Delete data records

This guide covers how to add frontend management for real estate records to an extension. The key parameters are:

*   **Extension-Key:** openimmo
*   **Objekt-Name:** Immobilie


## Deleting records

Records are deleted from the record list. Delete buttons in the list are configured as follows:

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

The records will be marked as deleted and so the methods `getDeleted` und `setDeleted` need to be defined in the object model.

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

A *deleted* field  will need to be defined in the TCA:

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
