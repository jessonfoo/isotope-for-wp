<?php
add_action( 'wp_enqueue_scripts', 'wps_load_scripts' );

/**
 * Enqueue Isotope
 * For commercially developed child themes, you must obtain a license
 * from isotope.metafizzy.co for approx. $25.
 *
 * @link http://isotope.metafizzy.co/
 * @link https://github.com/desandro/isotope
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link http://codex.wordpress.org/Function_Reference/wp_register_script
 *
 * @uses wps_enqueue_jquery()   Registers and enqueues Google CDN jQuery or WordPress jQuery.
 * @uses wp_register_script()   Registers javascripts for use with wp_enqueue_script() later.
 * @uses wp_enqueue_script()    Enqueues javascript.
 */

function wps_load_scripts() {
	// Setup suffix according to WordPress Coding Standards and jQuery Conventions
	// Load dev version if in debug mode
	// Must have dev versions and minified versions in js folder
	$suffix = ( WP_DEBUG || WP_SCRIPT_DEBUG ) ? '.js' : '.min.js';
	
	// Enqueue jQuery, always
	// See https://gist.github.com/4083811
	//wps_enqueue_jquery();
	
	// Register Isotope, so it can be called anytime
	// Prefix everything!
	wp_register_script( 'wps-isotope', get_stylesheet_uri() . '/js/jquery.isotope' . $suffix, array( 'jquery' ), '1.5.21', true );
	
	// Register Isotope Parameters, so it can be called anytime
	// Create minified isotope-parameters version at http://jscompress.com
	// isotope-parameters file named: isotope-parameters.min.js
	wp_register_script( 'wps-isotope-parameters', get_stylesheet_uri() . '/js/isotope-parameters' . $suffix, array( 'wps-isotope' ), '1.5.21', true );
	
	// Enqueue Isotope Scripts only when needed (home, page template, custom field set)
	global $post;
	if ( is_home() || is_page_template( 'my-super-cool-template.php' ) || get_post_meta( $post->ID, 'wps_isotope' ) )
		wp_enqueue_script( 'wps-isotope-parameters' );
}
