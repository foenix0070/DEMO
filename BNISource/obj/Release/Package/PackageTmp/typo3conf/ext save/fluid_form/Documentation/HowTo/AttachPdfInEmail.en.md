# Attach a dynamic PDF to Email

With Fluid-Form you're able to create a dynamic PDF immediately and attach it to your mails. For that you can choose if the PDF should attached only to the receiver mail or attached to the sender mail as well. The configuration can be done in the `receiver` or `sender` node of the configuration.

Following example generates a PDF in the attachment for the mail receiver:

1.  Keep care that the Fluid-FPDF extension is installed.
2.  Enable the PDF setting within your form configuration:
    ```typo3_typoscript
    plugin.tx_fluidform.settings.forms.warrantyRegistration {
        finisher.mail.receiver.pdf.attach = 1
    }
    ```
3.  Configure an optional background PDF:
    ```typo3_typoscript
    plugin.tx_fluidform.settings.forms.warrantyRegistration {
        configuration.pdf.receiver.background = EXT:theme_eibach/Resources/Private/Extensions/FluidForm/Pdf/Normbriefbogen_DIN5008.pdf
    }
    ```
4.  Configure the filename of the attached file:
    ```typo3_typoscript
    plugin.tx_fluidform.settings.forms.warrantyRegistration {
        finisher.mail.receiver.pdf.filename = Materialgarantie.pdf
    }
    ```
5.  Override the Template path of the PDF-Template:
    ```typo3_typoscript
    plugin.tx_fluidform.settings.forms.warrantyRegistration {
        configuration.pdf.receiver.templateRootPath = EXT:theme_eibach/Resources/Private/Extensions/FluidForm/Templates/
    }
    ```

Now the general configuration is created and you only need to provide the PDF-Template as a Fluid file.
