<?php

function _s_vc_show_team_links() {
	vc_map( array(
		'name'     => __('Contact Links'),
		'base'     => _S_SHORTCODE_PREFIX . '-team-links',
		'class'    => '',
		'category' => __('Content'),
		'icon'     => get_template_directory_uri() . '/images/icons/_s.png',
		'show_settings_on_create' => true,
		'weight'   => 197,
		'params'   => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Email address', '_s' ),
				'param_name' => 'email',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Email link text', '_s' ),
				'param_name' => 'email_text',
				'description' => 'This text will be shown, linked to the email address. If left blank, \'Email\' will be used.',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Phone', '_s' ),
				'param_name' => 'phone',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Twitter name', '_s' ),
				'param_name' => 'twitter_name',
				'description' => 'Just the name itself, no spaces or @ or http://',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'LinkedIn URL', '_s' ),
				'param_name' => 'linkedin_url',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Facebook URL', '_s' ),
				'param_name' => 'facebook_url',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'CSS classes', '_s' ),
				'param_name' => 'classes',
				'description' => __( 'These should be space-separated.', '_s' ),
			),
		)
	) );
}
add_action( 'vc_before_init', '_s_vc_show_team_links' );