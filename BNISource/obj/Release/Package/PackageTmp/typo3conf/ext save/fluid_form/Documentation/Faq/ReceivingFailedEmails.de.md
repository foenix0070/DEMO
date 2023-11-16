# Empfang von fehlgeschlagenen E-Mails (z.B. bei Verwendung von Hosteurope als Hoster)

Bitte prüfe, ob die Absender-E-Mail-Adresse existiert! Wenn Du Hosteurope nutzt, musst Du im Provider-Backend eine Standard-E-Mail-Adresse einstellen. Du findest diese Einstellung unter *Administration* -> *Webhosting*/*Virtual Server Managed* -> *Skripte* -> *Standard-E-Mail-Adresse* - auf dieser Seite kannst Du die Emailadresse auswählen.

Anschließend musst Du diese E-Mail-Adresse im TYPO3-Installtool einstellen:

```
[MAIL][transport] = sendmail
[MAIL][transport_sendmail_command] = /usr/sbin/sendmail -t -f mail@domain.com
```

Anstelle der *mail@domain.com* musst Du die Standard-E-Mail-Adresse verwenden, die Du in Hosteuropes Provider-Backend ausgewählt hast. Danach sollte der E-Mail-Empfang problemlos funktionieren.

