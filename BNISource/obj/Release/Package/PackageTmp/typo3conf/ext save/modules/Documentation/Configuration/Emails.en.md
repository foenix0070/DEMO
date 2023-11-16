# Emails

There are 2 ways that a user can register:
1. Simple 2-step registration process (user registration form and confirmation link in email).
2. Registration where user account is activated by the site administrator.

## Simple registration

## Registration Email

An email is sent to a new user when they register. The email contains an activation link (double opt-in) which the user clicks to activate their account

**Settings:**

| Setting       | Description                         | Default         |
|:--------------|:------------------------------------|:----------------|
| Absender-Name | Sender name in email                | Registrierung   |
| Absender-Mail | Sender email address in email       | typo3@coding.ms |
| Betreff       | Email subject line                  | Registrierung   |

**Email text:**

Template: `EXT:modules/Resources/Private/Templates/Email/ActivateRegistration.html`

```text
Hi max@mustermann.com,
please confirm your registration by clicking the following link:

https://www.domain.tld/registrierung/9nCKfhT5za3HcexZTEf0T8xLHiUxmEFf?cHash=3e47d8e1eca4cc746b40e599520f2177

---
Thank you for your attention
```

## Registration activation/confirmation email

The email is sent when a new user clicks on the activation link. The email is only a confirmation and contains a link to the login page. Please note that this option must be enabled in settings!

**Settings:**

| Setting       | Description                         | Default         |
|:--------------|:------------------------------------|:----------------|
| Absender-Name | Sender name in email                | Registrierung   |
| Absender-Mail | Sender email address in email       | typo3@coding.ms |
| Betreff       | Subject line in email               | Registrierung   |

**Email text:**

Template: `EXT:modules/Resources/Private/Templates/Email/Activation.html`

```text
Hi max@mustermann.com,
your activation was successful - login by clicking the following link:

https://www.domain.tld/login

---
Thank you for your attention
```

## Registration confirmed by site administrator

Registration consists of three steps:

1. The user registers using a form and receives an email with a confirmation link. (See Simple registration > Registration Email)
2. After the user has confirmed their registration the site administrator receives an email with 2 options (links) 
    1. Confirm registration
    2. Reject registration
3. The user is informed of the site administrator's decision by email.


### Registration admin email

This email is sent to the site administrator when a new user clicks on the activation link. The site administrator can then confirm or reject activation of the user account.

**Settings:**

| Setting       | Description                         | Default         |
|:--------------|:------------------------------------|:----------------|
| Absender-Name | Sender name in the email            | Registration    |
| Absender-Mail | Sender email address in the email   | typo3@coding.ms |
| Betreff       | Subject line in the email           | Registration   |
| Empfäger-Mail | Site administrator email address    | typo3@coding.ms |


**Email text:**

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
last name: Mustermann
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

### Registration confirmed admin email

This email is sent when the site administrator confirms user registration. This email is only a confirmation and contains a link to the login page. Please note that this email must be enabled in settings!

**Settings:**

| Setting       | Description                         | Default         |
|:--------------|:------------------------------------|:----------------|
| Absender-Name | Sender name in the email            | Registration    |
| Absender-Mail | Sender email address in the email   | typo3@coding.ms |
| Betreff       | Email subject line                  | Registrierung   |

**Email text:**

Template: `EXT:modules/Resources/Private/Templates/Email/ActivateAdminConfirmation.html`

```text
Hi max@mustermann.com,
site administrator has activated your account - login by clicking the following link:

https://www.domain.tld/login


---
Thank you for your attention
```

### Registration rejected admin email

This email is sent if the site administrator rejects the user registration. Please note that this email must be enabled in settings!

**Settings:**

| Setting       | Description                         | Default         |
|:--------------|:------------------------------------|:----------------|
| Absender-Name | Sender name in the email            | Registration    |
| Absender-Mail | Sender email address in the email   | typo3@coding.ms |
| Betreff       | Email subject line                  | Registrierung   |

**Email text:**

Template: `EXT:modules/Resources/Private/Templates/Email/ActivateAdminConfirmation.html`

```text
Hi max@mustermann.com,
site administrator has rejected your registration - please contact the site administrator.

https://www.domain.tld/login


---
Thank you for your attention
```
