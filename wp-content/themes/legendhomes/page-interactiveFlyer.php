<?php /* Template Name: Interactive Flyer */ ?>
<?php get_header() ?>

<?php //Determines the parrent page to pull in Heading/Sub Heading
if ($post->post_parent != 0){$headID = $post->post_parent;}
else {$headID = $post->ID;}
?>

	<div class="headmeta">			
		<h2><span><?php echo get_post_meta($headID,'Heading-Title',true); ?></span></h2>
		<div class="headtxtbar"><?php echo get_post_meta($headID,'Heading-SubTitle',true); ?></div>		
	</div>		

	<div id="container">
		<div class="headimgfloat"><?php the_post_thumbnail(); ?></div>
		<div id="content">							
			<?php the_post() ?>

			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h3 class="entry-title"><?php the_title() ?></h3>
				<div class="entry-content">
					<?php the_content(); ?>

						<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery-qtip/jquery.qtip-1.0.0-rc3.min.js"></script>
						<script type="text/javascript">
						// Create the tooltips only when document ready
						$(document).ready(function()
						{
						   // Use the each() method to gain access to each elements attributes
						   $('area').each(function()
						   {
						   		$img = '<img src="<?php bloginfo('template_directory') ?>/images/interactiveFlyer/'+$(this).attr('alt')+'" />';
						      $(this).qtip(
						      {        	 
						         content: $img,
						         position: {
						      			corner: {
						         			target: 'top',
						         			tooltip: 'bottomMiddle'
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
						
						<img src="<?php bloginfo('template_directory') ?>/images/interactiveFlyer/earthSmartHome.jpg" border="0" usemap="#InteractiveMap">
						<map name="InteractiveMap" id="InteractiveMap">
						<area shape="circle" coords="115,204,13" id="mouseover" alt="1.jpg" />
						<area shape="circle" coords="269,162,13" id="mouseover" alt="2.jpg" />
						<area shape="circle" coords="360,155,13" id="mouseover" alt="3.jpg" />
						<area shape="circle" coords="246,86,13"  id="mouseover" alt="4.jpg" />
						<area shape="circle" coords="426,352,13" id="mouseover" alt="5.jpg" />
						<area shape="circle" coords="79,295,13"  id="mouseover" alt="6.jpg" />
						<area shape="circle" coords="151,334,13" id="mouseover" alt="7.jpg" />
						<area shape="circle" coords="360,217,13" id="mouseover" alt="8.jpg" />
						<area shape="circle" coords="511,144,13" id="mouseover" alt="9.jpg" />
						<area shape="circle" coords="197,297,13" id="mouseover" alt="10.jpg" />
						<area shape="circle" coords="439,103,13" id="mouseover" alt="11.jpg" />
						<area shape="circle" coords="511,228,13" id="mouseover" alt="12.jpg" />
						<area shape="circle" coords="155,72,13"  id="mouseover" alt="13.jpg" />
						<area shape="circle" coords="275,396,13" id="mouseover" alt="14.jpg" />
						<area shape="circle" coords="188,164,13" id="mouseover" alt="16.jpg" />
						<area shape="circle" coords="359,305,13" id="mouseover" alt="17.jpg" />
						<area shape="circle" coords="136,116,13" id="mouseover" alt="18.jpg" />
						<area shape="circle" coords="362,77,13"  id="mouseover" alt="19.jpg" />
						<area shape="circle" coords="314,75,13"  id="mouseover" alt="20.jpg" />
						<area shape="circle" coords="510,293,13" id="mouseover" alt="21.jpg" />
						<area shape="circle" coords="303,326,13" id="mouseover" alt="22.jpg" />
						</map>				

				</div>
			</div><!-- .post -->
		</div><!-- #content -->
	</div><!-- #container -->
<div id="sidebar">
<?php get_sidebar('earthsmart') ?>
</div>
<?php get_footer() ?>