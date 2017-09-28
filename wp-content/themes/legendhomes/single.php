<?php get_header(); ?>

	<main class="main clr" role="main">
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'content post-homes' ) ); ?>>
		
			<header class="container clr">
				
				<div class="post-gallery">
	
				<?
				
				if ( has_post_thumbnail() && !get_video_shortcode() ) :
				
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

					<h1 class="post-headline"><?php the_title(); ?></h1>

					<p class="post-subheadline highlight<?php echo ( get_field( 'post_subheadline_highlight' ) ) ? ' focus' : ''; ?>"><?php the_field( 'post_subheadline' ); ?></p>
				
				</div>

			</header>

			<section class="content container">

				<?php
				
				the_content();

				$twitter_url = get_the_permalink() . ' Legend Homes: ' . get_the_title();
				
				?>

				<p class="share-intro">Share this post</p>

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

			<?php if ( is_single( 1267 ) ) : ?>

			<section class="share-homes section-alt clr">
				
				<h2 class="section-headline headline-icon-collection">
					<span class="container">Share a Move-In Ready Home From The NW Collection</span>
				</h2>

				<div class="container clr">
				<?php
	
				$nw_args = array(
					'post_type'		=> 'homes',
					'post_status'		=> 'publish',
					'posts_per_page'	=> 3,
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

					if ( $nw_query->post_count = 3 ) :
					
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
						
						$nw_meta = get_field_objects();
		
						$nw = new stdClass();
						
						foreach( $nw_meta as $key => $value ) :
						
							$nw->$key = $value[ 'value' ];
						
						endforeach;

						?>
					<div class="columns <?php echo $nw_class; ?>" data-addr="<?php echo $nw->homes_address; ?>, Wilsonville, OR 97070" data-beds="<?php echo $nw->homes_beds; ?> Beds" data-baths="<?php echo $nw->homes_baths; ?> Baths" data-sqft="<?php echo $nw->homes_sqft; ?> SQFT">

						<?php
						
						if ( $nw->homes_gallery ) :

							$nw->image = $nw->homes_gallery[0][ 'sizes' ][ 'medium' ];

						elseif ( has_post_thumbnail() ) :

							$nw->image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

						endif;

						if ( $nw->image ) :

						?>
						<a class="home-url" href="<?php the_permalink(); ?>">
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
						<p class="related-details related-home-title">
							<?php echo "Lot " . $nw->homes_lot . " " . $plan . " " . $nw->homes_elevation; ?>
						</p>
						<p class="related-details home-status status-<?php echo $status[ 'class' ]; ?>">
							<?php //echo ( $status == 'move-in-ready' ) ? "Move-In Ready" : str_replace( '-', ' ', $status ); ?>
							<?php echo $status[ 'banner' ]; ?>
						</p>
						<p class="related-details related-home-price">
							<?php echo ( $status[ 'class' ] != 'sold' ) ? prettyPrice( $nw->homes_price ) : $status[ 'banner' ]; ?>
						</p>
						<p class="related-details related-home-specs">
							<?php echo $nw->homes_beds . " Beds, " . $nw->homes_baths . " Bath"; ?>
						</p>
						<a class="btn btn-center js-share-home" href="<?php the_permalink(); ?>">Share This Home</a>

					</div>
					<?

					endfor;

				endif;
				
				wp_reset_postdata();

				?>

				<div class="modal">
					<div class="modal-container">
						<div class="form-share-home"><?php echo do_shortcode( '[contact-form-7 id="1268" title="Share A Home"]' ); ?></div>
						<button class="js-modal-close" type="button">X Close</button>
					</div>
				</div>

				</div>

			</section>

			<?php endif; ?>

			<?php

			if ( have_rows( 'section' ) ) :

				while( have_rows( 'section' ) ) : the_row();

					$section_title = get_sub_field( 'title' );
					$section_type = get_sub_field( 'type' );
					$section_content = get_sub_field( 'content' );
					
					$section_slug = str_replace( ' ', '-', strtolower( $section_title ) );
					$section_class = '';
					$headline_class = '';

					$gmaps_addr = str_replace( ' ', '+', $addr_street . '+' . $addr_city . '+OR+' . $addr_zip );

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

			<section class="post-related container clr">

				<h2 class="section-headline headline-icon-house">
					<span class="container">Related Content</span>
				</h2>

			<?php

			$rel_args = array(
				'post_type'		=> 'post',
				'post_status'		=> 'publish',
				'posts_per_page'	=> 3,
				'post__not_in'	=> array( get_the_ID() )
			);

			$rel_query = new WP_Query( $rel_args );

			shuffle( $rel_query->posts );
			
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
				
				<article class="related one-third columns <?php echo $rel_class; ?>">

					<?php
					
					if ( has_post_thumbnail() ) :

						$rel_thmb_args = array(
							'class' => 'related-thmb'
						);

						echo get_the_post_thumbnail( get_the_ID(), 'medium', $rel_thmb_args );
						
					else:
					
						echo get_video_shortcode();
	
					endif;
	
					?>

					<h1 class="related-title">
						<?php the_title(); ?>
					</h1>

					<?php edgemm_excerpt( 'edgemm_custom_post' ); ?>

					<a class="highlight" href="<?php the_permalink(); ?>">View post</a>

				</article>
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