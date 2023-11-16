# Frontend modules integration

**Todo list**

*   Add a `frontend_user` property in object that should be editable from frontend (DB, TCA, Model, Translation)
*   Define a frontend plugin (ext_localconf.php and ext_tables.php)
*   Define a frontend controller (see EXT:bookings or EXT:address_manager)
*   Add required Fluid template (create, edit, error, list)
*   Add `findAllForFrontendList` and `findByIdentifierFrontend` in object repository
*   Define a static template for TypoScript configuration
*   Add Fluid template pathes for EXT:modules in setup.typoscript
*   Ensure your object model have getter/setter for `deleted`, `hidden`
