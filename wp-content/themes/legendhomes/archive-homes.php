<?php get_header(); ?>

<?php

$community = get_page_by_path( $_GET[ 'community' ], OBJECT, 'communities' );

$community_id = ( $community ) ? $community->ID : '';

$headline = ( get_field( 'community_seo_headline_homes', $community_id ) );
$subheadline = ( get_field( 'community_seo_subheadline_homes', $community_id ) );
$description = ( get_field( 'community_seo_description_homes', $community_id ) );

$headline = ( !empty( $headline ) ) ? $headline : get_field( 'homes_archive_headline', 'option' );
$subheadline = ( !empty( $subheadline ) ) ? $subheadline : get_field( 'homes_archive_subheadline', 'option' );
$description = ( !empty( $description ) ) ? $description : get_field( 'homes_archive_description', 'option' );

?>

	<main class="main clr" role="main">

		<section <?php post_class( array( 'content archive archive-homes' ) ); ?>>
		
			<header class="container clr">

				<div class="header-headline container">

					<h1 class="post-headline"><?php echo $headline; ?></h1>
					
					<p class="post-subheadline highlight"><?php echo $subheadline; ?></p>
				
				</div>

			</header>

			<div class="container clr">

				<div class="archive-description"><?php echo $description; ?></div>

				<?php

				$sold_args = array(
					'post_type'		=> 'homes',
					'post_status'		=> 'publish',
					'posts_per_page'	=> 10,
					'meta_query'	=> array(
						'relation'	=> 'AND',
						array(
							'key' => 'homes_status',
							'value'	=> 'sold',
							'compare'	=> 'LIKE'
						),
						array(
							'key'		=> 'homes_community',
							'value'		=> $community_id,
							'compare'	=> 'LIKE'
						)
					),
					'orderby'	=> 'modified'
				);

				$sold_query = new WP_Query( $sold_args );

				$i = 1;

				$wp_query->posts = array_merge( $wp_query->posts, $sold_query->posts );				
				$wp_query->post_count = $wp_query->post_count + $sold_query->post_count;

				if ( have_posts() ) : while ( have_posts() ) : the_post();

				$classes = 'columns eight ';
				$classes .= ( $i % 2 == 0 ) ? 'omega' : 'alpha';

				$home_meta = get_field_objects();

				$home = new stdClass();
				
				foreach( $home_meta as $key => $value ) :
				
					$home->$key = $value[ 'value' ];
				
				endforeach;

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
				
				$home->price = prettyPrice( intval( $home->homes_price ) );
				$home->status = get_home_status( $home->homes_status, get_the_ID(), $community );
				
				// $home->status_class = ( strpos( $home->status, 'Complete' ) !== false ) ? 'coming-soon' : $home->status;
				// $home->status = ( strpos( $home->status, 'move-in-ready' ) ) ? 'Move-In Ready' : str_replace( '-', ' ', $home->status );

				// if ( ( $community->communities_special && $community->communities_special_sales ) && $home->status != 'sold' ) :

				// 	$home->status = $community->special_home_banner;
				// 	$home->status_class = "special";

				// endif;

				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post ' . $classes ); ?>>

					<a class="hentry-thmb-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php

					if( $home->homes_gallery ) :

						echo '<img src="' . $home->homes_gallery[0][ 'sizes' ][ 'medium' ] . '" alt="' . get_the_title() . '">';

					elseif ( has_post_thumbnail() ) :

						the_post_thumbnail( 'medium' );

					endif;

					?>
					</a>
				
					<h1 class="post-subheadline">
						<?php
	
						if ( !empty( $home->homes_lot ) ) echo 'Lot ' . $home->homes_lot;
	
						if ( $plan ) echo " " . $plan->title . " " . $home->homes_elevation;
	
						?>
					</h1>
	
					<p class="post-subheadline highlight"><?php echo $home->price; ?></p>
		
					<p class="home-status status-<?php echo $home->status[ 'class' ]; ?>">
						<?php echo $home->status[ 'banner' ]; ?>
					</p>

					<p class="plan-specs clr">
						<span class="plan-sqft"><?php echo $home->homes_sqft; ?> SF</span>, 
						<span class="plan-beds"><?php echo $home->homes_beds; ?> bedrooms</span>, 
						<span class="plan-baths"><?php echo $home->homes_baths; ?> baths</span>
					</p>

					<?php if ( $home->status[ 'class' ] == 'coming-soon' && $home->homes_availability ) : ?>
					<p class="home-availability">Construction complete <?php echo $home->homes_availability; ?></p>
					<?php endif; ?>

					<a class="highlight" href="<?php the_permalink(); ?>">View Home</a>
				
				</article>

				<?php

				$i++;

				endwhile;

				endif;

				?>

				<div class="pagination">
					<?php edgemm_pagination(); ?>
				</div>

			</div>

		</section>

	</main>

<?php get_footer(); ?>