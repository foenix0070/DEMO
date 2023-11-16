# DateTime with toolbar

This field can be used the same as the default TYPO3 date input with an option to add a toolbar. It has `+` and `-` buttons which will add or substract one day from the date.

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
