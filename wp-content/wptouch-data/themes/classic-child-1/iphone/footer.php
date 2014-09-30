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
							<?php _e( "Mobile Theme", "wptouch-pro" ); ?>
						</span>
						<div title="<?php wptouch_the_mobile_switch_link(); ?>">
							<span class="on active" role="button"></span>
							<span class="off" role="button"></span>
						</div>
					</div>
				<?php } ?>
						
				<div class="<?php wptouch_footer_classes(); ?>">
					<?php wptouch_footer(); ?>
				</div>
	
				<?php do_action( 'wptouch_advertising_bottom' ); ?>
			</div> <!-- #inner-ajax -->
		</div> <!-- #outer-ajax -->
		<?php // include_once('web-app-bubble.php'); ?>
		<!-- <?php echo 'Built with WPtouch Pro ' . WPTOUCH_VERSION; ?> -->
	</body>
</html>