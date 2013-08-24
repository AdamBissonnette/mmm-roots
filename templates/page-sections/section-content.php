<?php
	global $MMM_Roots;

	$sectionID = $MMM_Roots->get_post_meta(get_the_ID(), "sectionID", true);
	$inlineStyles = $MMM_Roots->get_post_meta(get_the_ID(), "inline-styles", true);

	if (isset($background))
	{
		$inlineStyles = sprintf('style: %s', $inlineStyles);
	}
?>

<section id="<?php echo $sectionID; ?>" class="page-section" style="<?php echo $inlineStyles; ?>">
	<?php get_template_part('templates/page-sections/section', 'header'); ?>

	<div class="container content">
      <div class="row-fluid">
   		<?php the_content(); ?>	
      </div>  
  </div>
</section>