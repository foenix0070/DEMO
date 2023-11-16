# Duration field

This field can be used for duration or time values.

![Duration Form-Engine field](https://www.coding.ms/fileadmin/extensions/additional_tca/current/Documentation/Images/Duration.png)


## Definition

```php
$table = 'tx_crm_domain_model_activityunit';
$lll = 'LLL:EXT:crm/Resources/Private/Language/locallang_db.xlf:' . $table;
return [
   'columns' => [
        'duration' => [
            'label' => $lll . '.duration',
            'config' => \CodingMs\AdditionalTca\Tca\Configuration::get('duration'),
        ],
    ],
];
```
