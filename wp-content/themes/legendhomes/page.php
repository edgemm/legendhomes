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

					<p class="post-subheadline highlight<?php echo ( get_field( 'post_subheadline_highlight' ) ) ? ' focus' : ''; ?>"><?php the_field( 'post_subheadline' ); ?></p>
				
				</div>

			</header>

			<section class="content container clr">

				<?php the_content(); ?>

			</section>

			<?php

			if( have_rows( 'section' ) ) :

				while( have_rows( 'section' ) ) : the_row();

					$section_title = get_sub_field( 'title' );
					$section_type = get_sub_field( 'type' );
					$section_content = get_sub_field( 'content' );
					
					$section_slug = str_replace( ' ', '-', strtolower( $section_title ) );
					$section_class = '';
					$headline_class = '';

					$gmaps_addr = str_replace( ' ', '+', $addr_street . '+' . $addr_city . '+OR+' . $addr_zip );

					switch( $section_type ) :
					
						case 'no_headline':
							$section_class = '';
							break;
						case 'collapse':
							$section_class = 'section-collapse';
							$headline_class = 'headline-collapse';
							break;
						case 'collapse_alt':
							$section_class = 'section-collapse section-alt';
							$headline_class = 'headline-collapse';
							break;
						case 'location':
							$section_class = 'gmap';
							break;
						case 'location_headline':
							$section_class = 'section-alt';
							$headline_class = 'headline-icon-auto';
							break;
						case 'collection':
							$section_class = 'section-alt';
							$headline_class = 'headline-icon-house';
							break;
						case 'form':
							$headline_class = 'headline-icon-envelope';
							break;
						case 'alternate':
							$section_class = 'section-alt';
							break;
						case 'default':
							$section_class = '';
							break;
						default:
							$section_class = '';
							$headline_class = '';

					endswitch;

			?>
			<section class="section-<?php echo $section_slug . ' ' . $section_class; ?> clr">

				<h2 class="section-headline <?php echo $headline_class; ?>">
					<span class="container">
					<?php

					if ( $section_anchor ) echo '<a class="headline-anchor" name="' . $section_anchor . '">';
					echo $section_title;
					if ( $section_anchor ) echo '</a>';

					?>
					</span>
				</h2>

				<?php if( $section_type != 'location' ) : ?>

				<div class="container clr">

					<?php echo $section_content; ?>

				</div>
				
					<?php if( $section_type == 'location_headline' ) : ?>

				<div class="gmap container">

					<iframe class="gmap-embed" width="600" height="348" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAFHmVFJvu5em9z2LKlXNXwf-sIEckQ0MY&q=<?php echo $gmaps_addr; ?>" allowfullscreen>
</iframe>

				</div>
				
					<?php endif; ?>
				
				<?php else : ?>

				<iframe class="gmap-embed" width="600" height="348" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAFHmVFJvu5em9z2LKlXNXwf-sIEckQ0MY&q=<?php echo $gmaps_addr; ?>" allowfullscreen>
</iframe>

				<?php endif; ?>

			</section>
			<?php

				endwhile;

			endif;

			?>

		</article>

	<?php endwhile; ?>

	<?php endif; ?>

	</main>

<?php get_footer(); ?>