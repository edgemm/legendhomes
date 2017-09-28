					<div class="gallery-spotlight">
					<?php

						global $post;
					
						echo do_shortcode( '[video url="https://www.youtube.com/watch?v=o4jm54DiwsE"]' );

						echo '</div>'; // closing .gallery-spotlight

				?>

				</div>

				<div class="header-headline">

					<?php $tag = ( $community->communities_city ) ? "p" : "h1"; ?>
					<<?php echo $tag; ?> class="post-headline"><?php the_title(); ?></<<?php echo $tag; ?>>
	
					<?php if ( !empty( $community->communities_city ) ) : ?>
					<h1 class="post-subheadline<?php echo ( get_field( 'post_subheadline_highlight' ) ) ? ' focus' : ''; ?>">					
						New homes in <span class="highlight"><?php echo $community->communities_city; ?></span>
					</h1>
					<?php endif; ?>
				
				</div>

				<div class="header-meta">

				<?php

				the_content();

				$twitter_url = get_the_permalink() . ' Legend Homes ' . get_the_title() . ' community, located in ' . $community->communities_city . ', features brand new, green-built homes.';
				
				?>

				<p class="share-intro">Share this community</p>

				<ul class="social">
					<li class="social-item">
						<a class="share-link share-facebook img-replace" href="https://www.facebook.com/LegendHomes" title="Share on Facebook">Facebook</a>
					</li>
					<li class="social-item">
						<a class="share-link share-twitter img-replace" href="http://twitter.com/home/?status=<?php echo urlencode( $twitter_url ); ?>" title="Share on Twitter" target="_blank">Twitter</a>
					</li>
					<li class="social-item">
						<a class="share-link share-pinterest img-replace" href="https://www.pinterest.com/legendhomes/" title="Share on Pinterest">Pinterest</a>
					</li>
				</ul>

			</header>
			
			<section class="section-community-news section-alt clr">

				<h2 class="section-headline">
					<span class="container">Latest Sylvia News</span>
				</h2>

				<?php
				
				//if ( $temporary_shutoff == "this is just to shut off functionality for now" ) :
				
				$syl_news_args = array(
					'cat' => 68,
					'posts_per_page' => 3
				);
				
				$syl_news_query = new WP_Query( $syl_news_args );
				
				if ( $syl_news_query->have_posts() ) :
				
				?>
				
				<div class="community-news container clr">
					
				<?php
				
					if ( $syl_news_query->post_count > 2 ) :
					
						$cols = "one-third";
						$total = 3;
						
					else:
					
						$cols = "eight";
						$total = 2;
	
					endif;
						
					for ( $i = 1; $i <= $total; $i++ ) :
						$syl_news_query->the_post();
	
						$news_class = ( $i > 1 ) ? ( ( $i == $total ) ? " omega" : "" ) : " alpha";
						$news_class = $cols . $news_class;
						
					?>
					<article class="community-news-item columns <?php echo $news_class; ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php
						$news_thmb_args = array(
							'class' => 'related-thmb'
						);
						?>
						<a class="community-news-thmb-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'medium', $news_thmb_args ); ?>
						</a>
					<?php

					elseif( get_video_shortcode() ) :

						echo get_video_shortcode();

					endif;

					?>
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h1>					
					</article>
					<?php
					endfor;

					wp_reset_postdata();
				?>
				
					<p class="community-news-btn-all clr">
						<a class="btn btn-large btn-center" href="/sylvia-news/">View all Sylvia news</a>
					</p>

				</div>
				
				<?php endif; ?>
				<?php //endif; // this is for the shutoff ?>
				
				<div class="container clr">
					
					<p>Don't want to miss anything about our latest development? Sign up to receive the latest news on the Sylvia neighborhood as development continues.</p>
					
					<form action="http://lh.edgemm.com/t/y/s/zitduy/" class="form-below clr" method="post">
						<input class="form-columns form-one-third" id="fieldName" name="cm-name" placeholder="Name" type="text">
						<input class="form-columns form-one-third" id="fieldEmail" name="cm-zitduy-zitduy" placeholder="Email" required="" type="email">
						<label class="form-columns form-one-third form-below-one-third" for="listbtyihi">
							<input id="listbtyihi" name="cm-ol-btyihi" type="checkbox">Receive latest Legend Homes news
						</label>
						<button class="btn form-columns form-one-third" type="submit">Get Sylvia Neighborhood Updates</button>
					</form>
					
				</div>

			</section>

			<?php

			if ( have_rows( 'section' ) ) :

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
					<span class="container"><?php echo $section_title; ?></span>
				</h2>

				<?php if ( $section_type != 'location' ) : ?>

				<div class="container clr">

					<?php echo $section_content; ?>

				</div>
				
					<?php if ( $section_type == 'location_headline' ) : ?>

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

	</main>

<?php get_footer(); ?>