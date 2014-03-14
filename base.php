<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->

  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>

  <?php include roots_template_path(); ?>

  <?php get_template_part('templates/footer'); ?>


  <?php
      global $MMM_Roots;
      $animation = $MMM_Roots->get_setting("jumbotron_animation");
      if ($animation != '')
      {
        $animation = sprintf('animation: "%s"', $animation);
      }
      
      $jumbotron = $animation;
      
      $mapPosition = $MMM_Roots->get_setting("map_position");
      $mapZoom = $MMM_Roots->get_setting("zoom_level");
  ?>

  <script type="text/javascript">  
    jQuery().ready(function($) {
    // ------------------------------------
    // FlexSlider
    // ------------------------------------
    $('.flexslider').flexslider({
      <?php echo $jumbotron; ?>
    });
  });
  </script>

  <div class="modal fade" id="mm-dialog" tabindex="-1" role="dialog" aria-labelledby="mm-dialog-title" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="mm-dialog-title"></h4>
        </div>
        <div class="modal-body" id="mm-dialog-message">
          <p>Your message has been sent.  We will be in touch shortly!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

</body>
</html>
