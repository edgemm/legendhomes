<div id="primary" class="sidebar">
	<ul>
		<li id="categories">
			<h3>Financial Resources</h3>
			<ul><?php wp_nav_menu( array('menu' => 'Sub-Home Finance' )); ?></ul>
		</li>
		<li class="singlenew">
			<?php $my_query = new WP_Query( 'cat=4,85,82,83&showposts=3');
				if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); 
			?>
			<h4 class="sidenew"><?php the_title(); ?></h4>
			<div class="singlenewp"><?php sidebar_excerpt(); ?></div>
			<p class="singlenewa"><a href="<?php the_permalink() ?>">Read More &raquo;</a></p>
			<?php endwhile; endif; wp_reset_query(); ?>
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

