# Frontend Module integrieren

**ToDo-Liste**

*   Hinzufügen einer `frontend_user`-Eigenschaft in Objekten, die vom Frontend aus editierbar sein sollen (DB, TCA, Model, Translation)
*   Definieren eines Frontend-Plugin (ext_localconf.php und ext_tables.php)
*   Definieren eines Frontend-Controller (siehe EXT:bookings oder EXT:address_manager)
*   Erforderliches Fluid-Template hinzufügen (Erstellen, Bearbeiten, Fehler, Liste)
*   `FindAllForFrontendList` und `findByIdentifierFrontend` im Objekt-Repository hinzufügen
*   Definieren einer statischen Vorlage für die TypoScript-Konfiguration
*   Fluid-Template-Pfade für EXT:modules in setup.typoscript hinzufügen
*   Sicher stellen, dass Objektmodell über Getter/Setter für `deleted`, `hidden` verfügt
