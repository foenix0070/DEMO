#
# Table structure for table 'tx_additionaltca_domain_model_example'
#
CREATE TABLE tx_additionaltca_domain_model_example (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,


	string varchar(255) DEFAULT '' NOT NULL,
	int int(11) DEFAULT '0' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	color varchar(255) DEFAULT '' NOT NULL,

	# Custom ones
	currency_db_int int(11) DEFAULT '0' NOT NULL,
	currency_db_float decimal(15,2) unsigned NOT NULL default '0',
	percent_db_int int(11) DEFAULT '0' NOT NULL,
	percent_db_float decimal(15,2) unsigned NOT NULL default '0',
	duration int(11) DEFAULT '0' NOT NULL,
	badge_suggested varchar(255) DEFAULT '' NOT NULL,
	date_db_timestamp int(11) DEFAULT '0' NOT NULL,
	date_db_date date DEFAULT NULL,
	datetime_db_timestamp int(11) DEFAULT '0' NOT NULL,
	datetime_db_date datetime DEFAULT NULL,
	expandable_textarea_open text NOT NULL,
	expandable_textarea_closed text NOT NULL,
	expandable_textarea_small_open text NOT NULL,
	expandable_textarea_small_closed text NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY language (l10n_parent,sys_language_uid)

);
