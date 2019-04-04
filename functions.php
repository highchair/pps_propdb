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

    // Theme Styles
    wp_enqueue_style( 'ppsdb-stylesheet',
        get_stylesheet_directory_uri() . '/library/stylesheets/screen.css',
        array( 'ppsri-stylesheet' ),
        wp_get_theme()->get('Version')
    );

    // Theme Scripts
    wp_enqueue_script( 'ppsdb-js', get_stylesheet_directory_uri() . '/library/scripts/scripts.js', array( 'jquery' ), '', true );

    // Google Maps scripts
    // conditional here because Property needs `callback=initMap` and Tour doesn't
    if ( is_singular('property') ) {
      wp_enqueue_script('googlemaps-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDA4aghw-j9Z_ooVKc1vtE-cRjnjWHJDYo&callback=initMap', array(), '', true);
    } elseif ( is_singular('tour') ) {
      wp_enqueue_script('googlemaps-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDA4aghw-j9Z_ooVKc1vtE-cRjnjWHJDYo', array(), '', true);
    }

    // Foundation scripts
    wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/node_modules/foundation-sites/js/foundation.core.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'foundation-keyboard-js', get_template_directory_uri() . '/node_modules/foundation-sites/js/foundation.util.keyboard.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'foundation-mediaquery-js', get_template_directory_uri() . '/node_modules/foundation-sites/js/foundation.util.mediaQuery.js', array( 'jquery' ), '', true );

    // AddThis share widget
    wp_enqueue_script( 'addthis-js', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b97face49653134' );

}

add_action('wp_enqueue_scripts', 'ppsdb_scripts_and_styles', 999);


// Remove Waypoints js
function ppsdb_remove_waypoints() {
  wp_dequeue_script( 'waypoints' );
  wp_deregister_script( 'waypoints' );

  wp_dequeue_script( 'ppsri-waypoints-js' );
  wp_deregister_script( 'ppsri-waypoints-js' );
}

add_action( 'wp_print_scripts', 'ppsdb_remove_waypoints' );


/*********************
THEME SUPPORT
*********************/

// Update existing image sizes
function ppsdb_update_img_sizes() {

  add_image_size( 'grid-thumb', 680, 340, array( 'center', 'center' ) );

}
add_action( 'init', 'ppsdb_update_img_sizes', 11 );

// Add more image sizes
function ppsdb_more_img_sizes() {

  add_image_size( 'squarish', 680, 500, array( 'center', 'center' ) );

} /* end ppsdb theme support */

add_action('after_setup_theme','ppsdb_more_img_sizes');


/*********************
FUNCTIONS
*********************/

/************* GOOGLE MAPS API *****************/

function ppsdb_acf_google_map_api( $api ) {

  $api['key'] = 'AIzaSyDA4aghw-j9Z_ooVKc1vtE-cRjnjWHJDYo';

  return $api;

}

add_filter('acf/fields/google_map/api', 'ppsdb_acf_google_map_api');


/************* CUSTOM TOUR QUERY VAR *****************/

function ppsdb_add_query_vars_filter( $vars ) {
  $vars[] = 't';
  return $vars;
}
add_filter( 'query_vars', 'ppsdb_add_query_vars_filter' );


/************* CUSTOM SEARCH FORM *****************/
// uses `pssri_` prefix in order to override parent theme

function ppsri_wpsearch($form) {
  $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
  <input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="Search for properties and tours" />
  <button type="submit" class="primary">Search</button>
  </form>';
  return $form;
}

add_filter( 'get_search_form', 'ppsri_wpsearch' );

?>
