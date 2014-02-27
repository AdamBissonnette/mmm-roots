<?php
  global $MMM_Roots;
  $brand_logo = $MMM_Roots->get_setting("brand_logo");
  $search_in_navigation = $MMM_Roots->get_setting("search_in_navigation");
?>

<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <?php if ($search_in_navigation != "") { ?>
    <form role="search" method="get" class="search-form form-inline" action="<?php echo home_url('/'); ?>">
      <div class="input-group">
        <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>">
        <label class="hide"><?php _e('Search for:', 'roots'); ?></label>
        <span class="input-group-btn">
          <button type="submit" class="search-submit btn btn-default"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <?php } ?>

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo home_url(); ?>/"><img class="logo" src="<?php echo $brand_logo; ?>" title="<?php bloginfo('name'); ?>"></a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
    </nav>
  </div>
</header>
