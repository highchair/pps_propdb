<?php

/*

PPS PROPERTY DATABASE Theme Functions
Author: Kay Belardinelli
URL: http://kangabell.co

*/

/*********************
ENQUEUEING
*********************/

function ppsdb_scripts_and_styles() {

    // Parent Theme
    wp_enqueue_style( 'ppsri-stylesheet', get_template_directory_uri() . '/library/stylesheets/screen.css');

    // Child Theme
    wp_enqueue_style( 'ppsdb-stylesheet',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'ppsri-stylesheet' ),
        wp_get_theme()->get('Version')
    );

}

add_action('wp_enqueue_scripts', 'ppsdb_scripts_and_styles', 999);

?>
