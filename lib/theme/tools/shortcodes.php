<?php

function getFormattedPostContent($postid, $linktext)
{
	global $MMM_Roots;
	//Load content "blurb" from a given post or page
     $output = '';
     $postFormat = '<p class="post-content">%s</p><a class="btn btn-small btn-primary" href="%s"><i class="icon-search"></i>%s</a>';
     $postContent = '';
     
     if ($postid != '')
     {
    	if (has_excerpt($postid))
    	{
    		$postContent = get_post($postid)->post_excerpt;
    	}
    	else
    	{
     		$postContent = $MMM_Roots->get_post_meta($postid, "blurb", true);
     	}
     	
        $output = sprintf($postFormat, $postContent, get_permalink($postid), $linktext);
     }
     
     return $output;
}

function row($atts, $content="")
{
	extract( shortcode_atts( array(
	      'class' => 'row'
     ), $atts ) );

	$output = '';
	$spanFormat = '<div class="%s">%s</div>';
	
	$output = sprintf($spanFormat, $class, do_shortcode($content));
	
	return $output;
}
add_shortcode( 'row', 'row' );

function span($atts, $content="")
{
	extract( shortcode_atts( array(
	      'size' => '3',
	      'cssClass' => ''
     ), $atts ) );

	$output = '';
	$spanFormat = '<div class="col-lg-%s">%s</div>';
	
	if ($cssClass != '')
	{
		$size .= ' ' . $cssClass;
	}
	
	$output = sprintf($spanFormat, $size, do_shortcode($content));
	
	return $output;
}
add_shortcode( 'span', 'span' );

function video($atts, $content="")
{
	extract(shortcode_atts(array(
		'id' => '',
		'autoplay' => '',
		'x' => '420',
		'y' => '315'
	), $atts) );

	//not sure what to do with height / width right now...

	$output = "";
	$videoContainerFormat = '<div class="fitvids">%s</div>';
	$videoEmbedFormat = '<iframe src="http://www.youtube.com/embed/%s" height="%s" frameborder="0" allowfullscreen></iframe>';

	$embedOutput = sprintf($videoEmbedFormat, $id, $y);
	$output = sprintf($videoContainerFormat, $embedOutput);

	return $output;
}

add_shortcode( 'video', 'video' );

function BusinessInfo()
{
	ob_start();
	get_template_part('templates/contact/business', 'info');
	$output = ob_get_contents();  
    ob_end_clean();  
    return $output;  
}

add_shortcode("BusinessInfo", "BusinessInfo");

function PricingBox($atts, $content = null)
{
	extract(shortcode_atts(array(
		'title' => '',
		'price' => '',
		'term' => '',
		'ribbon' => '',
		'class' => '',
		'url' => '',
		'orderText' => 'Order Now'
	), $atts) );

	if ($ribbon != '')
	{
		$ribbon = sprintf('<div class="ribbon">%s</div>', $ribbon);
	}

	if ($class != '')
	{
		$class = " " . $class;
	}

	$template = '<div class="box pricing-box%s">
            <h3 class="box-title">%s</h3>
            <div class="box-content">
              <h1 class="lead">
                %s
                <small>$/%s</small>
              </h1>
              <ul class="muted icons">
                %s
              </ul>
              <a class="btn btn-primary btn-small" href="%s">
                <i class="icon-shopping-cart"></i>
                %s
              </a>
            </div>%s
          </div>';

    $output = sprintf($template, $class, $title, $price, $term, do_shortcode($content), $url, $orderText, $ribbon);

    return $output;

}

add_shortcode("PricingBox", "PricingBox");

function PricingItem($atts, $content='')
{
	extract(shortcode_atts(array(
		'title' => ''
	), $atts) );

	return sprintf('<li><i class="icon-ok"></i>%s%s</li>', $title, $content);
}


add_shortcode("PricingItem", "PricingItem");

//[ButtonLink url="" class="" title="" icon="" /]

function ButtonLink($atts)
{
	extract(shortcode_atts(array(
		'url' => '',
		//'id' => '',
		//'onclick' => '',
		'class' => 'btn-primary',
		'title' => 'Take a Look',
		'icon' => ''
	), $atts) );

	$iconTemplate = '<i class="icon-%s"></i>
	';

	if ($icon != '')
	{
		$icon = sprintf($iconTemplate, $icon);
	}

	$template = '<a class="btn %s" href="%s">
              %s%s
            </a>';

    $output = sprintf($template, $class, $url, $icon, $title);

    return $output;
}

add_shortcode("ButtonLink", "ButtonLink");

function IconBlock($atts, $content='')
{
	extract(shortcode_atts(array(
		'tagline' => '',
		'keyword' => '',
		'icon' => 'cloud',
		'size' => '4',
		'class' => ''
	), $atts) );

	if ($class != '')
	{
		$class = " " . $class;
	}

	$iconBlockTemplate = '<span class="label label-warning lines-bg-color text-center">
				                <i class="icon-%s icon-%sx%s"></i>
				        </span>';

	$iconBlock = sprintf($iconBlockTemplate, $icon, $size, $class);

	if ($keyword != '')
	{
		$keyword = sprintf('<span class="main-color">%s</span>', $keyword);
		$tagline .= ' ' . $keyword;
	}

	$template = '<div class="effect-box-1 active">
        %s
        <h4 class="features-title"> 
          %s
        </h4>
        <p>%s</p>
  	</div>';

  	$output = sprintf($template, $iconBlock, $tagline, do_shortcode($content));

  	return $output;
}

add_shortcode("IconBlock", "IconBlock");

function ListReviews($atts)
{
	extract(shortcode_atts(array(
		'numberposts' => '2',
		'orderby' => 'rand',
		'wrapsize' => '',
		'class' => ''
	), $atts) );

	global $MMM_Roots;

	$args = array('post_type' => 'review',	 'orderby' => $orderby, 'numberposts' => $numberposts);
	$reviews = get_posts($args);
	$cssClass = "";

	$output = "";

	$reviewTemplate = '<blockquote>
	  <p>
	  %s
	  </p>
	  %s
    </blockquote>';

    $captionTemplate = '<span class="test-caption"> <strong>%s </strong></span>';
    $captionTemplateUrl = '<span class="test-caption"> <strong><a href="%s">%s</a> </strong></span>';;

    if ($wrapsize != '')
	{
		$cssClass = $wrapsize;
	}

    if ($class != '')
	{
		$cssClass .= ' ' . $class;
	}

    $wrapTemplate = '<div class="col-lg-%s">%s</div>';

	foreach ($reviews as $post):
		$ReviewerName = $MMM_Roots->get_post_meta($post->ID, "name", true);
		$ReviewContent = $MMM_Roots->get_post_meta($post->ID, "content", true);
		$ReviewUrl = $MMM_Roots->get_post_meta($post->ID, "url", true);

		$caption = "";

		if ($ReviewUrl != '')
		{
			$caption = sprintf($captionTemplateUrl, $ReviewUrl,  $ReviewerName);
		}
		else
		{
			$caption = sprintf($captionTemplate, $ReviewerName);
		}

		
		$review = sprintf($reviewTemplate, $ReviewContent, $caption);

		if ($wrapsize != '')
		{
			$output .= sprintf($wrapTemplate, $cssClass, $review);
		}
		else
		{
			$output .= $review;
		}

	endforeach;

	return $output;
}

add_shortcode("ListReviews", "ListReviews");

function ListTaxTerms($atts)
{
	extract( shortcode_atts( array(
		      'taxonomy' => '',
		      'template' => '<li><a href="%1$s" title="%2$s">%2$s</a></li>',
		      'orderby' => 'name',
		      'order' => 'asc'
	     ), $atts ) );
	$output = '';

	if (isset($taxonomy))
	{
		$tax_terms = get_terms($taxonomy, array('orderby'=>$orderby, 'order'=>$order));

		foreach ($tax_terms as $tax_term) {
			$output .= sprintf($template, get_term_link($tax_term, $taxonomy), $tax_term->name);
		}
	}

	return $output;
}

add_shortcode( 'ListTaxTerms', 'ListTaxTerms' );


//Enable Shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

?>