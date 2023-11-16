# Currency field

This field can be used for currency values.

![Currency Form-Engine field](https://www.coding.ms/fileadmin/extensions/additional_tca/current/Documentation/Images/Currency.png)


## Definition

```php
$table = 'tx_crm_domain_model_activityunit';
$lll = 'LLL:EXT:crm/Resources/Private/Language/locallang_db.xlf:' . $table;
return [
   'columns' => [
        'currency' => [
            'label' => $lll . '.currency',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('currency'),
        ],
    ],
];
```
