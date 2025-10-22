<?php

  function theme_setup(){
    add_theme_support( 'post-thumbnails' );
    //logo header
    add_theme_support(
      'custom-logo', 
      array(
        'width'         => true,
        'height'        => true,
        'flex-height'   => true,
        'flex-width'    => true
      )
    );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', 
      array( 
        'comment-list', 
        'comment-form', 
        'search-form', 
        'gallery', 
        'caption', 
        'style', 
        'script'
      ) 
    );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );

    // theme support gutenberg
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style-editor.css' );
    add_theme_support( 'wp-block-styles' );   

  }
  add_action( 'after_setup_theme', 'theme_setup' );

  //
  // this is body class
  //
  function wp_modify_body_classes( $classes, $class ){
    if( is_singular() ){
      $class[] = 'cardoso-wellington';
      $classes = array_merge( $classes, $class );
    }
    return $classes;
  }
  add_filter( 'body_class', 'wp_modify_body_classes', 10, 2 );

  function orbe_logout_link(){
    if( is_user_logged_in() ){
      $url = wp_logout_url( home_url( '/' ) );
      return '<li class="wp-block-navigation-item wp-block-navigation-link"><a href="'. esc_url($url) .'" class="wp-block-navigation-item__content"><span class="wp-block-navigation-item__label"><span class="material-icons">logout</span>Logout</span></a></li>';
    }
  }
  add_shortcode( 'logout_link','orbe_logout_link' );