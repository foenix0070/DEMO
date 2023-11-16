# Beispiel-Mail einer Registrierungs-Mail

Folgende Beispiel-Mail enthält eine vielzahl an Informationen über den neuen Benutzer. Abhängig von den Eingaben bzw. der gewählten Benutzergruppe werden unterschiedliche Informationen angezeigt.

```xml
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
	  data-namespace-typo3-fluid="true">

<f:section name="Subject">{settings.registration.emailOnActivation.subject}</f:section>
<f:section name="Message">Hallo {frontendUser.firstName} {frontendUser.lastName},
Ihre Bestellung ist eingegangen und wird nun bearbeitet. Die Einzelheiten Ihrer Bestellung können Sie nachfolgend entnehmen.
<f:spaceless><f:variable name="userGroup" value="Basis" />
<f:for each="{frontendUser.usergroup}" as ="group">
<f:if condition="{group.title} == 'Premium'"><f:variable name="userGroup" value="Premium" /></f:if>
<f:if condition="{group.title} == 'Premium Plus'"><f:variable name="userGroup" value="Premium Plus" /></f:if>
</f:for></f:spaceless>
<f:if condition="{userGroup} == 'Basis'">TARIF: STANDARD
Inserate: 1
Kosten: 5,90 Euro (zzgl. MwSt.) im Monat
Laufzeit: 12 Monate
Abrechnung: Jährlich im Voraus
Gewünschte Zahlungsweise: <f:if condition="{frontendUser.accountingType} == 'debit'"><f:then>Lastschrift</f:then><f:else>Rechnung</f:else></f:if>
<f:if condition="{frontendUser.accountingType} == 'debit'">Name der Bank: {frontendUser.bankAccountBankName}
Name des Kontoinhabers: {frontendUser.bankAccountOwnerName}
IBAN: {frontendUser.bankAccountIban}
BIC: {frontendUser.bankAccountBic}
</f:if>
Anrede: <f:if condition="{frontendUser.gender} == 'male'"><f:then>Herr</f:then><f:else if="{frontendUser.gender} == 'female'">Frau</f:else><f:else if="{frontendUser.gender} == 'family'">Familie</f:else><f:else>Divers</f:else></f:if>
Vorname: {frontendUser.lastName}
Name: {frontendUser.firstName}
Strasse: {frontendUser.address}
PLZ: {frontendUser.zip}
Ort: {frontendUser.city}
E-Mail: {frontendUser.email}
Telefon: {frontendUser.telephone}
</f:if>
<f:if condition="{userGroup} == 'Premium'">TARIF: PREMIUM
Inserate: 3
Kosten: 9,90 Euro (zzgl. MwSt.) im Monat
Laufzeit: 12 Monate
Abrechnung: Jährlich im Voraus
Gewünschte Zahlungsweise: <f:if condition="{frontendUser.accountingType} == 'debit'"><f:then>Lastschrift</f:then><f:else>Rechnung</f:else></f:if>
<f:if condition="{frontendUser.accountingType} == 'debit'">Name der Bank: {frontendUser.bankAccountBankName}
Name des Kontoinhabers: {frontendUser.bankAccountOwnerName}
IBAN: {frontendUser.bankAccountIban}
BIC: {frontendUser.bankAccountBic}
</f:if>
Anrede: <f:if condition="{frontendUser.gender} == 'male'"><f:then>Herr</f:then><f:else if="{frontendUser.gender} == 'female'">Frau</f:else><f:else if="{frontendUser.gender} == 'family'">Familie</f:else><f:else>Divers</f:else></f:if>
Vorname: {frontendUser.lastName}
Name: {frontendUser.firstName}
Strasse: {frontendUser.address}
PLZ: {frontendUser.zip}
Ort: {frontendUser.city}
E-Mail: {frontendUser.email}
Telefon: {frontendUser.telephone}
</f:if>
<f:if condition="{userGroup} == 'Premium Plus'">TARIF: PREMIUM PLUS
Inserate: 5
Kosten: 19,90 Euro (zzgl. MwSt.) im Monat
Laufzeit: 12 Monate
Abrechnung: Jährlich Im Voraus
Gewünschte Zahlungsweise: <f:if condition="{frontendUser.accountingType} == 'debit'"><f:then>Lastschrift</f:then><f:else>Rechnung</f:else></f:if>
<f:if condition="{frontendUser.accountingType} == 'debit'">Name der Bank: {frontendUser.bankAccountBankName}
Name des Kontoinhabers: {frontendUser.bankAccountOwnerName}
IBAN: {frontendUser.bankAccountIban}
BIC: {frontendUser.bankAccountBic}
</f:if>
Anrede: <f:if condition="{frontendUser.gender} == 'male'"><f:then>Herr</f:then><f:else if="{frontendUser.gender} == 'female'">Frau</f:else><f:else if="{frontendUser.gender} == 'family'">Familie</f:else><f:else>Divers</f:else></f:if>
Vorname: {frontendUser.lastName}
Name: {frontendUser.firstName}
Strasse: {frontendUser.address}
PLZ: {frontendUser.zip}
Ort: {frontendUser.city}
E-Mail: {frontendUser.email}
Telefon: {frontendUser.telephone}
</f:if>

Vielen Dank für Ihre Bestellung auf www.domain.tld

Viele Grüße
Ihre Team von ...
</f:section>

</html>
```
