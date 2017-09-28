		<footer class="footer" role="contentinfo">

			<section class="footer-bottom">
	
				<div class="container">
				
					<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	
						<button type="submit" class="search-submit img-replace"><?php echo _x( 'Search', 'submit button' ); ?></button>
	
						<input type="search" class="search-field form-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />
	
					</form>
	
					<ul class="social">
						<li class="social-item">
							<a class="social-link social-facebook img-replace" href="https://www.facebook.com/LegendHomes" target="_blank">Facebook</a>
						</li>
						<li class="social-item">
							<a class="social-link social-twitter img-replace" href="https://twitter.com/legendhomes" target="_blank">Twitter</a>
						</li>
						<li class="social-item">
							<a class="social-link social-youtube img-replace" href="https://www.youtube.com/user/LegendHomesPDX" target="_blank">YouTube</a>
						</li>
						<li class="social-item">
							<a class="social-link social-pinterest img-replace" href="https://www.pinterest.com/legendhomes/" target="_blank">Pinterest</a>
						</li>
					</ul>
	
					<p class="disclaimer clr">CCB# 55151 See sales representative for details. Prices, amenities and availability are subject to change without notice. Room sizes, square footage and ceiling details vary from one elevation to another. Marketed by Legend Homes.</p>

					<p class="lower-logos">
						<img src="/wp-content/themes/legendhomes/img/footer-equal-housing-opportunity.png" alt="Equal Housing Opportunity">
					</p>
					
					<p>
						<a href="/about-us/privacy-policy/">Privacy Policy</a>
					</p>
	
					<p class="copyright">&copy; <?php echo date( 'Y' ); ?> Legend Homes</p>
	
					<p class="edgemm-plug">Website designed by <a class="edgemm-plug-link" href="http://edgemm.com/" target="_blank">Edge Multimedia</a></p>

				</div>

			</section>

		</footer>
		<!-- /footer -->

		<?php wp_footer(); ?>

	</body>
</html>
