<?php
/**
* Plugin Name:		B3M White Label
* Description:		White label WordPress install before delivering to client.
* Author:			Rick R. Duncan - B3Marketing, LLC
* Author URI:		http://rickrduncan.com
*
* License:			GPLv3
* License URI:		https://www.gnu.org/licenses/gpl-3.0.html
*
* Version:			1.0.0
*/


/**
* Add Colophon meta tag into head of document
*
* @since 1.0.0
*/
function b3m_insert_head_meta_data() { 	
	echo '<meta name="web_author" content="Rick R. Duncan — rickrduncan.com" />';	
}
add_action( 'wp_head', 'b3m_insert_head_meta_data' );


/**
* Customize the footer text in admin screens
*
* @since 1.0.0
*/
function b3m_modify_footer_admin () {  
    echo '<span id="footer-thankyou">WordPress solutions by <a href="http://rickrduncan.com" target="_blank">Rick R. Duncan</a></span>';
}
add_filter( 'admin_footer_text', 'b3m_modify_footer_admin' );


/**
* Login Screen: Use your own URL for login logo link
*
* @since 1.0.0
*/
function b3m_url_login(){
	return get_bloginfo( 'wpurl' ); 
}
add_filter( 'login_headerurl', 'b3m_url_login' );


/**
* Login Screen: Change login logo hover text
*
* @since 1.0.0
*/
function b3m_login_logo_url_title() {
    return 'Rick R. Duncan - WordPress Solutions Provider';
}
add_filter( 'login_headertitle', 'b3m_login_logo_url_title' );


/**
* Login Screen: Don't inform user which piece of credential was incorrect
*
* @since 1.0.0
*/
function b3m_failed_login () {
    return 'The login information you have entered is incorrect. Please try again.';
}
add_filter ( 'login_errors', 'b3m_failed_login' );


/**
* Login Screen: Set 'remember me' to be checked Part 1
*
* @since 1.0.0
*/
function b3m_rememberme_checked() {	
	echo "<script>document.getElementById('rememberme').checked = true;</script>";	
}


/**
* Login Screen: Set 'remember me' to be checked Part 2
*
* @since 1.0.0
*/
function b3m_login_checked_remember_me() {	
	add_filter( 'login_footer', 'b3m_rememberme_checked' );
}
add_action( 'init', 'b3m_login_checked_remember_me' );


/**
* Login Screen: Change login logo
*
* @since 1.0.0
*/
function b3m_custom_login_logo() {
	echo '<style type="text/css">
	h1 a { background-image:url('.plugin_dir_url( __FILE__ ).'images/login-logo.png) !important; background-size: 152px 95px !important;height: 95px !important; width: 152px !important; margin-bottom: 20px !important; padding-bottom: 0 !important; }
    .login form { margin-top: 10px !important; } 
    </style>';
}
add_action( 'login_head', 'b3m_custom_login_logo' );

/**
* Add branded info box into WordPress Dashboard
*
* @since 1.0.0
*/
function b3m_theme_info() {	
	echo "<ul>
	<li><strong>Theme:</strong> WPSyntax — A Starter Theme for the Genesis Framework</li>
	<li><strong>Website:</strong> <a href='http://rickrduncan.com/wpsyntax'>View details</a></li>
	<li><strong>Contact:</strong> <a href='mailto:rick@rickrduncan.com'>rick@rickrduncan.com</a></li>
	</ul>";	
}

function b3m_add_dashboard_widgets() {	
	wp_add_dashboard_widget('wp_dashboard_widget', 'Theme Details', 'b3m_theme_info');	
}
add_action('wp_dashboard_setup', 'b3m_add_dashboard_widgets' );


/**
* Change WordPress welcome message from 'Howdy'
*
* @since 1.0.0
*/
function b3m_change_howdy( $translated, $text, $domain ) {

    if ( !is_admin() || 'default' != $domain )
        return $translated;

    if ( false !== strpos( $translated, 'Howdy' ) )
        return str_replace( 'Howdy', 'Welcome', $translated );

    return $translated;
}
add_filter( 'gettext', 'b3m_change_howdy', 10, 3 );