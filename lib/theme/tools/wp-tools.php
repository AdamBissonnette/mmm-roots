<?php
function createFormField($label, $name, $value, $type, $options=null)
{
	$output = '';
	$field = '';
	$useField = true;

	switch ($type)
	{
		case 'text':
			$field = createInput($label, $value, $type, $options);
		break;
		case 'textarea':
			$field = createTextArea($label, $value, $options);
		break;
		case 'select':
			$field = createSelect($label, $value, $options);
		break;
		case 'editor':
			$useField = false;
		break;
		case 'checkbox':
			$field = createCheckbox($label, $value, $options);
		break;
	}

	echo '<div class="control-group">' .
					'<label class="control-label" for="' . $label . '">' . $name . '</label>' .
					'<div class="controls">';

	if ($useField)
	{
		echo $field;
	}
	else
	{
		wp_editor( $value, $label, $settings = array() );
	}

	echo '</div></div>';
				
	//return $output;
}

function merge_options($pairs, $atts) {
    $atts = (array)$atts;
    $out = array();
    foreach($pairs as $name => $default) {
            if ( array_key_exists($name, $atts) )
                    $out[$name] = $atts[$name];
            else
                    $out[$name] = $default;
    }
    return $out;
}

function createInput($label, $value, $type="text", $options = null)
{
	extract( merge_options(
		array("class" => "", "placeholder" => "", "note" => ""), $options)
	);

	$output = sprintf('<input type="%s" id="%s" class="%s" name="%s" value="%s" placeholder="%s" />', $type,
		 $label, //id
		 $class,
		 $label, //name
		 stripslashes($value), //value
		 $placeholder
	);
	
	if (isset($note)) {
		$output .= sprintf('<p class="help-block">%s</p>', $note);
	}
	
	return $output;
}

function createTextArea($label, $value, $options = null)
{
	extract( merge_options(
		array("class" => "", "placeholder" => "", "rows" => 3, "note" => ""), $options)
	);

	$output = sprintf('<textarea id="%s" class="%s" rows="%s" name="%s" placeholder="%s">%s</textarea>', 
		 $label, //id
		 $class,
 		 $rows,
		 $label, //name
		 $placeholder,
		 stripslashes($value) //value
	);
	
	if ($note) {
		$output .= sprintf('<p class="help-block">%s</p>', $note);
	}
	
	return $output;
}

function createCheckbox($label, $value, $options = null)
{
	extract( merge_options(
		array("class" => "", "placeholder" => "", "note" => ""), $options)
	);

	$checked = "";
	if ($value != "") //if there is a value then it's checked
	{
		$checked = ' checked="checked"';
	}

	$output = sprintf('<input type="checkbox" id="%s" class="%s" name="%s"%s />', 
		 $label, //id
		 $class,
		 $label, //name
		 $checked //value
	);
	
	if ($note) {
		$output .= sprintf('<p class="help-block">%s</p>', $note);
	}
	
	return $output;
}

function createSelect($label, $selectedKey, $options)
{
	extract( merge_options(
		array("class" => "", "placeholder" => "", "note" => "", "data" => array(), "isMultiple" => false, "updateOnChange" => ""), $options)
	);

	$optionTemplate = '<option value="%s"%s>%s</option>\n';

	//check if the data is associative
	$isAssoc = (bool)count(array_filter(array_keys($data), 'is_string'));

	//If it's a multi select then don't 
	if ($isMultiple)
	{
		$output = sprintf('<select id="%s" class="%s" name="%s" multiple>', $label, $class, $label);
	}
	else
	{
		$output = sprintf('<select id="%s" class="%s" name="%s">', $label, $class, $label);
		$output .= sprintf($optionTemplate, "", "", $placeholder);
	}

	if ($isAssoc)
	{
		foreach ($data as $key => $value)
		{
			if ($selectedKey == $key)
			{
				$output .= sprintf($optionTemplate, $key, ' selected', $value);
			}
			else
			{
				$output .= sprintf($optionTemplate, $key, '', $value);
			}
		}
	}
	else
	{
		foreach ($data as $data)
		{
			if ($selectedKey == $data)
			{
				$output .= sprintf($optionTemplate, $data, ' selected', $data);
			}
			else
			{
				$output .= sprintf($optionTemplate, $data, '', $data);
			}
		}
	}
	
	$output .= '</select>';
	
	if ($updateOnChange != "") {
		$output .= sprintf($updateOnChange, $selectedKey);
	}

	if ($note != "") {
		$output .= sprintf('<p class="help-block">%s</p>', $note);
	}
	
	return $output;
}

function getCategorySelectArray()
{
	$categories = get_categories(array('hide_empty' => 0));
	
	$catArray = array();
	foreach ($categories as $category)
	{
		$catArray[$category->term_id] = $category->cat_name;
	}
	
	return $catArray;
}

function getPagesSelectArray()
{
	return getTaxonomySelectArray('page');
}

function getPostsSelectArray()
{
	return getTaxonomySelectArray('post');
}

function getTaxonomySelectArray($taxonomy)
{
	$args = array('post_type' => $taxonomy);
	$posts = get_posts($args);
	
	$postArray = array();
	foreach ($posts as $post)
	{
		$postArray[$post->ID] = $post->post_title;
	}
	
	return $postArray;
}

function getFontAwesomeSelectArray()
{
	return array('glass' => 'icon-glass (&#xf000;)', 'music' => 'icon-music (&#xf001;)', 'search' => 'icon-search (&#xf002;)', 'envelope-alt' => 'icon-envelope-alt (&#xf003;)', 'heart' => 'icon-heart (&#xf004;)', 'star' => 'icon-star (&#xf005;)', 'star-empty' => 'icon-star-empty (&#xf006;)', 'user' => 'icon-user (&#xf007;)', 'film' => 'icon-film (&#xf008;)', 'th-large' => 'icon-th-large (&#xf009;)', 'th' => 'icon-th (&#xf00a;)', 'th-list' => 'icon-th-list (&#xf00b;)', 'ok' => 'icon-ok (&#xf00c;)', 'remove' => 'icon-remove (&#xf00d;)', 'zoom-in' => 'icon-zoom-in (&#xf00e;)', 'zoom-out' => 'icon-zoom-out (&#xf010;)', 'off' => 'icon-off (&#xf011;)', 'signal' => 'icon-signal (&#xf012;)', 'cog' => 'icon-cog (&#xf013;)', 'trash' => 'icon-trash (&#xf014;)', 'home' => 'icon-home (&#xf015;)', 'file-alt' => 'icon-file-alt (&#xf016;)', 'time' => 'icon-time (&#xf017;)', 'road' => 'icon-road (&#xf018;)', 'download-alt' => 'icon-download-alt (&#xf019;)', 'download' => 'icon-download (&#xf01a;)', 'upload' => 'icon-upload (&#xf01b;)', 'inbox' => 'icon-inbox (&#xf01c;)', 'play-circle' => 'icon-play-circle (&#xf01d;)', 'repeat' => 'icon-repeat (&#xf01e;)', 'refresh' => 'icon-refresh (&#xf021;)', 'list-alt' => 'icon-list-alt (&#xf022;)', 'lock' => 'icon-lock (&#xf023;)', 'flag' => 'icon-flag (&#xf024;)', 'headphones' => 'icon-headphones (&#xf025;)', 'volume-off' => 'icon-volume-off (&#xf026;)', 'volume-down' => 'icon-volume-down (&#xf027;)', 'volume-up' => 'icon-volume-up (&#xf028;)', 'qrcode' => 'icon-qrcode (&#xf029;)', 'barcode' => 'icon-barcode (&#xf02a;)', 'tag' => 'icon-tag (&#xf02b;)', 'tags' => 'icon-tags (&#xf02c;)', 'book' => 'icon-book (&#xf02d;)', 'bookmark' => 'icon-bookmark (&#xf02e;)', 'print' => 'icon-print (&#xf02f;)', 'camera' => 'icon-camera (&#xf030;)', 'font' => 'icon-font (&#xf031;)', 'bold' => 'icon-bold (&#xf032;)', 'italic' => 'icon-italic (&#xf033;)', 'text-height' => 'icon-text-height (&#xf034;)', 'text-width' => 'icon-text-width (&#xf035;)', 'align-left' => 'icon-align-left (&#xf036;)', 'align-center' => 'icon-align-center (&#xf037;)', 'align-right' => 'icon-align-right (&#xf038;)', 'align-justify' => 'icon-align-justify (&#xf039;)', 'list' => 'icon-list (&#xf03a;)', 'indent-left' => 'icon-indent-left (&#xf03b;)', 'indent-right' => 'icon-indent-right (&#xf03c;)', 'facetime-video' => 'icon-facetime-video (&#xf03d;)', 'picture' => 'icon-picture (&#xf03e;)', 'pencil' => 'icon-pencil (&#xf040;)', 'map-marker' => 'icon-map-marker (&#xf041;)', 'adjust' => 'icon-adjust (&#xf042;)', 'tint' => 'icon-tint (&#xf043;)', 'edit' => 'icon-edit (&#xf044;)', 'share' => 'icon-share (&#xf045;)', 'check' => 'icon-check (&#xf046;)', 'move' => 'icon-move (&#xf047;)', 'step-backward' => 'icon-step-backward (&#xf048;)', 'fast-backward' => 'icon-fast-backward (&#xf049;)', 'backward' => 'icon-backward (&#xf04a;)', 'play' => 'icon-play (&#xf04b;)', 'pause' => 'icon-pause (&#xf04c;)', 'stop' => 'icon-stop (&#xf04d;)', 'forward' => 'icon-forward (&#xf04e;)', 'fast-forward' => 'icon-fast-forward (&#xf050;)', 'step-forward' => 'icon-step-forward (&#xf051;)', 'eject' => 'icon-eject (&#xf052;)', 'chevron-left' => 'icon-chevron-left (&#xf053;)', 'chevron-right' => 'icon-chevron-right (&#xf054;)', 'plus-sign' => 'icon-plus-sign (&#xf055;)', 'minus-sign' => 'icon-minus-sign (&#xf056;)', 'remove-sign' => 'icon-remove-sign (&#xf057;)', 'ok-sign' => 'icon-ok-sign (&#xf058;)', 'question-sign' => 'icon-question-sign (&#xf059;)', 'info-sign' => 'icon-info-sign (&#xf05a;)', 'screenshot' => 'icon-screenshot (&#xf05b;)', 'remove-circle' => 'icon-remove-circle (&#xf05c;)', 'ok-circle' => 'icon-ok-circle (&#xf05d;)', 'ban-circle' => 'icon-ban-circle (&#xf05e;)', 'arrow-left' => 'icon-arrow-left (&#xf060;)', 'arrow-right' => 'icon-arrow-right (&#xf061;)', 'arrow-up' => 'icon-arrow-up (&#xf062;)', 'arrow-down' => 'icon-arrow-down (&#xf063;)', 'share-alt' => 'icon-share-alt (&#xf064;)', 'resize-full' => 'icon-resize-full (&#xf065;)', 'resize-small' => 'icon-resize-small (&#xf066;)', 'plus' => 'icon-plus (&#xf067;)', 'minus' => 'icon-minus (&#xf068;)', 'asterisk' => 'icon-asterisk (&#xf069;)', 'exclamation-sign' => 'icon-exclamation-sign (&#xf06a;)', 'gift' => 'icon-gift (&#xf06b;)', 'leaf' => 'icon-leaf (&#xf06c;)', 'fire' => 'icon-fire (&#xf06d;)', 'eye-open' => 'icon-eye-open (&#xf06e;)', 'eye-close' => 'icon-eye-close (&#xf070;)', 'warning-sign' => 'icon-warning-sign (&#xf071;)', 'plane' => 'icon-plane (&#xf072;)', 'calendar' => 'icon-calendar (&#xf073;)', 'random' => 'icon-random (&#xf074;)', 'comment' => 'icon-comment (&#xf075;)', 'magnet' => 'icon-magnet (&#xf076;)', 'chevron-up' => 'icon-chevron-up (&#xf077;)', 'chevron-down' => 'icon-chevron-down (&#xf078;)', 'retweet' => 'icon-retweet (&#xf079;)', 'shopping-cart' => 'icon-shopping-cart (&#xf07a;)', 'folder-close' => 'icon-folder-close (&#xf07b;)', 'folder-open' => 'icon-folder-open (&#xf07c;)', 'resize-vertical' => 'icon-resize-vertical (&#xf07d;)', 'resize-horizontal' => 'icon-resize-horizontal (&#xf07e;)', 'bar-chart' => 'icon-bar-chart (&#xf080;)', 'twitter-sign' => 'icon-twitter-sign (&#xf081;)', 'facebook-sign' => 'icon-facebook-sign (&#xf082;)', 'camera-retro' => 'icon-camera-retro (&#xf083;)', 'key' => 'icon-key (&#xf084;)', 'cogs' => 'icon-cogs (&#xf085;)', 'comments' => 'icon-comments (&#xf086;)', 'thumbs-up-alt' => 'icon-thumbs-up-alt (&#xf087;)', 'thumbs-down-alt' => 'icon-thumbs-down-alt (&#xf088;)', 'star-half' => 'icon-star-half (&#xf089;)', 'heart-empty' => 'icon-heart-empty (&#xf08a;)', 'signout' => 'icon-signout (&#xf08b;)', 'linkedin-sign' => 'icon-linkedin-sign (&#xf08c;)', 'pushpin' => 'icon-pushpin (&#xf08d;)', 'external-link' => 'icon-external-link (&#xf08e;)', 'signin' => 'icon-signin (&#xf090;)', 'trophy' => 'icon-trophy (&#xf091;)', 'github-sign' => 'icon-github-sign (&#xf092;)', 'upload-alt' => 'icon-upload-alt (&#xf093;)', 'lemon' => 'icon-lemon (&#xf094;)', 'phone' => 'icon-phone (&#xf095;)', 'check-empty' => 'icon-check-empty (&#xf096;)', 'bookmark-empty' => 'icon-bookmark-empty (&#xf097;)', 'phone-sign' => 'icon-phone-sign (&#xf098;)', 'twitter' => 'icon-twitter (&#xf099;)', 'facebook' => 'icon-facebook (&#xf09a;)', 'github' => 'icon-github (&#xf09b;)', 'unlock' => 'icon-unlock (&#xf09c;)', 'credit-card' => 'icon-credit-card (&#xf09d;)', 'rss' => 'icon-rss (&#xf09e;)', 'hdd' => 'icon-hdd (&#xf0a0;)', 'bullhorn' => 'icon-bullhorn (&#xf0a1;)', 'bell' => 'icon-bell (&#xf0a2;)', 'certificate' => 'icon-certificate (&#xf0a3;)', 'hand-right' => 'icon-hand-right (&#xf0a4;)', 'hand-left' => 'icon-hand-left (&#xf0a5;)', 'hand-up' => 'icon-hand-up (&#xf0a6;)', 'hand-down' => 'icon-hand-down (&#xf0a7;)', 'circle-arrow-left' => 'icon-circle-arrow-left (&#xf0a8;)', 'circle-arrow-right' => 'icon-circle-arrow-right (&#xf0a9;)', 'circle-arrow-up' => 'icon-circle-arrow-up (&#xf0aa;)', 'circle-arrow-down' => 'icon-circle-arrow-down (&#xf0ab;)', 'globe' => 'icon-globe (&#xf0ac;)', 'wrench' => 'icon-wrench (&#xf0ad;)', 'tasks' => 'icon-tasks (&#xf0ae;)', 'filter' => 'icon-filter (&#xf0b0;)', 'briefcase' => 'icon-briefcase (&#xf0b1;)', 'fullscreen' => 'icon-fullscreen (&#xf0b2;)', 'group' => 'icon-group (&#xf0c0;)', 'link' => 'icon-link (&#xf0c1;)', 'cloud' => 'icon-cloud (&#xf0c2;)', 'beaker' => 'icon-beaker (&#xf0c3;)', 'cut' => 'icon-cut (&#xf0c4;)', 'copy' => 'icon-copy (&#xf0c5;)', 'paper-clip' => 'icon-paper-clip (&#xf0c6;)', 'save' => 'icon-save (&#xf0c7;)', 'sign-blank' => 'icon-sign-blank (&#xf0c8;)', 'reorder' => 'icon-reorder (&#xf0c9;)', 'list-ul' => 'icon-list-ul (&#xf0ca;)', 'list-ol' => 'icon-list-ol (&#xf0cb;)', 'strikethrough' => 'icon-strikethrough (&#xf0cc;)', 'underline' => 'icon-underline (&#xf0cd;)', 'table' => 'icon-table (&#xf0ce;)', 'magic' => 'icon-magic (&#xf0d0;)', 'truck' => 'icon-truck (&#xf0d1;)', 'pinterest' => 'icon-pinterest (&#xf0d2;)', 'pinterest-sign' => 'icon-pinterest-sign (&#xf0d3;)', 'google-plus-sign' => 'icon-google-plus-sign (&#xf0d4;)', 'google-plus' => 'icon-google-plus (&#xf0d5;)', 'money' => 'icon-money (&#xf0d6;)', 'caret-down' => 'icon-caret-down (&#xf0d7;)', 'caret-up' => 'icon-caret-up (&#xf0d8;)', 'caret-left' => 'icon-caret-left (&#xf0d9;)', 'caret-right' => 'icon-caret-right (&#xf0da;)', 'columns' => 'icon-columns (&#xf0db;)', 'sort' => 'icon-sort (&#xf0dc;)', 'sort-down' => 'icon-sort-down (&#xf0dd;)', 'sort-up' => 'icon-sort-up (&#xf0de;)', 'envelope' => 'icon-envelope (&#xf0e0;)', 'linkedin' => 'icon-linkedin (&#xf0e1;)');
}

?>