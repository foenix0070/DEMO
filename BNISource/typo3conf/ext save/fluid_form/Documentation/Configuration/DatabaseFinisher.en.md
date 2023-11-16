# Configuration of the database finisher

>   #### Notice: {.alert .alert-info}
>
>   Finishers are processed in the same order as they're defined - for that take a look into the TypoScript-Object-Browser.


For using the database finisher for a form you need the following TypoScript configuration:

```typo3_typoscript
plugin.tx_fluidform.settings.forms.contactBasic {
    finisher {
        # Copy database finisher pre-definition
        database < plugin.tx_fluidform.presets.finisher.database
        database {
            # Activate the database finisher
            active = 1
            # Define the Container, where the records should be saved
            storagePid = 605
        }
    }
}
```

>	#### Tip: {.alert .alert-info}
>
>	You are able to change the page tree icon of the Mail-Container - just open the page settings, jump to tab *Behaviour* and select the *Fluid Form mails* item in section *Use as Container*.
