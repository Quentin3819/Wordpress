<?php

function childtheme_parent_styles(){
    wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css');
}

add_action('wp_enqueue_scripts', 'childtheme_parent_styles');

?>