<?php
	global $MM_Roots;

	//$tagline = $MM_Roots->get_post_meta(get_the_ID(), "tagline", true);

	$args = array('post_type' => 'home-section', 'orderby' => 'menu_order', 'order' => 'ASC');
	$sections = get_posts($args);

	foreach ($sections as $post) : setup_postdata($post);

		get_template_part('templates/home-sections/section', 'content');
		
	endforeach;

?>