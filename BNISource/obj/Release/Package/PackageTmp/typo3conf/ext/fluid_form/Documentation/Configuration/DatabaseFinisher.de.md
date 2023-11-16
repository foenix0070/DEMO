# Konfiguration des Datenbank-Finishers

>   #### Hinweis: {.alert .alert-info}
>
>   Finisher werden in der Reihenfolge verarbeitet, wie sie definiert werden - um die aktuelle Reihenfolge zu prüfen schaue in den TypoScript-Object-Browser.


Um den Datenbank-Finisher nutzen zu können, benötigen wir die folgende TypoScript Konfiguration:

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

>	#### Tipp: {.alert .alert-info}
>
>   Du kannst das Icon des Mail-Containers im Seitenbaum verändern - öffne einfach die Seiten-Einstellungen, wechsel auf den Tab *Verhalten* und wähle in der *Enthält Erweiterung* Auswahlbox den Eintrag *fluid Form mails*.
