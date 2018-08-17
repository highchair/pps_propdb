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
        get_stylesheet_directory_uri() . '/library/stylesheets/screen.css',
        array( 'ppsri-stylesheet' ),
        wp_get_theme()->get('Version')
    );

    // Parent theme scripts
    wp_enqueue_script( 'ppsri-js', get_template_directory_uri() . '/library/scripts/scripts.js', array( 'jquery' ), '', true );

    // Child theme scripts
    wp_enqueue_script( 'ppsdb-js', get_stylesheet_directory_uri() . '/library/scripts/scripts.js', array( 'jquery' ), '', true );

    // modernizr media queries
    wp_enqueue_script( 'modernizr-mq', get_template_directory_uri() . '/library/scripts/modernizr-mq.js', array( 'jquery' ), '', true );

}

add_action('wp_enqueue_scripts', 'ppsdb_scripts_and_styles', 999);


/*********************
FUNCTIONS
*********************/

function ppsdb_acf_google_map_api( $api ){

    $api['key'] = 'AIzaSyDIqb19OYrLxZvikR_yVnPTDnhsCsP0vtA';

    return $api;

}

add_filter('acf/fields/google_map/api', 'ppsdb_acf_google_map_api');



?>
