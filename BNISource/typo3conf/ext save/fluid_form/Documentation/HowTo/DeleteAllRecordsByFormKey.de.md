# Wie kann ich alle Datensätze eines Formulars aus der Datenbank löschen?

Nutze einfach die beiden folgenden SQL-Befehle. Hier musst Du lediglich den Form-Key `warrantyRegistration` anpassen.

```
DELETE FROM tx_fluidform_domain_model_field WHERE fluidform IN (
	SELECT uid FROM tx_fluidform_domain_model_form WHERE form_key = 'warrantyRegistration'
);
DELETE FROM tx_fluidform_domain_model_form WHERE form_key = 'warrantyRegistration';
```
