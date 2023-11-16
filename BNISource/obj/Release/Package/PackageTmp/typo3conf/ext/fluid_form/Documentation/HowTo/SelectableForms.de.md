# Hinzufügen und entfernen von Formularen in der Plugin-Auswahl

Man kann Formulare einfach mit Page-TypoScript (tsconfig) verschiedenen Benutzern/Benutzergruppen hinzufügen oder entfernen.

>	**Hinweis:**
>
>	Diese Konfiguration ist nur für die Backend Formular-Selektion. Ein Formular kann aber auch mit Setup-TypoScript definiert und eingebunden werden!

```typo3_typoscript
TCEFORM.tt_content.pi_flexform.fluidform_form.sDEF {
	settings\.form {
		removeItems = contactBasic, callBack, jobApplication, fileUpload
	}
}
```
