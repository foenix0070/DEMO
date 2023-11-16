# DateTime mit Symbolleiste

Dieses Feld kann genauso verwendet werden wie die standardmäßige DateTime-Eingabe von TYPO3 mit einer Option zum Hinzufügen einer Symbolleiste. Es verfügt über die Schaltflächen `+` und `-`, die eine variable Anzahl von Minuten addieren oder subtrahieren (verfügbare Schritte sind `5`, `10`, `15` und `30`). Außerdem wird die Zeit auf den nächsten Schritt gerundet.

![DateTime input with toolbar](https://www.coding.ms/fileadmin/extensions/additional_tca/current/Documentation/Images/DateTime.png)


## Definition

```php
$table = 'tx_crm_domain_model_activityunit';
$lll = 'LLL:EXT:crm/Resources/Private/Language/locallang_db.xlf:' . $table;
return [
   'columns' => [
        'start' => [
            'exclude' => 1,
            'label' => $lll . '.start',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('dateTime', true, false, '', [
                'toolbar' => true,
                'step' => 15,
            ]),
        ],
    ],
];
```
