<?php
/*
Template Name: Fullwidth Page
*/
?>
<div class="wrap container" role="document">
<div class="content row">
  <div class="main col-lg-12" role="main">
    <?php get_template_part('templates/page', 'header'); ?>
	<?php get_template_part('templates/content', 'page'); ?>
  </div><!-- /.main -->
</div><!-- /.content -->
</div><!-- /.wrap -->

<?php
    get_template_part('templates/page-sections/section', 'listing');
?>