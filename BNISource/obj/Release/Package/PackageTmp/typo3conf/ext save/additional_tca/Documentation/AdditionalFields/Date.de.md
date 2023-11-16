# Datum mit Symbolleiste

Dieses Feld kann genauso verwendet werden wie die standardmäßige TYPO3-Datumseingabe mit einer Option zum Hinzufügen einer Symbolleiste. Es hat die Schaltflächen `+` und `-`, die einen Tag zum Datum hinzufügen oder davon abziehen.
![DateTime input with toolbar](https://www.coding.ms/fileadmin/extensions/additional_tca/current/Documentation/Images/Date.png)


## Definition

```php
$table = 'tx_crm_domain_model_activityunit';
$lll = 'LLL:EXT:crm/Resources/Private/Language/locallang_db.xlf:' . $table;
return [
   'columns' => [
        'start' => [
            'exclude' => 1,
            'label' => $lll . '.start',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('date', true, false, '', [
                'toolbar' => true,
            ]),
        ],
    ],
];
```
