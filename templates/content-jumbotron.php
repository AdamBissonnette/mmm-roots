<?php
global $MMM_Roots;

$jumbotronCategory = $MMM_Roots->get_setting("jumbotron_category");
$jumbotronCount = $MMM_Roots->get_setting("jumbotron_count");
$jumbotronDefault = $MMM_Roots->get_setting("jumbotron_default");

?>

<section class="section-content section-jumbotron" id="section-jumbotron">
        <div class="flexslider">

    	    <ul class="slides">
<?php

$posts = get_posts( "category=" . $jumbotronCategory . "&numberposts=" . $jumbotronCount);

foreach ($posts as $jumbotron)
{

	$blurb = $MMM_Roots->get_post_meta($jumbotron->ID, "blurb", true);
		
	if ($blurb == null)
	{
		$blurb = wp_trim_words($jumbotron->post_content, 25, "...");
	}

	$readmoretext = $MMM_Roots->get_post_meta($jumbotron->ID, "readmoretext", true);

	if ($readmoretext == null)
	{
		$readmoretext = "Read More";
	}

	$image = $MMM_Roots->get_post_meta($jumbotron->ID, "image", true);
	$icon = $MMM_Roots->get_post_meta($jumbotron->ID, "icon", true);

	if ($image == null)
	{
		if (has_post_thumbnail())
		{
			$thumb =  wp_get_attachment_image_src(get_post_thumbnail_id( $jumbotron->ID), 'full');
			$image = $thumb[0];
		}
		else if ($icon == "")
		{
			$image = $jumbotronDefault;
		}
	}

?>

<li>
	<div class="container">
		<div class="row">
			<div class="col-lg-5 offset1 jumbotron-image">
				<?php if ($image) { ?>
				  	<img src="<?php echo $image; ?>" />
				  <?php } else {  ?>
					<i class="icon-<?php echo $icon; ?> icon"></i>
				  <?php } ?>
			</div>
			<div class="col-lg-5 _offset1">
				<div class="slogan">
					<h1><?php echo $jumbotron->post_title; ?></h1>
					<p class="lead"><?php
					echo $blurb;
					?></p>
					<p>
					<a class="btn btn-large btn-primary" href="<?php echo get_permalink($jumbotron); ?>"><?php echo $readmoretext; ?></a>
					</p>
				</div>
			</div>
		</div>
	</div>
</li>
      	
      

<?php } ?>

</ul>
    </div>
</section>