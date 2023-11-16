# Unterschiedliche Konfigurationen für Frontend-Benutzergruppen

Wenn Du unterschiedliche Konfigurationen abhängig von der Frontend-Benutzergruppe für Deine Frontend-Module benötigst, kannst Du folgende TypoScript-Conditions verwenden:

```typo3_typoscript
[like(","~frontend.user.userGroupList~",", "*,1,*")]
    plugin.tx_bookingspro.settings.lists.bookingObject.maxItems = 1
[END]

[like(","~frontend.user.userGroupList~",", "*,2,*")]
    plugin.tx_bookingspro.settings.lists.bookingObject.maxItems = 3
[END]

[like(","~frontend.user.userGroupList~",", "*,3,*")]
    plugin.tx_bookingspro.settings.lists.bookingObject.maxItems = 5
[END]
```
