<div class="footer">
<div class="copyright">
<a href="http://www.widgilabs.com" target="_blank">WidgiLabs</a> - <a href="http://www.experimentadesign.pt/actionforage/pt/0101.html" target="_blank">Action for Age</a>, Setembro 2011
</div>
</div>

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
	
	/*First*/
	 jQuery.post( '/wp-content/themes/rolopress-core/library/includes/checkstatus.php', { usernames: skypenames }, function( data ) {
		 data = eval(data);
		 for (var i=0; i < refs.length; i++)
		{ 
			 if (data[i] == "offline") 
			{
				refs[i].fadeTo('slow',0.5);
			} 
		}
	});
	
	
	/*Keep repeting*/
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
	   
   }, 60000);
    	
    
  });
</script> 

</body>
</html>