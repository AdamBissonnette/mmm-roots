<?php
/*
Template Name: Homepage
*/
global $MMM_Roots;

?>

<?php
    if ($MMM_Roots->get_setting('jumbotron_category')) get_template_part('templates/content', 'jumbotron');
    get_template_part('templates/page-sections/section', 'listing');
?>