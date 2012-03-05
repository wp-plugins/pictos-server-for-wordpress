<?php

# Create font selection page in themes menu

if ( ! function_exists( 'render_pictos_menu' ) )   :
   function render_pictos_menu()	{
	
	   function render_saved_message()	{
		   echo '<div class="updated fade"><p>Pictos Server options updated</p></div>';
	   }

	   if ( $_GET['page'] == 'render_pictos' ) :
		   if ( ! isset( $_REQUEST['submit'] ) || ( $_REQUEST['submit'] != 'Save Changes' ) )	:
            $submitted = null;
         else  :
			   $submitted = $_REQUEST[ 'submit' ];
			   check_admin_referer( 'render_pictos_admin' );
			   add_action('render_updated', 'render_saved_message');

				   if ( empty( $_REQUEST[ 'account' ] ) )
					   $_REQUEST[ 'account' ] = '';

				   if ( empty( $_REQUEST[ 'combo' ] ) )
					   $_REQUEST[ 'combo' ] = '';

               $account    = esc_attr( $_REQUEST[ 'account' ] );
               $combo      = esc_attr( $_REQUEST[ 'combo' ] );

				   set_theme_mod( 'pictos_account', $account );
				   set_theme_mod( 'pictos_combo', $combo );

		   endif;
	   endif;
   ?>
	
	   <style>
      #pictos-lighting  {
         background: transparent url( '<?php echo plugins_url( '/lightning.png', __FILE__ ); ?>' ) no-repeat;
      }

		.widefat th	{
			font-size: 1.5em;
			padding: .5em 1em;
			text-align: left;
		}
		
		.widefat td	{
			font-size: 1.5em;
			padding: 1em;
		}</style>

	   <div class="wrap">
	   <div class="icon32" id="pictos-lighting"></div>
	   <h2><?php echo __( 'Pictos Server Settings' ); ?></h2>
   <?php do_action( 'render_updated' ); ?>
	   <form method="post">
		   <legend><p></p></legend>
		   <?php wp_nonce_field( 'render_pictos_admin' ); ?>
		   <table class="widefat" width="100%">
		     <col style="text-align:left" width="50%" />
		     <col style="text-align:left" width="50%" />
	     <thead>
		     <tr>
			     	<th><?php echo __( 'Account #' ); ?></th>
	     			<th><?php echo __( 'Combo #' ); ?></th>
		     </tr>
	     </thead>
	     <tbody>
	     	<tr>
	     		<td><input value="<?php echo get_theme_mod( 'pictos_account' ); ?>" name="account" type="number"></td>
	     		<td><input value="<?php echo get_theme_mod( 'pictos_combo' ); ?>" name="combo" type="number"></td>
	     	</tr>
	     </tbody>
   </table>
	   <?php submit_button(); ?>
	   </form>
	   </div>
   <?php
   }
endif;

if ( ! function_exists( 'render_pictos_menu_page' ) )   :
   function render_pictos_menu_page()	{

	   add_theme_page( 'Pictos Server', 'Pictos', 'switch_themes', 'render_pictos', 'render_pictos_menu' );

   }
endif;
