<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WPOrigo Smooth Scrolling actions
 * @package      WPOrigo Smooth Scrolling
 * @author       Elod Horvath
 * @copyright    2014-... Elod Horvath
 * @since        1.0
*/


/**
 * Enqueue scripts and styles.
 */
function wporigo_ssp_scripts() {
	
	// Scripts
	wp_enqueue_script( 'modernizr', WPORIGO_SSP_URL . '/vendor/modernizr.custom.27157.js', '', '2.8.3', true );
	wp_enqueue_script( 'tweenmax', WPORIGO_SSP_URL . '/vendor/TweenMax.min.js', array( 'jquery' ), '', true );	
	wp_enqueue_script( 'scrolltoplugin', WPORIGO_SSP_URL . '/vendor/ScrollToPlugin.min.js', array( 'jquery' ), '', true );	
	wp_enqueue_script( 'wporigo_ssp', WPORIGO_SSP_URL . '/assets/js/wporigo_ssp.js', array( 'jquery' ), '1.0', true );

	// Add variables to JS
	$options = get_option( 'wporigo_ssp_options' );
	wp_localize_script( 'wporigo_ssp', 'wporigo_ssp_vars', array( 
		'wporigo_ssp_scrolldistance' => $options['wporigo_ssp_scrolldistance'] ? $options['wporigo_ssp_scrolldistance'] : '240'		
	) );

}
add_action( 'wp_enqueue_scripts', 'wporigo_ssp_scripts' );



/**
 * Add page to admin dashboard
 */
function wporigo_ssp_add_page() {

	add_menu_page(
			__( 'WPOrigo SSP', 'wporigo_ssp' ), 
			__( 'WPOrigo SSP', 'wporigo_ssp' ), 
			'manage_options',  
			'wporigo_ssp_options',
			'wporigo_ssp_create_page'
		);

}
add_action( 'admin_menu', 'wporigo_ssp_add_page' );	


/**
 * Options page callback
 */
function wporigo_ssp_create_page() {

	?>
		<div class="wrap wporigo-ssp-page">
			<div id="icon-plugins" class="icon32"></div>
			<h2><?php _e( 'WPOrigo Smooth Scrolling' , 'wporigo' ) ?></h2> 

			<form method="post" action="options.php">
			
				<?php 					 
					settings_fields( 'wporigo_ssp_options' );   
					do_settings_sections( 'wporigo_ssp_options' );

					submit_button(); 
				?>


			</form>			

		</div>

	<?php

}


/**
 * Register and add settings
 */
function wporigo_ssp_page_init() {

	/**
	 * Register Options		
	 */
	register_setting(
		'wporigo_ssp_options', // Options group
		'wporigo_ssp_options', // Options name
		'wporigo_ssp_sanitize' // Sanitize
	);		

	// Add Section
	add_settings_section(
		'wporigo_ssp_options_section', // ID
		__( 'WPOrigo SSP Options', 'wporigo_ssp' ), // Title
		'', // Callback
		'wporigo_ssp_options' // Page
	);  

	// Add field to the Section
	add_settings_field(
		'wporigo_ssp_scrolldistance', // ID
		__( 'Scrolldistance', 'wporigo_ssp' ), // Title 
		'wporigo_ssp_scrolldistance_cb', // Callback
		'wporigo_ssp_options', // Page
		'wporigo_ssp_options_section' // Section           
	); 

}
add_action( 'admin_init', 'wporigo_ssp_page_init' );


/**
 * Sanitize section fields
 */
function wporigo_ssp_sanitize( $input ) {

	$new_input = array();

	if( isset( $input['wporigo_ssp_scrolldistance'] ) )
		$new_input['wporigo_ssp_scrolldistance'] = sanitize_text_field( $input['wporigo_ssp_scrolldistance'] );

	return $new_input;

}


/**
 * Callback Section Fields
 */
function wporigo_ssp_scrolldistance_cb() {

	$options = get_option( 'wporigo_ssp_options' );

	printf(
		'<input type="text" id="wporigo_ssp_scrolldistance" name="wporigo_ssp_options[wporigo_ssp_scrolldistance]" value="%s" />',
		! empty( $options['wporigo_ssp_scrolldistance'] ) ? esc_attr( $options['wporigo_ssp_scrolldistance']) : '240'
	);

}


?>
