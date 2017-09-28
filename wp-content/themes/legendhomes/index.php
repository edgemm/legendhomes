<?php get_header(); ?>

	<main class="main clr" role="main">
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>	

		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'content post-homes' ) ); ?>>
		
			<header class="container clr">
				
				<div class="post-gallery">
	
				<?

				if( has_post_thumbnail() ) :
				
				$thmb_attr = array(
					'class' => 'attachment-$size gallery-spotlight-img'
				);
				
				?>
					<div class="gallery-spotlight">
						<?php the_post_thumbnail( 'large', $thmb_attr ); ?>
					</div>
				<? endif; ?>

				</div>

				<div class="header-headline">

					<h1 class="post-headline"><?php the_title(); ?></h1>

					<p class="post-subheadline highlight"><?php the_field( 'post_subheadline' ); ?></p>
				
				</div>

			</header>

			<section class="content container clr">

				<?php the_content();?>

			</section>

		</article>

	<?php endwhile; ?>

	<?php endif; ?>

	</main>

<?php get_footer(); ?>