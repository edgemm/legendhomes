<?php global $wptouch_pro; ?>
<?php if ( wptouch_show_switch_link() ) { ?>
	<div id="wptouch-desktop-switch">	
		<?php if ( $wptouch_pro->active_device_class == 'ipad' ) { ?>
		<?php _e( "Desktop Version", "wptouch-pro" ); ?> | <a href="http://legendhomes.com/"</a>
		<?php } else { ?>
		<?php _e( "Desktop Version", "wptouch-pro" ); ?> | <a href="http://legendhomes.com/"</a>
		<?php } ?>
	</div>
<?php } ?>
