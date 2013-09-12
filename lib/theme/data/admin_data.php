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
		)
	);
?>