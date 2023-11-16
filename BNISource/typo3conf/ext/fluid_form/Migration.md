# Migration

## Version 3.1.0

The mail templates needs to be migrated.

### Receiver mail

*Old file in Templates/Email/Receiver.html*

```xml
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
	  data-namespace-typo3-fluid="true">

<f:section name="Subject">Fluid-Form: Contact-Request by {form.fieldsets.complete.fields.name.value}</f:section>
<f:section name="Message">Hi,
this is a contact request by {form.fieldsets.complete.fields.name.value}!

Filled fields:<f:for each="{form.fieldsets}" as="fieldset">
<f:for each="{fieldset.fields}" as="field"><f:if condition="{field.excludeFromMail} != '1'"><f:switch expression="{field.type}">
<f:case value="Hidden">
{field.label}: {field.value}
</f:case>
<f:case value="Input">
{field.label}: {field.value}
</f:case>
<f:case value="Textarea">
{field.label}:
{field.value}
</f:case>
</f:switch></f:if></f:for></f:for>
---
Thank you for your attention
</f:section>

</html>
```

*New file in Templates/Email/Form/Receiver.html*

```xml
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers" data-namespace-typo3-fluid="true">
<f:layout name="SystemEmail" />
<f:section name="Subject"><f:format.raw>{subject}</f:format.raw></f:section>
<f:section name="Title">{subject}</f:section>
<f:section name="Main">
	<f:format.html>{finisher.message.introduction}</f:format.html>
	<f:render partial="Form/FieldRows" arguments="{_all}"/>
	<f:format.html>{finisher.message.conclusion}</f:format.html>
</f:section>
</html>
```



### Sender mail

*Old file in Templates/Email/Sender.html*

```xml
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
	  data-namespace-typo3-fluid="true">

<f:section name="Subject">Fluid-Form: Contact-Request by {form.fieldsets.complete.fields.name.value}</f:section>
<f:section name="Message">Hi,
this is a contact request by {form.fieldsets.complete.fields.name.value}!

Filled fields:<f:for each="{form.fieldsets}" as="fieldset">
<f:for each="{fieldset.fields}" as="field"><f:if condition="{field.excludeFromMail} != '1'"><f:switch expression="{field.type}">
<f:case value="Hidden">
{field.label}: {field.value}
</f:case>
<f:case value="Input">
{field.label}: {field.value}
</f:case>
<f:case value="Textarea">
{field.label}:
{field.value}
</f:case>
</f:switch></f:if></f:for></f:for>
---
Thank you for your attention
</f:section>

</html>
```

*New file in Templates/Email/Form/Sender.html*

```xml
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers" data-namespace-typo3-fluid="true">
<f:layout name="SystemEmail" />
<f:section name="Subject"><f:format.raw>{subject}</f:format.raw></f:section>
<f:section name="Title">{subject}</f:section>
<f:section name="Main">
	<f:format.html>{finisher.message.introduction}</f:format.html>
	<f:render partial="Form/FieldRows" arguments="{_all}"/>
	<f:format.html>{finisher.message.conclusion}</f:format.html>
</f:section>
</html>
```



### Add new TypoScript

You might need to add some new TypoScript for your own form definitions:

```typo3_typoscript
plugin.tx_fluidform {
	presets {
		# Finisher
		finisher {
			# Mail finisher
			mail {
				subject = {$themes.configuration.siteName}: Contact-Request
				message {
					introduction (
						<p>
							Hi,<br />
							this is a contact request.<br />
							<br />
							<b>Filled fields:</b>
						</p>
					)
					conclusion (
						<p>Thank you for your attention</p>
					)
				}
				# Define the new Fluid mail templates
				sender {
					template = Form/Sender
				}
				receiver {
					template = Form/Receiver
				}
			}
		}
	}
}
```



### Remove unused TypoScript

You can remove some unused TypoScript from your mail finisher configuration:

```typo3_typoscript
plugin.tx_fluidform {
	presets {
		# Finisher
		finisher {
			# Mail finisher
			mail {
				message {
					header.0 = Dear admin,
					header.1 = this is a contact request from {$themes.configuration.baseurl}.
					header.2 =
					header.3 = Fields:
					footer.0 = ---
					footer.1 = Thanks for your attention
				}
				# Render email by Fluid
				fluid {
					active = 0
					template {
						receiver = EXT:fluid_form/Resources/Private/Templates/Email/Receiver.html
						sender = EXT:fluid_form/Resources/Private/Templates/Email/Sender.html
					}
				}
				sender {
					fluid {
						active = 0
						template = EXT:fluid_form/Resources/Private/Templates/Email/Sender.html
					}
				}
				receiver {
					fluid {
						active = 0
						template = EXT:fluid_form/Resources/Private/Templates/Email/Sender.html
					}
				}
			}
		}
	}
}
```

