# Receiving emails failed (For example by using Hosteurope as Hoster)

Please check if the sender emailaddress really exists! In case of using Hosteurope, you need to set a default emailaddress within the Provider-Backend. You will find this setting in *Administration* -> *Webhosting*/*Virtual Server Managed* -> *Skripte* -> *Standard-E-Mail-Adresse* - on this page you're able to select the emailaddress.

Finally you have to set this emailaddress in TYPO3 Installtool:

```
[MAIL][transport] = sendmail
[MAIL][transport_sendmail_command] = /usr/sbin/sendmail -t -f mail@domain.com
```

Instead of the *mail@domain.com* you have to use the default emailaddress, which you had selected in Hosteuropes Provider-Backend. Afterwards the receiving of email should work fine.

