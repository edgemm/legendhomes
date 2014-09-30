<?php get_header(); ?>	

	<?php if ( wptouch_have_posts() ) { ?>
	
		<?php wptouch_the_post(); ?>

		<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

			<?php if ( classic_use_thumbnail_icons() && classic_thumbs_on_single() ) { ?>
				<?php include('thumbnails.php'); ?>
			<?php } ?>

			<h2><?php wptouch_the_title(); ?></h2>

			<div class="date-author-wrap">
				<?php if ( classic_show_date_single() ) { ?>
					<div class="<?php wptouch_date_classes(); ?>">
						<?php _e( "Published on", "wptouch-pro" ); ?> <?php wptouch_the_time( 'F jS, Y' ); ?>
					</div>			
				<?php } ?>	
				<?php if ( classic_show_author_single() ) { ?>
					<div class="post-author">
						<?php _e( "Written by", "wptouch-pro" ); ?>: <?php the_author(); ?> 
					</div>
				<?php } ?>	
			</div>
		</div><!-- wptouch_posts_classes() -->
		
		<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

		<!-- text for 'back and 'next' is hidden via CSS, and replaced with arrow images -->

			<div class="<?php wptouch_content_classes(); ?>">

				<div class="headmeta">			
			
					<h2><span></span></h2>
			
					<div class="headtxtbar"></div>		
			
				</div>
    
				<?php wptouch_the_content(); ?>
				
				<?php wp_reset_query(); ?>
					
				<div class="management-team">
				
				<?php
				$wpQuery = new WP_Query( array ( 'cat' => '547', 'posts_per_page' => '-1', 'meta_key' => 'staff_order', 'orderby' => 'meta_value', 'order' => 'ASC' ) );

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

				<p><a href="http://legendhomes.com/about-us/management-team/">Click here for full Legend Management Bios</a></p>

			</div><!-- wptouch_content_classes() -->

		</div><!-- wptouch_posts_classes() -->

		<?php } ?>


<?php get_footer(); ?>