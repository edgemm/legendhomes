<?php
// Determines Community based on URL
$community = get_community();
$community_url = get_bloginfo('url')."/find-your-home/".$community."/";

// Determine Community based on category
$cat_community = "";
if( in_category( 247 ) ) :
	$comm_email_local = "john";
	$comm_email_domain = "decosta-properties.com";
elseif( in_category( 28 ) ) :
	$comm_email_local = "villebois";
	$comm_email_domain = "legendhomes.com";
elseif( in_category( 49 ) ) :
	$comm_email_local = "willamettelanding";
	$comm_email_domain = "legendhomes.com";
else :
	$comm_email_local = "lead";
	$comm_email_domain = "legendhomes.com";
endif;

?>

<div id="primary" class="sidebar">
	<ul>
		<li class="sidebar-contact-agent">
			<a href="/about-us/contact-us/" class="strx-zurb-css3-awesome orange large btn-sidebar trig-modal modal-contact-agent" data-modal="contact-agent" data-eLoc="<?php echo $comm_email_local; ?>" data-eDom="<?php echo $comm_email_domain; ?>" style="margin: 10px 0 15px;" title="Contact Agent" onclick="_gaq.push(['_trackEvent', 'Contact Agent', 'MIR contact-agent click']);">Contact an Agent or Schedule a Tour</a>
			<script type="text/javascript">				
				// hide modal first page, show back page then close
				function modalRevealOmega() {
					var alpha = jQuery( ".modal-container.target" ).find( ".modal-alpha" );
					alpha.addClass( "complete" );
					var closeModal = window.setTimeout( function(){
						modalClose( alpha );
					}, 10000 );
				}
				
				// set contact info for newsletter sign-up
				function contactSent(){
				    jQuery.removeCookie( "contactForm-name" );
				    jQuery.removeCookie( "contactForm-email" );
				    jQuery.cookie( 'contactForm-name', jQuery( '#contact-name' ).val(), { expires: 1, path: '/' } );
				    jQuery.cookie( 'contactForm-email', jQuery( '#contact-email' ).val(), { expires: 1, path: '/' } );
				    window.location = "/thank-you/";
				}
			</script>
		</li>
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