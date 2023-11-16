# Percent field

This field can be used for percent values.

![Percent Form-Engine field](https://www.coding.ms/fileadmin/extensions/additional_tca/current/Documentation/Images/Percent.png)


## Definition

```php
$table = 'tx_crm_domain_model_activityunit';
$lll = 'LLL:EXT:crm/Resources/Private/Language/locallang_db.xlf:' . $table;
return [
   'columns' => [
        'percent' => [
            'label' => $lll . '.percent',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('percent'),
        ],
    ],
];
```
