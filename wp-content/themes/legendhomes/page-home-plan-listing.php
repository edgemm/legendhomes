<?php /* Template Name: Home-Plan Listings */ ?>
<?php get_header() ?>

<?php //Determines the parrent page to pull in Heading/Sub Heading
if ($post->post_parent != 0){
	if (get_post_meta($post->ID,'Heading-Title',true) != "") {
		$headID = $post->ID;
	} else {$headID = $post->post_parent;}
} else {$headID = $post->ID;}
?>

<?php //Determines if this is a plan or home or move in ready listing
$url = explode("/", $_SERVER["REQUEST_URI"]);
if (in_array("move-in-ready", $url)) {$type="move-in-ready";}
else {$type = $url[3];}
?>

<?php //Determines if page should hide sold properties gfh
$hide_sold = (get_field('hide_sold') ? true : false);
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
					<?php wp_reset_query(); ?>

					<?php 
					if ($type == "move-in-ready") {
						$args = array(
							'post_type'	=> 'post',
							'cat'		=> 655,
							'meta_key'	=> 'show_sold_banner',
							'orderby'      => array(
								'meta_value' => 'ASC',
								'' => ''
							),
							'order' => 'ASC',
							'posts_per_page' => -1
						);
						$wpQuery = new WP_Query( $args );
					} else {
						$wpQuery = new WP_Query('category_name='.get_community().'-'.$type);
					}
		
					if ($wpQuery->have_posts()) {
						while ($wpQuery->have_posts()) {
							$wpQuery->the_post();
					?>
                    
<?php 
$img = get_post_meta($post->ID,'home-image',true);
$tag = get_post_meta($post->ID,'homepage-tagline',true);
$price = get_post_meta($post->ID,'homepage-price',true);
$sf = get_post_meta($post->ID,'square-feet',true);
?>	
					
                        
					<?php // Filters out the SOLD homes from the main Move-in Ready Section, but shows them under the Community View 
						if (($type == "move-in-ready" && strtolower(get_post_meta($post->ID,'homepage-price',true)) != "sold") || $type == "homes" || $type == "plans") { ?>
						
                        <!--The filters out Sold script that actually works smc/gfh-->
                        <?php  if (strpos($price,'SOLD') !== false && $hide_sold == true) {echo '';} else if (strpos($price,'sold') !== false) {echo '';} else { ?>
                        
                        <!--The filters out Sold script that actually works smc-->

                        
                        <div class="mirhome">
						<h3><?php the_title() ?></h3>
						


<!--Sold Banner And Home Image smc-->

<?php $other_page = $post->ID; ?>

<?php if ($img !== '') { ?>

<div class="home-sold-small" style="background-image:url(<?php echo $img; ?>)">

<?php if(get_field('show_sold_banner', $other_page)) { ?>

<?php echo '<p><a href="'.get_permalink($post->ID).'"><img src="/wp-content/themes/legendhomes/images/LH-SoldBanner-small.png"></a></p>'; ?>

<?php } else { ?>
																
<?php echo '<p><a href="'.get_permalink($post->ID).'"><span></span></a></p>'; } ?>

</div>
												
<?php } ?>

<!-- End Sold Banner And Home Image smc-->

                                                
						<p class="nopad"><?php echo $tag ?> <span class="red"><?php echo $price ?></span></p>
						<?php if ($sf != ''){?><p class="nopad"><em><?php echo $sf ?> Square Feet</em></p><?php } ?>
						<p class="nopad"><a href="<?php echo the_permalink() ?>">View details &raquo;</a></p>
						<?php /* edit_post_link(); */  ?>
						</div>
						
						<?php 
						}
					} 
				} 
				?>
	
	
	
	
	
											
				</div>
			</div><!-- .post -->
            
            <?php  } ?>

		</div><!-- #content -->
	</div><!-- #container -->
	
<div id="sidebar">
	
<?php //Custom Sidebars Used - determined based on URL
get_sidebar('find-your-home');
?>		
</div>
<?php get_footer() ?>