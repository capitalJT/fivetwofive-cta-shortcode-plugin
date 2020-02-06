<?php // fivetwofive - Core Functionality



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// custom login logo url
function fivetwofive_custom_login_url( $url ) {

	$options = get_option( 'fivetwofive_options', fivetwofive_options_default() );

	if ( isset( $options['custom_url'] ) && ! empty( $options['custom_url'] ) ) {

		$url = esc_url( $options['custom_url'] );

	}

	return $url;

}
add_filter( 'login_headerurl', 'fivetwofive_custom_login_url' );



// custom login logo title
function fivetwofive_custom_login_title( $title ) {

	$options = get_option( 'fivetwofive_options', fivetwofive_options_default() );

	if ( isset( $options['custom_title'] ) && ! empty( $options['custom_title'] ) ) {

		$title = esc_attr( $options['custom_title'] );

	}

	return $title;

}
add_filter( 'login_headertitle', 'fivetwofive_custom_login_title' );


// custom login message
function fivetwofive_custom_login_message( $message ) {

	$options = get_option( 'fivetwofive_options', fivetwofive_options_default() );

	if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {

		$message = wp_kses_post( $options['custom_message'] ) . $message;

	}

	return $message;

}
add_filter( 'login_message', 'fivetwofive_custom_login_message' );



// TODO: Keeping the above code for reference.




/* JT adding shortcode functionality */

/*
 * Download CTA
 * shortcode: [cta-download cta_title="" cta_subtitle="" cta_content="" cta_link=""]
 */
function fivetwofive_cta_download(){

	extract(
		shortcode_atts(
			array(
				'cta_title' => '',
				'cta_subtitle' => '',
				'cta_content' => '',
				'cta_link' => ''
			), $atts
		)
	);

	$options = get_option( 'fivetwofive_options', fivetwofive_options_default() );

	$fivetwofive_default_options_array = fivetwofive_options_default();

//	$fivetwofive_cta_default_title = $fivetwofive_default_options_array['custom_title'];
//	$fivetwofive_cta_default_url = $fivetwofive_default_options_array['custom_url'];
//	$fivetwofive_cta_default_message = $fivetwofive_default_options_array['custom_message'];

//	echo "Default Title: ". $fivetwofive_default_options_array['custom_title'] ."</br>";
//	echo "Default URL: ". $fivetwofive_default_options_array['custom_url'] ."</br>";
//	echo "Default Message: ". $fivetwofive_default_options_array['custom_message'] ."</br>";

	$cta_download_html = "<div class='cta cta-download'>";
	$cta_download_html .= "<div class='cta-download-inner'>";
	$cta_download_html .= "<div class='cta-column-1'>";
	if($cta_title !== '') {
		$cta_download_html .= "<h3 class='cta-title text-white'>$cta_title</h3>";
	} else {
		$cta_download_html .= "<h3 class='cta-title text-white'>Download Cribl. It's free to get started.</h3>";
	}

	if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {
		$cta_message = wp_kses_post( $options['custom_message'] );
	} else {
		$cta_message = wp_kses_post( $fivetwofive_default_options_array['custom_message'] );
	}

	$cta_download_html .= $cta_message;

	$cta_download_html .= "</div>";

	$cta_download_html .= "<div class='cta-column-2'>";

		if ( isset( $options['custom_url'] ) && ! empty( $options['custom_url'] ) ) {
			$cta_link = esc_url( $options['custom_url'] );
		} else {
			$cta_link = esc_url( $fivetwofive_default_options_array['custom_url'] );
		}

		$cta_download_html .= "<a class='button cta-button-1 has-shadow' href='$cta_link'>Download</a>";

	$cta_download_html .= "</div>";
	$cta_download_html .= "</div>";
	$cta_download_html .= "</div>";

	return $cta_download_html;
}


function fivetwofive_register_cta_shortcodes() {
	/* Adding Shortcodes */
	add_shortcode('cta-download', 'fivetwofive_cta_download');

	/* Adding Styles */
	wp_register_style( 'fivetwofive_cta_styles', plugins_url('../public/css/fivetwofive-cta-styles.css', __FILE__), false, '1.0.0', 'all');
	wp_enqueue_style( 'fivetwofive_cta_styles' );

	/* Adding Scripts */
	wp_register_script( 'fivetwofive_cta_scripts', plugins_url('../public/js/fivetwofive-cta-scripts.js',__FILE__ ));
	wp_enqueue_script('fivetwofive_cta_scripts');
}

add_action( 'init', 'fivetwofive_register_cta_shortcodes');


