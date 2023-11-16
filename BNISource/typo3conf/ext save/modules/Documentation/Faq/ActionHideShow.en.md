# Why doesn't the *HideShow* action work?

You might have forgotten to add the *hidden* property to your model. Add it like this:

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

Also make sure that you have added the field to TCA columns:

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
