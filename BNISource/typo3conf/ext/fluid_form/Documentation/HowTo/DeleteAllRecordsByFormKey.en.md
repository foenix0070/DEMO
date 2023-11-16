# How to delete all records of a form from database?

Just use the following SQL query - you only have to exchange the form key `warrantyRegistration`.

```
DELETE FROM tx_fluidform_domain_model_field WHERE fluidform IN (
	SELECT uid FROM tx_fluidform_domain_model_form WHERE form_key = 'warrantyRegistration'
);
DELETE FROM tx_fluidform_domain_model_form WHERE form_key = 'warrantyRegistration';
```
