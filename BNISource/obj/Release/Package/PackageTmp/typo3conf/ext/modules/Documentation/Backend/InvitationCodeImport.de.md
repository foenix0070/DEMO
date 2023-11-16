# Einladungscode Import

Du kannst Einladungscodes mit einer CSV-Datei importieren. Eine Beispieldatei kann wie folgt aussehen:

```csv
code,company,first_name,last_name,birthday,usergroups,starttime,endtime
123,Testing GmbH,Theo,Test,1995-12-31,"3,4",1995-12-31 12:00:00,2023-12-31 12:00:00
124,PLZ Inc.,Poldi Postleitzahl,,,"PLZ 38xxx,PLZ 28xxx",,
```

* Ein Code muss immer vorhanden sind, alle anderen Felder sind optional und können während der Registrierung in den Benutzerdatensatz übertragen werden.
* Die Benutzergruppe kann als uid oder als Name angegeben werden. Mehrere Benutzergruppen müssen durch ein Komma getrennt werden.
* Das Datei-Encoding muss UTF-8 sein
