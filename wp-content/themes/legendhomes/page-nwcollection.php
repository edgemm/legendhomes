<?php // Template Name: NW Collection ?>

<?php get_header(); ?>

	<main class="main clr" role="main">
	
	<?php	if (have_posts()): while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'content' ) ); ?>>

			<header class="container clr">
			<?php

				if ( has_post_thumbnail() ) :

					$thmb_attr = array(
						'class' => 'attachment-$size gallery-spotlight-img'
					);

					$masthead = get_the_post_thumbnail( 'large', $thmb_attr );

				endif;
				
				?>

				<div class="header-headline">

					<h1 class="post-headline"><?php the_title(); ?></h1>

					<p class="post-subheadline highlight"><?php the_field( 'post_subheadline' ); ?></p>
				
				</div>

			</header>

			<section class="nwcollection featured-homes clr">

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

						?>
						<p class="related-details">
							<?php echo "Lot " . $nw->homes_lot . " " . $plan . " " . $nw->homes_elevation; ?>
						</p>
						<p class="related-details home-status status-<?php echo $status[ 'class' ]; ?>">
							<?php //echo ( $status == 'move-in-ready' ) ? "Move-In Ready" : str_replace( '-', ' ', $status ); ?>
							<?php echo $status[ 'banner' ]; ?>
						</p>
						<p class="related-details related-home-price">
							<?php //echo ( $status != 'sold' ) ? prettyPrice( $nw->homes_price ) : "Sold"; ?>
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
				<a class="btn btn-large btn-center" href="/communities/legend-at-villebois/">Go to Legend at Villebois</a>

			</section>

			<section class="video-promo section-alt clr">
				
				<h2 class="section-headline headline-icon-collection">
					<span class="container">President Jim Chapman Introduces the Northwest Collection</span>
				</h2>

				<div class="container">
				<?php echo do_shortcode( '[video url="https://www.youtube.com/watch?v=wjni2od5Ycw"]' ); ?>
				</div>

				<a class="btn btn-large btn-center" href="/communities/legend-at-villebois/">Go to Legend at Villebois</a>

			</section>

			<?php

			if( have_rows( 'section' ) ) :

				while( have_rows( 'section' ) ) : the_row();

					$section_title = get_sub_field( 'title' );
					$section_type = get_sub_field( 'type' );
					$section_anchor = get_sub_field( 'anchor' );
					$section_content = get_sub_field( 'content' );
					
					$section_slug = str_replace( ' ', '-', strtolower( $section_title ) );
					$section_class = '';
					$headline_class = '';

					$gmaps_addr = ( get_sub_field( 'address' ) ) ? get_sub_field( 'address' ) : $addr_street . '+' . $addr_city . '+OR+' . $addr_zip;
					$gmaps_addr = str_replace( ' ', '+', $gmaps_addr );

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
						case 'form':
							$headline_class = 'headline-icon-envelope';
							break;
						case 'form_alt':
							$section_class = 'section-alt';
							$headline_class = 'headline-icon-envelope';
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

				<?php if ( $section_type != 'no_headline' ) : ?>
				<h2 class="section-headline <?php echo $headline_class; ?>">
					<span class="container">
					<?php

					if ( $section_anchor ) echo '<a class="headline-anchor" name="' . $section_anchor . '">';
					echo $section_title;
					if ( $section_anchor ) echo '</a>';

					?>
					</span>
				</h2>
				<?php endif; ?>

				<?php if( $section_type != 'location' ) : ?>

				<div class="container clr">

					<?php echo $section_content; ?>

				</div>
				
					<?php if( $section_type == 'location_headline' ) : ?>

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