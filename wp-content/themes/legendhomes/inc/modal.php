<div class="modal-container" data-modalID="contact-agent">
		<div class="modal-content modal-contact-agent">
			<a href="#close" title="Close" class="modal-close">X</a>
			<div class="modal-alpha">
				<?php echo do_shortcode( '[contact-form-7 id="5971" title="Contact Agent"]' ); ?>
			</div>
			<div class="modal-omega">
				<?php
				if( get_field( 'lh-home-contact-agent-thanks' ) ) :
					echo get_field( 'lh-home-contact-agent-thanks' );
				else :
					echo 'Thank you for contacting us! An agent will be in touch with you as soon as possible.';
				endif;
				?>
			</div>
		</div>
	</div>