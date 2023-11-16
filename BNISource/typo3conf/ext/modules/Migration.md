# Modules Migration

## Migration to 5.3.0 !?!?!?!?!?

### Migration of email templates

The email templates must be migrated to HTML Fluid-Mails.

>	#### Attention: {.alert .alert-danger}
>
>	If you've overridden the Service for finalizing the registration, you need to migrate the email sending like in `DefaultService.php`.


#### ActivateRegistration

**Before:**

```xml
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
	  data-namespace-typo3-fluid="true">

<f:section name="Subject">{settings.registration.email.subject}</f:section>
<f:section name="Message">Hi {frontendUser.username},
please confirm your registration by clicking the following link:

<f:format.raw><f:uri.page pageUid="{settings.pages.registration}" additionalParams="{hash: frontendUser.hash}" absolute="1" /></f:format.raw>

---
Thank you for your attention
</f:section>

</html>
```

**After:**

```xml
<f:layout name="SystemEmail" />
<f:section name="Subject"><f:format.raw>{subject}</f:format.raw></f:section>
<f:section name="Title">{subject}</f:section>
<f:section name="Main">
	<p>
		Hi {frontendUser.username},<br />
		please confirm your registration by clicking the following link:<br />
		<br />
		<f:link.page pageUid="{settings.pages.registration}"
					 additionalParams="{hash: frontendUser.hash}"
					 absolute="1">
			<f:format.raw><f:uri.page pageUid="{settings.pages.registration}"
									  additionalParams="{hash: frontendUser.hash}"
									  absolute="1" /></f:format.raw>
		</f:link.page>

	</p>
	<p>
		Thank you for your attention
	</p>
</f:section>
```



#### ActivateAdminConfirmation

**Before:**

```xml
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
	  data-namespace-typo3-fluid="true">

<f:section name="Subject">{settings.registration.emailAdminConfirmation.subject}</f:section>
<f:section name="Message">Hi {frontendUser.username},
site administrator has activated your account - login by clicking the following link:

<f:format.raw><f:uri.page pageUid="{settings.pages.login}" absolute="1" /></f:format.raw>

---
Thank you for your attention
</f:section>

</html>
```

**After:**

```xml
<f:layout name="SystemEmail" />
<f:section name="Subject"><f:format.raw>{subject}</f:format.raw></f:section>
<f:section name="Title">{subject}</f:section>
<f:section name="Main">
	<p>
		Hi {frontendUser.username},<br />
		site administrator has activated your account - login by clicking the following link::<br />
		<br />
		<f:link.page pageUid="{settings.pages.login}"
					 absolute="1">
			<f:format.raw><f:uri.page pageUid="{settings.pages.login}"
									  absolute="1" /></f:format.raw>
		</f:link.page>

	</p>
	<p>
		Thank you for your attention
	</p>
</f:section>

```



#### ActivateAdminRejection

**Before:**

```xml
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
	  data-namespace-typo3-fluid="true">

<f:section name="Subject">{settings.registration.emailAdminRejection.subject}</f:section>
<f:section name="Message">Hi {frontendUser.username},
site administrator has rejected your registration - please contact the site administrator.

<f:format.raw><f:uri.page pageUid="{settings.pages.login}" absolute="1" /></f:format.raw>

---
Thank you for your attention
</f:section>

</html>
```

**After:**

```xml
<f:layout name="SystemEmail" />
<f:section name="Subject"><f:format.raw>{subject}</f:format.raw></f:section>
<f:section name="Title">{subject}</f:section>
<f:section name="Main">
	<p>
		Hi {frontendUser.username},<br />
		site administrator has rejected your registration - please contact the site administrator.<br />
	</p>
	<p>
		Thank you for your attention
	</p>
</f:section>
```



#### ActivateRegistrationAdmin

**Before:**

```xml
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
	  data-namespace-typo3-fluid="true">

<f:section name="Subject">{settings.registration.emailAdminActivation.subject}</f:section>
<f:section name="Message">
Please confirm or reject registration of the user {frontendUser.username} by clicking one of the following links:

confirm:

<f:format.raw><f:uri.page pageUid="{settings.pages.registration}" additionalParams="{hash: frontendUser.hash, adminActivation:1, confirm:1}" absolute="1" /></f:format.raw>

reject:

<f:format.raw><f:uri.page pageUid="{settings.pages.registration}" additionalParams="{hash: frontendUser.hash, adminActivation:1, confirm:0}" absolute="1" /></f:format.raw>

username: {frontendUser.username}
name: {frontendUser.name}
first name: {frontendUser.firstName}
middle name: {frontendUser.middleName}
last name: {frontendUser.lastName}
address: {frontendUser.address}
telephone: {frontendUser.telephone}
fax: {frontendUser.fax}
email: {frontendUser.email}
lock to domain: {frontendUser.lockToDomain}
title: {frontendUser.title}
zip: {frontendUser.zip}
city: {frontendUser.city}
country: {frontendUser.country}
www: {frontendUser.www}
company: {frontendUser.company}

gender: {frontendUser.gender}
birthday: {frontendUser.birthdayAsString}
mobile: {frontendUser.mobile}
terms confirmed: {frontendUser.termsConfirmed}
privacy confirmed: {frontendUser.privacyConfirmed}
disclaimer confirmed: {frontendUser.disclaimerConfirmed}
newsletter: {frontendUser.newsletter}
profession: {frontendUser.profession}
marital status: {frontendUser.maritalStatus}
children: {frontendUser.children}
bank account owner name: {frontendUser.bankAccountOwnerName}
bank account bank name: {frontendUser.bankAccountBankName}
bank account bic: {frontendUser.bankAccountBic}
bank account iban: {frontendUser.bankAccountIban}
accounting type: {frontendUser.accountingType}
vat number: {frontendUser.vatNumber}


---
Thank you for your attention
</f:section>

</html>
```

**After:**

```xml
<f:layout name="SystemEmail" />
<f:section name="Subject"><f:format.raw>{subject}</f:format.raw></f:section>
<f:section name="Title">{subject}</f:section>
<f:section name="Main">
	<p>Hi,<br />
		Please confirm or reject registration of the user {frontendUser.username}
		by clicking one of the following links:<br />
		<br />
		<f:link.page pageUid="{settings.pages.registration}"
					 additionalParams="{hash: frontendUser.hash, adminActivation:1, confirm:1}"
					 absolute="1">Confirm registration</f:link.page><br />
		<br />
		<f:link.page pageUid="{settings.pages.registration}"
					 additionalParams="{hash: frontendUser.hash, adminActivation:1, confirm:0}"
					 absolute="1">Reject registration</f:link.page><br />
		<br />
		<b>User data:</b>
		<br />
		<f:render partial="FrontendUserFields" arguments="{_all}"/>
	</p>
	<p>
		Thank you for your attention
	</p>
</f:section>
```



#### Activation

**Before:**

```xml
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
	  data-namespace-typo3-fluid="true">

<f:section name="Subject">{settings.registration.emailOnActivation.subject}</f:section>
<f:section name="Message">Hi {frontendUser.username},
your activation was successful - login by clicking the following link:

<f:format.raw><f:uri.page pageUid="{settings.pages.login}" absolute="1" /></f:format.raw>

---
Thank you for your attention
</f:section>

</html>

```

**After:**

```xml
<f:layout name="SystemEmail" />
<f:section name="Subject"><f:format.raw>{subject}</f:format.raw></f:section>
<f:section name="Title">{subject}</f:section>
<f:section name="Main">
	<p>
		Hi {frontendUser.username},<br />
		your activation was successful - login by clicking the following link::<br />
		<br />
		<f:link.page pageUid="{settings.pages.login}"
					 absolute="1">
			<f:format.raw><f:uri.page pageUid="{settings.pages.login}"
									  absolute="1" /></f:format.raw>
		</f:link.page>

	</p>
	<p>
		Thank you for your attention
	</p>
</f:section>
```



#### Clean up

In order to clean your system up, follow the next steps:

```typo3_typoscript
# Remove TypoScript constant
themes.configuration.extension.modules.registration.email.template = …
themes.configuration.extension.modules.registration.emailOnActivation.template = …
themes.configuration.extension.modules.registration.emailAdminActivation.template = …
themes.configuration.extension.modules.registration.emailAdminConfirmation.template = …
themes.configuration.extension.modules.registration.emailAdminRejection.template = …
```

```typo3_typoscript
# Remove TypoScript setup
plugin.tx_modules.settings.registration {
	email {
		template = {$themes.configuration.extension.modules.registration.email.template}
	}
	emailOnActivation {
		template = {$themes.configuration.extension.modules.registration.emailOnActivation.template}
	}
	emailAdminActivation {
		template = {$themes.configuration.extension.modules.registration.emailAdminActivation.template}
	}
	emailAdminConfirmation {
		template = {$themes.configuration.extension.modules.registration.emailAdminConfirmation.template}
	}
	emailAdminRejection {
		template = {$themes.configuration.extension.modules.registration.emailAdminRejection.template}
	}
}
```



## Migration to 5.2.0

### migration to the frontend user page type

1. For the migration to the frontend user page type, open the frontend user container for editing in backend.
2. Unselect the _Contains Plugin_ selection, if any is selected.
3. Change the page type to _Website users_.



## Migration to 4.2.6

The custom defined frontend user field are now configured as exclude fields. This means, you might need to activate them for your editors.



### Parameter $extensionName cannot be empty if a fully-qualified key is not specified.

**Solution:**
Add following script in initializeViewAction

```php
//
// Ensure extension name is available
if($this->extensionName === null || strtolower($this->extensionName) === 'modules') {
	$this->extensionName = $this->controllerContext->getRequest()->getControllerExtensionKey();
}
```



### Call to undefined method TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl()

**Solution:**
Migrate to UriBuilder.

**Prepration:**
```php
use TYPO3\CMS\Backend\Routing\UriBuilder as UriBuilderBackend;

/**
 * @var UriBuilderBackend
 */
protected $uriBuilderBackend;

/**
 * @param UriBuilderBackend $uriBuilderBackend
 * @noinspection PhpUnused
 */
public function injectUriBuilderBackend(UriBuilderBackend $uriBuilderBackend)
{
	$this->uriBuilderBackend = $uriBuilderBackend;
}
```

**Before:**
```php
$returnUrl = BackendUtility::getModuleUrl('web_QuestionsQuestions', $parameter);
```

**After:**
```php
$returnUrl = (string)$this->uriBuilderBackend->buildUriFromRoute('web_QuestionsQuestions', $parameter);
```

**Before:**
```php
BackendUtility::getModuleUrl('record_edit', $parameter)
```

**After:**
```php
(string)$this->uriBuilderBackend->buildUriFromRoute('record_edit', $parameter)
```


### Call to undefined method TYPO3\CMS\Backend\Routing\UriBuilder::setRequest()

**Before:**
```php
	protected function createMenu()
	{
		/** @var UriBuilder $uriBuilder */
		$uriBuilder = $this->objectManager->get(UriBuilder::class);
		$uriBuilder->setRequest($this->request);
		// ...
		$item = $menu->makeMenuItem()
						->setTitle($action['label'])
						->setHref($uriBuilder->reset()->uriFor($action['action'], [], 'Backend'))
						->setActive($this->request->getControllerActionName() === $action['action']);
		// ...
	}
```

**After:**
```php
	protected function createMenu()
	{
		// ...
		$item = $menu->makeMenuItem()
						->setTitle($action['label'])
						->setHref($this->uriBuilderBackend->reset()->uriFor($action['action'], [], 'Backend'))
						->setActive($this->request->getControllerActionName() === $action['action']);
		// ...
	}
```


### Button "TYPO3\CMS\Backend\Template\Components\Buttons\LinkButton" is not valid

Please check if the Translation/Label is filled. There might be a wrong
