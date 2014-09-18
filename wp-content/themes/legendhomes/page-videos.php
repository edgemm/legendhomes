<?php /* Template Name: Video */

$post = get_post($post->ID);

get_header();

?>




<?php //Determines the parrent page to pull in Heading/Sub Heading
if ($post->post_parent != 0){
	if (get_post_meta($post->ID,'Heading-Title',true) != "") {
		$headID = $post->ID;
	} else {$headID = $post->post_parent;}
} else {$headID = $post->ID;}
?>

	<div class="headmeta">			
		<h2><span><?php echo get_post_meta($headID,'Heading-Title',true); ?></span></h2>
		<div class="headtxtbar"><?php echo get_post_meta($headID,'Heading-SubTitle',true); ?></div>		
	</div>		

	<div id="container">
		<div class="headimgfloat"><?php the_post_thumbnail(); ?></div>
		<div id="content">	
							
			<?php the_post(); ?>


			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class(); ?>">
				<h3 class="entry-title video-heading"><?php the_title() ?></h3>
				<div class="entry-content">

					<?php the_content(); ?>

					<?php // displays latest Home Maintenace Tip video if videos page - gfh
					//if( is_page( array( 5462, 7577 ) ) ) :
						//$args = array(
						//	'post_type' => 'post',
						//	'cat' => 570,
						//	'orderby' => 'date',
						//	'order' => 'DESC',
						//	'posts_per_page' => 1
						//);
						//$vid_query = new WP_Query( $args );
						//
						//if ($vid_query->have_posts()) {
						//	while ($vid_query->have_posts()) {
						//		$vid_query->the_post();
						//		
						//		$video = get_post_meta($post->ID,'youtube-id',true);			
						//	}
						//	
						//}
					//endif;
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
else if (in_array("legend-villebois-releases-new-chateau-collection-homes", explode("/", $_SERVER["REQUEST_URI"]))) {$sidebar="villebois-contact";}
else {$sidebar = "";}
get_sidebar($sidebar);
?>
<!-- the sidebar in use is <?php echo $sidebar; ?> -->
</div>
<?php get_footer() ?>