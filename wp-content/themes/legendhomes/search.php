<?php get_header() ?>

	<div id="container">
		<div id="content">

<?php if ( have_posts() ) : ?>

		<h2 class="page-title"><?php _e( 'Search Results for:', 'sandbox' ) ?> <span><?php the_search_query() ?></span></h2>

			<div id="nav-above" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older results', 'sandbox' ) ) ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer results <span class="meta-nav">&raquo;</span>', 'sandbox' ) ) ?></div>
			</div>

<?php while ( have_posts() ) : the_post() ?>

			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h3 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf( __( 'Permalink to %s', 'sandbox' ), the_title_attribute('echo=0') ) ?>" rel="bookmark"><?php the_title() ?></a></h3>
				<div class="entry-content">
<?php the_excerpt( __( 'Read More <span class="meta-nav">&raquo;</span>', 'sandbox' ) ) ?>

				</div>

<?php if ( $post->post_type == 'post' ) { ?>
				<div class="entry-meta">

<?php edit_post_link( __( 'Edit', 'sandbox' ), "\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
				</div>
<?php } ?>

			</div><!-- .post -->

<?php endwhile; ?>

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older results', 'sandbox' ) ) ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer results <span class="meta-nav">&raquo;</span>', 'sandbox' ) ) ?></div>
			</div>

<?php else : ?>

			<div id="post-0" class="post no-results not-found">
				<h2 class="entry-title"><?php _e( 'Nothing Found', 'sandbox' ) ?></h2>
				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'sandbox' ) ?></p>
				</div>
				<form id="searchform-no-results" class="blog-search" method="get" action="<?php bloginfo('home') ?>">
					<div>
						<input id="s-no-results" name="s" class="text" type="text" value="<?php the_search_query() ?>" size="40" />
						<input class="button" type="submit" value="<?php _e( 'Find', 'sandbox' ) ?>" />
					</div>
				</form>
			</div><!-- .post -->

<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_footer() ?>