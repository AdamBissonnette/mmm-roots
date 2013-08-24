<?php
	global $MMM_Roots;
	global $page, $post;

	$pageSections = explode(",", $MMM_Roots->get_post_meta(get_the_ID(), "sections", true));

	foreach ($pageSections as $pid)
	{
		$post = get_post($pid);
		setup_postdata($post);
		get_template_part('templates/page-sections/section', 'content');
	}
?>