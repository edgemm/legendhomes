<?php /* Template Name: EarthSmart-EPS */ ?>
<?php get_header() ?>

<?php //Determines the parrent page to pull in Heading/Sub Heading
if ($post->post_parent != 0){$headID = $post->post_parent;}
else {$headID = $post->ID;}
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
					<?php the_content(); ?>
				</div>
			</div><!-- .post -->
			<h2>Featured Energy Performance Scored Homes</h2>
			<?php
			$wpQuery = new WP_Query('tag=EPS&meta_key=homepage-eps&orderby=meta_value&order=ASC');	
			
			if ($wpQuery->have_posts()) {
				while ($wpQuery->have_posts()) {
					$wpQuery->the_post();
					$img = get_post_meta($post->ID,'home-image',true);
					$tag = get_post_meta($post->ID,'homepage-tagline',true);
					$price = get_post_meta($post->ID,'homepage-price',true);
					$comm = get_post_meta($post->ID,'community',true);
					?>
					<div class="mirhome">
						<h3><?php the_title(); ?></h3>
						<p><a href="<?php echo the_permalink() ?>"><img src="<?php echo $img; ?>" border="0" /></a></p>
						<p class="nopad"><strong>EPS: <?php echo get_post_meta($post->ID,'homepage-eps',true); ?></strong></p>
						<p class="nopad"><?php echo $tag; ?> <span class="red"><?php echo $price; ?></span></p>
						<?php if ($comm !== '') { ?><p class="nopad">at <?php echo $comm; ?></p><?php } ?>
						<p class="nopad"><a href="<?php echo the_permalink() ?>">View details &raquo;</a></p>
						<?php edit_post_link(); ?>
					</div>
					<?								
				}	
			}
			?>
			<br style="clear:both;" />
			<div style="font-size:10px; padding:20px 0 10px;">
			3 Year Energy Cost Guarantee (limited): Legend Homes guarantees the original purchaser that the energy costs (Gas & Electricity costs) for your new Legend EarthSmart home will not exceed an average of $99 per month for any one year period during the first 3 years of homeownership. This guarantee is based on the energy costs for the 1646 sq. ft. The Garden C plan at Willamette Landing. Other Legend EarthSmart Homes costs will vary due to square footage differences. The Energy Cost Guarantee is calculated using an Energy Trust of Oregon Energy Performance Score (EPS) figure to determine the gas (therms) and electricity (kilowatt hours) energy required to live in your home in a typical weather year. If the energy costs used in your home exceeds the Guaranteed Cost, Legend Homes will reimburse you 100% of the cost of the difference between the Guaranteed Cost and the actual Utility Bills paid for living in your home. The reimbursement will be based on an average of your monthly utility rates during those 12 months and does not include utility fees and taxes. Used Home and Code Built Home data provided by Energy Trust of Oregon. See Builder's on-site sales representative for all the specific terms and limitation details. Marketed by Legend Real Estate Services 503-620-8080 ext. 236. CCB# 55151
			</div>
			
			
			
			
		</div><!-- #content -->
	</div><!-- #container -->
<div id="sidebar">
<?php get_sidebar() ?>
</div>
<?php get_footer() ?>