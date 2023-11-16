# Why doesn't the delete modal appear?

Maybe you've forgotten to add the correct RequireJs-Module:

```php
$pageRenderer->loadRequireJsModule('TYPO3/CMS/Backend/Modal');
```
