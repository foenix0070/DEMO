# Reporting

The Fluid-Form extension includes a Scheduler/CommandController which can email form enquiries stored in the database. Form enquiries for a form are identified, written to a CSV file and then emailed. The form enquiries can then optionally be deleted from the database.

Important: If the option "Delete data" is activated, any uploaded files will be deleted.
However, these are not sent in the email.

>	#### Alert: {.alert .alert-info}
>
> Before changing form fields a CSV export should be carried out.
> Otherwise the data in the later CSV file may be shown shifted in the cells.
