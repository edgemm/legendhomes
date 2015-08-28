<?php /* Template Name: Home Maintenance Tips */ ?>
<?php get_header() ?>

<?php //Determines the parrent page to pull in Heading/Sub Heading
if ($post->post_parent != 0){
	if (get_post_meta($post->ID,'Heading-Title',true) != "") {
		$headID = $post->ID;
	} else {$headID = $post->post_parent;}
} else {$headID = $post->ID;}
?>

<?php //Determines what type of news category
$url = explode("/", $_SERVER["REQUEST_URI"]);
if ($url[2] != ""){$type = $url[2];}
else {$type = "home-maintenance-tips";}
?>



	<div class="headmeta">			
		<h2><span><?php echo get_post_meta($headID,'Heading-Title',true); ?></span></h2>
		<div class="headtxtbar"><?php echo get_post_meta($headID,'Heading-SubTitle',true); ?></div>		
	</div>		

	<div id="container">
		<div class="headimgfloat"><?php the_post_thumbnail(); ?></div>
		<div id="content">
		<?php
		//$page_id = 6632;
		$page = get_post( get_the_ID() );
		$content = $page->post_content;
		echo apply_filters('the_content', $content)
		//echo "<p>$page->post_content</p>";
		?>
		<div class="video-blogroll">
		<?php 
			if ($type == "home-maintenance-tips") {
				$args = array(
					'post_type'		=> 'post',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1,
					'meta_key'		=> 'post_sort_order',
					'orderby'		=> 'meta_value_num',
					'order'			=> 'ASC'
				);
				$wpQuery = new WP_Query( $args );
			} else {
				$wpQuery = new WP_Query('category_name='.$type.'&orderby=date&order=DESC&showposts=20');
			}

		if ($wpQuery->have_posts()) {
			while ($wpQuery->have_posts()) {
				$wpQuery->the_post();
				
				$video = get_post_meta($post->ID,'youtube-id',true);
				?>
					<h4 class="entry-title"><a href="<?php echo the_permalink(); ?>" style="color:#4D6345;"><?php the_title(); ?></a></h4>
					<div class="entry-content">
						<?php the_excerpt(); ?>
						<?php if( $video ) { ?><iframe width="610" height="458" src="//www.youtube.com/embed/<?php echo $video; ?>" frameborder="0" allowfullscreen></iframe><?php } ?>
						<p class="video-readmore"><a href="<?php echo the_permalink(); ?>">Read More</a>&nbsp;<?php edit_post_link(); ?></p>
						
				</div>
				<?				
			}
			
		}
		?>
		</div>
        
        </div><!-- #content -->
	</div><!-- #container -->
	
<div id="sidebar">
	
<?php //Custom Sidebars Used - determined based on URL
get_sidebar( 'customer-care' );
?>		
</div>
<?php get_footer(); ?>