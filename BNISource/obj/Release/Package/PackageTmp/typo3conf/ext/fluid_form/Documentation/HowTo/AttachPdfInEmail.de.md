# Dynamisches PDF an E-Mail anhängen

Mit Fluid-Form kannst Du in Verbindung mit Fluid-FPDF dynamische PDFs direkt an Deine E-Mails hängen. Dabei kann das PDF an den Empfänger und das PDF der E-Mailkopie an den Versender gesondert konfiguriert werden. Hierfür müssen nur entsprechend der `receiver` oder der `sender` Knoten in der Konfiguration genommen werden.

Folgendes Beispiel generiert ein PDF im Anhang der Mail für den Empfänger:

1.  Stelle sicher, dass die Fluid-FPDF Erweiterung installiert ist.
2.  Aktiviere die PDF-Erstellung für Dein Formular:
    ```typo3_typoscript
    plugin.tx_fluidform.settings.forms.warrantyRegistration {
        finisher.mail.receiver.pdf.attach = 1
    }
    ```
3.  Weise einen eigenen Hintergrund zu:
    ```typo3_typoscript
    plugin.tx_fluidform.settings.forms.warrantyRegistration {
        configuration.pdf.receiver.background = EXT:theme_eibach/Resources/Private/Extensions/FluidForm/Pdf/Normbriefbogen_DIN5008.pdf
    }
    ```
4.  Passe den Dateinamen des PDF im E-Mailanhang an:
    ```typo3_typoscript
    plugin.tx_fluidform.settings.forms.warrantyRegistration {
        finisher.mail.receiver.pdf.filename = Materialgarantie.pdf
    }
    ```
5.  Überschreibe den Template-Pfad für das PDF-Template:
    ```typo3_typoscript
    plugin.tx_fluidform.settings.forms.warrantyRegistration {
        configuration.pdf.receiver.templateRootPath = EXT:theme_eibach/Resources/Private/Extensions/FluidForm/Templates/
    }
    ```

Nun ist die Grund-Konfiguration erstellt und Du musst nur noch das PDF-Template als Fluid-Datei bereitstellen.
