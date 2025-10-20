<?php

  /*
  *
  * remover admin bar
  *
  */
  add_filter( 'show_admin_bar', function( $show ) {
    if( is_admin() ){
      return $show;
    }

    if( ! is_user_logged_in() ){
      return false;
    }

    if( current_user_can( 'manage_options' ) ){
      return true;
    }

    return false;

  } );

  /*
  *
  *Dashboard view
  *
  */
  add_action( 'template_redirect', function(){
    if( ! is_user_logged_in() && is_page() ){
      global $post;
      
      if( $post->post_parent || $post->post_name === 'dashboard' ){
        $ancestor = get_post_ancestors( $post->ID );
        $top_slug = $ancestor ? get_post( end ( $ancestor ) )->post_name : $post->post_name;

        if( $top_slug === 'dashboard' ){
          $login_page = get_page_by_path( 'home' );
          if( $login_page ){
            wp_redirect( get_permalink( $login_page->ID ) );
            exit;
          }
        }
      }
    }
  } );


  /*
  *
  *Block dynamic name user + avatar
  *
  **/
  add_shortcode( 'cpflogin_data', function() {

    ob_start();
    global $wpdb;

    $current_user = wp_get_current_user();

    if( ! $current_user->exists() ){
      echo '<p>Você precisa estar logado para ver essa informação.</p>';
      return ob_get_clean();
    }

    $transient_key = 'cpf_user_data_' . $current_user->ID;

    $user_data = get_transient( $transient_key );

    if( false === $user_data ){

      $cpf = get_user_meta( $current_user->ID, 'cpf', true );
  
      if( empty( $cpf ) ){
        echo '<p>CPF não cadastrado.</p>';
        return ob_get_clean();
      }
  
      $table_name = $wpdb->prefix . 'cpf_users';
  
      $table_exists = $wpdb->get_var( $wpdb->prepare(
        "SHOW TABLES LIKE %s", 
        $table_name
      ) );
  
      if( $table_exists !== $table_name ){
        echo '<p>Tabela de usuários não encontrada.</p>';
        return ob_get_clean();
      }
  
      $user_data = $wpdb->get_row( $wpdb->prepare(
        "SELECT nome FROM $table_name WHERE cpf = %s LIMIT 1",
        $cpf
      ) );
  
      if( $user_data ){
        set_transient( $transient_key, $user_data, 12 * HOUR_IN_SECONDS );
      }

    }

    if( $user_data ){
      echo '<div class="avatar">'.get_avatar( $current_user->user_email, 64 ).'</div><p class="mb-0"><span>'. esc_html( $user_data->nome ) .'</span></p>';
    }else{
      echo '<p>Dados do usuário não encontrados.</p>';
    }

    return ob_get_clean();

  } );
