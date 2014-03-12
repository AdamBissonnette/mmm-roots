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

function column($atts, $content="")
{
	extract( shortcode_atts( array(
	      'size' => '3',
	      'cssClass' => ''
     ), $atts ) );

	$output = '';
	$spanFormat = '<div class="col-sm-%s">%s</div>';
	
	if ($cssClass != '')
	{
		$size .= ' ' . $cssClass;
	}
	
	$output = sprintf($spanFormat, $size, do_shortcode($content));
	
	return $output;
}
add_shortcode( 'column', 'column' );

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

//add_shortcode("PricingBox", "PricingBox");

function PricingItem($atts, $content='')
{
	extract(shortcode_atts(array(
		'title' => ''
	), $atts) );

	return sprintf('<li><i class="icon-ok"></i>%s%s</li>', $title, $content);
}


//add_shortcode("PricingItem", "PricingItem");

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

//add_shortcode("IconBlock", "IconBlock");

function ListTaxonomy($atts, $content=null)
{
	extract(shortcode_atts(array(
		'taxonomy' => '',
		'numberposts' => '-1',
		'orderby' => 'date',
		'order' => 'desc',
		'class' => ''
	), $atts) );

	$output = "";

	if (isset($taxonomy))
	{
		$args = array('post_type' => $taxonomy, 'orderby' => $orderby, 'order' => $order, 'numberposts' => $numberposts);
		$posts = get_posts($args);
		$template = '<li><a title="%2$s" href="%1$s"><img alt="" src="%3$s" /><span>%2$s</span></a></li>'; //Url = 1, Title = 2, FeaturedImageUrl = 3, Content = 4

		if ($content != null)
		{
			$template = $content;
		}

		$imageUrl = "";
		
		if ($class != '')
		{
			$output .= sprintf('<ul class="%s">', $class);
		}
		
		foreach ($posts as $post)
		{
			if (has_post_thumbnail($post->ID))
			{
				$thumb =  wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 'thumbnail');
				$imageUrl = $thumb[0];
			}

			$output .= sprintf($template, get_permalink($post), $post->post_title, $imageUrl, do_shortcode($post->content));
		}

		if ($class != '')
		{
			$output .= '</ul>';
		}
	}

	return $output;
}

add_shortcode("ListTaxonomy", "ListTaxonomy");

function ListTaxTerms($atts, $content = null)
{
	extract( shortcode_atts( array(
			'taxonomy' => '',
			'template' => '',
			'orderby' => 'name',
			'order' => 'asc',
			'numberposts' => '',
			'class' => ''
			), $atts ) );
	$output = '';

	$template = '<li><a href="%1$s" title="%2$s">%2$s</a></li>';

	if ($content != null)
	{
		$template = $content;
	}

	if (isset($taxonomy))
	{
		if ($class != '')
		{
			$output .= sprintf('<ul class="%s">', $class);
		}

		$tax_terms = get_terms($taxonomy, array('orderby'=>$orderby, 'order'=>$order, 'number'=>$numberposts));

		foreach ($tax_terms as $tax_term) {
			$output .= sprintf($template, get_term_link($tax_term, $taxonomy), $tax_term->name);
		}

		if ($class != '')
		{
			$output .= '</ul>';
		}
	}

	return $output;
}

add_shortcode( 'ListTaxTerms', 'ListTaxTerms' );


//Enable Shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

?>