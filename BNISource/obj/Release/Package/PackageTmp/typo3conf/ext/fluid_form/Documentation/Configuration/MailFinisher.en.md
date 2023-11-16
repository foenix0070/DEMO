# Configuration of the mail finisher

>   #### Notice: {.alert .alert-info}
>
>   Finishers are processed in the same order as they're defined - for that take a look into the TypoScript-Object-Browser.


The general definition of a mail finisher looks like:

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic {
    finisher {
        # Copy database finisher pre-definition
        mail < plugin.tx_fluidform.presets.finisher.mail
        mail {
            # Activiate mail finisher
            active = 1
            # Define the visual sender of the mail
            from {
                name = {$themes.configuration.extension.fluid_form.contactSmall.mail.from.name}
                email = {$themes.configuration.extension.fluid_form.contactSmall.mail.from.email}
            }
            # Define the receiver of the mail
            to {
                0 {
                    name = {$themes.configuration.extension.fluid_form.contactSmall.mail.to.0.name}
                    email = {$themes.configuration.extension.fluid_form.contactSmall.mail.to.0.email}
                }
            }
        }
    }
}
```



## Mail sender and receiver

The definition of the different mail addresses looks like:

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic {
    finisher {
        mail {
            # This is the visual sender of the mails
            from {
                name = Fluid-Form
                email = fluid-form@t3co.de
            }
            # This is the receiver of the mail
            to {
                # You can define as much receiver as you need.
                # Each numbered index represents one receiver.
                #0 {
                #	name = TYPO3 Fluid-Form (TO1)
                #	email = codingms+typo3-fluid-form-to1@gmail.com
                #}
                #1 {
                #	name = TYPO3 Fluid-Form (TO2)
                #	email = codingms+typo3-fluid-form-to2@gmail.com
                #}
            }
            # This is the cc-receiver of the mail
            cc {
                # You can define as much cc-receiver as you need.
                # Each numbered index represents one cc-receiver.
                #0 {
                #	name = TYPO3 Fluid-Form (CC)
                #	email = codingms+typo3-fluid-form-cc@gmail.com
                #}
            }
            # This is the bcc-receiver of the mail
            bcc {
                # You can define as much bcc-receiver as you need.
                # Each numbered index represents one bcc-receiver.
                #0 {
                #	name = TYPO3 Fluid-Form (BCC)
                #	email = codingms+typo3-fluid-form-bcc@gmail.com
                #}
            }
        }
    }
}
```

### Configuring a reply to email address

By using this configuration, you are able to set a form email address as the reply to email address. Just activate it, set the *fieldset* and the email *field*.

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic {
    finisher {
        mail {
            reply {
                # Activate the reply to email
                active = 1
                # Fieldset that contains the reply to email address field
                addressFieldset = complete
                # Field that contains the reply to email address
                addressField = email
            }
        }
    }
}
```


## Mail content

In the default configuration the mail content is simply defined by TypoScript. This allowes you to use the form out-of-the-box. By using the TypoScript mail content, the sender and receiver mail looks exactly the same.

### TypoScript mail content

This is how the TypoScript mail content works:

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic {
    finisher {
        # Copy database finisher pre-definition
        mail < plugin.tx_fluidform.presets.finisher.mail
        mail {
            # This is the subject of the mail
            subject = Fluid-Form: Contact-Request
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
        }
    }
}
```

### Fluid mail content

You can also render your mail content by using Fluid. This makes you more flexible by defining what your mail should contain. You can activate the Fluid templates like in the following Setup-TypoScript:

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic {
    finisher {
        # Copy database finisher pre-definition
        mail < plugin.tx_fluidform.presets.finisher.mail
        mail {
            sender {
                template = Form/Sender
            }
            receiver {
                template = Form/Receiver
            }
        }
    }
}
```

A Fluid template could look like this:

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



## Sender configuration

For the sender (your website visitor who is sending up your form) there are some additional options.

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic {
    finisher {
        # Copy database finisher pre-definition
        mail < plugin.tx_fluidform.presets.finisher.mail
        mail {
            sender {
                # Sender gets a copy
                sendCopy = 0
                # Fieldset that contains the sender email address field
                addressFieldset = complete
                # Field that contains the sender email address
                addressField = email
            }
        }
    }
}
```

>
>   #### Alert: {.alert .alert-danger}
>
>   This could possibly be a spam risk!
