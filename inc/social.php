<?php

// Set up social networks
global $social_networks;
$social_networks = array(
	array(
		'slug' => 'facebook',
		'name' => 'Facebook',
		'input_label' => 'Facebook URL',
		'show_in_account_links' => true,
		'show_in_share_links' => true,
	),
	array(
		'slug' => 'twitter',
		'name' => 'Twitter',
		'input_label' => 'Twitter URL',
		'show_in_account_links' => true,
		'show_in_share_links' => true,
	),
	array(
		'slug' => 'pinterest',
		'name' => 'Pinterest',
		'input_label' => 'Pinterest URL',
		'show_in_account_links' => true,
		'show_in_share_links' => true,
	),
	array(
		'slug' => 'instagram',
		'name' => 'Instagram',
		'input_label' => 'Instagram URL',
		'show_in_account_links' => true,
		'show_in_share_links' => true,
	),
	array(
		'slug' => 'linkedin',
		'name' => 'LinkedIn',
		'input_label' => 'LinkedIn URL',
		'show_in_account_links' => true,
		'show_in_share_links' => true,
	),
	array(
		'slug' => 'google',
		'name' => 'Google+',
		'input_label' => 'Google+ URL',
		'show_in_account_links' => true,
		'show_in_share_links' => true,
	),
	array(
		'slug' => 'youtube',
		'name' => 'YouTube',
		'input_label' => 'YouTube URL',
		'show_in_account_links' => true,
		'show_in_share_links' => true,
	),
	array(
		'slug' => 'yelp',
		'name' => 'Yelp',
		'input_label' => 'Yelp URL',
		'show_in_account_links' => true,
		'show_in_share_links' => true,
	),
	array(
		'slug' => 'stumbleupon',
		'name' => 'StumbleUpon',
		'input_label' => 'StumbleUpon URL',
		'show_in_account_links' => true,
		'show_in_share_links' => true,
	),
	array(
		'slug' => 'email',
		'name' => 'Email',
		'input_label' => 'Email address',
		'show_in_account_links' => true,
		'show_in_share_links' => false,
	),
	array(
		'slug' => 'rss',
		'name' => 'RSS',
		'input_label' => 'RSS URL',
		'show_in_account_links' => true,
		'show_in_share_links' => false,
	),
);

function _s_get_social_redux_array() {
	global $social_networks;

	$participating_networks = array();

	foreach ( $social_networks as $network ) {
		if ( $network['show_in_account_links'] ) {
			$participating_networks[] = array(
				'id' => $network['slug'],
				'type' => 'text',
				'title' => __( $network['input_label'], '_s' ),
			);
		}
	}

	return $participating_networks;
}