# Fehlermeldungen anzeigen

In dieser Anleitung wollen wir ein Frontend-Management für Immobilien in einer Erweiterung integrieren. Unsere Eckdaten sind dabei:

*   **Extension-Key:** openimmo
*   **Objekt-Name:** Immobilie


## Fehlerausgabe

Für die Fehlerausgabe, wenn z.B. versucht wird das Frontend-Management ohne gültigen Login aufzurufen, kann das folgende Fluid-Template verwendet werden:

**Resources/Private/Templates/Frontend/Immobilie/Error.html**
```xml
<div xmlns="http://www.w3.org/1999/xhtml" lang="en"
	 xmlns:f="http://typo3.org/ns/fluid/ViewHelpers"
	 xmlns:modules="http://typo3.org/ns/CodingMs/Modules/ViewHelpers">
	<f:layout name="Frontend"/>
	<f:section name="Main">

		<f:flashMessages />

	</f:section>
</div>

```
