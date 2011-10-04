<?php

/**
 * Add your custom functions here
 */


if(!is_admin())
	{
	   wp_deregister_script( 'jquery' );
//	  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';
	}

add_filter( 'show_admin_bar', '__return_false' );	
add_action( 'register_form', 'my_wp_register_form', 9);
add_action( 'login_form', 'my_wp_login_form', 9);

/**
 * Add information about registration to wp-login.php?action=register 
 *
 * @action: register_form
 **/
function my_wp_register_form() {
		echo '
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript"> 
			jQuery(function() {
				jQuery("#reg_passmail").hide();
			
			});
		</script>';

}

/**
 * Add information about registration to wp-login.php
 *
 * @action: login_form
 **/
function my_wp_login_form() {
		echo '
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript"> 
			jQuery(function() {
				jQuery("#login_error").hide();
				jQuery("#backtoblog").hide();
			});
		</script>';

}

add_theme_support( 'post-formats', array( 'image', 'gallery' ) );
add_theme_support( 'post-thumbnails' );

if ( function_exists( 'add_image_size' ) ) { 
	
	add_image_size( 'frame11', 102, 140, true ); //(cropped)
	add_image_size( 'frame12', 184, 254, true ); //(cropped)
	add_image_size( 'frame13', 221, 307, true ); //(cropped)
	
	add_image_size( 'frame21', 176, 110, true ); //(cropped)
	add_image_size( 'frame22', 232, 145, true ); //(cropped)
	add_image_size( 'frame23', 280, 176, true ); //(cropped)
	
	add_image_size( 'frame31', 136, 113, true ); //(cropped)
	add_image_size( 'frame32', 180, 150, true ); //(cropped)
	add_image_size( 'frame33', 217, 182, true ); //(cropped)
	
}

?>