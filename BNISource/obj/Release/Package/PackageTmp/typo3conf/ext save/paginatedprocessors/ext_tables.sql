CREATE TABLE tt_content (
	tx_paginatedprocessors_paginationenabled int(1) DEFAULT '0' NOT NULL,
	tx_paginatedprocessors_itemsperpage varchar(6),
	tx_paginatedprocessors_pagelinksshown varchar(6),
	tx_paginatedprocessors_urlsegment varchar(20),
	tx_paginatedprocessors_anchor int(1) DEFAULT '0' NOT NULL,
	tx_paginatedprocessors_anchorid int(1) DEFAULT '0' NOT NULL,
);
