CREATE TABLE tx_gdprextensionscomyoutube_domain_model_gdprmanager (
	heading text NOT NULL DEFAULT '',
	content text NOT NULL DEFAULT '',
	button_text text NOT NULL DEFAULT '',
	enable_background_image int(11) NOT NULL DEFAULT '0',
	background_image text NOT NULL DEFAULT '',
	background_image_color varchar(255) NOT NULL DEFAULT '',
	button_color varchar(255) NOT NULL DEFAULT '',
	button_text_color varchar(255) NOT NULL DEFAULT '',
	text_color varchar(255) NOT NULL DEFAULT '',
	button_shape varchar(255) NOT NULL DEFAULT '',
	extension_title varchar(255) NOT NULL DEFAULT '',
	extension_key varchar(255) NOT NULL DEFAULT '',
	locations int(11) unsigned NOT NULL DEFAULT '0',
	map_api varchar(255) NOT NULL DEFAULT '',

);

CREATE TABLE tx_gdprextensionscomyoutube_domain_model_cookiewidget (
	 cookie_widget_image text NOT NULL DEFAULT '',
	 cookie_widget_position varchar(255) NOT NULL DEFAULT '',
);
CREATE TABLE tx_gdprextensionscomgooglereview_domain_model_header(
	 filtered_reviews int(11) NOT NULL DEFAULT '0',
	 total_reviews int(11) NOT NULL DEFAULT '0',
	 average_rating_filtered_reviews int(11) NOT NULL DEFAULT '0',
	 average_rating_total_reviews int(11) NOT NULL DEFAULT '0',
	 dashboard_api_key varchar(255) NOT NULL DEFAULT '',
	 root_pid int(11) NOT NULL DEFAULT '0',
);

CREATE TABLE tt_content (
	gdpr_color_of_text_header varchar(255) NOT NULL DEFAULT '',
	gdpr_business_locations_header varchar(255) NOT NULL DEFAULT '',
);

CREATE TABLE tx_gdprextensionscomgooglemap_domain_model_maplocation (
	map int(11) unsigned DEFAULT '0' NOT NULL,
	title varchar(255) NOT NULL DEFAULT '',
	address varchar(255) NOT NULL DEFAULT '',
	lat int(11) NOT NULL DEFAULT '0',
	lon int(11) NOT NULL DEFAULT '0'
);

CREATE TABLE gdpr_multilocations (
	 name_of_location varchar(255) NOT NULL DEFAULT '',
	 dashboard_api_key varchar(255) NOT NULL DEFAULT '',
	 root_pid int(11) unsigned DEFAULT '0',
);
CREATE TABLE tx_gdprclientreviews_domain_model_reviews (
	 review_id varchar(255) NOT NULL DEFAULT '',
	 reviewer_profile_photo_url varchar(255) NOT NULL DEFAULT '',
	 reviewer_display_name varchar(255) NOT NULL DEFAULT '',
	 star_rating int(11) NOT NULL DEFAULT '0',
	 comment text NOT NULL DEFAULT '',
	 source varchar(255) NOT NULL DEFAULT '',
	 content_hash varchar(255) NOT NULL DEFAULT '',
	 reply_comment text DEFAULT '',
	 reply_time varchar(255) DEFAULT '',
	 create_time varchar(255) NOT NULL DEFAULT '',
	 root_pid int(11) NOT NULL DEFAULT '0',
	 date_sort int(11) NOT NULL DEFAULT '0',
	 locationtitle varchar(255) DEFAULT '',
	 revidroot varchar(255) DEFAULT '',
	 dashboard_api_key varchar(255) NOT NULL DEFAULT '',
	 UNIQUE KEY content_hash (content_hash),
	 UNIQUE KEY revidroot (revidroot)
);
