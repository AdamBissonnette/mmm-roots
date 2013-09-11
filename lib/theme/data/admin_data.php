<?php
	/*
		Tabs
		Sections
		Fields
	*/

	global $theme_options;
	$theme_options = array(
		array('name' => 'Theme Options',
			'id' => 'theme',
			'icon' => 'cog',
			'sections' => array(
				array(
					'name' => 'General Options',
					'size' => '6',
					'fields' => array(
						array('id' => 'brand_logo',
							'label' => 'Navbar / Brand Logo',
							'type' => 'text'),
						array('id' => 'search_in_navigation',
							  'label' => 'Search In Navigation',
							  'type' => 'checkbox',
							  'options' => array("note" => "Note: When enabled a searchbar will appear in the navigation")
							),
						array('id' => 'footer_logo',
							'label' => 'Footer Logo',
							'type' => 'text'),
						array('id' => 'footer_text',
							'label' => 'Footer Text',
							'type' => 'textarea'),
						array('id' => 'icon_default',
							'label' => 'Default Icon',
							'type' => 'select',
							'options' => array("class" => 'font-awesome', "data" => getFontAwesomeSelectArray()))
					)
				)
			)
		),
		array('name' => 'Homepage Options',
			'id' => 'home',
			'icon' => 'home',
			'sections' => array(
				array(
					'name' => 'Jumbotron Options',
					'size' => 6,
					'fields' => array(
						array('id' => 'jumbotron_category',
							'label' => 'Jumbotron Category',
							'type' => 'select',
							'options' => array( "data" => getCategorySelectArray())),
						array('id' => 'jumbotron_count',
							'label' => 'Number Jumbotron Slides to Display',
							'type' => 'text'),
						array('id' => 'jumbotron_default',
							'label' => 'Default Image to Display',
							'type' => 'text'),
						array('id' => 'jumbotron_animation',
							'label' => 'Transition Effect',
							'type' => 'select',
							'options' => array( "data" => array("slide"=>"Slide", "fade"=>"Fade"))
							)
					)
				)
			)
		)
	);
?>