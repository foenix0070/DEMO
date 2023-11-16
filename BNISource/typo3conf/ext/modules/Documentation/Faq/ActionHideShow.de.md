# Warum funktioniert die Aktion *HideShow* nicht wie erwartet?

Vielleicht hast Du vergessen, die *hidden* Eigenschaften zu Deinem Modell hinzuzufügen. Füge Folgendes hinzu:

```php
/**
 * @var boolean
 */
protected $hidden;

/**
 * @return bool
 */
public function isHidden()
{
    return $this->hidden;
}

/**
 * @param bool $hidden
 */
public function setHidden($hidden)
{
    $this->hidden = $hidden;
}
```

Stell zusätzlich sicher, dass Dein Feld in TCA-Spalten eingestellt ist:

```
`hidden` => [
    `config` => [
        `type` => `passthrough`,
    ]
],
`crdate` => [
    `config` => [
        `type` => `passthrough`,
    ]
],
`tstamp` => [
    `config` => [
        `type` => `passthrough`,
    ]
],
```
