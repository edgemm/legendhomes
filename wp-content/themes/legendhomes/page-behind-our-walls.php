<?php /* Template Name: Behind Our Walls */ ?>
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
					<?php the_content() ?>

					<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/fade/js/jquery.innerfade.js"></script>
					<script type="text/javascript">
						(function($){ $(document).ready(function(){$('#behindwalls').innerfade({ speed: 500, timeout: 5000, type: 'sequence', containerheight: '436px' });}) })(jQuery);
					</script>

						<div id="behindwalls" style="width: 580px; height: 100%; margin-bottom: 20px; padding: 4px; border: 1px solid #ccc;">
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive01.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive02.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive03.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive04.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive05.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive06.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive07.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive08.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive09.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive10.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive11.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive12.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive13.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive14.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive15.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive16.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive17.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive18.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive19.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive20.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive21.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive22.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive23.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive24.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive25.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive26.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive27.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive28.jpg" />
							
						</div>						
					
					
					
				</div>
			</div><!-- .post -->

		</div><!-- #content -->
	</div><!-- #container -->
	
<div id="sidebar">
	
<?php get_sidebar('customer-care'); ?>		

</div>
<?php get_footer() ?>