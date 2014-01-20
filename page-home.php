<?php
/*
Template Name: Homepage
*/
global $MMM_Roots;
?>

<?php
    if ($MMM_Roots->get_setting('jumbotron_category')) get_template_part('templates/content', 'jumbotron');
    get_template_part('templates/page-sections/section', 'listing');
?>

<div class="wrap container" role="document">
<div class="content row">
  <div class="main col-lg-12" role="main">
	<?php wp_reset_postdata(); the_content(); ?>
  </div><!-- /.main -->
</div><!-- /.content -->
</div><!-- /.wrap -->