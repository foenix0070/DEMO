#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (
  tx_modules_gender varchar(6) DEFAULT '' NOT NULL,
  tx_modules_birthday int(11) DEFAULT '0' NOT NULL,
  tx_modules_mobile varchar(255) DEFAULT '' NOT NULL,
  tx_modules_hash varchar(255) DEFAULT '' NOT NULL,
  tx_modules_terms_confirmed tinyint(4) unsigned DEFAULT '0' NOT NULL,
  tx_modules_privacy_confirmed tinyint(4) unsigned DEFAULT '0' NOT NULL,
  tx_modules_disclaimer_confirmed tinyint(4) unsigned DEFAULT '0' NOT NULL,
  tx_modules_newsletter tinyint(4) unsigned DEFAULT '0' NOT NULL,
  tx_modules_profession varchar(255) DEFAULT '' NOT NULL,
  tx_modules_marital_status varchar(255) DEFAULT '' NOT NULL,
  tx_modules_children int(11) DEFAULT '0' NOT NULL,
  tx_modules_bank_account_owner_name varchar(255) DEFAULT '' NOT NULL,
  tx_modules_bank_account_bank_name varchar(255) DEFAULT '' NOT NULL,
  tx_modules_bank_account_bic varchar(255) DEFAULT '' NOT NULL,
  tx_modules_bank_account_iban varchar(255) DEFAULT '' NOT NULL,
  tx_modules_accounting_type varchar(255) DEFAULT '' NOT NULL,
  tx_modules_vat_number varchar(255) DEFAULT '' NOT NULL,
);
#
# Table structure for table 'tx_modules_domain_model_invitationcode'
#
CREATE TABLE tx_modules_domain_model_invitationcode (
  code varchar(255) DEFAULT '' NOT NULL,
  used tinyint(4) unsigned DEFAULT '0' NOT NULL,
  used_at datetime DEFAULT NULL,
  usergroups text,
  first_name varchar(50) DEFAULT '' NOT NULL,
  last_name varchar(50) DEFAULT '' NOT NULL,
  company varchar(255) DEFAULT '' NOT NULL,
  birthday int(11) DEFAULT '0' NOT NULL,
  starttime int(11) unsigned DEFAULT '0' NOT NULL,
  endtime int(11) unsigned DEFAULT '0' NOT NULL,
);
