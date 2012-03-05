<?php
/*
Plugin Name: Pictos Server for WordPress
Plugin URI: http://jeffsebring.com/wordpress/plugins/pictos-server-for-wordpress/
Description: Add your Pictos Server Fonts to your WordPress Website.
Version: 1.0
Author: Jeff Sebring
Author URI: http://jeffsebring.com
License: GPLv2
*/

if ( ! is_admin() )  :

   add_action( 'wp_enqueue_scripts', function() {

      $account = get_theme_mod( 'pictos_account' );
      $combo   = get_theme_mod( 'pictos_combo' );

      wp_enqueue_style(
         'pictos-server',
         "http://get.pictos.cc/fonts/$account/$combo"
      );

   });

elseif ( is_admin() )	:

   # Create options page in theme menu
   include_once( 'includes/render_pictos_server.php' );

   add_action( 'admin_menu', 'render_pictos_menu_page' );

   register_activation_hook( __FILE__, function()  { set_theme_mod( 'pictos_account', '' ); set_theme_mod( 'pictos_combo', '' ); } );


endif;


