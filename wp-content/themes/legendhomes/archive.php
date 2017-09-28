<?php get_header(); ?>

	<main class="main clr" role="main">

		<section <?php post_class( array( 'content archive' ) ); ?>>
		
			<header class="container clr">

				<div class="header-headline container">

					<h1 class="post-headline"><?php single_term_title(); ?></h1>
				
				</div>

			</header>

			<div class="container clear">

				<?php

				$i = 1;

				if (have_posts()): while (have_posts()) : the_post();

				$classes = 'columns eight ';
				$classes .= ( $i % 2 == 0 ) ? 'omega' : 'alpha';

				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post ' . $classes ); ?>>

					<?php if ( has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</a>
					<?php endif; ?>
				
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
