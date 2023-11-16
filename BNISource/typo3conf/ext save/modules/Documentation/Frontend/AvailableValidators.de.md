# Verfügbare Validatoren

*   `NotEmpty` - Fehler wenn ein String leer ist.
*   `Email` - Fehler wenn ein String keine gültige Mailadresse ist.
*   `Slug` - Fehler wenn ein String kein valider Slug ist.
*   `SlugUnique` - Fehler wenn der String bereits als Slug verwendet wird.
*   `MaxLength` - Fehler wenn der String länger ist, als in `maxLength` angegeben.
*   `FileType` - Fehler wenn eine hochgeladenen Datei nicht vom Dateityp aus `file.types.*` ist.
*   `FileSize` - Fehler wenn eine hochgeladenen Datei größer aus die in `file.maxSize` angegebenen MB ist.
