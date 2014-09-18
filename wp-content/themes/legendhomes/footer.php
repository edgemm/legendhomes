	<div id="footer">
		<div id="footertop">
			<div class="searchinput">
				<form id="searchform" class="blog-search" method="get" action="<?php bloginfo('home') ?>">
					<div class="searchcontainer">
					<table><tr>
					<td><input id="s" name="s" type="text" class="text" value="<?php the_search_query() ?>" size="10" tabindex="1" /></td>
					<td><input type="submit" class="button" value="<?php _e( 'Search', 'sandbox' ) ?>" tabindex="2" /></td>
					</tr></table>
					</div>
				</form>
			</div>
		<br clear="both" />

		</div>
		<div id="footerbottom">
			<div id="footernav">
				<ul class="foot">
					<li class="cat-item cat-item-3"><a href="http://legendhomes.com/find-your-home/" title="View all posts filed under Find Your Home">Find Your Home</a>
						<?php wp_nav_menu(array('menu' => 'Sub-Find Your Home', 'menu_class' => 'children')); ?> 
					</li>
					
					<li class="cat-item cat-item-4"><a href="http://legendhomes.com/earthsmart/" title="View all posts filed under EarthSmart">EarthSmart</a>
						<?php wp_nav_menu(array('menu' => 'Sub-Earth Smart', 'menu_class' => 'children')); ?> 
					</li>

					<li class="cat-item cat-item-5"><a href="http://legendhomes.com/design-center/" title="View all posts filed under Design Center">Design Center</a>
						<?php wp_nav_menu(array('menu' => 'Sub-Design Center', 'menu_class' => 'children')); ?> 
					</li>					

					<li class="cat-item cat-item-6"><a href="http://legendhomes.com/home-finance/" title="View all posts filed under Home Finance">Home Finance</a>
						<?php wp_nav_menu(array('menu' => 'Sub-Home Finance', 'menu_class' => 'children')); ?> 
					</li>						

					<li class="cat-item cat-item-7"><a href="http://legendhomes.com/news-events/" title="View all posts filed under News & Events">News & Events</a>
						<?php wp_nav_menu(array('menu' => 'Sub-News Events', 'menu_class' => 'children')); ?> 
					</li>	

					<li class="cat-item cat-item-8"><a href="http://legendhomes.com/about-us/" title="View all posts filed under About Us">About Us</a>
						<?php wp_nav_menu(array('menu' => 'Sub-About Us', 'menu_class' => 'children')); ?> 
					</li>					

					<li class="cat-item cat-item-23"><a href="http://legendhomes.com/customer-care/" title="View all posts filed under Customer Care">Customer Care</a>
						<?php wp_nav_menu(array('menu' => 'Sub-Customer Care', 'menu_class' => 'children')); ?> 
					</li>	
					
				</ul>		
			</div>
			

		<br clear="both" />
		</div>
	</div><!-- #footer -->
			<div id="smallsocial">
				<a href="http://www.facebook.com/LegendHomes" target="_blank" title="Legend Homes Facebook">&nbsp;</a><a href="http://twitter.com/legendhomes" target="_blank" title="Legend Homes Twitter">&nbsp;</a><a href="http://www.youtube.com/user/LegendHomesPDX" target="_blank" title="Legend Homes Youtube">&nbsp;</a><a href="http://pinterest.com/legendhomes/" target="_blank" title="Legend Homes Pinterest Page">&nbsp;</a>
			</div>
	<div id="ccb">
<table>
<tbody>
<tr>
<td valign="top"><img class="alignnone size-full wp-image-159" title="equalhousing" src="<?php bloginfo('url'); ?>/uploads/equalhousing.png" alt="" width="21" height="21" /></td>
<td><p>CCB# 55151 See sales representative for details. Prices, amenities and availability are subject to change without notice. Room sizes, square footage and ceiling details vary from one elevation to another. Marketed by Legend Homes.  Copyright &copy; <?php echo date('Y'); ?> Legend Homes.</p>
<p>Hosted by Edge Multimedia <a href="http://www.edgemm.com" target="blank"> Portland Advertising Agency</a>.</p>
<p>&nbsp;</p></td>
</tr>
</tbody>
</table>
</div>

</div><!-- #wrapper .hfeed -->

<?php wp_footer() ?>


</body>
</html>