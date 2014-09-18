<?php
/*
Template Name: Neighborhood 3
*/
$post = get_post($post->ID);

?>


<?php get_header() ?>





	<div class="headmeta">			
		<h3 class="entry-title"><?php the_title() ?></h3>		
	</div>		

	<div id="container">
		<div class="headimgfloat"><?php the_post_thumbnail(); ?></div>
		<div id="content">	
							
			<?php the_post() ?>


			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				
				<div class="entry-content">
					<?php // Used for /earthsmart/features/
						if (in_array("features", explode("/", $_SERVER["REQUEST_URI"]))) { ?>
							<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery-qtip/jquery.qtip-1.0.0-rc3.min.js"></script>
							<script class="qtipBox" type="text/javascript">
							// Create the tooltips only on document load
							$(document).ready(function() 
							{
							   // Notice the use of the each() method to acquire access to each elements attributes
							   $('#content a[tooltip]').each(function()
							   {
								   	$img = '<img src="<?php bloginfo('template_directory') ?>/images/interactiveFlyer/'+$(this).attr('tooltip')+'" />';
							      $(this).qtip(
							      {        	 
							         content: $img,
							         position: {
							      			corner: {
							         			target: 'top',
							         			tooltip: 'bottomLeft'
							      			}
							   			 },
							         show: { 
							            when: 'click', 
							            solo: true // Only show one tooltip at a time
							         },
							         hide: 'unfocus',
							         style: {
							            name: 'green', // Give it the preset dark style
							            width: 570,
							      			padding: 5,
							      			textAlign: 'center',
							            border: {
							               width: 0, 
							               radius: 4 
							            }, 
							            tip: true
							         }
							      });
							   });
							});
							</script>
							<style type="text/css">
								#mouseover {cursor:pointer; cursor:hand;}
							</style>							
						<?php } ?> 								
					
					<?php the_content() ?>
					
					<?php // Outputs a map if 'google-map' is set
					  $gmap = get_post_meta($post->ID,'google-map',true);
						if ($gmap != "") {echo '<p>'.$gmap.'</p>';}
					?> 
										
					
											
				</div>
			</div><!-- .post -->

		</div><!-- #content -->
	</div><!-- #container -->
	
<div id="sidebar">
	
<?php //Custom Sidebars Used - determined based on URL
		 if (in_array("find-your-home", explode("/", $_SERVER["REQUEST_URI"]))) {$sidebar="find-your-home";}
else if (in_array("earthsmart", explode("/", $_SERVER["REQUEST_URI"]))) {$sidebar="earthsmart";}		
else if (in_array("design-center", explode("/", $_SERVER["REQUEST_URI"]))) {$sidebar="design-center";} 
else if (in_array("home-finance", explode("/", $_SERVER["REQUEST_URI"]))) {$sidebar="home-finance";}
else if (in_array("customer-care", explode("/", $_SERVER["REQUEST_URI"]))) {$sidebar="customer-care";}
else {$sidebar = "";}
get_sidebar($sidebar);
?>		
</div>
<?php get_footer() ?>