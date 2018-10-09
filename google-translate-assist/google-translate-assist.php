<?php

/**
* @package GoogleTranslateAssist
*/

/*
Plugin Name: Google Translate Assist
Description: A simple plugin to assist with Google Website Translator Plugin by Prisna. It allows for url and GET detection to change cookies and language for the user.
Version: 1.0.0
Author: Mid-West Digital Marketing
License: GPLv2 or later
*/

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

function GoogleTranslateAssist_set_cookie_on_page() {

	//If URL has GET Request proceed, if not, die
	if( !isset( $_GET['language'] ) ) {
		return;
	}

	//Variable for Get Request
	$language = '/en' . '/' . $_GET['language'];
	$expires = 6*30*24*3600;
	$domain = site_url();

	//Removes http and https for use in set cookie parameter
	$to_remove = array( 'http://', 'https://' );
	foreach ( $to_remove as $item ) {
	    $domain = str_replace($item, '', $domain);
	}

	//If an existing cookie exists, remove it
	if( isset( $_COOKIE['googtrans'] ) ){
		//Remove cookie, must use null for language parmeter and negative time
		setrawcookie( 'googtrans', null, time()-$expires, '/', $domain);
    }

    //Set new cookie
	setrawcookie( 'googtrans', $language, time()+$expires, '/' );
}
add_action( 'init', 'GoogleTranslateAssist_set_cookie_on_page' );




