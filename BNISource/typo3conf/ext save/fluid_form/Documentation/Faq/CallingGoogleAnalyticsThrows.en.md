# Calling Google-Analytics throws Uncaught ReferenceError

When calling Google-Analytics throws a `(index):151 Uncaught ReferenceError: ga is not defined`, check if your AdBlock blocks user tracking. If the error remains, check if your Google-Analytics Code-Inclusion is up to date.

For conversion tracking you may need to include a special Google library for that:

```typo3_typoscript
page.includeJS {
	conversion_async = //www.googleadservices.com/pagead/conversion_async.js
	conversion_async.external = 1
}
```
