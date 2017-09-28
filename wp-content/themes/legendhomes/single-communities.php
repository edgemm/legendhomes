<?php get_header(); ?>

	<main class="main clr" role="main">
	
	<?php
	
	if (have_posts()): while (have_posts()) : the_post();
	
		$community_meta = get_field_objects();
		
		$community = new stdClass();
		
		foreach( $community_meta as $key => $value ) :
		
			$community->$key = $value[ 'value' ];
		
		endforeach;
		
		$addr_street = $community->communities_address;
		$addr_city = $community->communities_city;
		$addr_zip = $community->communities_zip;

		$community->headline = ( get_field( 'post_headline' ) ) ? get_field( 'post_headline' ) : get_the_title();
		$community->subheadline = get_field( 'post_subheadline' );

		$sylvia = is_single( '9' ); // different layout for Sylvia during early development
		
	?>	

		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'content post-communities' ) ); ?>>

			<header class="header-split container clr">

				<div class="post-gallery">

					<?php

					// if ( $sylvia ) : // load separate template for Sylvia while in early development
					
					// 	include TEMPLATEPATH . '/single-sylvia.php';

					// 	exit();

					// elseif ( $community->communities_gallery ) :
					
					/*if ( $sylvia ) :

						echo do_shortcode( '[video url="https://www.youtube.com/watch?v=o4jm54DiwsE"]' );

					elseif ( $community->communities_gallery ) :*/
					if ( $community->communities_gallery ) :
					
						echo do_shortcode( '[gallery meta="communities_gallery"]' );
	
					elseif ( has_post_thumbnail() ) :

					echo '<div class="gallery-spotlight">';
					
					$thmb_attr = array(
						'class' => 'attachment-$size gallery-spotlight-img'
					);
					
					the_post_thumbnail( 'large', $thmb_attr );
					
					echo '</div>'; // closing .gallery-spotlight

					endif;

				?>

				</div>

				<div class="header-headline">

					<?php $tag = ( $community->communities_city ) ? "p" : "h1"; ?>
					<<?php echo $tag; ?> class="post-headline"><?php echo $community->headline; ?></<<?php echo $tag; ?>>
	
					<?php if ( !empty( $community->subheadline ) ) : ?>
					<h1 class="post-subheadline<?php echo ( $community->post_subheadline_highlight ) ? ' focus' : ''; ?>"><?php echo $community->subheadline; ?></h1>
					<?php endif; ?>
				
				</div>

				<nav class="post-subnav">
	
					<ul class="subnav">
						<li class="subnav-item">
							<a class="subnav-link btn" href="/home-plans/?community=<?php echo $post->post_name; ?>">Home plans</a>
						</li>
						<li class="subnav-item">
							<a class="subnav-link btn" href="/new-homes/?community=<?php echo $post->post_name; ?>">Move-In Ready Homes</a>
						</li>
						<li class="subnav-item btn-contact-agent">
							<a class="subnav-link btn toggle-form" data-toggle-id="form-contact-agent" data-agent="sylvia" href="/contact/" onclick="_gaq.push(['_trackEvent', 'Contact Agent', 'Home Plan contact-agent click']);">Contact an agent</a>
						</li>
					</ul>
	
				</nav>
				
				<section class="form-contact toggle-hidden hidden" id="form-contact-agent">
	
					<?php echo do_shortcode( '[contact-form-7 id="216" title="Contact Agent"]' ); ?>
	
				</section>

			</header>

			<?php if ( $community->communities_special ) : ?>

			<section class="section-special clr">

				<h2 class="section-headline">
					<span class="container"><?php echo $community->special_title; ?></span>
				</h2>

				<div class="container clr">

					<?php echo $community->special_details; ?>
					
					<?php
					if ( $community->special_cta_text && $community->special_cta_url ) :
						$special_cta_target = ( $community->special_cta_new_tab ) ? ' target="_blank"' : '';
					?>
					<p class="special-cta">
						<a class="btn btn-large" href="<?php echo $community->special_cta_url; ?>"<?php echo $special_cta_target; ?>><?php echo $community->special_cta_text; ?></a>
					</p>
					<?php endif; ?>
					
					<?php if ( $community->special_disclaimer ) : ?>
					<p class="special-disclaimer"><?php echo strip_tags( $community->special_disclaimer, '<strong><a><span>' ); ?></p>
					<?php endif; ?>

				</div>

			</section>

			<?php endif; ?>

			<section class="community-desc container clr">

				<?php
				
				the_content();

				$twitter_url = get_the_permalink() . ' Legend Homes ' . get_the_title() . ' community, located in ' . $community->communities_city . ', features brand new, green-built homes.';
				
				?>

				<p class="share-intro">Share this community</p>

				<ul class="social">
					<li class="social-item">
						<a class="share-link share-facebook img-replace" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_the_permalink() ); ?>" title="Share on Facebook" target="_blank">Facebook</a>
					</li>
					<li class="social-item">
						<a class="share-link share-twitter img-replace" href="http://twitter.com/home/?status=<?php echo urlencode( $twitter_url ); ?>" title="Share on Twitter" target="_blank">Twitter</a>
					</li>
					<li class="social-item">
						<a href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-custom="true" title="Share on Pinterest"><img class="share-link share-pinterest" src="/wp-content/themes/legendhomes/img/blank.gif" alt="Pinterest"></a>
					</li>
				</ul>

			</section>
			
			<?php if ( $sylvia ) : ?>
			<section class="section-aerial-view section-alt clr">

				<h2 class="section-headline">
					<span class="container">Community Aerial View</span>
				</h2>
				
				<div class="community-aerial-view container clr">
					<?php echo do_shortcode( '[video url="https://www.youtube.com/watch?v=LfmWSQ3nEds"]' ); ?>
				</div>

			</section>

			<section class="section-community-news section-alt clr">

				<h2 class="section-headline">
					<span class="container">Latest Sylvia News</span>
				</h2>

				<?php
				
				//if ( $temporary_shutoff == "this is just to shut off functionality for now" ) :
				
				$syl_news_args = array(
					'cat' => 68,
					'posts_per_page' => 3
				);
				
				$syl_news_query = new WP_Query( $syl_news_args );
				
				if ( $syl_news_query->have_posts() ) :
				
				?>
				
				<div class="community-news container clr">
					
				<?php
				
					if ( $syl_news_query->post_count > 2 ) :
					
						$cols = "one-third";
						$total = 3;
						
					else:
					
						$cols = "eight";
						$total = 2;
	
					endif;
						
					for ( $i = 1; $i <= $total; $i++ ) :
						$syl_news_query->the_post();
	
						$news_class = ( $i > 1 ) ? ( ( $i == $total ) ? " omega" : "" ) : " alpha";
						$news_class = $cols . $news_class;
						
					?>
					<article class="community-news-item columns <?php echo $news_class; ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php
						$news_thmb_args = array(
							'class' => 'related-thmb'
						);
						?>
						<a class="community-news-thmb-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'medium', $news_thmb_args ); ?>
						</a>
					<?php

					elseif( get_video_shortcode() ) :

						echo get_video_shortcode();

					endif;

					?>
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h1>					
					</article>
					<?php
					endfor;

					wp_reset_postdata();
				?>
				
					<p class="community-news-btn-all clr">
						<a class="btn btn-large btn-center" href="/sylvia-news/">View all Sylvia news</a>
					</p>

				</div>
				
				<?php endif; ?>
				<?php //endif; // this is for the shutoff ?>
				
				<div class="container clr">
					
					<p>Don't want to miss anything about our latest development? Sign up to receive the latest news on the Sylvia neighborhood as development continues.</p>
					
					<form action="http://lh.edgemm.com/t/y/s/zitduy/" class="form-below clr" method="post">
						<input class="form-columns form-one-third" id="fieldName" name="cm-name" placeholder="Name" type="text">
						<input class="form-columns form-one-third" id="fieldEmail" name="cm-zitduy-zitduy" placeholder="Email" required="" type="email">
						<label class="form-columns form-one-third form-below-one-third" for="listbtyihi">
							<input id="listbtyihi" name="cm-ol-btyihi" type="checkbox">Receive latest Legend Homes news
						</label>
						<button class="btn form-columns form-one-third" type="submit">Get Sylvia Neighborhood Updates</button>
					</form>
					
				</div>

			</section>
			<?php endif; ?>

			<?php

			if ( is_single( 7 ) ) : // special layout for Legend at Villebois (NW Collection)

			?>
			<section class="nwcollection featured-homes section-alt clr">
				
				<h2 class="section-headline headline-icon-collection">
					<span class="container">Move-In Ready Homes From The NW Collection</span>
				</h2>

				<div class="container clr">
				<?php
	
				$nw_args = array(
					'post_type'		=> 'homes',
					'post_status'		=> 'publish',
					'posts_per_page'	=> 4,
					'meta_query' => array(
						'relation' => 'AND',
						'status_clause' => array(
							'key' => 'homes_status',
							'value'	=> 'sold',
							'compare'	=> 'NOT LIKE'
						),
						'collection_clause' => array(
							'key'	=> 'homes_collection',
							'value'	=> 'northwest',
						),
						'availability_clause' => array(
							'key' => 'homes_availability'
						)
					),
					'orderby'	=> array(
						'status_clause' => 'ASC',
						'availability_clause' => 'ASC',
						'rand'	=> 'ASC'
					)
				);
	
				$nw_query = new WP_Query( $nw_args );
				
				$sold_args = array(
					'post_type'		=> 'homes',
					'post_status'		=> 'publish',
					'posts_per_page'	=> 3,
					'meta_query' => array(
						'relation' => 'AND',
						'status_clause' => array(
							'key' => 'homes_status',
							'value'	=> 'sold',
							'compare'	=> 'LIKE'
						),
						'collection_clause' => array(
							'key'	=> 'homes_collection',
							'value'	=> 'northwest',
						),
						'availability_clause' => array(
							'key' => 'homes_availability'
						)
					),
					'orderby' => 'modified'
				);
				
				$sold_query = new WP_Query( $sold_args );
				
				$nw_query->posts = array_merge( $nw_query->posts, $sold_query->posts );				
				$nw_query->post_count = $nw_query->post_count + $sold_query->post_count;
				
				if ( $nw_query->have_posts() ) :

					if ( $nw_query->post_count >= 4 ) :

						$cols = "four";
						$total = 4;
						
					elseif ( $nw_query->post_count = 3 ) :
					
						$cols = "one-third";
						$total = 3;
					
					else:
					
						$cols = "eight";
						$total = 2;

					endif;
						
					for ( $i = 1; $i <= $total; $i++ ) :
						$nw_query->the_post();

						$nw_class = ( $i > 1 ) ? ( ( $i == $total ) ? " omega" : "" ) : " alpha";
						$nw_class = $cols . $nw_class;

					?>
					<div class="columns <?php echo $nw_class; ?>">

						<?php
						
						$nw_meta = get_field_objects();
		
						$nw = new stdClass();
						
						foreach( $nw_meta as $key => $value ) :
						
							$nw->$key = $value[ 'value' ];
						
						endforeach;
						
						if ( $nw->homes_gallery ) :

							$nw->image = $nw->homes_gallery[0][ 'sizes' ][ 'medium' ];

						elseif ( has_post_thumbnail() ) :

							$nw->image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

						endif;

						if ( $nw->image ) :

						?>
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo $nw->image; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
						</a>
						<?php

						endif;
					
						$plan = get_the_title( $nw->homes_floorplan->ID );
						$community = get_field( 'plans_community', $nw->homes_floorplan->ID );
						$status = get_home_status( $nw->homes_status, get_the_ID(), $community );

						// $status_class = ( strpos( $status, 'Complete' ) !== false ) ? 'coming-soon' : $status;
						// $status = ( strpos( $status, 'move-in-ready' ) ) ? 'Move-In Ready' : str_replace( '-', ' ', $status );

						// if ( $community->communities_special && $status != 'sold' ) :
		
						// 	$status = $community->special_home_banner;
						// 	$status_class = "special";
		
						// endif;

						?>
						<p class="related-details">
							<?php echo "Lot " . $nw->homes_lot . " " . $plan . " " . $nw->homes_elevation; ?>
						</p>
						<p class="related-details home-status status-<?php echo $status[ 'class' ]; ?>">
							<?php //echo ( $status == 'move-in-ready' ) ? "Move-In Ready" : str_replace( '-', ' ', $status ); ?>
							<?php echo $status[ 'banner' ]; ?>
						</p>
						<p class="related-details related-home-price">
							<?php echo ( $status[ 'class' ] != 'sold' ) ? prettyPrice( $nw->homes_price ) : $status[ 'banner' ]; ?>
						</p>
						<p class="related-details">
							<?php echo $nw->homes_beds . " Beds, " . $nw->homes_baths . " Bath"; ?>
						</p>
						<a class="highlight" href="<?php the_permalink(); ?>">More info</a>

					</div>
					<?

					endfor;

				endif;
				
				wp_reset_postdata();

				?>

				</div>

				<a class="btn btn-large btn-center" href="/new-homes/?community=legend-at-villebois">View Move-In Ready Homes</a>

			</section>

			<section class="video-promo clr">
				
				<h2 class="section-headline headline-icon-collection">
					<span class="container">
						<a class="headline-anchor" name="nw_promo">Introducing the Northwest Collection</a>
					</span>
				</h2>

				<div class="container">
				<?php echo do_shortcode( '[video url="https://www.youtube.com/watch?v=N-LnRqwDOtY"]' ); ?>
				</div>

			</section>
			<?php

			endif;

			?>

			<?php

			if ( have_rows( 'section' ) ) :

				while( have_rows( 'section' ) ) : the_row();

					$section_title = get_sub_field( 'title' );
					$section_type = get_sub_field( 'type' );
					$section_anchor = get_sub_field( 'anchor' );
					$section_content = get_sub_field( 'content' );
					
					$section_slug = str_replace( ' ', '-', strtolower( $section_title ) );
					$section_class = '';
					$headline_class = '';

					if ( get_sub_field( 'address_type' ) == 'custom' ) :
					
						$gmaps_addr = str_replace( ' ', '+', get_sub_field( 'address' ) );

					else:

						$gmaps_addr = str_replace( ' ', '+', $addr_street . '+' . $addr_city . '+OR+' . $addr_zip );

					endif;

					switch( $section_type ) :
					
						case 'no_headline':
							$section_class = '';
							break;
						case 'collapse':
							$section_class = 'section-collapse';
							$headline_class = 'headline-collapse';
							break;
						case 'collapse_alt':
							$section_class = 'section-collapse section-alt';
							$headline_class = 'headline-collapse';
							break;
						case 'location':
							$section_class = 'gmap';
							break;
						case 'location_headline':
							$section_class = 'section-alt';
							$headline_class = 'headline-icon-auto';
							break;
						case 'collection':
							$section_class = 'section-alt';
							$headline_class = 'headline-icon-house';
							break;
						case 'alternate':
							$section_class = 'section-alt';
							break;
						case 'default':
							$section_class = '';
							break;
						default:
							$section_class = '';
							$headline_class = '';

					endswitch;

			?>
			<section class="section-<?php echo $section_slug . ' ' . $section_class; ?> clr">

				<h2 class="section-headline <?php echo $headline_class; ?>">
					<span class="container">
					<?php

					if ( $section_anchor ) echo '<a class="headline-anchor" name="' . $section_anchor . '">';
					echo $section_title;
					if ( $section_anchor ) echo '</a>';

					?>
					</span>
				</h2>

				<?php if ( $section_type != 'location' ) : ?>

				<div class="container clr">

					<?php echo $section_content; ?>

				</div>
				
					<?php if ( $section_type == 'location_headline' ) : ?>

				<div class="gmap container">

					<iframe class="gmap-embed" width="600" height="348" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAFHmVFJvu5em9z2LKlXNXwf-sIEckQ0MY&q=<?php echo $gmaps_addr; ?>" allowfullscreen>
</iframe>

				</div>
				
					<?php endif; ?>
				
				<?php else : ?>

				<iframe class="gmap-embed" width="600" height="348" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAFHmVFJvu5em9z2LKlXNXwf-sIEckQ0MY&q=<?php echo $gmaps_addr; ?>" allowfullscreen>
</iframe>

				<?php endif; ?>

			</section>
			<?php

				endwhile;

			endif;

			?>

		</article>

	<?php endwhile; ?>

	<?php endif; ?>

	</main>

<?php get_footer(); ?>