<?php
/*
*
*Cache handler - Updated automotically by inc/cache-handler
*
**/

if( ! defined ( 'ABSPATH' ) ) exit;

add_action( 'profile_update', function( $user_id ){
  delete_transient( 'cpf_user_data_'. $user_id );
}, 10, 1 );

add_action( 'update_user_meta', function($meta_id, $user_id, $meta_key, $meta_value){
  if( $meta_key === 'cpf' ){
    delete_transient( 'cpf_user_data_'. $user_id );
  }
}, 10, 4 );

add_action( 'cpf_user_cache_clear', function(){
  delete_transient( 'cpf_user_data_' . $user_id );
}, 10, 1 );

add_action( 'cpf_cache_clear_all', function(){
  global $wpdb;

  $transients = $wpdb->get_col(
    "SELECT option_name 
    FROM {$wpdb->options}
    WHERE option_name LIKE '%_transient_cpf_user_data_%'"
  );

  if( $transients ){
    foreach( $transients as $transient ){
      $key = str_replace( '_transient_', '', $transient );
      delete_transient( $key );
    }
  }

} );