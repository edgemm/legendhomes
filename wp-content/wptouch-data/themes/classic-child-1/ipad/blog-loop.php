<?php $first = 0; global $post_ID; ?>
<?php if ( wptouch_have_posts() ) { while ( wptouch_have_posts() ) { ?>

<?php wptouch_the_post(); ?>
<?php $first++; ?>

<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

	<?php if ( is_sticky() ) echo '<div class="sticky-pushpin"></div>'; ?>

	<?php if ( classic_use_calendar_icons() || classic_use_thumbnail_icons() ) { ?>
		<?php if ( wptouch_get_comment_count() ) { ?> 
				<div class="comment-bubble <?php wptouch_comment_bubble_size(); ?>">
				<?php comments_number( '0', '1', '%' ); ?>
			</div>
		<?php } ?>
	<?php } ?>

	<?php if ( classic_use_calendar_icons() ) { ?>
		<?php include('calendar-icons.php'); ?>	
	<?php } elseif ( classic_use_thumbnail_icons() ) { ?>
		<?php include('thumbnails.php'); ?>
	<?php } ?>		
	<?php if ( !classic_mobile_excerpts_open() ) { ?>
		<a href="#" rel="<?php the_ID(); ?>" class="excerpt-button no-ajax"></a>	
	<?php } ?>
	<h2><a href="<?php wptouch_the_permalink(); ?>"><?php wptouch_the_title(); ?></a></h2>

	<div class="date-author-wrap">
		<?php if ( !classic_use_calendar_icons() && classic_show_date_in_posts() ) { ?>
			<div class="<?php wptouch_date_classes(); ?>">
				<?php wptouch_the_time( 'F jS, Y' ); ?>
			</div>	
		<?php } ?>		
		<?php if ( classic_show_author_in_posts() ) { ?>
			<div class="post-author">
				<?php echo sprintf( __( 'by %s', 'wptouch-pro' ), get_the_author() ); ?> 
			</div>
		<?php } ?>
	</div>
					
		
	<div class="<?php wptouch_content_classes(); ?> <?php if ( 1 == $first && !is_paged() ) { echo 'first-post'; } ?>">
		<?php if ( classic_mobile_first_full_post() && 1 == $first && !is_paged() ) { ?>

			<?php the_content(); ?>
			<a href="<?php wptouch_the_permalink(); ?>#comments" class="read-entry"><?php _e( "Comment On This Article", "wptouch-pro" ); ?></a>				

		<?php } elseif ( classic_mobile_show_all_full_post() ) { ?>

			<?php the_content(); ?>
			<a href="<?php wptouch_the_permalink(); ?>#comments" class="read-entry"><?php _e( "Comment On This Article", "wptouch-pro" ); ?></a>				

		<?php } else { ?>

			<?php the_excerpt(); ?>
			<a href="<?php wptouch_the_permalink(); ?>" class="read-entry"><?php _e( "VIEW DETAILS »", "wptouch-pro" ); ?></a>

		<?php } ?>				
	</div>

</div><!-- .wptouch_posts_classes() -->

<?php } } ?>

