<?php // fivetwofive - Register Settings


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}


// register plugin settings
function fivetwofive_register_settings() {

	register_setting( 
		'fivetwofive_options',
		'fivetwofive_options',
		'fivetwofive_callback_validate_options'
	); 


	/* Login Page Section */
	add_settings_section( 
		'fivetwofive_section_login',
		esc_html__('Customize FiveTwoFive CTA', 'fivetwofive'),
		'fivetwofive_callback_section_login',
		'fivetwofive'
	);


	/* Login Page Fields */
	add_settings_field(
		'custom_url',
		esc_html__('Custom URL', 'fivetwofive'),
		'fivetwofive_callback_field_text',
		'fivetwofive',
		'fivetwofive_section_login',
		[ 'id' => 'custom_url', 'label' => esc_html__('Custom URL for the login logo link', 'fivetwofive') ]
	);
	
	add_settings_field(
		'custom_title',
		esc_html__('Custom Title', 'fivetwofive'),
		'fivetwofive_callback_field_text',
		'fivetwofive',
		'fivetwofive_section_login',
		[ 'id' => 'custom_title', 'label' => esc_html__('Custom title attribute for the logo link', 'fivetwofive') ]
	);

	add_settings_field(
		'custom_message',
		esc_html__('Custom Message', 'fivetwofive'),
		'fivetwofive_callback_field_textarea',
		'fivetwofive',
		'fivetwofive_section_login',
		[ 'id' => 'custom_message', 'label' => esc_html__('Custom text and/or markup', 'fivetwofive') ]
	);
    
}

add_action( 'admin_init', 'fivetwofive_register_settings' );


