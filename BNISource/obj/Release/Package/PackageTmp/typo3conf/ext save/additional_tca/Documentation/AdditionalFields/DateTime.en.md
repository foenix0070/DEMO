# DateTime with toolbar

This field can be used the same as the default TYPO3 DateTime input with an option to add a toolbar. It has `+` and `-` buttons which will add or substract variable amount of minutes (available steps are `5`, `10`, `15` and `30`). It will also round the time to the nearest step.

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
