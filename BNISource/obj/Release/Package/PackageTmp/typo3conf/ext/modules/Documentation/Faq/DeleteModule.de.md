# Warum wird das Delete-Modal nicht angezeigt?

Vielleicht hast Du vergessen, das erforderliche RequireJs-Modul hinzuzufügen:

```php
$pageRenderer->loadRequireJsModule(`TYPO3/CMS/Backend/Modal`);
```
