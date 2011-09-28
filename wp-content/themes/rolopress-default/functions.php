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
	/*add_image_size( 'frame1', 163, 221, true ); //(cropped)
	add_image_size( 'frame2', 146, 174, true );
	add_image_size( 'frame3', 122, 102, true );
	add_image_size( 'frame4', 214, 179, true );
	add_image_size( 'frame5', 170, 205, true );
	add_image_size( 'frame6', 264, 194, true );
	add_image_size( 'frame7', 259, 357, true );
	add_image_size( 'frame8', 176, 116, true );
	add_image_size( 'frame9', 373, 231, true );*/

	/*add_image_size( 'frame1', 181, 244, true ); //(cropped)
	add_image_size( 'frame2', 184, 209, true );
	add_image_size( 'frame3', 174, 148, true );*/
	
	add_image_size( 'frame1', 182, 251, true ); //(cropped)
	add_image_size( 'frame2', 235, 146, true );
	add_image_size( 'frame3', 180, 150, true );
	
	/*
	add_image_size( 'frame4', 178, 149, true );
	add_image_size( 'frame5', 172, 210, true );
	add_image_size( 'frame6', 210, 140, true );
	add_image_size( 'frame7', 181, 251, true );
	add_image_size( 'frame8', 213, 139, true );
	add_image_size( 'frame9', 235, 144, true );*/
	/*
	
	add_image_size( 'frame10', 224, 274, true ); //(cropped)
	add_image_size( 'frame11', 225, 168, true );
	add_image_size( 'frame12', 222, 205, true );
	add_image_size( 'frame13', 226, 124, true );
	add_image_size( 'frame14', 227, 189, true );
	add_image_size( 'frame15', 223, 291, true );
	add_image_size( 'frame16', 226, 140, true );*/
}

?>