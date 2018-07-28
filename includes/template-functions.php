<?php

function wpfunc_hide_profile_fields( $contactmethods ) {
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	return $contactmethods;
	}
add_filter('user_contactmethods','wpfunc_hide_profile_fields',10,1);
