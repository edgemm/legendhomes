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
		<p>Legend Homes is committed to providing the best home value and the best home buying experience you can imagine in the Portland area and across Northwest Oregon. Better plans, more standard features, a strong focus on energy efficiency and conservation as well as state-of-the-art home building practices are just part of what make Legend's new-contsruction homes some of best in all of Oregon.</p> 
		<p>Our mission as new home builders is to be the leader in quality, value and community through integrity, innovation and pride. Legend provides you as the homebuyer the personalized service and attention to detail that you deserve with a selection of beautifully-crafted new home plans built to last through generations and our own <a href="/customer-care/warranty-requests/" title="Owning a quality-built Legend home includes a much longer warranty than most new homes! Find out more...">3-5-10 new home warranty</a> that's one of the homebuilding industry's best.</p>
        <p><strong>Peace of Mind. We build it into every Legend Home.</strong></p>
	   </div>
			<div id="mirs-smc">
			<h2>Move-In Ready Homes</h2>
		<div id="mirslide">
				<ul id="mirslider" class="jcarousel-skin-tango">
					<?php
					$count = 0;
					$newsq = new WP_Query('cat='.$lh_mir.'&showposts=100');
					if ($newsq->have_posts()) : while ($newsq->have_posts()) : $newsq->the_post();
						$price = get_post_meta($post->ID,'homepage-price',true);
						
						if ( ( strpos($price,'SOLD' ) !== false) || ( strpos($price,'sold') !== false ) ) { echo ''; } else {
							$count++;
							$img = get_post_meta($post->ID,'home-image',true);
							$tag = get_post_meta($post->ID,'homepage-tagline',true);
							$comm = get_post_meta($post->ID,'community',true);
					?>
						
					<li>
						<div class="mir">
							<h4><?php the_title() ?></h4>
							<div class="mir_img">
								<a href="<?php the_permalink() ?>">
									<img src="<?php echo $img; ?>" width="180" height="140" />
									<?php if( get_field( 'show_sold_banner' ) ) : ?>
									<img src="/wp-content/themes/legendhomes/images/LH-SoldBanner-small.png" class="mir_img_sold" alt="" />
									<?php endif; ?>
								</a>
							</div>
							<p class="nopad"><?php echo $tag ?> <span class="red"><?php echo $price ?></span></p>
							<?php if ($comm !== '') { ?><p class="nopad">at <?php echo $comm ?></p><?php } ?>
		
							<h4><a href="<?php the_permalink() ?>">View now &raquo;</a></h4>
						</div>
					</li>
					<?php } ?>
					<?php endwhile; endif; wp_reset_query(); ?>
					<?php // new query if $count < 4
					if( $count < 4 ) :
						$sold_count = 4 - $count;
						$sold_args = array (
							'cat'                    => $lh_mir,
							'posts_per_page'         => $sold_count,
							'meta_query'             => array(
								array(
									'key'       => 'show_sold_banner',
									'value'     => true,
								)
							)
						);
						$soldq = new WP_Query( $sold_args );

						if ($soldq->have_posts()) : while ($soldq->have_posts()) : $soldq->the_post();
							$price = get_post_meta($post->ID,'homepage-price',true);
							$img = get_post_meta($post->ID,'home-image',true);
							$tag = get_post_meta($post->ID,'homepage-tagline',true);
							$comm = get_post_meta($post->ID,'community',true);
					?>
					<li>
						<div class="mir">
							<h4><?php the_title() ?></h4>
							<div class="mir_img">
								<a href="<?php the_permalink() ?>">
									<img src="<?php echo $img; ?>" width="180" height="140" />
									<img src="/wp-content/themes/legendhomes/images/LH-SoldBanner-small.png" class="mir_img_sold" alt="" />
								</a>
							</div>
							<p class="nopad"><?php echo $tag ?> <span class="red"><?php echo $price ?></span></p>
							<?php if ($comm !== '') { ?><p class="nopad">at <?php echo $comm ?></p><?php } ?>
		
							<h4><a href="<?php the_permalink() ?>">View now &raquo;</a></h4>
						</div>
					</li>

					<?php endwhile; endif; wp_reset_query(); ?>
					<?php endif; ?>
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