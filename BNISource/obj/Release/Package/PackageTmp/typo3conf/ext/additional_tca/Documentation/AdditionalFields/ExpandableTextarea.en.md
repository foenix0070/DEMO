# Textarea with expand and collapse feature

This field can be configured like default text field with additional `expandedInitially` param, witch indicates to expand or collapse the field on page load.

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
