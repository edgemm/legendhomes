<?php

get_header();

$args = array(
	'order'		=> 'ASC'
);

global $wp_query;

query_posts( array_merge( $wp_query->query, $args ) );

?>

	<main class="main clr" role="main">

		<section <?php post_class( array( 'content archive archive-communities' ) ); ?>>
		
			<header class="container clr">

				<div class="header-headline container">

					<h1 class="post-headline">Move-In Ready &amp; New Construction Homes</h1>
					
					<p class="post-subheadline highlight">Take a tour of Legend's Move-In Ready and New Construction Homes currently for sale</p>
				
				</div>

			</header>

			<div class="container clr">

				<p class="archive-description">We offer a wide range of energy-certified, new construction home plans for sale in Northwest Oregon. You'll find a Move-In Ready or new construction home that's perfect for your family here.</p>

				<?php
				
				$i = 1;

				if (have_posts()): while (have_posts()) : the_post();

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
					
					<a class="highlight" href="<?php the_permalink(); ?>">View Community</a>
				
				</article>
				
				<?php
				
				$i++;
				
				endwhile;
				
				endif;
				
				?>
			
			</div>

		</section>

	</main>

<?php get_footer(); ?>