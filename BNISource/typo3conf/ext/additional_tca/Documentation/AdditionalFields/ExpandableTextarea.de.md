# Textarea mit ein/ausklapp Funktion

Dieses Feld kann wie ein Standardtextfeld mit zusätzlichem ExpandedInitially-Parameter konfiguriert werden, der angibt, ob das Feld beim Laden der Seite zu offen oder geschlossen ist.

![Expandable textarea field](https://www.coding.ms/fileadmin/extensions/additional_tca/current/Documentation/Images/ExpandableTextarea.png)


## Definition

```php
$table = 'tx_crm_domain_model_activityunit';
$lll = 'LLL:EXT:crm/Resources/Private/Language/locallang_db.xlf:' . $table;
return [
   'columns' => [
        'internal_notice' => [
            'exclude' => 1,
            'label' => $lll . '.internal_notice',
            'config' => \CodingMs\Crm\Tca\Configuration::get('expandableTextarea', false, false, '', [
                'expandedInitially' => false,
                'size' => 'small'
            ])
        ],
    ],
];
```
