<?php get_header(); ?>

	<main class="main clr" role="main">
	
	<?php
	
	if (have_posts()): while (have_posts()) : the_post();

		$home_meta = get_field_objects();
		
		$home = new stdClass();
		
		foreach( $home_meta as $key => $value ) :
		
			$home->$key = $value[ 'value' ];
		
		endforeach;
		
		$home->price = prettyPrice( intval( $home->homes_price ) );
		
		//$home->status_class = ( strpos( $home->status, 'Complete' ) !== false ) ? 'coming-soon' : $home->status;

		$plan_post = $home->homes_floorplan;
	
	if( $plan_post ) :

		$plan_meta = get_field_objects( $plan_post->ID );
		
		$plan = new stdClass();

		foreach( $plan_meta as $key => $value ) :
		
			$plan->$key = $value[ 'value' ];
		
		endforeach;
		
		$plan->ID = $plan_post->ID;
		$plan->title = $plan_post->post_title;
		$plan->content = $plan_post->post_content;

		$community = get_field( 'plans_community', $plan_post->ID );

	endif;

	$home->status = get_home_status( $home->homes_status, get_the_ID(), $community );

	?>	

		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'content post-homes' ) ); ?>>
		
			<header class="header-split container clr">
				
				<div class="post-gallery">

				<?php
				
				if( $home->homes_gallery ) :
				
					echo do_shortcode( '[gallery meta="homes_gallery"]' );

				elseif( has_post_thumbnail() ) :
				
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

					<?php $tag = ( $home->post_subheadline ) ? "p" : "h1"; ?>
					<<?php echo $tag; ?> class="post-subheadline home-title"><?php echo 'Lot ' . $home->homes_lot . " " . $plan->title . " " . $home->homes_elevation; ?></<?php echo $tag; ?>>

					<p class="home-price post-subheadline highlight" data-instapage="price"><?php echo $home->price; ?></p>

					<?php if ( $home->post_subheadline ) : ?>
					<h1 class="post-subheadline<?php echo ( $home->post_subheadline_highlight ) ? ' focus' : ''; ?>"><?php echo $home->post_subheadline; ?></h1>
					<?php endif; ?>

				</div>
				
				<?php

				// if ( ( $community->communities_special && $community->communities_special_sales ) && $home->status != 'sold' ) :

				// 	$home->status = $community->special_home_banner;
				// 	$home->status_class = "special";

				// endif;

				?>
	
				<p class="home-status status-<?php echo $home->status[ 'class' ]; ?>" data-instapage="status">
					<?php //echo ( $home->status == 'move-in-ready' ) ? "Move-In Ready" : str_replace( '-', ' ', $home->status ); ?>
					<?php echo $home->status[ 'banner' ]; ?>
				</p>

				<div class="header-meta">

					<p class="home-addr"><?php echo $home->homes_address; ?>, <?php echo $community->communities_city; ?>, OR <?php echo $community->communities_zip; ?></p>

					<p class="plan-specs">
						<span class="plan-sqft"><?php echo $home->homes_sqft; ?> SF</span>, 
						<span class="plan-beds"><?php echo $home->homes_beds; ?> bedrooms</span>, 
						<span class="plan-baths"><?php echo $home->homes_baths; ?> baths</span>
					</p>

					<p class="plan-features"><?php echo $home->homes_features; ?></p>

					<?php if ( $home->homes_mls ) : ?>
					<p class="home-mls">MLS# <?php echo $home->homes_mls; ?></p>
					<?php endif; ?>

					<?php if ( $home->status[ 'class' ] == 'coming-soon' && $home->homes_availability ) : ?>
					<p class="home-availability">Construction complete <?php echo $home->homes_availability; ?></p>
					<?php endif; ?>

				</div>

				<?php

				if ( $home->homes_virtual_tour ) :

					$virtual_tour = $home->homes_virtual_tour;

				elseif ( $plan->plans_virtual_tour ) :

					$virtual_tour = $plan->plans_virtual_tour;

				endif;

				?>
				
				<?php if ( $virtual_tour ) : ?>
				<p class="plan-tour">
					<a class="btn" href="<?php echo $virtual_tour; ?>" target="_blank">Take Virtual Tour</a>
				</p>
				<?php endif; ?>

				<p class="share-intro">Share this home</p>
				<?php

				$twitter_url = get_the_permalink() . ' ' . get_the_title() . ': ' . $home->homes_sqft . ' sqft, ' . $home->homes_beds . ' beds, ' . $home->homes_baths . ' baths in ' . $community->communities_city . ' by Legend Homes. ' . $home->price;

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
						<a class="subnav-link btn" href="/new-homes/">All Move-In Ready Homes</a>
					</li>
					<?php if( $community ) : ?>
					<li class="subnav-item">
						<a class="subnav-link btn" href="/communities/<?php echo $community->post_name; ?>">About <?php echo $community->post_title; ?></a>
					</li>
					<? endif; ?>
					<li class="subnav-item">
						<a class="subnav-link btn toggle-form" data-toggle-id="form-contact-agent" data-agent="villebois" href="/contact/" onclick="_gaq.push(['_trackEvent', 'Contact Agent', 'Home Plan contact-agent click']);">Contact an agent</a>
					</li>
				</ul>

			</nav>
			
			<section class="container form-contact toggle-hidden hidden" id="form-contact-agent">

				<?php echo do_shortcode( '[contact-form-7 id="216" title="Contact Agent"]' ); ?>

			</section>

			<section class="collection-details section-alt">

				<h2 class="section-headline headline-icon-house">
					<?php

					$collection_headline = ( $plan->plans_collection ) ? $plan->plans_collection . ' Collection' : $plan->title;

					?>
					<span class="container">The <?php echo $collection_headline; ?></span>
				</h2>

				<div class="container">

					<?php the_content(); ?>

				</div>

			</section>

			<?php if( $plan ) : ?>
			<section class="plan-details container clr">

				<div class="plan-desc eight columns alpha">

					<?php
					
					$rendering_attr = array(
						'class' => 'plan-rendering',
					);

					if ( $home->homes_elevation_rendering || has_post_thumbnail( $plan->ID ) ) :

						if ( $home->homes_elevation_rendering ) :

							echo wp_get_attachment_image( $home->homes_elevation_rendering[ 'ID' ], 'medium', false, $rendering_attr );

						else:

							echo get_the_post_thumbnail( $plan->ID, 'medium', $rendering_attr );

						endif;

						

					endif;

					$floorplan_flyer = ( $home->homes_floorplan_brochure[ 'url' ] ) ? $home->homes_floorplan_brochure[ 'url' ] : $plan->plans_brochure[ 'url' ];

					?>

					<ul class="plan-flyers">
						<li>
							<a class="plan-flyers-link" href="<?php echo $floorplan_flyer; ?>" target="_blank">Floorplan Flyer</a>
						</li>
						<li>
							<!-- <a class="plan-flyers-link" href="<?php echo ( $plan->plans_collection == 'northwest' ) ? '/nwcollection' : '/communities/' . $community->post_name; ?>/#home_features">Home Features Flyer</a> -->
							<a class="plan-flyers-link" href="/communities/<?php echo $community->post_name; ?>/#home_features">Home Features Flyer</a>
						</li>
					</ul>

				</div>
				
				<div class="plan-floorplan eight columns omega">

					<?php

					$floorplan_img_id = ( $home->homes_floorplan_img ) ? $home->homes_floorplan_img[ 'id' ] : $plan->plans_floorplan_img[ 'id' ];

					$floorplan_img = wp_get_attachment_image_src( $floorplan_img_id, 'medium' )[0];

					?>

					<img class="floorplan-layout-img" src="<?php echo $floorplan_img; ?>" alt="Floorplans layout">

				</div>

			</section>
			<?php endif; // if ( $plan ) ?>

			<?php if( $home->homes_map_options != 'none' ) : // do not display map if option set to "none" ?>
			<section class="gmap container">

				<?php

				if( $home->homes_map_options == 'custom' ) :

					$gmaps_addr = str_replace( ' ', '+', $home->homes_map_address );

				else: // generate address based on home street address and community city + zip

					$gmaps_addr = str_replace( ' ', '+', $home->homes_address . '+' . $community->communities_city . '+' . $community->communities_zip );

				endif;

				?>

				<iframe class="gmap-embed" width="600" height="348" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAFHmVFJvu5em9z2LKlXNXwf-sIEckQ0MY&q=<?php echo $gmaps_addr; ?>" allowfullscreen>
</iframe>

			</section>
			<?php endif; // if display maps ?>

			<section class="post-related container clr">

				<h2 class="section-headline headline-icon-house">
					<span class="container">More by Legend Homes</span>
				</h2>

			<?php

			$rel_args = array(
				'post_type'		=> 'homes',
				'post_status'		=> 'publish',
				'posts_per_page'	=> -1,
				'meta_query' => array(
					'relation' => 'AND',
					'status_clause' => array(
						'key' => 'homes_status',
						'value'	=> 'sold',
						'compare'	=> 'NOT LIKE'
					),
					'availability_clause' => array(
						'key' => 'homes_availability'
					)
				),
				'orderby'	=> array(
					'status_clause' => 'ASC',
					'availability_clause' => 'ASC',
					'rand'	=> 'ASC'
				),
				'post__not_in'	=> array( get_the_ID() )
			);

			$rel_query = new WP_Query( $rel_args );

			if ( $rel_query->post_count < 3 ) :
			
				$sold_count = 3 - $rel_query->post_count;
			
				$sold_args = array(
					'post_type'		=> 'homes',
					'post_status'		=> 'publish',
					'posts_per_page'	=> $sold_count,
					'meta_query'	=> array(
						'relation'	=> 'AND',
						array(
							'key' => 'homes_status',
							'value'	=> 'sold',
							'compare'	=> 'LIKE'
						)
					),
					'orderby'	=> 'modified'
				);
			
				$sold_query = new WP_Query( $sold_args );
			
				$rel_query->posts = array_merge( $rel_query->posts, $sold_query->posts );				
				$rel_query->post_count = $rel_query->post_count + $sold_query->post_count;
			
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
					
					$community = get_field( 'plans_community', get_field( 'homes_floorplan' ) );
					
					$status = get_home_status( get_field( 'homes_status' ) );
					// $status_class = ( strpos( $status, 'Complete' ) !== false ) ? 'coming-soon' : $status;
					// $status = ( strpos( $status, 'move-in-ready' ) ) ? 'Move-In Ready' : str_replace( '-', ' ', $status );
					
					// if ( get_field( 'communities_special', $community->ID ) && $status != 'sold' ) :

					// 	$status_class = "special";
					// 	$status = get_field( 'special_home_banner', $community->ID );

					// endif;

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
					<p class="related-details home-status status-<?php echo $status[ 'class' ]; ?>">
						<?php //echo ( $status == 'move-in-ready' ) ? "Move-In Ready" : str_replace( '-', ' ', $status ); ?>
						<?php echo $status[ 'banner' ]; ?>
					</p>
					<p class="related-details related-home-price">
						<?php //echo ( $status == 'sold' ) ? "Sold!" : prettyPrice( get_field( 'homes_price' ) ); ?>
						<?php echo ( $status[ 'class' ] == 'sold' ) ? $status[ 'banner' ] . "!" : prettyPrice( get_field( 'homes_price' ) ); ?>
					</p>
					<p class="related-details">
						<?php echo get_field( 'homes_beds' ); ?> Beds, <?php echo get_field( 'homes_baths' ); ?> Baths
					</p>
					<p class="related-details">
						at <?php echo get_the_title( $community->ID ); ?>
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