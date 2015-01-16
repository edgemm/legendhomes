<?php get_header(); 
/*
global $options;
//echo 'OPTIONS:'; print_r($options); echo '<br/>';
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] = get_option( $value['id'] ); }
}
*/
	global $lh_mir,$cat,$lh_news_events, $lhimg;
?>

	<div class="home">
		<div id="contentwide" >
           <div id="shadow">
			<div id="head-smc">
				           <?php the_uds_billboard('lh-home-slide-1'); ?>

			</div>
           </div>
	   <div class="home-desc">
		<h2>New Home Builders in Oregon</h2>
		<p>Legend Homes is committed to providing the best home value and the best home buying experience for the buyers of our new homes in Portland and across Oregon. Better plans, more standard features, a strong focus on energy conservation and efficiency and state-of-the art home building practices are what drive us to be the very best.</p> 
		<p>Legend Home’s mission as new home builders is to be the leader in quality, value and community through integrity, innovation and pride. Legend provides homebuyers with the personalized service and attention they deserve as well as with new homes built to last through generations.</p>
	   </div>
			<div id="mirs-smc">
			<h2>Move-In Ready Homes</h2>
		<div id="mirslide">
				<ul id="mirslider" class="jcarousel-skin-tango">
					<?php
					$newsq = new WP_Query('cat='.$lh_mir.'&showposts=100');
					if ($newsq->have_posts()) : while ($newsq->have_posts()) : $newsq->the_post();
						$img = get_post_meta($post->ID,'home-image',true);
						$tag = get_post_meta($post->ID,'homepage-tagline',true);
						$price = get_post_meta($post->ID,'homepage-price',true);
						$comm = get_post_meta($post->ID,'community',true);
						
						if (strpos($price,'SOLD') !== false) {echo '';} else if (strpos($price,'sold') !== false) {echo '';} else { ?>
						
                        <li><div class="mir"><!-- <?php echo $lh_mir; ?> -->
							<h4><?php the_title() ?></h4>
							<div class="mir_img"><a href="<?php the_permalink() ?>"><img src="<?php echo $img; ?>" width="180" height="140" /></a></div>
							<p class="nopad"><?php echo $tag ?> <span class="red"><?php echo $price ?></span></p>
							<?php if ($comm !== '') { ?><p class="nopad">at <?php echo $comm ?></p><?php } ?>
		
							<h4><a href="<?php the_permalink() ?>">View now &raquo;</a></h4>
						</div></li>
					<?php } ?>
					<?php endwhile; endif; wp_reset_query(); ?>			
			</ul>
		</div>
			</div>
			<div id="leadout">
				<div id="youtube">
					<div class="tubehead"><h4><a href="http://legendhomes.com/about-us/behind-our-walls">Behind the Walls Video Series</a></h4></div>
					<p><a href="http://legendhomes.com/about-us/behind-our-walls">Take a peek</a>…see what makes our homes energy efficient and state-of-the-art.</p>
						
                        <iframe width="560" height="315" src="//www.youtube.com/embed/videoseries?list=PLnsJZwrh2aZY7TotQgadacpr7uPvOBh4x" frameborder="0" allowfullscreen></iframe>
					
				</div>
				<div id="news">
					<h2>What's Happening</h2>
						<?php $newsq = new WP_Query( 'cat=7,57,81&showposts=2');
						if ($newsq->have_posts()) : while ($newsq->have_posts()) : $newsq->the_post(); 
						?>
						<div class="singlenew">
							<h4 class="singlenewdot"><?php the_title() ?></h4>
							<p><?php homepage_excerpt(); ?></p>
							<p><a href="<?php the_permalink() ?>">Read More &raquo;</a></p>
						</div>
						<?php endwhile; endif; wp_reset_query(); ?>				
				</div>
			</div>


		</div><!-- #content -->
	</div><!-- #container -->

<?php get_footer() ?>