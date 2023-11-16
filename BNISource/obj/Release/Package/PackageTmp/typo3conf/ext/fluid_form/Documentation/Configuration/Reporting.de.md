# Reporting

Die Fluid-Form Erweiterung bringt einen Scheduler/CommandController mit sich, welcher
in der Datenbank gespeicherte Formular-Anfragen verschicken kann. Hier bei werden je
Formular alle vorhandenen Formular-Anfragen ermittelt, in eine CSV-Datei geschrieben und
dann via E-Mail verschickt. Optional können die gerade verschicken Formular-Anfragen dann
aus der Datenbank gelöscht werden.

Wichtig: Wenn die Option "Daten löschen" aktiviert ist, werden auch hochgeladene Dateien gelöscht.
Diese werden jedoch nicht in der E-Mail mit versendet.

>	#### Hinweis: {.alert .alert-info}
>
> Wenn die Felder eines Formulars verändert werden, sollte vorher ein CSV-Export ausgeführt
> werden. Andernfalls kann es sein das die Daten in der späteren CSV in den Zellen verschoben dargestellt werden.
