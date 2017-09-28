<?php // Template Name: Find Your Home ?>
<?php get_header(); ?>

	<main class="main clr" role="main">

		<section <?php post_class( array( 'content' ) ); ?>>
		
			<header class="container clr">

				<div class="header-headline container">

					<h1 class="post-headline"><?php the_title(); ?></h1>

					<p class="post-subheadline highlight<?php echo ( get_field( 'post_subheadline_highlight' ) ) ? ' focus' : ''; ?>"><?php the_field( 'post_subheadline' ); ?></p>

				</div>

			</header>

			<div class="container clr">
				<?php

				if (have_posts()) : while (have_posts()) : the_post();

				the_content();
				
				endwhile;
				
				endif;
				
				$communities_args = array(
					'post_type'		=> 'communities',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1,
					'order'	=> 'ASC'
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
			
			</div>

		</section>

	</main>

<?php get_footer(); ?>