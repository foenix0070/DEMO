# Define different configurations depending on frontend user group

If you need to set different configurations depending on the frontend user group in your frontend modules, use TypoScript conditions:

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
