<?php get_header(); ?>
	
	<?php rolopress_before_container(); // Before container hook ?>
	<div id="container">
	
		<?php rolopress_before_main(); // Before main hook ?>
		<div id="main">

				<?php //rolo_pageheader();?>
				<?php rolo_loop();?>
				<?php //comments_template( '/notes.php' ); ?>
			
		</div><!-- #main -->
		<?php rolopress_after_main(); // After main hook ?>
	</div><!-- #container -->
	<?php rolopress_after_container(); // After container hook ?>

<?php //get_sidebar(); ?>	
<?php //get_footer(); ?>

<script src="http://masonry.desandro.com/js/jquery-1.6.2.min.js"></script> 
<script> 
  jQuery(function(){

    var refs = [];
    var skypenames = [];
	jQuery.each(jQuery('.photo img.wp-post-image'), function() {
		refs.push(jQuery(this));
		skypenames.push(jQuery(this).attr('alt'));
	});

	/*First*/
	 jQuery.post( '/wp-content/themes/rolopress-core/library/includes/checkstatus.php', { usernames: skypenames }, function( data ) {
		 data = eval(data);
		 if (data[0] == "offline") 
			{
			 console.log('datai = '+data[0]);
				refs[0].fadeTo('slow',0.5);
			} 
	});
	
	
	/*Keep repeating*/
   setInterval(function() {

	   jQuery.post( '/wp-content/themes/rolopress-core/library/includes/checkstatus.php', { usernames: skypenames }, function( data ) {
			
			data = eval(data);
			for (var i=0; i < refs.length; i++)
			{
				console.log('datai = '+data[i]);
				if (data[i] == "offline") 
				{
					refs[i].fadeTo('slow',0.5);
				} else {
					refs[i].fadeTo('slow',1);
				}
			}
   		
   		});
	   
   }, 15000);
    	
    
  });
</script> 