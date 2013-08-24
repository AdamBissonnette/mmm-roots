<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 7]><div class="alert"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->

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
      global $MM_Roots;
      $animation = $MM_Roots->get_setting("jumbotron_animation");
      if ($animation != '')
      {
        $animation = sprintf('animation: "%s"', $animation);
      }
      
      $jumbotron = $animation;
      
      $mapPosition = $MM_Roots->get_setting("map_position");
      $mapZoom = $MM_Roots->get_setting("zoom_level");
  ?>

  <script type="text/javascript">  
    jQuery().ready(function($) {
    // ------------------------------------
    // FlexSlider
    // ------------------------------------
    $('.flexslider').flexslider({
      <?php echo $jumbotron; ?>
    });
  
    // ------------------------------------
    // Google Maps
    // ------------------------------------
    $('#map_canvas').gmap({'scrollwheel': false}).bind('init', function() {
      $('#map_canvas').gmap('addMarker', {'position': '<?php echo $mapPosition; ?>', 'bounds': true}).click(function() {});
      $('#map_canvas').gmap('option', 'zoom', <?php echo $mapZoom; ?>);
    });
  });
  </script>

  <div class="modal hide fade" id="mm-dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="mm-dialog-title">Message Sent!</h3>
    </div>
     <div class="modal-body" id="mm-dialog-message">
        <p>Your message has been sent.  We will be in touch shortly!</p>
     </div>
     <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn">Close</a>
      </div>
  </div>

</body>
</html>
