<?php

/**
 * Add your custom functions here
 */


if(!is_admin())
	{
	   wp_deregister_script( 'jquery' );
	  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';
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

?>