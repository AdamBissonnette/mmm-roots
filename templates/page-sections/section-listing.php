<?php
	global $MMM_Roots;

	$sectionMeta = $MMM_Roots->get_post_meta(get_the_ID(), "sections", true);

	if ($sectionMeta != "") //Blank section will register as an element in the listing array so we're ignoring it in this case
	{
		$pageSections = explode(",", $sectionMeta);

		foreach ($pageSections as $pid)
		{
			$section = get_post($pid);
			setup_postdata($section);
			get_template_part('templates/page-sections/section', 'content');
		}
		wp_reset_postdata();
	}
?>