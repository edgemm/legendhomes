<?php
//$post = get_post($post->ID);

?>

<?php /* Template Name: Management Team */ ?>
<?php get_header() ?>




<?php //Determines the parent page to pull in Heading/Sub Heading
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
							
			<?php the_post() ?>
			
			<?
			$p_Id = $post->ID;
			
			switch( $p_Id ) {
				case "6563":
					$cat_filter = "553";
					$btm_link = '<a href="http://legendhomes.com/about-us/the-legend-team/">Click here for the full Legend Team</a>';
					break;
				case "6447":
					$cat_filter = "547";
					$btm_link = '<a href="http://legendhomes.com/about-us/management-team/">Click here for full Legend Management Bios</a>';
					break;
				default:
					$cat_filter = "547";
			}
			?>


			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h3 class="entry-title"><?php the_title() ?></h3>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_reset_query(); ?>
					
					<div class="management-team">
					
					<?php
					//$wpQuery = new WP_Query( array ( 'cat' => '547', 'posts_per_page' => '-1', 'meta_key' => 'staff_order', 'orderby' => 'meta_value_num', 'order' => 'ASC' ) );
					$wpQuery = new WP_Query( array ( 'cat' => $cat_filter, 'posts_per_page' => '-1', 'orderby' => 'rand' ) ); // rand may cause slowdowns. disable in WP Engine are of WP Admin - gfh

					if ($wpQuery->have_posts()) {
						while ($wpQuery->have_posts()) {
							$wpQuery->the_post();

							$img = get_post_meta($post->ID,'staff_photo',true);
							$name = get_post_meta($post->ID,'staff_name',true);
							$title = get_post_meta($post->ID,'staff_title',true);					
					?>

						<div class="team-member">
							<img class="team-member-thmb" src="<?php echo $img; ?>" alt="<?php echo $name . ' - ' . $title; ?>" title="<?php echo $name . ' - ' . $title; ?>" />
							<p class="team-member-info">
								<?php echo $name; ?>
								<br />
								<?php echo $title; ?>
							</p>
						</div>

						<?php } ?>
					<?php } ?>
					</div><!-- .management-team -->

					<p><? echo $btm_link; ?></p>
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