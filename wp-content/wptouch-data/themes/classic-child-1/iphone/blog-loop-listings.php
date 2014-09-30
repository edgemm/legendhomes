<?php $first = 0; global $post_ID; ?>
<?php if ( wptouch_have_posts() ) { while ( wptouch_have_posts() ) { ?>

<?php wptouch_the_post(); ?>
<?php $first++; ?>

<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

	
					
		
	<div class="<?php wptouch_content_classes(); ?> <?php if ( 1 == $first && !is_paged() ) { echo 'first-post'; } ?>">
		<?php if ( classic_mobile_first_full_post() && 1 == $first && !is_paged() ) { ?>

			<?php the_content(); ?>
			<a href="<?php wptouch_the_permalink(); ?>#comments" class="read-entry"><?php _e( "Comment On This Article", "wptouch-pro" ); ?></a>				

		<?php } elseif ( classic_mobile_show_all_full_post() ) { ?>

			<?php the_content(); ?>
			<a href="<?php wptouch_the_permalink(); ?>#comments" class="read-entry"><?php _e( "Comment On This Article", "wptouch-pro" ); ?></a>				

		<?php } else { ?>

			<div class="mirhome">
						<h3><?php the_title() ?></h3>

<!--Sold Banner And Home Image smc-->
						
						<?php 
$img = get_post_meta($post->ID,'home-image',true);
$tag = get_post_meta($post->ID,'homepage-tagline',true);
$price = get_post_meta($post->ID,'homepage-price',true);
$sf = get_post_meta($post->ID,'square-feet',true);
?>


<?php $other_page = $post->ID; ?>

<?php if ($img !== '') { ?>

<div class="home-sold-small" style="background-image:url(<?php echo $img; ?>);">

<?php if(get_field('show_sold_banner', $other_page)) { ?>

<?php echo '<p><a href="'.get_permalink($post->ID).'"><img width="100%" height="auto" src="/wp-content/themes/legendhomes/images/LH-SoldBanner.png"></a></p>'; ?>

<?php } else { ?>
																
<?php echo '<p><a href="'.get_permalink($post->ID).'"><img width="100%" height="auto" src="/wp-content/themes/legendhomes/images/smc-image-spacer.gif"></a></p>'; } ?>

</div>
												
<?php } ?>

<!-- End Sold Banner And Home Image smc-->

						<p class="nopad"><?php echo $tag ?></p>
                        <p><span class="red"><?php echo $price ?></span></p>
						<?php if ($sf != ''){?><p class="nopad"><em><?php echo $sf ?> Square Feet</em></p><?php } ?>
						<p class="nopad"><a href="<?php echo the_permalink() ?>">View details &raquo;</a></p>
						<?php /* edit_post_link(); */ ?>
						</div>

		<?php } ?>				
	</div>

</div><!-- .wptouch_posts_classes() -->

<?php } } ?>

<?php if ( wptouch_has_next_posts_link() ) { ?>
	<?php if ( !classic_is_ajax_enabled() ) { ?>	
		<div class="posts-nav post rounded-corners-8px">
			<div class="left"><?php previous_posts_link( __( "Back", "wptouch-pro" ) ) ?></div>
			<div class="right clearfix"><?php next_posts_link( __( "Next", "wptouch-pro" ) ) ?></div>
		</div>
	<?php } else { ?>
		<a class="load-more-link no-ajax" href="javascript:return false;" rel="<?php echo get_next_posts_page_link(); ?>">
			<?php _e( "Load More Entries&hellip;", "wptouch-pro" ); ?>
		</a>
	<?php } ?>
<?php } ?>