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
						array('id' => 'footer_logo',
							'label' => 'Footer Logo',
							'type' => 'text'),
						array('id' => 'footer_text',
							'label' => 'Footer Text',
							'type' => 'textarea'),
						array('id' => 'icon_default',
							'label' => 'Default Icon',
							'type' => 'text',
							'options' => array( "placeholder" => 'ex. cloud', "note" => "Hint: font-awesome icon class" ))
					)
				),
				array(
					'name' => 'Portfolio Options',
					'size' => '6',
					'fields' => array(
						array('id' => 'portfolio_category',
							'label' => 'Portfolio Category',
							'type' => 'select',
							'options' => array( "data" => getCategorySelectArray()))
						)
				)
			)
		),
		array('name' => 'Homepage Options',
			'id' => 'home',
			'icon' => 'home',
			'sections' => array(
				array(
					'name' => 'Services Options',
					'size' => 6,
					'fields' => array(
						array('id' => 'service_page',
							'label' => 'Service Page',
							'type' => 'select',
							'options' => array( "data" => getPagesSelectArray())),
						array('id' => 'service_category',
							'label' => 'Service Category',
							'type' => 'select',
							'options' => array( "data" => getCategorySelectArray()))
					)
				),
				array(
					'name' => 'News Options',
					'size' => 6,
					'fields' => array(
						array('id' => 'news_title',
							'label' => 'News Section Title',
							'type' => 'text'),
						array('id' => 'news_tagline',
							'label' => 'News Section Tagline',
							'type' => 'text'),
						array('id' => 'news_category',
							'label' => 'News Category',
							'type' => 'select',
							'options' => array( "data" => getCategorySelectArray()))
					)
				),
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
				),
				array(
					'name' => 'Testimonial Options',
					'size' => 6,
					'fields' => array(
						array('id' => 'testimonial_category',
							'label' => 'Testimonial Category',
							'type' => 'select',
							'options' => array( "data" => getCategorySelectArray())),
						array('id' => 'testimonial_title',
							'label' => 'Testimonial Title',
							'type' => 'text'),
						array('id' => 'testimonial_tagline',
							'label' => 'Testimonial Tagline',
							'type' => 'text')

					),
				)
			)
		),
		array('name' => 'Contact Options',
			'id' => 'contact',
			'icon' => 'envelope',
			'sections' => array(
				array(
					'name' => 'Business Information',
					'size' => 6,
					'fields' => array(
						array('id' => 'business_name',
							'label' => 'Business Name',
							'type' => 'text'
						),
						array('id' => 'business_address',
							'label' => 'Business Address',
							'type' => 'textarea'
						),
						array('id' => 'business_phone',
							'label' => 'Phone Number',
							'type' => 'text'
						),
						array('id' => 'business_email',
							'label' => 'Email Address',
							'type' => 'text'
						),
						array('id' => 'business_github',
							'label' => 'Github',
							'type' => 'text'
						),
						array('id' => 'business_twitter',
							'label' => 'Twitter',
							'type' => 'text'
						)

					)
				),
				array(
					'name' => 'Hours Information',
					'size' => 6,
					'fields' => array(
						array('id' => 'hours_title',
							'label' => 'Business Hours Title',
							'type' => 'text'
						),
						array('id' => 'hours_content',
							'label' => 'Business Hours',
							'type' => 'textarea'
						)
					)
				),
				array(
					'name' => 'Google Map Information',
					'size' => 6,
					'fields' => array(
						array('id' => 'map_position',
							'label' => 'Google Map Position',
							'type' => 'text',
							'options' => array(
								array('placeholder' => 'ex. lattitude,longitude',
								'note' => "Note: if you can't find your lattitude and longitude just ask google.")
							)
						),
						array('id' => 'zoom_level',
							'label' => 'Google Map Zoom',
							'type' => 'text'
						)
					)				
				),
				array(
					'name' => 'Collaboration Information',
					'size' => 6,
					'fields' => array(
						array('id' => 'collab_title',
							'label' => 'Collaboration Title',
							'type' => 'text'
						),
						array('id' => 'collab_content',
							'label' => 'Collaboration Content',
							'type' => 'textarea'
						)
					)				
				)
			)
		),
		array('name' => 'Misc Options',
			'id' => 'misc',
			'icon' => 'shopping-cart',
			'sections' => array(
				array(
			'name' => 'MM Facts',
					'size' => 12,
					'fields' => array(
						array('id' => 'mm_facts',
							'label' => 'Random Facts',
							'type' => 'textarea',
							'options' => array('note' => "Note: each new line will be randomly selected to be displayed when using the [MMFact /] shortcode.",
											'class' => "span9", "rows" => "15")
						)
					)	
				)
			)
		)
	);
?>