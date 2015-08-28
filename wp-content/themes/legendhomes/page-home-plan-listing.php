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

<?php //Determine community
$community = get_community();
?>
			
					
	<div class="headmeta">			
		<h2><span><?php echo get_post_meta($headID,'Heading-Title',true); ?></span></h2>
		<div class="headtxtbar"><?php echo get_post_meta($headID,'Heading-SubTitle',true); ?></div>		
	</div>		

	<div id="container">
		<div class="headimgfloat"><?php the_post_thumbnail(); ?></div>
		<div id="content">							
			<?php the_post(); ?>

			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h3 class="entry-title"><?php the_title() ?></h3>
				<div class="entry-content">
					<?php the_content() ?>
					<?php wp_reset_query(); ?>
					
					<?php // display featured collection above other plans

					switch( $community ) :

						case "legend-at-villebois":
							$collection = strtolower( "northwest" );
							$collection_heading = "Introducing the Northwest Collection";
							break;

					endswitch;
					
					if( $collection && $type == "plans" ) :

						$collection_args = array(
							'post_type'	=> 'post',
							'category__in'	=> array( 122, 93, 220, 123, 94, 95 ),
							'meta_key'	=> 'lh_collection_name',
							'meta_value'	=> $collection,
							'orderby'	=> 'date',
							'order' => 'ASC',
							'posts_per_page' => -1
						);

						$collection_query = new WP_Query( $collection_args );

						if ($collection_query->have_posts()) :

							echo '<h6>' . $collection_heading . '</h6>';

							while ($collection_query->have_posts()) :

								$collection_query->the_post();

								$img = get_post_meta($post->ID,'home-image',true);
								$tag = get_post_meta($post->ID,'homepage-tagline',true);
								$price = get_post_meta($post->ID,'homepage-price',true);
								$sf = get_post_meta($post->ID,'square-feet',true);

								?>
			<div class="mirhome">
				<h3><?php the_title() ?></h3>				
				<?php $other_page = $post->ID; ?>
				<?php if ($img !== '') { ?>
					<div class="home-sold-small" style="background-image:url(<?php echo $img; ?>)">
					<?php if(get_field('show_sold_banner', $other_page)) { ?>
						<?php echo '<p><a href="'.get_permalink($post->ID).'"><img src="/wp-content/themes/legendhomes/images/LH-SoldBanner-small.png"></a></p>'; ?>
					<?php } else { ?>
						<?php echo '<p><a href="'.get_permalink($post->ID).'"><span></span></a></p>'; } ?>
					</div>											
				<?php } ?>
				<p class="nopad">
					<?php echo $tag ?>
					<span class="red"><?php echo $price ?></span>
				</p>
				<?php if ($sf != ''){?>
				<p class="nopad">
					<em><?php echo $sf ?> Square Feet</em>
				</p><?php } ?>
				<p class="nopad">
					<a href="<?php echo the_permalink() ?>">View details &raquo;</a>
				</p>
			</div>
					<?php
							endwhile;	
						endif;

						wp_reset_postdata();

					endif;

					?>

					<?php
					// arguments for query. category added based on $type
					$args = array(
						'post_type'	=> 'post',
						'meta_key'	=> 'show_sold_banner',
						'orderby'      => array(
							'meta_value' => 'ASC'
						),
						'order' => 'ASC',
						'posts_per_page' => -1
					);
					if ($type == "move-in-ready") {
						$args['cat'] = 655;
					} else {
						$args['category_name'] = $community . '-' . $type;
					}

					$wpQuery = new WP_Query( $args );
		
					if ($wpQuery->have_posts()) {
						if( $type == "plans" && $collection ) echo '<h6 style="clear:both;">Additional Available Home Plans</h6>';
						while ($wpQuery->have_posts()) {
							$wpQuery->the_post();

							// skip plan if part of the featured collection
							if( $collection && strtolower( get_post_meta( $post->ID, 'lh_collection_name', true ) ) === $collection ) continue;
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