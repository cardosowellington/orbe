<?php

  function orbe_enqueue_assets(){
    wp_enqueue_style(
      'orbe-style',
      get_template_directory_uri() . '/assets/css/style.css',
      array(),
      filemtime( get_template_directory() . '/assets/css/style.css' )
    );
  }
  add_action( 'wp_enqueue_scripts', 'orbe_enqueue_assets' );


  // bootstrap
  function orbe_enqueue_bootstrap(){
    wp_enqueue_style(
      'bootstrap',
      'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
      [],
      '5.3.3'
    );

    wp_enqueue_script(
      'boostrap',
      'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
      ['jquery'],
      '5.3.3',
      true
    );
  }
  add_action( 'wp_enqueue_scripts', 'orbe_enqueue_bootstrap' );

  /*
  *
  * Google Material Icons
  *
  **/
    function orbe_google_icons(){
    wp_enqueue_style(
      'google-material-icons',
      'https://fonts.googleapis.com/icon?family=Material+Icons',
      [],
      null
    );
  }
  add_action( 'wp_enqueue_scripts', 'orbe_google_icons' );
