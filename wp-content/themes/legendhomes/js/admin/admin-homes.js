(function($, root, undefined) {
	$(function() {
		// pull plan data
		$('#edgemm_pull_plan_data').click(function(e) {

			e.preventDefault();

			// notification that progress has started
			$(this).after('<p class="pull-status">Pulling data...</p>');

			//var plan_id = $( '#acf-field-homes_floorplan' ).val();
			var plan_id = $('#acf-field_56a7f1afb0d7d').val();

			// get base url
			if (!location.origin) location.origin = location.protocol + "//" + location.host;

			$.ajax({
				type: "post",
				dataType: "json",
				url: location.origin + '/wp-admin/admin-ajax.php',
				data: {
					action: 'pull_plan_data',
					plan_id: plan_id
				},
				success: function(response) {
					if (response) {
						// ensure text editor is visible before adding post content
						$('#wp-content-wrap.tmce-active').find('.wp-editor-tabs > #content-html').trigger('click');
						// add content (if empty)
						if ($('#content.wp-editor-area').val() == '') $('#content.wp-editor-area').val(response.plan_content);
						if ($('#acf-field_56cc9d1931841-input').val() == '') $('#acf-field_56cc9d1931841-input').val(response.plans_community[0]);
						if ($('#acf-field_56cde99703fbd').val() == '') $('#acf-field_56cde99703fbd').val(response.plans_collection[0]);
						if ($('#acf-field_56a7f261b0d84').val() == '') $('#acf-field_56a7f261b0d84').val(response.plans_beds[0]);
						if ($('#acf-field_56a7f26eb0d85').val() == '') $('#acf-field_56a7f26eb0d85').val(response.plans_baths[0]);
						if ($('#acf-field_56a7f282b0d86').val() == '') $('#acf-field_56a7f282b0d86').val(response.plans_sqft[0]);
						if ($('#acf-field_56a7f298b0d87').val() == '') $('#acf-field_56a7f298b0d87').val(response.plans_features[0]);
						if ($('input[name="acf[field_58dbfcdee3630]"]').val() == '' && response.plans_additional_elevation[0] !== '') {
							console.log(response.plans_additional_elevation);
							var $elev = $('.acf-field.acf-field-58dbfcdee3630'),
								$elev_img = $elev.find( '.show-if-value img[data-name="image"]' );

							$elev.find( '.acf-image-uploader' ).addClass( 'has-value' );

							$('input[name="acf[field_58dbfcdee3630]"]').val(response.plans_additional_elevation[0]);
							$elev_img.attr( 'src', response.plans_additional_elevation[ 'url' ][0] );
							$elev_img.attr( 'alt', response.plans_additional_elevation[ 'alt' ] );
						}
						$('.pull-status').text('Home updated!');
					} else {
						$('.pull-status').text('There was an error');
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				}
			});
		});
	});
})(jQuery, this);