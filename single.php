<div class="wrap container" role="document">
<div class="content row">
  <div class="main <?php echo roots_main_class(); ?>" role="main">
    <?php get_template_part('templates/content', 'single'); ?>
  </div><!-- /.main -->
  <?php if (roots_display_sidebar()) : ?>
  <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
    <?php include roots_sidebar_path(); ?>
  </aside><!-- /.sidebar -->
  <?php endif; ?>
</div><!-- /.content -->
</div><!-- /.wrap -->