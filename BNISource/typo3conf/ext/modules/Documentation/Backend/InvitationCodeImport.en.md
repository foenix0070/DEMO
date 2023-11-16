# Invitation code import

You can import invitation codes by using a CSV file. An example file can look like:

```csv
code,company,first_name,last_name,birthday,usergroups,starttime,endtime
123,Testing GmbH,Theo,Test,1995-12-31,"3,4",1995-12-31 12:00:00,2023-12-31 12:00:00
124,PLZ Inc.,Poldi Postleitzahl,,,"PLZ 38xxx,PLZ 28xxx",,
```

* The code must be available, all other fields are optional an can be transferred to the user record on registration.
* The usergroup can be provided by usergroup-uid or name. Multiple usergroups can be divided by a comma.
* The file encoding must be UTF-8
