<?php
	global $MM_Roots;

	$sectionID = $MM_Roots->get_post_meta(get_the_ID(), "sectionID", true);
	$inlineStyles = $MM_Roots->get_post_meta(get_the_ID(), "inline-styles", true);

	if (isset($background))
	{
		$inlineStyles = sprintf('style: %s', $inlineStyles);
	}
?>

<section id="<?php echo $sectionID; ?>" class="home-section" style="<?php echo $inlineStyles; ?>">
	<?php get_template_part('templates/home-sections/section', 'header'); ?>

	<div class="container content">
      <div class="row-fluid">
   		<?php the_content(); ?>	
      </div>  
  </div>
</section>