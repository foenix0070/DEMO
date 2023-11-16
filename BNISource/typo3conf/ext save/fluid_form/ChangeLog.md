# Fluid-Form Change-Log

## 2023-01-17  Release of version 3.1.0

*	[BUGFIX] Fix undefined array key in PHP 8+
*	[TASK] Migrate CSH to TCA description and clean up configuration
*	[TASK] Add missing services yaml
*	[TASK] Add meta description to config.json
*	[FEATURE] Add core Fluid HTML mails and remove plain text mails (see Migration.md)
*	[TASK] Extend and optimize documentation



## 2022-08-26  Release of version 3.0.0

*	[TASK] Extend and optimize documentation
*	[FEATURE] Refresh Captcha on invalid requests
*	[TASK] Migrations and optimizations for TYPO3 and PHP 8.0
*	[BUGFIX] Fix getting absolute folder for frontend files
*	[BUGFIX] Fix documentation configuration
*	[TASK] Add documentations configuration



## 2022-08-19  Release of version 2.5.8

*	[BUGFIX] Add missing composer information



## 2022-08-18  Release of version 2.5.7

*	[BUGFIX] Fix getting absolute folder for frontend files
*	[BUGFIX] Fix documentation configuration
*	[TASK] Add documentations configuration



## 2021-05-18  Release of version 2.5.6

*	[TASK] Add extension key in composer.json



## 2021-05-07  Release of version 2.5.5

*	[TASK] Add another documentation section about JavaScript-Events



## 2021-01-29  Release of version 2.5.4

*	[BUGFIX] Fix a type error in case of sending an empty Mathguard captcha
*	[TASK] Add another how-to article



## 2021-01-13  Release of version 2.5.3

*	[TASK] Refactoring des MathGuard source codes



## 2021-01-04  Release of version 2.5.2

*	[TASK] Add documentation translations



## 2021-01-04  Release of version 2.5.1

*	[TASK] Add documentation translations



## 2020-12-05  Release of version 2.5.0

*	[TASK] Add documentation and translations
*	[FEATURE] Add backend search word filtering
*	[BUGFIX] Fix method type definition in TypoScript service
*	[FEATURE] Add backend module for manage mails and requests
*	[TASK] Performance optimization for export scheduler



## 2020-10-14  Release of version 2.4.5

*	[BUGFIX] Send copy mail to sender
*	[TASK] Code clean up



## 2020-07-09  Release of version 2.4.4

*	[TASK] Add tags to composer.json



## 2020-07-01  Release of version 2.4.3

*	[TASK] Move content element wizard to forms tab
*	[TASK] Add missing tag "OpenSource"



## 2020-06-18  Release of version 2.4.2

*	[TASK] Remove basic, advanced and expert TypoScript constant category
*	[TASK] Add tags to composer.json



## 2020-05-19  Release of version 2.4.1

*	[TASK] Switch to Hook (PageLayoutViewDrawItemHookInterface) for Backend Preview to avoid interference with other extensions



## 2020-05-19  Release of version 2.4.0

*	[TASK] remove pages and recursive options from plugin configuration
*	[TASK] Delete form data after sending via email in report command
*	[TASK] Migrate report command from command controller to symfony command
*	[TASK] Remove obsolete realurl configuration
*	[TASK] Correct labels for wizard for new content element
*	[TASK] Add wizard for new content element see #2
*	[TASK] Add Editorconfig configuration
*	[TASK] Add backend preview for plugin element see #1



## 2020-05-19  Release of version 2.3.0

*	[TASK] Add support for TYPO3 10.4, drop support for TYPO3 8.7



## 2020-03-16  Release of version 2.2.0

*	[FEATURE] Add Scheduler/CommandController for sending reports for a form
*	[TASK] Rise PHP and TYPO3 version
*	[TASK] Optimize page tree icon for TYPO3 9.5
*	[TASK] Add documentation for PDF in mail attachments



## 2019-10-13  Release of version 2.1.3

*	[TASK] Remove DEV identifier.
*	[TASK] Add Gitlab-CI configuration.



## 2019-01-16  Release of version 2.1.2

*	[BUGFIX] Fixing jQuery selector for date picker binding.



## 2018-10-29  Release of version 2.1.1

*	[TASK] Increasing size of value database field.



## 2018-09-12  Release of version 2.1.0

*	[TASK] Strip HTML tags for plain text mail.
*	[BUGFIX] Fixing Fluid partial/layout typo issue.
*	[BUGFIX] Fixing Fluid paths in constants.txt.
*	[BUGFIX] Fixing JavaScript-Finisher issue.
*	[TASK] Adding todo for file uploads.
*	[TASK] Solving typos in error messages.
*	[FEATURE] Adding multi select support for select boxes.



## 2018-03-27  Release of version 2.0.2

*	[BUGFIX] Fixing JavaScript-Finisher issue.



## 2018-03-27  Release of version 2.0.1

*	[TASK] Adding requireCHashArgumentForActionArguments setting in TypoScript.
*	[TASK] Adding select box custom preset.
*	[BUGFIX] Fixing JavaScript-Finisher issue.
*	[TASK] Optimizing TypoScript configuration and settings.



## 2018-01-09  Release of version 2.0.0

*	[TASK] Migration to Bootstrap 4
*	[TASK] Uploads refactoring



## 2017-11-21  Release of version 1.4.3

*	[BUGFIX] Fixing versions



## 2017-11-21  Release of version 1.4.2

*	[BUGFIX] Fixing inline JavaScript error
*	[TASK] Moving JavaScript into Footer
*	[TASK] Remove default JavaScript events



## 2017-11-09  Release of version 1.4.1

*	[TASK] Presets and documentation



## 2017-08-30  Release of version 1.4.0

*	[FEATURE] Rendering Email templates by Fluid
*	[FEATURE] Adding a reply to configuration in Mail Finisher
*	[TASK] Cleaning up JSON result data
*	[TASK] Collapsing all fields in form Database records
*	[TASK] TCA and preset optimized
*	[FEATURE] Database finisher excludeFromDb field setting
*	[TASK] Refactor upload logic
*	[TASK] Mail subject prefixed with themes.configuration.siteName"
*	[BUGFIX] Fixing missed fieldset preset for CallBack form



## 2017-07-09  Release of version 1.3.0

*	[BUGFIX] Mathguard bugfix for calculating and comparing code
*	[FEATURE] Mail finisher ability for creating PDF for sender and receiver. PDF will be attached to the mails.
*	[TASK] Using a default TCA field for form selection. **Attention:** form.pagets must be modified!
*	[TASK] Loading bootstrap-fileinput only from CDN
*	[TASK] Move JavaScript into footer
*	[TASK] TypoScript clean up (each predefined form get's an own static template)
*	[FEATURE] Database finisher for saving form data in database
*	[FEATURE] Hidden field value is now excludable by `excludeFromMail = 1` from mail content
*	[FEATURE] Checkbox label is able to be displayed formatted raw (no use of HTML special chars)
*	[TASK] Optimize label handling in email and presets
*	[TASK] Foreach warning in cleanup return data
*	[TASK] PHPDoc optimized
*	[TASK] Sourcecode optimization (use statements in Controller)
*	[BUGFIX] Fixing send form on website root (in this case there is no pageUid, which is necessary for cHash calculation) - f:form now uses noCacheHash=1
*	[TASK] Cleanup JSON-Result
*	[FEATURE] Empty field validator for Honeypot implementation.
*	[TASK] TypoScript skip default arguments
*	[BUGFIX] Fixing Session restore method - This method should always return an array.
*	[TASK] Removed usage of REQUEST and replaced it with GeneralUtility-Method.
*	[FEATURE] Form configuration get a new attribute addQueryString. This is by default disabled.
*	[FEATURE] Add a Partial for Hidden fields. Additionally hidden fields can be prefilled by TypoScript.
*	[TASK] MathGuard refactoring
*	[FEATURE] Notice text is able to be displayed formatted raw (no use of HTML special chars)
*	[TASK] Radio-Button CSS settings
*	[TASK] Preselection of Radio-Button
*	[FEATURE] Adding radio button
*	[TASK] Insert Fluid root pathes in setup.txt
*	[TASK] Check if there's at least one active finisher.
*	[TASK] Add NotEmpty validation for Checkbox.
*	[TASK] Setting reply-to-email-address into mail.
*	[BUGFIX] Fixing CSS class in Chechbox Patrial
*	[TASK] Readability of Captcha optimized
*	[BUGFIX] Fixing invalid download/upload links in EmailFinisher
*	[TASK] Split static templates for date picker and upload

## 2016-02-15  Release of version 1.2.0

*	[FEATURE] Adding MathGuard Captcha
*	[FEATURE] Adding date, time and datetime field

## 2016-02-05  Release of version 1.1.0

*	[FEATURE] Adding realurl configuration
*	[FEATURE] Adding upload field
*	[FEATURE] Adding checkbox field
*	[FEATURE] Adding file download by link

## 2016-01-24  Release of version 1.0.0

*	[FEATURE] Adding configuration option for ajaxActionPid
