# E-Mails

Es stehen zwei Arten der Nutzerregistrierung zur Verfügung:
1. Eine einfache Registrierung aus zwei Schritten (Nutzerregistrierung im Formular + Email Bestätigungslink).
2. Eine Registrierung, bei der das Nutzerkonto durch den Seitenadministrator freigeschaltet werden muss.

## Einfache Registrierung

### Registrierungs E-Mail

Diese E-Mail wird verschickt, wenn sich ein neuer Benutzer registriert. Diese E-Mail enthält den Aktivierungs-Link (double-opt-in), der vom Registrierenden geklickt werden muss um seinen Account freizuschalten.

**Einstellungen:**

| Einstellung   | Beschreibung                        | Standard        |
|:--------------|:------------------------------------|:----------------|
| Absender-Name | Der Absender-Name in der E-Mail     | Registration    |
| Absender-Mail | Die Absender-Mailadresse der E-Mail | typo3@coding.ms |
| Betreff       | Der Betreff der E-Mail              | Registrierung   |

**Mailtext:**

Template: `EXT:modules/Resources/Private/Templates/Email/ActivateRegistration.html`

```text
Hi max@mustemann.com,
please confirm your registration by clicking the following link:

https://www.domain.tld/registrierung/9nCKfhT5za3HcexZTEf0T8xLHiUxmEFf?cHash=3e47d8e1eca4cc746b40e599520f2177

---
Thank you for your attention
```

### Registrierungs/Aktivierungs-E-Mail

Diese E-Mail wird verschickt, wenn ein neuer Benutzer auf den Aktivierungs-Link klickt. Diese E-Mail ist lediglich eine Bestätigung und enthält einen Link zur Login-Seite. Bitte beachte, dass diese E-Mail in den Einstellungen aktiviert werden muss!

**Einstellungen:**

| Einstellung   | Beschreibung                        | Standard        |
|:--------------|:------------------------------------|:----------------|
| Absender-Name | Der Absender-Name in der E-Mail     | Registration    |
| Absender-Mail | Die Absender-Mailadresse der E-Mail | typo3@coding.ms |
| Betreff       | Der Betreff der E-Mail              | Registrierung   |

**Mailtext:**

Template: `EXT:modules/Resources/Private/Templates/Email/Activation.html`

```text
Hi max@mustemann.com,
your activation was successful - login by clicking the following link:

https://www.domain.tld/login

---
Thank you for your attention
```

## Registrierung mit Bestätigung durch den Seitenadministrator

Die Registrierung erfolgt in drei Schritten:

1. Der Nutzer registriert sich durch ein Formular und erhält eine E-Mail mit einem Bestätigungslink. (Siehe Kapitel Einfache Registireung > Registrierungs E-Mail)
2. Nach der Bestätigung der Registrierung durch den Nutzer erhält der Seitenadministrator eine E-Mail mit zwei Optionslinks:
    1. Registrierung Bestätigen
    2. Registrierung Ablehnen
3. Der Nutzer wird über die Entscheidung des Seitenadministrators per E-Mail informiert.

### Registrierung Admin: E-Mail

Diese E-Mail wird an den Seitenadministrator verschickt, wenn ein neuer Benutzer auf den Aktivierungs-Link klickt. Diese E-Mail bietet dem Seitenadministrator die
Möglichkeit die Freischaltung des Nutzerkontos zu bestätigen oder abzulehnen.

**Einstellungen:**

| Einstellung   | Beschreibung                        | Standard        |
|:--------------|:------------------------------------|:----------------|
| Absender-Name | Der Absender-Name in der E-Mail     | Registration    |
| Absender-Mail | Die Absender-Mailadresse der E-Mail | typo3@coding.ms |
| Betreff       | Der Betreff der E-Mail              | Registrierung   |
| Empfäger-Mail | Die E-mail des Seitenadministratos  | typo3@coding.ms |

**Mailtext:**

Template: `EXT:modules/Resources/Private/Templates/Email/ActivateRegistrationAdmin.html`

```text
Please confirm or reject registration of the user Beispiel Nutzername by clicking one of the following links:

confirm:

https://www.domain.tld/registration?adminActivation=1&confirm=1&hash=someUserHash


reject:

https://www.domain.tld/registration?adminActivation=1&confirm=0&hash=someUserHash



username: Beispiel Nutzername
name: Max Mustermann
first name: Max
middle name:
last name: Mustemann
address: Beispieladresse 1
telephone: +49 123456789
fax:
email: max@mustermann.de
lock to domain:
title:
zip: 12345
city: Beispielstadt
country:
www:
company:

gender:
birthday:
mobile:
terms confirmed:
privacy confirmed:
disclaimer confirmed:
profession:
marital status:
children:
bank account owner name:
bank account bank name:
bank account bic:
bank account iban:
accounting type:
vat number:


---
Thank you for your attention
```

### Registrierung Admin: Bestätigungs-E-Mail

Diese E-Mail wird verschickt, wenn der Seitenadministrator die Nutzerregistrierung bestätigt. Diese E-Mail ist lediglich eine Bestätigung und enthält einen Link zur Login-Seite. Bitte beachte, dass diese E-Mail in den Einstellungen aktiviert werden muss!

**Einstellungen:**

| Einstellung   | Beschreibung                        | Standard        |
|:--------------|:------------------------------------|:----------------|
| Absender-Name | Der Absender-Name in der E-Mail     | Registration    |
| Absender-Mail | Die Absender-Mailadresse der E-Mail | typo3@coding.ms |
| Betreff       | Der Betreff der E-Mail              | Registrierung   |

**Mailtext:**

Template: `EXT:modules/Resources/Private/Templates/Email/ActivateAdminConfirmation.html`

```text
Hi max@mustemann.com,
site administrator has activated your account - login by clicking the following link:

https://www.domain.tld/login


---
Thank you for your attention
```

### Registrierung Admin: Ablehnungs-E-Mail

Diese E-Mail wird verschickt, wenn der Seitenadministrator die Nutzerregistrierung abgelehnt. Bitte beachte, dass diese E-Mail in den Einstellungen aktiviert werden muss!

**Einstellungen:**

| Einstellung   | Beschreibung                        | Standard        |
|:--------------|:------------------------------------|:----------------|
| Absender-Name | Der Absender-Name in der E-Mail     | Registration    |
| Absender-Mail | Die Absender-Mailadresse der E-Mail | typo3@coding.ms |
| Betreff       | Der Betreff der E-Mail              | Registrierung   |

**Mailtext:**

Template: `EXT:modules/Resources/Private/Templates/Email/ActivateAdminConfirmation.html`

```text
Hi max@mustemann.com,
site administrator has rejected your registration - please contact the site administrator.

https://www.domain.tld/login


---
Thank you for your attention
```
