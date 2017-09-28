<?php get_header(); ?>

	<main class="main" role="main">

		<article id="post-404">
	
			<header class="container clr">

				<div class="header-headline">

					<h1 class="post-headline"><?php _e( 'Page not found', 'html5blank' ); ?></h1>
				
				</div>

			</header>

			<section class="content container clr">
				
				<p>Looks like the page you're looking for has moved or does not exist. You can head to the <a class="highlight" href="<?php echo home_url(); ?>">home page</a> or start with one of communities or move-in ready homes below.</p>
				
			</section>

			<section class="section-alt featured-homes clr">

				<h2 class="section-headline headline-collection">
					<span class="container">Move-In Ready Homes</span>
				</h2>

				<div class="container">
				<?php
	
				$mir_args = array(
					'post_type'		=> 'homes',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1,
					'meta_query'	=> array(
						'status_clause' => array(
							'key' => 'homes_status',
							'value'	=> 'sold',
							'compare'	=> 'NOT LIKE'
						)
					),
					'orderby' => array(
						'status_clause' => 'ASC',
						'rand'	=> 'ASC'
					)
				);
	
				$mir_query = new WP_Query( $mir_args );
				
				if ( $mir_query->have_posts() ) :

					if ( $mir_query->post_count > 2 ) :

						$cols = "one-third";
						$total = 3;
						
					else:
					
						$cols = "eight";
						$total = 2;

					endif;
						
					for ( $i = 1; $i <= $total; $i++ ) :
						$mir_query->the_post();

						$mir_class = ( $i > 1 ) ? ( ( $i == $total ) ? " omega" : "" ) : " alpha";
						$mir_class = $cols . $mir_class;

					?>
					<div class="columns <?php echo $mir_class; ?>">

						<?php
						
						$mir_meta = get_field_objects();
		
						$mir = new stdClass();
						
						foreach( $mir_meta as $key => $value ) :
						
							$mir->$key = $value[ 'value' ];
						
						endforeach;
					
						$plan = get_the_title( $mir->homes_floorplan->ID );
						$community = get_field( 'plans_community', $mir->homes_floorplan->ID );
						
						//$mir->status = get_home_status( $mir->homes_status );
						$mir->status = get_home_status( $mir->homes_status, get_the_ID(), $community );
						
						if ( $mir->homes_gallery ) :

							$mir->image = $mir->homes_gallery[0][ 'sizes' ][ 'medium' ];

						elseif ( has_post_thumbnail() ) :

							$mir->image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

						endif;

						if ( $mir->image ) :

						?>
						<img src="<?php echo $mir->image; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
						<?php

						endif;

						?>
						<p class="related-details">
							<?php echo "Lot " . $mir->homes_lot . " " . $plan . " " . $mir->homes_elevation; ?>
						</p>
						<p class="related-details home-status status-<?php echo $mir->status[ 'class' ]; ?>">
							<?php echo $mir->status[ 'banner' ]; ?>
						</p>
						<p class="related-details related-home-price">
							<?php echo ( $mir->status != 'sold' ) ? prettyPrice( $mir->homes_price ) : "Sold"; ?>
						</p>
						<p class="related-details">
							<?php echo $mir->homes_beds . " Beds, " . $mir->homes_baths . " Bath"; ?>
						</p>
						<p class="related-details">
							at <?php echo $community->post_title; ?>
						</p>
						<a class="highlight" href="<?php the_permalink(); ?>">More info</a>

					</div>
					<?

					endfor;

				endif;

				?>

				<a class="btn btn-large btn-full" href="/new-homes/">View all move-in ready homes</a>

				</div>

			</section>

			<section class="clr">

				<h2 class="section-headline headline-collection">
					<span class="container">Legend Homes Communities</span>
				</h2>

				<div class="container clr">

				<?php
				
				$communities_args = array(
					'post_type'		=> 'communities',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1
				);
				
				$communities_query = new WP_Query( $communities_args );
				
				$i = 1;

				if ( $communities_query->have_posts() ): while ( $communities_query->have_posts() ) : $communities_query->the_post();

				$classes = 'columns one-third ';
				$classes .= ( $i % 3 == 0 ) ? 'omega' : ( ( $i == 1 ) ? 'alpha' : '' );

				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post ' . $classes ); ?>>

					<a class="hentry-thmb-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php

					if( get_field( 'communities_gallery' ) ) :
					
						$images = get_field( 'communities_gallery' );

						echo '<img src="' . $images[0][ 'sizes' ][ 'medium' ] . '" alt="' . get_the_title() . '">';

					elseif ( has_post_thumbnail()) :

						the_post_thumbnail( 'medium' );

					endif;

					?>
					</a>
				
					<h1 class="post-subheadline"><?php the_title(); ?></h1>
	
					<p class="post-subheadline highlight"><?php echo get_field( 'communities_city' ); ?></p>
					
					<p class="community-excerpt clr"><?php edgemm_excerpt( 'edgemm_index' ); ?></p>
					
					<a class="highlight" href="<?php the_permalink(); ?>">View Community</a>
				
				</article>
				
				<?php
				
				$i++;
				
				endwhile;
				
				endif;
				
				wp_reset_postdata();
				
				?>
					
			</section>

		</article>

	</main>

<?php get_footer(); ?>
