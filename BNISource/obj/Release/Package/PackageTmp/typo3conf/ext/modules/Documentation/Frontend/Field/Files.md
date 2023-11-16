


Damit die FileReferencen zu neu hochgeladenen Bildern richtig gesetzt werden können, muss das TCA der Datei folgende Informationen enthalten:


```php
$GLOBALS['TCA']['tx_openimmo_domain_model_anhang'] = [
    'columns' => [
        'file' => [
            'config' => [
                // ...
                'foreign_match_fields' => [
                    'fieldname' => 'file',
                    'tablenames' => 'tx_openimmo_domain_model_anhang',
                    'table_local' => 'sys_file',
                ],
                // ...
            ],
        ],
    ],
];
```



Wenn die Datei direkt in an eine Model-Property geschrieben wird (`multipe = 0`), dann muss eine Methode zum entfernen der Datei hinzugefügt werden:

```php
class Anhang extends AbstractEntity
{

    /**
     * Remove the file
     *
     * @return void
     */
    public function removeFile($file)
    {
        $this->file = null;
    }

}
```
