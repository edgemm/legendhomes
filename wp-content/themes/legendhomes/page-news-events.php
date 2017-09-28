<?php // Template Name: News & Events ?>
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
				
				$categories_args = array(
					'category__in'		=> array( 28, 29, 30, 31, 32 )
				);
				
				$categories_query = new WP_Query( $categories_args );
				
				$i = 1;

				if ( $categories_query->have_posts() ): while ( $categories_query->have_posts() ) : $categories_query->the_post();

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
				
				wp_reset_postdata();
				
				?>
			
			</div>

		</section>

	</main>

<?php get_footer(); ?>