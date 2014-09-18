<?php /* Template Name: News & Events */ ?>
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
else {$type = "news";}
?>



	<div class="headmeta">			
		<h2><span><?php echo get_post_meta($headID,'Heading-Title',true); ?></span></h2>
		<div class="headtxtbar"><?php echo get_post_meta($headID,'Heading-SubTitle',true); ?></div>		
	</div>		

	<div id="container">
		<div class="headimgfloat"><?php the_post_thumbnail(); ?></div>
		<div id="content">	

		<?php 
			if ($type == "news") {
				$wpQuery = new WP_Query('cat=81,97,57,89&orderby=date&order=DESC&showposts=5');
			} else {
				$wpQuery = new WP_Query('category_name='.$type.'&orderby=date&order=DESC&showposts=20');
			}

		if ($wpQuery->have_posts()) {
			while ($wpQuery->have_posts()) {
				$wpQuery->the_post();
				?>
					<h4 class="entry-title"><a href="<?php echo the_permalink(); ?>" style="color:#4D6345;"><?php the_title() ?></a></h4>
					<div class="entry-content">
						<?php the_excerpt() ?>
						<p><a href="<?php echo the_permalink() ?>">Read More</a><?php edit_post_link() ?></p>
						
				</div>
				<?				
			}
			
		}
		?>	
        
        </div><!-- #content -->
	</div><!-- #container -->
	
<div id="sidebar">
	
<?php //Custom Sidebars Used - determined based on URL
get_sidebar();
?>		
</div>
<?php get_footer() ?>