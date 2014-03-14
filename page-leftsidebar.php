<?php
/*
Template Name: Left Sidebar Page
*/
?>
<div class="wrap container" role="document">
<div class="content row">
  <?php if (roots_display_sidebar()) : ?>
  <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
    <?php include roots_sidebar_path(); ?>
  </aside><!-- /.sidebar -->
  <?php endif; ?>
  <div class="main <?php echo roots_main_class(); ?>" role="main">
    <?php get_template_part('templates/page', 'header'); ?>
	<?php get_template_part('templates/content', 'page'); ?>
  </div><!-- /.main -->
</div><!-- /.content -->
</div><!-- /.wrap -->

<?php
    get_template_part('templates/page-sections/section', 'listing');
?>