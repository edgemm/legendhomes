<?php get_header(); ?>

	<main class="main clr" role="main">

		<section <?php post_class( array( 'content category' ) ); ?>>
		
			<header class="container clr">

				<div class="header-headline container">

					<h1 class="post-headline"><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo '"' . get_search_query() . '"'; ?></h1>
				
				</div>

			</header>

			<div class="container clear">

				<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-post columns sixteen' ); ?>>
				
					<h1 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>
					
					<?php edgemm_excerpt( 'edgemm_custom_post' ); ?>
				
				</article>
				
				<?php
				
				endwhile;
				
				endif;
				
				?>
				
				<div class="pagination">
					<?php edgemm_pagination(); ?>
				</div>
			
			</div>

		</section>

	</main>
		
		<section id="content">

			<div class="container clear">

			<article <?php post_class( array( 'sixteen', 'columns' ) ); ?>>

				<header>
					<h1 class="entry-title"></h1>
				</header>

				<?php get_template_part('loop'); ?>
	
				<?php get_template_part('pagination'); ?>

			</article>

			</div>
			<!-- /.container -->

		</section>
		<!-- /#conent -->

	</main>

<?php get_footer(); ?>
