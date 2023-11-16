# Add or remove forms for the plugin selector

You're able to provide forms to different user/usergroups, simply by using Page-TypoScript (tsconfig).

>	**Notice:**
>
>	This configuration is only for the backend form selection. A form can also be defined and used by Setup-TypoScript!

```typo3_typoscript
TCEFORM.tt_content.pi_flexform.fluidform_form.sDEF {
	settings\.form {
		removeItems = contactBasic, callBack, jobApplication, fileUpload
	}
}
```
