<?php
/*
Template Name: Homepage
*/
global $MM_Roots;

?>

<?php
    if ($MM_Roots->get_setting('jumbotron_category')) get_template_part('templates/content', 'jumbotron');
    get_template_part('templates/home-sections/section', 'listing');
?>