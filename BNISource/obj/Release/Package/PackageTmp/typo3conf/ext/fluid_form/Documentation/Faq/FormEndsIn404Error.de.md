# Das Absenden des Formulars endet mit einem 404-Fehler

Die AJAX-Anfrage des Formulars ergibt ein:

```
Page Not Found
Reason: Request parameters could not be validated (&cHash empty)
```

**Lösung:** Öffne das Installtool und deaktiviere die Einstellung *pageNotFoundOnCHashError*: `[FE][pageNotFoundOnCHashError] = false`
