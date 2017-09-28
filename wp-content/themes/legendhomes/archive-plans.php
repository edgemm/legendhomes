<?php get_header(); ?>

<?php

$community = get_page_by_path( $_GET[ 'community' ], OBJECT, 'communities' );

$community_id = ( $community ) ? $community->ID : '';

$headline = ( get_field( 'community_seo_headline_plans', $community_id ) );
$subheadline = ( get_field( 'community_seo_subheadline_plans', $community_id ) );
$description = ( get_field( 'community_seo_description_plans', $community_id ) );

$headline = ( !empty( $headline ) ) ? $headline : get_field( 'plans_archive_headline', 'option' );
$subheadline = ( !empty( $subheadline ) ) ? $subheadline : get_field( 'plans_archive_subheadline', 'option' );
$description = ( !empty( $description ) ) ? $description : get_field( 'plans_archive_description', 'option' );

?>

	<main class="main clr" role="main">

		<section <?php post_class( array( 'content archive archive-plans' ) ); ?>>
		
			<header class="container clr">

				<div class="header-headline container">

					<h1 class="post-headline"><?php echo $headline; ?></h1>
					
					<p class="post-subheadline highlight"><?php echo $subheadline; ?></p>
				
				</div>

			</header>

			<div class="container clr">

				<div class="archive-description"><?php echo $description; ?></div>

				<?php

				$i = 1;

				if ( have_posts() ): while ( have_posts() ) : the_post();

				$classes = 'columns eight ';
				$classes .= ( $i % 2 == 0 ) ? 'omega' : 'alpha';
				
				$plan_meta = get_field_objects();
		
				$plan = new stdClass();
				
				foreach( $plan_meta as $key => $value ) :
				
					$plan->$key = $value[ 'value' ];
				
				endforeach;
				
				//$plan->price = prettyPrice( intval( $plan->plans_starting_price ) );

				/*if ( strlen( $plan->plans_starting_price ) > 3 ) : 

					$plan->price = prettyPrice( intval( $plan->plans_starting_price ) );

				elseif ( $post->ID == 1191 ) :

					$plan->price = 'the mid $' . $plan->plans_starting_price . '\'s';

				else :

					$plan->price = 'the low $' . $plan->plans_starting_price . '\'s';

				endif;*/

				$plan->price = ( is_numeric( $plan->plans_starting_price ) ) ? prettyPrice( intval( $plan->plans_starting_price ) ) : $plan->plans_starting_price;
			
				$community = get_field( 'plans_community', $post->ID );

				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post ' . $classes ); ?>>

					<a class="hentry-thmb-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php

					if( $plan->plans_gallery ) :

						echo '<img src="' . $plan->plans_gallery[0][ 'sizes' ][ 'medium' ] . '" alt="' . get_the_title() . '">';

					elseif ( has_post_thumbnail()) :

						the_post_thumbnail( 'medium' );

					endif;

					?>
					</a>
				
					<h1 class="post-subheadline"><?php the_title(); ?></h1>
	
					<p class="post-subheadline highlight">Starting at <?php echo $plan->price; ?></p>
					
					<p class="plan-specs clr">
						<span class="plan-sqft"><?php echo $plan->plans_sqft; ?> SF</span>, 
						<span class="plan-beds"><?php echo $plan->plans_beds; ?> bedrooms</span>, 
						<span class="plan-baths"><?php echo $plan->plans_baths; ?> baths</span>
					</p>
	
					<p class="post-subheadline"><?php echo $community->post_title; ?></p>
					
					<a class="highlight" href="<?php the_permalink(); ?>">View Plan</a>
				
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