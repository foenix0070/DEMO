# Fluid-Conditions für Frontend-Benutzergruppe

Um Frontend-Benutzergruppen unterschiedliche Funktionen oder Inhalte im Fluid/HTML zu bieten, kannst Du folgende Fluid-Conditions nutzen:

```xml
<f:variable name="userGroup" value="Basis" />
<f:for each="{bookingObject.frontendUser.usergroup}" as ="group">
    <f:if condition="{group.title} == 'Premium'">
        <f:variable name="userGroup" value="Premium" />
    </f:if>
    <f:if condition="{group.title} == 'Premium Plus'">
        <f:variable name="userGroup" value="Premium Plus" />
    </f:if>
</f:for>

<!-- Alternative -->
<f:security.ifHasRole role="1">
   This is being shown in case the current FE user belongs to a FE usergroup (aka role) with the uid "1"
</f:security.ifHasRole>
```
