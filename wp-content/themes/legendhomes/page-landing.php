<?php /* Template Name: Landing Page */
$post = get_post($post->ID);

?>


<?php get_header( 'landing' ); ?>

<?php //Determines the parrent page to pull in Heading/Sub Heading
if ($post->post_parent != 0){
	if (get_post_meta($post->ID,'Heading-Title',true) != "") {
		$headID = $post->ID;
	} else {$headID = $post->post_parent;}
} else {$headID = $post->ID;}
?>

<div id="menu" class="headmeta">			
	<h2><span><?php echo get_post_meta($headID,'Heading-Title',true); ?></span></h2>
	<div class="headtxtbar"><?php echo get_post_meta($headID,'Heading-SubTitle',true); ?></div>		
</div>	

</div><!--  #header -->	

	<div id="container">
		<div class="headimgfloat"><?php the_post_thumbnail(); ?></div>
		<div id="content">	
							
			<?php the_post() ?>


			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<div class="entry-content">								

					<?php the_content() ?>

				</div>
			</div><!-- .post -->

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_footer( 'landing' ) ?>