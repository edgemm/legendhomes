<?php // Determines Community based on URL

		$community = get_community();

		$community_url = get_bloginfo('url')."/find-your-home/".$community."/";		

?>



<div id="primary" class="sidebar">

	<ul>

		<?php if ($community == "move-in-ready" || $community == ""){ ?>

		<li id="categories">

			<h3>Communities</h3>

				<ul><?php wp_nav_menu( array('menu' => 'Sub-Find Your Home' )); ?></ul>

		</li>

		<?php } else { ?>

		

			<h3>Community Information</h3>

			<ul>

				<li class="cat-item cat-item-17"><a href="<?php echo $community_url; ?>features/" title="Features">Community Features</a></li>

                                <li class="cat-item cat-item-16"><a href="<?php echo $community_url; ?>home-features/" title="Home Features">Home Features</a></li>		

				<li class="cat-item cat-item-18"><a href="<?php echo $community_url; ?>amenities/" title="Area Amenities">Area Amenities</a></li>

				<li class="cat-item cat-item-21"><a href="<?php echo $community_url; ?>schools/" title="Schools">Schools</a></li>

				<li class="cat-item cat-item-19"><a href="<?php echo $community_url; ?>gallery/" title="Photo Gallery">Photo Gallery</a></li>

				<li class="cat-item cat-item-16"><a href="<?php echo $community_url; ?>directions/" title="Maps & Directions">Maps &amp; Directions</a></li>

			</ul>

			<h3 style="padding-top:10px;">View Homes</h3>

			<ul>

				<li class="cat-item cat-item-91"><a href="<?php echo $community_url; ?>plans/" title="Home Plans">All Home Plans</a></li>	

				<li class="cat-item cat-item-15"><a href="<?php echo $community_url; ?>homes/" title="Move-In Ready Homes">Move-In Ready Homes</a></li>

			</ul>

		

		<?php } ?>
        
        <div id="wpcf7-smc">
        
        <h2>Contact Agent</h2>

		       <?php echo do_shortcode( '[contact-form-7 id="5971" title="Contact Agent"]' ); ?>
</div>

			<li class="singlenew">

				<h4 class="sidenew">Energy Bill Guarantee</h4>

					<div class="singlenewp"><p>Legend Homes has created a better investment for you now...</div>

					<p class="singlenewa"><a href="<?php bloginfo('url'); ?>/earthsmart/energy-bill-guarantee/">Read More &raquo;</a></p>

<h4 class="sidenew">Benefits of EarthSmart Homes</h4>

					<div class="singlenewp"><p>For the full list of EarthSmart benefits, please click here...</div>

					<p class="singlenewa"><a href="<?php bloginfo('url'); ?>/earthsmart/benefits/">Read More &raquo;</a></p>

			</li>



		</ul>

	</div><!-- #primary .sidebar -->