<?php get_header(); ?>

	<main class="main clr" role="main">

		<section <?php post_class( array( 'content category' ) ); ?>>
		
			<header class="container clr">

				<div class="header-headline container">
					
					<?php
					
					$cat_id = $wp_query->get_queried_object_id();
					$cat_title = ( get_term_meta( $cat_id, 'cat_display_title', true ) ) ? get_term_meta( $cat_id, 'cat_display_title', true ) : single_term_title( '', false );
					
					?>

					<h1 class="post-headline"><?php echo $cat_title; ?></h1>
				
				</div>

			</header>

			<div class="container clear">
				
				<p class="archive-description"><?php echo category_description(); ?></p>

				<?php

				$i = 1;

				if (have_posts()): while (have_posts()) : the_post();

				$classes = 'columns eight ';
				$classes .= ( $i % 2 == 0 ) ? 'omega' : 'alpha';

				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'category-post ' . $classes ); ?>>

					<?php if ( has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( 'medium' ); ?>
						</a>
					<?php

					elseif( get_video_shortcode() ) :

						echo get_video_shortcode();

					endif;

					?>
				
					<h1 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>
					
					<?php edgemm_excerpt( 'edgemm_custom_post' ); ?>
				
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
