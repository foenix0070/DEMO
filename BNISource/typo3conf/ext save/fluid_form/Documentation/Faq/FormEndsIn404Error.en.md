# Sending the form ends in a 404 error

The AJAX request of form results a:

```
Page Not Found
Reason: Request parameters could not be validated (&cHash empty)
```

**Solution:** Open the Installtool and disable *pageNotFoundOnCHashError* setting: `[FE][pageNotFoundOnCHashError] = false`
