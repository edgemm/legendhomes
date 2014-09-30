<?php

// Add your device specific code here


function classic_mobile_excerpts_open() {
	$settings = wptouch_get_settings();
	if ( $settings->classic_show_excerpts == 'excerpts-shown' || $settings->classic_show_excerpts == 'first-full-shown' ) {
		return true;
	} else {
		return false;
	}
}

function classic_mobile_show_all_full_post() {
	$settings = wptouch_get_settings();
	if ( $settings->classic_show_excerpts == 'full-hidden' || $settings->classic_show_excerpts == 'full-shown' ) {
		return true;
	} else {
		return false;
	}
}

function classic_mobile_first_full_post() {
	$settings = wptouch_get_settings();
	if ( $settings->classic_show_excerpts == 'first-full-hidden' || $settings->classic_show_excerpts == 'first-full-shown' ) {
		return true;
	} else {
		return false;
	}
}

function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );