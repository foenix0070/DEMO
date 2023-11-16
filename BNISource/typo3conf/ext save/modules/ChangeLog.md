# Modules Change-Log

*	[TASK] Remove deprecation of TYPO3_version constant
*	[TASK] Add a TypoScript constant and setting for the user profile page uid
*	[BUGFIX] Add missing controller parameter for returnUrl backend controller method
*	[TASK] Optimize CSS for backend modules
*	[FEATURE] Add default columns for lists



## 2022-11-20  Release of version 5.5.0

*	[FEATURE] Add column selector in backend module lists
*	[FEATURE] Make access utility extendable
*	[TASK] Add FAQ documentation translation EN
*	[TASK] Move translations from TypoScript to XLIFF files



## 2022-11-08  Release of version 5.4.1

*	[BUGFIX] Fix changing return types for PHP 8.1



## 2022-11-02  Release of version 5.4.0

*	[FEATURE] Add column selector for backend modules
*	[FEATURE] Add delimiter selection in invitation code importer
*	[TASK] Clean up deprecated tsconfig
*	[TASK] Optimized documentation
*	[BUGFIX] Fix import invitation codes with usergroup names
*	[TASK] Disable import button until file is selected
*	[TASK] Allow pages in container so that translated container are possible
*	[TASk] Transfer default data from invitation into new frontend user
*	[TASk] Add birthday as default to the invitation code
*	[FEATURE] Add backend module for importing invitation codes for registration
*	[TASK] Transfer default data from invitation into new frontend user
*	[TASK] Add birthday as default to the invitation code
*	[BUGFIX] Fix newsletter field validation for profile editing form
*	[TASK] Add invitation codes extra fields - DB, TCA, model
*	[FEATURE] Migrate from text to html mail templates
*	[TASK] Add invitation codes submodule
*	[TASK] Move table header and pagination above the table
*	[FEATURE] Add a group filter in frontend user backend module
*	[TASK] Don't display the own backend user in backend user module
*	[TASK] Migrate styling for backend filter checkbox
*	[TASK] Add missing german translation
*	[FEATURE] Add optional invitation codes for registration



## 2022-08-19  Release of version 5.3.0

*	[BUGFIX] Fix frontend management repository initialization
*	[FEATURE] Add newsletter checkbox for Frontend user registration and profile
*	[BUGFIX] Fix group column in backend user module
*	[FEATURE] Add authorization for backend export of frontend user



## 2022-08-07  Release of version 5.2.2

*	[TASK] Add FrontendUserUtility method for checking if a user has a group
*	[TASK] Add FrontendUser method for getting email/name array for sending emails



## 2022-08-05  Release of version 5.2.1

*	[TASK] Add authorization rules for questions extension



## 2022-08-04  Release of version 5.2.0

*	[BUGFIX] Fix inheritance of frontend user group
*	[BUGFIX] Fix default icon identifier in editLink ViewHelper
*	[FEATURE] Add AccessUtility method for accessible pages in backend
*	[FEATURE] Add a page type for frontend user management
*	[TASK] Optimize TCA for be_groups
*	[BUGFIX] Fix access on array index disable in backend modules
*	[TASK] Optimize TCA for fe_users and fe_groups
*	[TASK] Insert an active/inactive action in EditLink ViewHelper
*	[TASK] Add starttime and endtime trait in frontend user model



## 2022-07-15  Release of version 5.1.4

*	[TASK] Add backend module cell for single images



## 2022-07-03  Release of version 5.1.3

*	[TASK] Add authorization rules for bookings extension



## 2022-06-14  Release of version 5.1.2

*	[BUGFIX] Fix access utility and the permission on add and delete tables



## 2022-06-01  Release of version 5.1.1

*	[BUGFIX] Fix backend bookmark button for TYPO3 10



## 2022-05-12  Release of version 5.1.0

*	[TASK] Migrate extension icons into Public folder
*	[TASK] Add header and footer ViewHelper for backend modules
*	[TASK] Solve deprecation for bookmarks buttons in backend
*	[TASK] Remove deprecated enableMultiSelectFilterTextfield from TCA
*	[BUGFIX] Transform extension name for backend modules to upper-camel-case
*	[BUGFIX] Fix frontend user profile radio buttons
*	[TASK] Merge static template for frontend profile and registration, because they depend on each other
*	[TASK] Refactoring of backend user authorizations for modules
*	[FEATURE] Add logging service



## 2022-02-22  Release of version 5.0.0

*	[TASK] Add authorization rules for glossaries extension
*	[TASK] Identify backend module extension key by request
*	[BUGFIX] Fix backend list sorting by a mapped field configuration
*	[TASK] Introduce variables for different Bootstrap versions in TYPO3 10/11 Backend
*	[BUGFIX] Fix modal JavaScript attributes for TYPO3 11
*	[BUGFIX] Fix getting absolute folder for frontend files
*	[TASK] Check PHP array access before using
*	[TASK] Migrate clear cache for frontend management
*	[TASK] Working on documentation und structure
*	[TASK] Ensure profile field value is initialized
*	[TASK] Optimize code style
*	[TASK] Remove noCacheHash parameter
*	[TASK] Cleanup Source code and add Services.yaml
*	[BUGFIX] Fix documentation configuration
*	[TASK] Rise PHP version to 7.4
*	[TASK] Migration for TYPO3 11.5 - remove support for TYPO3 9.5
*	[TASK] Add documentations configuration



## 2022-12-14 Release of version 4.3.9

*	[BUGFIX] Add missing controller parameter for returnUrl backend controller method



## 2022-02-22 Release of version 4.3.8

*	[BUGFIX] Fix frontend user profile radio buttons



## 2022-02-22 Release of version 4.3.7

*	[BUGFIX] Fix backend list sorting by a mapped field configuration



## 2021-10-17 Release of version 4.3.6

*	[BUGFIX] Fix entities in frontend editing textarea



## 2021-09-29 Release of version 4.3.5

*	[BUGFIX] Fix login as feature for TYPO3 9.x



## 2021-09-25 Release of version 4.3.4

*	[TASK] Move registration form finisher service into variable



## 2021-06-10 Release of version 4.3.3

*	[BUGFIX] Fix initialize values for frontend user profile



## 2021-06-10 Release of version 4.3.2

*	[BUGFIX] Downgrade Doctrine/DBAL methods for traditional install TYPO3 instances



## 2021-06-06 Release of version 4.3.1

*	[BUGFIX] Fix condition on undefined value in ValidationService



## 2021-05-31 Release of version 4.3.0

*	[TASK] Update translation file Readme.de.md



## 2021-05-26 Release of version 4.2.9

*	[TASK] Add translation file Readme.de.md



## 2021-05-18 Release of version 4.2.8

*	[TASK] Add extension key in composer.json



## 2021-02-21 Release of version 4.2.7

*	[BUGFIX] Deactivate page tree for backend user module, so that is impossible to select a page in this module



## 2021-02-19 Release of version 4.2.6

*	[TASK] Configure all custom defined frontend user fields as exclude fields



## 2021-02-19 Release of version 4.2.5

*	[BUGFIX] Fix backend user creation link



## 2021-02-19 Release of version 4.2.4

*	[BUGFIX] Fix extension configuration utility



## 2021-02-19 Release of version 4.2.3

*	[TASK] Add option to allow non admins to login as frontend user



## 2021-02-18 Release of version 4.2.2

*	[BUGFIX] Fix frontend user login from backend



## 2021-02-17 Release of version 4.2.1

*	[TASK] Optimize translations



## 2021-02-17 Release of version 4.2.0

*	[FEATURE] Add backend module for managing backend users as editor backend user



## 2020-11-02 Release of version 4.1.6

*	[TASK] Add some documentation



## 2020-10-30 Release of version 4.1.5

*	[TASK] Cleanup



## 2020-10-12 Release of version 4.1.4

*	[TASK] Registration email documentation (english)
*	[TASK] Registration email documentation (german)
*	[TASK] Change some example code in documentation



## 2020-10-07 Release of version 4.1.3

*	[TASK] Add en translation files for Documentation/Frontend



## 2020-10-06 Release of version 4.1.2

*	[FEATURE] Optional registration confirmation by administrator
*	[TASK] Add new password hashing method "default" which uses the system setting (usually Argon2i)
*	[BUGFIX] Fix typo password hashing constant and show it in the constant editor



## 2020-10-04 Release of version 4.1.1

*	[TASK] Add extra tag in composer.json for automatic TER release



## Release of version 4.1.0

*	[TASK] Add more documentation for frontend management
*	[BUGFIX] Fix DateTime field for frontend management
*	[BUGFIX] Fix sending mail-on-save in frontend management
*	[FEATURE] Use persistence service for object creation in frontend management as well



## Release of version 4.0.4

*	[BUGFIX] Compare controller as well in active select box item check
*	[BUGFIX] Check if value is null before iterating over it
*	[BUGFIX] Check if $field\['value'\] is an array before trimming it in ValidationService
*	[BUGFIX] Moved login check to prepareAction in the FrontendController
*	[TASK] Change translation label
*	[TASK] Change some translation and labeling issues
*	[TASK] Add TypoScript settings as constants see #14



## Release of version 4.0.3

*	[TASK] Move content element wizards see #16



## Release of version 4.0.2

*	[TASK] Translate documentation files
*	[TASK] Add additional documentation files



## Release of version 4.0.1

*	[TASK] Add notices about mandatory fields below registration and profile form



## Release of version 4.0.0

*	[BUGFIX] Fix checkbox invalid class for Bootstrap 4
*	[TASK] Add title attributes for checkbox links
*	[TASK] Add constant setting for disabling the username field and use email as username
*	[FEATURE] Add export feature for frontend user list in backend
*	[TASK] Fix email sending for TYPO3 10 in DefaultService
*	[TASK] Correct language labels for new content element wizard
*	[BUGFIX] Fix activating tabs in frontend management
*	[BUGFIX] Set correct default value for field "birthday"
*	[TASK] Add warning for missing table message in frontend management context
*	[TASK] Display frontend management svg icons inline for styling by using CSS
*	[BUGFIX] Fix validation of usernames
*	[FEATURE] Add date/time/datetime field for frontend management
*	[FEATURE] Add preset for a notice field in frontend management
*	[FEATURE] Highlight invalid data tabs in frontend management
*	[TASK] Insert filenames into upload element for frontend management
*	[FEATURE] Add unique validator for frontend management
*	[FEATURE] Add float validator for frontend management
*	[BUGFIX] Fix clear cache in frontend context issue
*	[TASK] Optimize error handling on frontend management configuration
*	[FEATURE] Send notification mail on inserted/updated records
*	[FEATURE] Add TypoScript configuration for: use email as username in registration process
*	[TASK] Optimize TCA
*	[FEATURE] Frontend user login from backend modules list
*	[FEATURE] Configuration setting for min length of username and password in registration
*	[TASK] Add new content element wizard for registration and profile see #12
*	[TASK] Add search box for users see #8
*	[TASK] Optimize translation files
*	[TASK] Add translations de.locallang_db see #4
*	[TASK] Add new fields to fe_users TCA and organize them into palettes
*	[TASK] Migration for TYPO3 9.5 upto 10.4
*	[FEATURE] Add Frontend-Editing Tools
*	[FEATURE] New data fields for frontend user: bank account (bank name, owner name, bic, iban), accounting type, country, vat number
*	[FEATURE] Gender options filled by TypoScript
*	[FEATURE] Disclaimer confirm checkbox for registration



## Release of version 3.2.0

*	[TASK] Add more german translations
*	[TASK] Refactoring of the BackendController, which is the base controller for backend modules
*	[FEATURE] Add backend module for frontend user groups
*	[FEATURE] Add preparations for page/user TypoScript settings and feature flags



## Release of version 3.1.2

*	[TASK] Modify Gitlab-CI configuration.



## Release of version 3.1.1

*	[TASK] Rise PHP version in ext_emconf.php.
*	[TASK] Clean up backend module for user.
*	[BUGFIX] Fix backend module for user if sys_note extension is not installed.



## Release of version 3.1.0

*	[FEATURE] Add Gitlab-CI configuration.
*	[FEATURE] Add columns only argument for EditLink view helper.
*	[FEATURE] Add company field for registration and profile.
*	[FEATURE] Add initial value for record type while registration.
*	[FEATURE] Send optionally mail notification on profile updates.
*	[FEATURE] Add privacy protection checkbox and field.
*	[BUGFIX] Fix radio and checkbox error message.
*	[TASK] Add strip tags on plain text column.
*	[BUGFIX] Fixing undeclared argument in editInModalLink ViewHelper.
*	[BUGFIX] Fix pagination link buttons - add missing action parameter.
*	[BUGFIX] Fix restoring filter arguments.
*	[BUGFIX] Fix return url in edit link ViewHelper.



## Release of version 3.0.1

*	[BUGFIX] Removing DEV identifier.



## Release of version 3.0.0

*	[TASK] Migration for TYPO3 9.5.



## Release of version 2.6.0

*	[FEATURE] Adding edit-in-modal feature.



## Release of version 2.5.1

*	[BUGFIX] Fixing version number in ext_emconf.php.


## Release of version 2.5.0

*	[BUGFIX] Fixing close feature in EditInPopupLink-ViewHelper.
*	[BUGFIX] Fixing FrontendUser group cell partial.
*	[TASK] Open links from EditInPopupLink-ViewHelper in maximized window size.
*	[BUGFIX] Adding page uid to edit links in EditLink-ViewHelper.
*	[TASK] Correcting a typo in language file.
*	[BUGFIX] Fixing setting year of birth in FrontendUser model.
*	[TASK] Adding a getAge method in FrontendUser model.



## Release of version 2.4.0

*	[TASK] Adding german translations for frontend plugins
*	[FEATURE] Adding frontend user fields for registration and profile: profession, marital status and children, birthday and year of birth
*	[FEATURE] Adding a min age setting and validation



## Release of version 2.3.0

*	[FEATURE] Adding frontend user profile username row
*	[FEATURE] Providing base controller
*	[TASK] Adding fetch list for restoring filter values
*	[FEATURE] Adding frontend user profile



## Release of version 2.2.0

*	[FEATURE] Adding a frontend user backend module
*	[FEATURE] Adding a simple frontend user registration with double-opt



## Release of version 2.0.1

*	[BUGFIX] Fixing key file



## Release of version 2.0.0

*	[BUGFIX] Fixing translation keys for actions
*	[TASK] Development of first version



[TASK]: https://docs.typo3.org/m/typo3/guide-contributionworkflow/master/en-us/Appendix/CommitMessage.html
[BUGFIX]: https://docs.typo3.org/m/typo3/guide-contributionworkflow/master/en-us/Appendix/CommitMessage.html
[FEATURE]: https://docs.typo3.org/m/typo3/guide-contributionworkflow/master/en-us/Appendix/CommitMessage.html
