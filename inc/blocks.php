<?php

  function orbe_register_dynamic_blocks(){
    register_block_type('orbe/current-year', array(
      'render_callback' => function(){
        return date_i18n( 'Y' );
      }
    ));
  }
  add_action( 'init', 'orbe_register_dynamic_blocks' );