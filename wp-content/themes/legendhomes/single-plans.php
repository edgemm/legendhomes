<?php get_header(); ?>

	<main class="main clr" role="main">
	
	<?php
	
	if (have_posts()): while (have_posts()) : the_post();
	
		$plan_meta = get_field_objects();
		
		$plan = new stdClass();

		foreach( $plan_meta as $key => $value ) :
		
			$plan->$key = $value[ 'value' ];
		
		endforeach;
		
		//$price = ( strlen( $plan->plans_starting_price ) > 3 ) ? prettyPrice( intval( $plan->plans_starting_price ) ) : 'the low $' . $plan->plans_starting_price . '\'s';

		/*if (  strlen( $plan->plans_starting_price ) > 3 ) : 

			$price = prettyPrice( intval( $plan->plans_starting_price ) );

		elseif ( is_single( array( 1191, 1290 ) ) ) :

			$price = 'the mid $' . $plan->plans_starting_price . '\'s';

		else :

			$price = 'the low $' . $plan->plans_starting_price . '\'s';

		endif;*/

		$price = ( is_numeric( $plan->plans_starting_price ) ) ? prettyPrice( intval( $plan->plans_starting_price ) ) : $plan->plans_starting_price;

		$community = get_field( 'plans_community', $plan->ID );

	?>	

		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'content post-plans' ) ); ?>>
		
			<header class="header-split container clr">
				
				<div class="post-gallery">
			
			<?php

			if ( has_post_thumbnail() ) :
			
			$thmb_attr = array(
				'class' => 'attachment-$size gallery-spotlight-img'
			);
			
			?>
				<div class="gallery-spotlight">
					<?php the_post_thumbnail( 'large', $thmb_attr ); ?>
				</div>
			<? endif; ?>

				</div>

				<div class="header-headline">

					<h1 class="post-headline">
						<?php the_title(); ?> Home Plan
					</h1>

					<?php if ( $plan->post_subheadline ) : ?>
					<h1 class="post-subheadline<?php echo ( $plan->post_subheadline_highlight ) ? ' focus' : ''; ?>"><?php echo $plan->post_subheadline; ?></h1>
					<?php elseif ( $community ) : ?>
					<p class="post-subheadline highlight"><?php echo $community->post_title; ?></p>
					<?php endif; ?>

				</div>
				
				<div class="header-meta">

					<p class="plan-price">Prices starting at <?php echo $price; ?></p>
					
					<p class="plan-specs">
						<span class="plan-sqft"><?php echo $plan->plans_sqft; ?> SF</span>, 
						<span class="plan-beds"><?php echo $plan->plans_beds; ?> bedrooms</span>, 
						<span class="plan-baths"><?php echo $plan->plans_baths; ?> baths</span>
					</p>
					
					<p class="plan-features"><?php echo $plan->plans_features; ?></p>

				</div>
				
				<?php if ( $plan->plans_virtual_tour ) : ?>
				<p class="plan-tour">
					<a class="btn" href="<?php echo $plan->plans_virtual_tour; ?>" target="_blank">Take Virtual Tour</a>
				</p>
				<?php endif; ?>
	
				<p class="share-intro">Share this plan</p>
				<?php

				$twitter_url = get_the_permalink() . ' ' . get_the_title() . ' Home Plan: ' . $plan->plans_sqft . ' sqft, ' . $plan->plans_beds . ' beds, ' . $plan->plans_baths . ' baths by Legend Homes. Starting at ' . $price;

				?>
				<ul class="social">
					<li class="social-item">
					<a class="share-link share-facebook img-replace" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_the_permalink() ); ?>" title="Share on Facebook" target="_blank">Facebook</a>
					</li>
					<li class="social-item">
						<a class="twitter-share-button share-link share-twitter img-replace" href="http://twitter.com/home/?status=<?php echo urlencode( $twitter_url ); ?>" title="Share on Twitter" target="_blank">Twitter</a>
					</li>
					<li class="social-item">
					<a href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-custom="true" title="Share on Pinterest"><img class="share-link share-pinterest" src="/wp-content/themes/legendhomes/img/blank.gif" alt="Pinterest"></a>
					</li>
				</ul>

			</header>
			
			<nav class="post-subnav container">

				<ul class="subnav">
					<li class="subnav-item">
						<a class="subnav-link btn" href="/home-plans/?community=<?php echo $community->post_name; ?>">All Home Plans</a>
					</li>
					<?php if ( $community ) : ?>
					<li class="subnav-item">
						<a class="subnav-link btn" href="/communities/<?php echo $community->post_name; ?>">About <?php echo $community->post_title; ?></a>
					</li>
					<? endif; ?>
					<li class="subnav-item">
						<a class="subnav-link btn toggle-form" data-toggle-id="form-contact-agent" data-agent="<?php echo str_replace( '@legendhomes.com', '', $community->agent_email ); ?>" href="/contact/" onclick="_gaq.push(['_trackEvent', 'Contact Agent', 'Home Plan contact-agent click']);">Contact an agent</a>
					</li>
				</ul>

			</nav>
			
			<section class="container form-contact toggle-hidden hidden" id="form-contact-agent">

				<?php echo do_shortcode( '[contact-form-7 id="216" title="Contact Agent"]' ); ?>

			</section>

			<?php

			// check if plan is part of collection or if plan has description (main content editor)
			if ( $plan->plans_collection || trim( str_replace( '&nbsp;', '', strip_tags( $post->post_content ) ) ) != '' ) :

			?>
			<section class="collection-details section-alt">

				<h2 class="section-headline headline-icon-house">
					<?php

					// if ( $plan->plans_collection ) :

					// 	$collection_headline = "The " . $plan->plans_collection . " Collection";

					// else :

					// 	$collection_headline = "About the " . get_the_title();

					// endif;

					$collection_headline = ( $plan->plans_collection ) ? "The " . $plan->plans_collection . " Collection" : "About the " . get_the_title();

					?>
					<span class="container"><?php echo $collection_headline; ?></span>
				</h2>

				<div class="container">

					<?php the_content(); ?>

				</div>

			</section>
			<?php endif; ?>

			<section class="plan-details container clr">

				<div class="plan-desc eight columns alpha">

					<?php

					$class_rendering = "plan-rendering";

					if ( $plan->plans_additional_elevation ) :

						$elevation_img = '<img class="' . $class_rendering . '" src="' . $plan->plans_additional_elevation[ 'url' ] . '" alt="' . $plan->plans_additional_elevation[ 'alt' ] . '">';

					elseif ( has_post_thumbnail() ) :

						$thmb_attr = array(
							'class' => $class_rendering
						);

						$elevation_img = get_the_post_thumbnail( $plan->ID, 'large', $thmb_attr );

					endif;

					echo $elevation_img;

					echo str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $plan->content ) );

					?>

					<ul class="plan-flyers">
						<li>
							<a class="plan-flyers-link" href="<?php echo $plan->plans_brochure[ 'url' ];; ?>" target="_blank">Floorplan Flyer</a>
						</li>
						<li>
							<a class="plan-flyers-link" href="<?php echo ( $plan->plans_collection == 'northwest' ) ? '/nwcollection' : '/communities/' . $community->post_name; ?>/#home_features">Home Features Flyer</a>
						</li>
					</ul>

				</div>
				
				<div class="plan-floorplan eight columns omega">

					<?php

					$floorplan = wp_get_attachment_image_src( $plan->plans_floorplan_img[ 'id' ], 'medium' )[0];

					?>
					<img class="floorplan-layout-img" src="<?php echo $floorplan; ?>" alt="Floorplans layout">

				</div>

			</section>

			<section class="post-related container clr">

				<h2 class="section-headline headline-icon-house">
					<span class="container">More by Legend Homes</span>
				</h2>

			<?php

			$rel_args = array(
				'post_type'		=> 'plans',
				'post_status'		=> 'publish',
				'posts_per_page'	=> -1,
				'post__not_in'	=> array( get_the_ID() ),
				'meta_query'	=> array(
					'relation'	=> 'AND',
					array(
						'key'	=> 'plans_community',
						'value'	=> $community->ID
					),
					array(
						'key'	=> 'plans_collection',
						'value'	=> $plan->plans_collection
					)
				)
			);

			$rel_query = new WP_Query( $rel_args );

			shuffle( $rel_query->posts );

			if ( $rel_query->post_count < 3 ) :

				$extra_args = array(
					'post_type'		=> 'plans',
					'post_status'		=> 'publish',
					'posts_per_page'	=> 3,
					'meta_query'	=> array(
						'relation'	=> 'AND',
						array(
							'key'	=> 'plans_community',
							'value'	=> $community->ID
						),
						array(
							'key'	=> 'plans_collection',
							'value'	=> $plan->plans_collection,
							'compare'	=> '!='
						)
					)
				);

				$extra_query = new WP_Query( $extra_args );
				
				shuffle( $extra_query->posts );

				$rel_query->posts = array_merge( $rel_query->posts, $extra_query->posts );
				
				$rel_query->post_count = $rel_query->post_count + $extra_query->post_count;

			endif;
			
			if ( $rel_query->have_posts() ) :

				if ( $rel_query->post_count > 2 ) :

					$cols = "one-third";
					$total = 3;
					
				else:
				
					$cols = "eight";
					$total = 2;

				endif;
					
				for ( $i = 1; $i <= $total; $i++ ) :
					$rel_query->the_post();

					$rel_class = ( $i > 1 ) ? ( ( $i == $total ) ? " omega" : "" ) : " alpha";
					$rel_class = $cols . $rel_class;

				?>
				<div class="related columns <?php echo $rel_class; ?>">

					<?php
					
					if ( has_post_thumbnail() ) :

						$rel_thmb_args = array(
							'class' => 'related-thmb'
						);

						echo get_the_post_thumbnail( get_the_ID(), 'medium', $rel_thmb_args );
	
					endif;
	
					?>
					<p class="related-details headline-related">
						<?php the_title(); ?>
					</p>
					<?php

					$price_rel = get_field( 'plans_starting_price' );

					/*if (  strlen( $price_rel ) > 3 ) : 

						$price_rel = prettyPrice( intval( $price_rel ) );

					elseif ( $post->ID == 1191 ) :

						$price_rel = 'the mid $' . $price_rel . '\'s';

					else :

						$price_rel = 'the low $' . $price_rel . '\'s';

					endif;*/

					$price_rel = ( is_numeric( $price_rel ) ) ? prettyPrice( intval( $price_rel ) ) : $price_rel;

					?>
					<p class="related-details related-home-price">
						Starting at <?php echo $price_rel; ?>
					</p>
					<p class="related-details">
						<?php echo get_field( 'plans_beds' ); ?> Beds, <?php echo get_field( 'plans_baths' ); ?> Baths
					</p>
					<p class="related-details">
						at <?php echo get_the_title( get_field( 'plans_community' ) ); ?>
					</p>
					<a class="highlight" href="<?php the_permalink(); ?>">More info</a>

				</div>
				<?

					endfor;
	
				endif;
	
				?>

			</section>

		</article>

	<?php endwhile; ?>

	<?php endif; ?>

	</main>

<?php get_footer(); ?>