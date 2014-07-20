<?php
	/* References */
	include_once('MmmTools/url-tools.php');
	include_once('MmmTools/data-tools.php');
	include_once('MmmTools/date-tools.php');
	include_once('MmmTools/html-tools.php');
	include_once('MmmTools/string-tools.php');
	include_once('MmmTools/email-tools.php');
	include_once('MmmTools/wp-tools.php');
	include_once('MmmTools/shortcodes.php');

	include_once('data/admin_data.php');
	include_once('data/taxonomy_data.php');
	include_once('data/customizer_data.php');


	// Register Navigation Menus
	/* function custom_navigation_menus() {
		$locations = array(
			'header_menu' => __( 'Subpage Menu', 'text_domain' ),
			'social_menu' => __( 'Social Menu', 'text_domain' )
		);

		register_nav_menus( $locations );
	} */

	// Hook into the 'init' action
	//add_action( 'init', 'custom_navigation_menus' );

	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 12);
?>