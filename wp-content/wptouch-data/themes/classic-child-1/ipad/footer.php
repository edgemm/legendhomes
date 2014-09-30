		<div class="post section page-title-area rounded-corners-8px">
			<h2 role="heading">STAY INFORMED!</h2>
			<p>Sign up for the newsletter using our private and secure system</p>
			<form action="http://edgemultimedia.createsend.com/t/y/s/btyihi/" method="post" id="subForm">
				<label class="signup-label" for="name">Name:</label>
				<input class="signup-field" type="text" name="cm-name" id="name" size="18">
				<label class="signup-label" for="btyihi-btyihi">Email:</label>
				<input class="signup-field" type="text" name="cm-btyihi-btyihi" id="btyihi-btyihi" size="18">
				<input class="signup-btn" type="submit" value=" Subscribe ">
			</form>
		</div>
	</div><!-- #content -->

	<?php do_action( 'wptouch_body_bottom' ); ?>

	<?php if ( wptouch_show_switch_link() ) { ?>
		<div id="switch" class="rounded-corners-8px">
			<span class="switch-text">
				<?php _e( "iPad Theme", "wptouch-pro" ); ?>
			</span>
			<div role="button" title="<?php wptouch_the_mobile_switch_link(); ?>">
				<span role="link" class="on active"></span>
				<span role="link" class="off"></span>
			</div>
		</div>
	<?php } ?>

	<div class="<?php wptouch_footer_classes(); ?>">
		<?php do_action( 'wptouch_advertising_bottom' ); ?>
		<?php wptouch_footer(); ?>
	</div>

	</div><!-- iscroll content -->
	</div><!-- iscroll wrapper -->

	<?php // include_once( 'web-app-bubble.php' ); ?>
	<?php include_once( 'comment-reply-fly-in.php' ); ?>
	<?php include_once( 'share-links.php' ); ?>
	<!-- <?php echo WPTOUCH_VERSION; ?> -->

	</body>
	</html>