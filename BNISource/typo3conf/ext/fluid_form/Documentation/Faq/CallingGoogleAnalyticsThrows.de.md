# Aufruf von Google-Analytics throws Uncaught ReferenceError

Wenn der Aufruf von Google-Analytics einen `(index):151 Uncaught ReferenceError: ga is not defined` Fehler wirft, prüfe zunächst, ob Dein AdBlocker das Nutzer-Tracking blockiert. Bleibt der Fehler bestehen, prüfe, ob Dein Google-Analytics Code-Inclusion auf dem neuesten Stand ist.

Für das Conversion-Tracking musst Du möglicherweise eine spezielle Google-Bibliothek einbinden:

```typo3_typoscript
page.includeJS {
	conversion_async = //www.googleadservices.com/pagead/conversion_async.js
	conversion_async.external = 1
}
```
