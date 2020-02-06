<?php
/**
 * Plugin Name:       FiveTwoFive CTA Shortcode Plugin
 * Plugin URI:        https://github.com/capitalJT/fivetwofive-cta-shortcode-plugin
 * Description:       FiveTwoFive CTA Shortcode Plugin.
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Jabal Torres
 * Author URI:        https://jabaltorres.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */


/* disable direct file access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/*
 * Download CTA
 * shortcode: [cta-download cta_title="" cta_subtitle="" cta_content="" cta_link=""]
 */
function fivetwofive_cta_download($atts){

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

	$cta_download_html = "<div class='cta cta-download'>";
		$cta_download_html .= "<div class='cta-download-inner'>";
			$cta_download_html .= "<div class='cta-column-1'>";
				if($cta_title !== '') {
					$cta_download_html .= "<h3 class='cta-title text-white'>$cta_title</h3>";
				} else {
					$cta_download_html .= "<h3 class='cta-title text-white'>Download Cribl. It's free to get started.</h3>";
				}

				if($cta_subtitle !== '') {
					$cta_download_html .= "<h4 class='cta-subtitle text-white'>$cta_subtitle</h4>";
				}

				if($cta_content !== '') {
					$cta_download_html .= "<p class='cta-paragraph text-white'>$cta_content</p>";
				} else {
					$cta_download_html .= "<p class='cta-paragraph text-white'>It's free to process <100 GB per day. Once you see the value and want to process more, let's talk. The free plan is single node and community supported.</p>";
				}
			$cta_download_html .= "</div>";

			$cta_download_html .= "<div class='cta-column-2'>";
				if($cta_link !== '') {
					$cta_download_html .= "<a class='cta-button' href='$cta_link'>Download</a>";
				} else {
				$cta_download_html .= "<a class='button cta-button-1 has-shadow' href='/download/'>Download</a>";
			}
			$cta_download_html .= "</div>";
		$cta_download_html .= "</div>";
	$cta_download_html .= "</div>";

	return $cta_download_html;
}

/*
 * Contact CTA Form
 * shortcode: [cta-contact-form cta_class="" cta_link=""]
 */
function fivetwofive_cta_contact_form($atts){

	extract(
		shortcode_atts(
			array(
				'cta_class' => '',
				'cta_link' => ''
			), $atts
		)
	);

	$cta_contact_form = "<div class='cta cta-contact-form'>";
		$cta_contact_form.= "<div id='cta-contact-form-content-wrapper' class='cta-contact-form-wrapper'>";
			if($cta_class !== '' && $cta_link !== '') {
				$cta_contact_form .= "<div class=\"$cta_class\"></div><script src=\"$cta_link\" type=\"text/javascript\" charset=\"utf-8\"></script>";
			} else {
				$cta_contact_form .= "<div class=\"_form_5\"></div><script src=\"https://cribl.activehosted.com/f/embed.php?id=5\" type=\"text/javascript\" charset=\"utf-8\"></script>";
			}
		$cta_contact_form .= "</div>";
	$cta_contact_form .= "</div>";

	return $cta_contact_form;
}


function fivetwofive_register_cta_shortcodes() {
	/* Adding Shortcodes */
	add_shortcode('cta-download', 'fivetwofive_cta_download');
	add_shortcode('cta-contact-form', 'fivetwofive_cta_contact_form');

	/* Adding Styles */
	wp_register_style( 'fivetwofive_cta_styles', plugins_url('/public/css/fivetwofive-cta-styles.css', __FILE__), false, '1.0.0', 'all');
	wp_enqueue_style( 'fivetwofive_cta_styles' );

	/* Adding Scripts */
	wp_register_script( 'fivetwofive_cta_scripts', plugins_url('/public/js/fivetwofive-cta-scripts.js',__FILE__ ));
	wp_enqueue_script('fivetwofive_cta_scripts');
}

add_action( 'init', 'fivetwofive_register_cta_shortcodes');