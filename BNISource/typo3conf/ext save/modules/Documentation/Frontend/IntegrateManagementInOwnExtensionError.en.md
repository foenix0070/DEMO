# Display error messages

This guide covers how to add frontend management for real estate records to an extension. The key parameters are:

*   **Extension-Key:** openimmo
*   **Object-Name:** Immobilie


## Display error messages

Use the following Fluid template to display error messages, e.g. when a user tries to access the frontend management system without a valid login.

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
