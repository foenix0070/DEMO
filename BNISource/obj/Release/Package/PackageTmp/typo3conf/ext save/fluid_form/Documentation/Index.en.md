# Documentation of TYPO3 Fluid-Form extension

Here you'll find the Documentation of the TYPO3 Fluid-Form extension. Fluid form is a small TYPO3 extension for creating forms only by using TypoScript. This extension has been developed for shipping TYPO3 Themes with pre-configured forms.

## Main benefits

* Comes with pre-defined forms (contact form, file upload, job application, call back request).
* Thanks to the AJAX technology it does not need a page reload and can therefore be nicely included in your website.
* Comes with a "report" scheduler task which sends submitted forms as CSV file and deletes all data afterwards to make sure no personal data is kept in the database.

## Requirements

By default, this extension works in "AJAX mode". For Form validation and submitting AJAX is used. Make sure you have jQuery with AJAX (not the slim version) included in your frontend.

Assuming "fileadmin" is your storage number 1 (this is the default behaviour), file uploads will be stored in the folder fileadmin/fluid_form_upload by default. Please make sure this folder exists or configure the forms to use another folder. See field "upload" in Configuration/TypoScript/Library/presets.fields.typoscript.

## Known limitations

File upload does not work if you disable the AJAX mode.

## Quick install

* Install the extension (via extension manager or composer: composer req codingms/fluid-form).
* Include the main static template and the static templates for the form types you want to use.
* Configure email receiver and email sender via typoscript constants and typoscript setup (see "Create a simple form" in this documentation).

> #### Notice: {.alert .alert-info}
>
> This documentation is currently under construction. If you found some mistakes or have suggestions for improvement, please send an e-mail to info@coding.ms.
