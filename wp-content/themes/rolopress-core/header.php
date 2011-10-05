<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://www.w3.org/2006/03/hcard">
<title><?php rolopress_document_title(); ?></title>

<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php rolopress_head(); // rolopress head hook ?>
<?php wp_head(); // wordpress head hook ?>

<?php 
	$user_id = get_current_user_id();
	
	$texture = 0;
	
	
	if(get_user_meta($user_id, 'wallpaper',true))
		$texture =get_user_meta($user_id, 'wallpaper',true);
		
	if(isset($_POST['texture'])){
		$texture = $_POST['texture'];
		//save option
		update_user_meta($user_id, 'wallpaper', $texture);
	}
	$src = get_bloginfo('stylesheet_directory').'/img/';	
		
?>

<style type="text/css">
	body{
	background: white url(<?php echo $src.$texture;?>texture.jpg) repeat !important;
}	
</style>

</head>

<body class="<?php rolopress_body_class() ?>">

<?php rolopress_before_wrapper(); // before wrapper hook ?> 

<div id="wrapper" class="hfeed">

	<?php rolopress_before_header(); // before header hook ?>
	<div id="header">
			<?php rolopress_header(); // Header hook ?>
		<div id="masthead">
		
			<div id="access">
				<div class="skip-link"><a href="#main" title="<?php _e( 'Skip to main', 'rolopress' ) ?>"><?php _e( 'Skip to main', 'rolopress' ) ?></a></div>
			</div><!-- #access -->
				
		</div><!-- #masthead -->	
	</div><!-- #header -->

	<?php rolopress_after_header(); ?>  