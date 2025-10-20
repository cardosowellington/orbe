<?php

  function theme_setup(){
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
  }
  add_action( 'after_setup_theme', 'theme_setup' );

  function orbe_logout_link(){
    if( is_user_logged_in() ){
      $url = wp_logout_url( home_url( '/' ) );
      return '<li class="wp-block-navigation-item wp-block-navigation-link"><a href="'. esc_url($url) .'" class="wp-block-navigation-item__content"><span class="wp-block-navigation-item__label"><span class="material-icons">logout</span>Logout</span></a></li>';
    }
  }
  add_shortcode( 'logout_link','orbe_logout_link' );