<?php
	// This is the home page
	 
	get_header(); 
?>

<?php echo $rolo_feedburner;?>
	
	<?php rolopress_before_container(); // Before container hook ?>
	<div id="container">
	
		<?php rolopress_before_main(); // Before main hook ?>
		<div id="main">

				<?php //rolo_pageheader();?>
				<?php rolo_sorter();?>
				<?php rolo_loop();?>
			
		</div><!-- #main -->
		<?php rolopress_after_main(); // After main hook ?>
	</div><!-- #container -->
	<?php rolopress_after_container(); // After container hook ?>

<?php //get_sidebar(); ?>	
<?php //get_footer(); ?>

<script src="http://masonry.desandro.com/js/jquery-1.6.2.min.js"></script> 
<script src="http://masonry.desandro.com/jquery.masonry.min.js"></script> 
<script> 
  jQuery(function(){
    
    jQuery('#container').masonry({
      itemSelector: '.photo',
      columnWidth: 100,
      isAnimated: true
    });

	/*Criar array com skypename de cada frame*/
    var refs = [];
    var skypenames = [];
	jQuery.each(jQuery('.photo img.wp-post-image'), function() {
		refs.push(jQuery(this));
		skypenames.push(jQuery(this).attr('alt'));
	});

	console.log(skypenames);
	
   setInterval(function() {

	   jQuery.post( '/wp-content/themes/rolopress-core/library/includes/checkstatus.php', { usernames: skypenames }, function( data ) {
			
			data = eval(data);
			console.log('data = ' + data);
			console.log('refs = ' + refs);
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

