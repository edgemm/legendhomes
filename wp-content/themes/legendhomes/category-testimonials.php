<?php get_header(); ?>

	<main class="main clr" role="main">

		<section <?php post_class( array( 'content category category-testimonials' ) ); ?>>
		
			<header class="container clr">

				<div class="header-headline container">

					<h1 class="post-headline"><?php single_term_title(); ?></h1>
				
				</div>

			</header>

			<div class="testimonials container clr">
				
				<p class="archive-description"><?php echo category_description(); ?></p>

				<?php

				$i = 1;

				if (have_posts()): while (have_posts()) : the_post();

				$classes = 'columns eight ';
				$classes .= ( $i % 2 == 0 ) ? 'omega' : 'alpha';

				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'category-post ' . $classes ); ?>>

					<?php echo get_video_shortcode(); ?>
				
					<h1 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>
					
					<?php edgemm_excerpt( 'edgemm_custom_post' ); ?>

					<a class="highlight" href="<?php the_permalink( ); ?>"><?php echo __( 'View Post', 'html5blank' ); ?></a>

				</article>

				<?php

				$i++;

				endwhile;
				
				endif;
				
				?>

				<!--<p class="clr">
					<a class="btn btn-large btn-center" href="https://www.youtube.com/playlist?list=PLnsJZwrh2aZavYh7PueRf60lJv-PeX4Nc" target="_blank">View all Testimonials (YouTube)</a>
				</p>-->
			
			</div>

		</section>

	</main>

<?php get_footer(); ?>
