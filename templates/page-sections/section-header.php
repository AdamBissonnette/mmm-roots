<?php
	global $MM_Roots;

	$tagline = $MM_Roots->get_post_meta(get_the_ID(), "tagline", true);
	$keyword = $MM_Roots->get_post_meta(get_the_ID(), "keyword", true);

	$keywordTemplate = '<p>%s</p>';

	if ($keyword != "")
	{
		$keyword = sprintf($keywordTemplate, $keyword);
	}

	if ($tagline != "")
	{
?>

<div class="container header">
	<div class="row">
	  <header>
	    <div class="page-header">
	      <h3>
	          <?php echo $tagline; ?>
	      </h3>
	      <?php echo $keyword; ?>
	    </div>
	  </header>
	</div>
</div>

<?php } ?>