<?php // Template Name: Home ?>

<?php get_header(); ?>

	<main class="main clr" role="main">
	
	<?php	if (have_posts()): while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'content' ) ); ?>>

			<header class="container clr">
			<?php

				if ( get_field( 'masthead_image' ) ) :

					$masthead = get_field( 'masthead_image' );
					$masthead = '<img class="gallery-spotlight-img" src="' . $masthead[ 'url' ] . '" alt="' . $masthead[ 'alt' ] . '">';
					
					$masthead_url = get_field( 'masthead_url' );

				elseif ( has_post_thumbnail() ) :

					$thmb_attr = array(
						'class' => 'attachment-$size gallery-spotlight-img'
					);

					$masthead = get_the_post_thumbnail( 'large', $thmb_attr );

				endif;

				if ( $masthead ) :

				?>
					<div class="gallery-spotlight">

						<?php if ( $masthead_url ) : ?>
						<a href="<?php echo $masthead_url; ?>" onclick="_gaq.push(['_trackEvent', 'Home Hero', 'Homepage hero image click']);">
						<?php
						
						endif;
						
						echo $masthead;
						
						if ( $masthead_url ) echo '</a>';

						?>

					</div>
				<? endif; ?>

				<h1 class="post-headline">
					<?php the_title(); ?>
				</h1>

				<?php
				
				$subheadline = get_field( 'post_subheadline' );
				
				if ( $subheadline ) :
				
				?>
				<p class="post-subheadline highlight">

					<?php echo $subheadline; ?>

				</p>
				<?php endif; ?>

			</header>

			<section class="container">

				<?php the_content(); ?>

			</section>

			<section class="section-alt featured-homes clr">

				<h2 class="section-headline headline-collection">
					<span class="container">Move-In Ready Homes</span>
				</h2>

				<div class="container clr">
				<?php
	
				$mir_args = array(
					'post_type'		=> 'homes',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1,
					'meta_key'		=> 'homes_status',
					'orderby'	=> array(
						'meta_value' => 'ASC',
						'modified'	=> 'ASC'
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
						
						if ( $mir->homes_gallery ) :

							$mir->image = $mir->homes_gallery[0][ 'sizes' ][ 'medium' ];

						elseif ( has_post_thumbnail() ) :

							$mir->image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

						endif;

						if ( $mir->image ) :

						?>
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo $mir->image; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
						</a>
						<?php

						endif;
					
						$plan = get_the_title( $mir->homes_floorplan->ID );
						$community = get_field( 'plans_community', $mir->homes_floorplan->ID );
						$status = get_home_status( $mir->homes_status, get_the_ID(), $community );

						/*$status_class = ( strpos( $status, 'Complete' ) !== false ) ? 'coming-soon' : $status;
						$status = ( strpos( $status, 'move-in-ready' ) ) ? 'Move-In Ready' : str_replace( '-', ' ', $status );

						if ( $community->communities_special && $status != 'sold' ) :
		
							$status = $community->special_home_banner;
							$status_class = "special";
		
						endif;*/

						?>
						<p class="related-details">
							<?php echo "Lot " . $mir->homes_lot . " " . $plan . " " . $mir->homes_elevation; ?>
						</p>
						<p class="related-details home-status status-<?php echo $status[ 'class' ]; ?>">
							<?php //echo ( $status == 'move-in-ready' ) ? "Move-In Ready" : str_replace( '-', ' ', $status ); ?>
							<?php echo $status[ 'banner' ]; ?>
						</p>
						<p class="related-details related-home-price">
							<?php echo ( $status != 'sold' ) ? prettyPrice( $mir->homes_price ) : $status[ 'banner' ]; ?>
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
				
				wp_reset_query();

				?>

				</div>

				<a class="btn btn-large btn-center" href="/new-homes/">View all move-in ready homes</a>

			</section>

			<section class="section-alt clr">

				<h2 class="section-headline headline-icon-check">
					<!--<span class="container">Why choose Legend Homes</span>-->
					<span class="container"><?php the_field( 'home_lower_title' ); ?></span>
				</h2>

				<div class="container clr">

					<!--<p>For more than 40 years, Legend Homes has made customer care a priority. That's one reason that <strong>99% of our homebuyers say they would recommend us to their family and friends</strong>. Through our innovative architectural design, quality construction, first-rate products and comprehensive three, five and ten year warranties, we have truly innovated the ideal homebuilding process.</p>
					
					<p>The Legend Homes New Home Warranty program guarantees that the smallest of details—from material defects and workmanship—will be covered for three years after final inspection.  Plus, our additional five and ten year warranty programs meet or, most likely, exceed typical industry practices.</p>
					
					<p>Legends' EarthSmart energy-efficient homes can <a href="/earthsmart/energy-bill-guarantee/">save you up to 50% on your monthly whole home energy cost</a>. When you compare that to the average used home in Oregon that's about 95 bucks a month.</p>-->
					<?php the_field( 'home_lower_content' ); ?>
					
					<p>
						<!--<a class="no-hover" href="/earthsmart/energy-bill-guarantee/"><img src="/wp-content/uploads/legend-neighborhood-save-50-percent-monthly-energy-cost.jpg" alt="Save up to 50% on your monthly energy costs"></a>-->
						<?php

						$lower_hero_url = get_field( 'lower_hero_url' );
						$lower_hero_img = get_field( 'lower_hero_image' );
						
						if ( !empty( $lower_hero_url ) ) echo '<a class="no-hover" href="' . $lower_hero_url . '">';
						if ( !empty( $lower_hero_img ) ) echo '<img src="' . $lower_hero_img[ 'url' ] . '" alt="' . $lower_hero_img[ 'alt' ] . '">';
						if ( !empty( $lower_hero_url ) ) echo '</a>';
						
						?>
					</p>

				</div>
					
			</section>

			<section class="section-separator clr">

				<h2 class="section-headline headline-icon-envelope">
					<span class="container">Stay Informed</span>
				</h2>

				<div class="container clr">

					<p>Don't miss out on your dream home! Sign up for our newsletter for all our latest offerings.</p>

					<form action="http://lh.edgemm.com/t/y/s/btyihi/" method="post" id="subForm">
							<div class="form-columns form-one-third alpha">
								<input id="fieldName" name="cm-name" type="text" placeholder="Name" />
							</div>
							<div class="form-columns form-one-third">
								<input id="fieldEmail" name="cm-btyihi-btyihi" type="email" placeholder="Email*" required />
							</div>
							<button class="btn form-columns form-one-third omega" type="submit">Subscribe me</button>
					</form>

				</div>
					
			</section>

		</article>

	<?php endwhile; ?>

	<?php endif; ?>

	</main>

<?php get_footer(); ?>