<?php
	global $MMM_Roots;

	$pageSections = $MMM_Roots->get_post_meta(get_the_ID(), "sections", true);

	//$args = array('post_type' => 'page-section', 'orderby' => 'menu_order', 'order' => 'ASC');
	//$sections = get_posts($args);

	foreach ($pageSections as $postID)
	{
		$post = get_post($postID);
		setup_postdata($post);
		get_template_part('templates/page-sections/section', 'content');
	}
?>