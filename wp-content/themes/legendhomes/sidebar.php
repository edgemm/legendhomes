<div id="primary" class="sidebar">
	<ul>
		<li id="categories">
			<h3>Information</h3>
			<ul>
			<?php // Determines Sub-Navigation for the General Sidebar
				if (in_array("earthsmart", explode("/", $_SERVER["REQUEST_URI"]))) {wp_nav_menu( array('menu' => 'Sub-Earth Smart' ));}
				else if (in_array("design-center", explode("/", $_SERVER["REQUEST_URI"]))) {wp_nav_menu( array('menu' => 'Sub-Design Center' ));}
				else if (in_array("news-events", explode("/", $_SERVER["REQUEST_URI"]))) {wp_nav_menu( array('menu' => 'Sub-News Events' ));}
				else if (in_array("about-us", explode("/", $_SERVER["REQUEST_URI"]))) {wp_nav_menu( array('menu' => 'Sub-About Us' ));}
				else { //Default Menu Display		

					if (get_depth() == 0) {
						$this_cat = get_category($cat);
						$id = $this_cat->cat_ID;
						echo '<ul>';
						wp_list_categories('exclude=1&orderby=ID&show_count=0&title_li=&use_desc_for_title=0&child_of='.$id.'&depth=1');
						echo '</ul>';
					} else if (get_depth() == 1) {
						$this_category = get_category($cat);
						get_category_siblings($this_category);					
					} else if (get_depth() == 2) {
						$this_category = get_category($cat);
						get_category_siblings($this_category);
					} else {
						wp_list_categories('exclude=1&title_li=&depth=2');
					}
				}
			?>
			</ul>
		</li>
		<li class="singlenew">
			<?php 
				$newsq = new WP_Query( 'cat=7,57,81&showposts=3');
				if ($newsq->have_posts()) : while ($newsq->have_posts()) : $newsq->the_post(); 
			?>
			<h4 class="sidenew"><?php the_title(); ?></h4>
			<div class="singlenewp"><?php sidebar_excerpt(); ?></div>
			<p class="singlenewa"><a href="<?php the_permalink() ?>">Read More &raquo;</a></p>
			<?php endwhile; endif; wp_reset_query(); ?>
		</li>
	</ul>
</div><!-- #primary .sidebar -->
