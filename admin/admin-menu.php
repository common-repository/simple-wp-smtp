<?php
/**
 * Provide a admin area view for the plugin
 *
 * Admin menu for the SMTP settings
 *
 * @link       https://indianic.com
 * @since      1.0.0
 *
 * @package    simple-wp-smtp
 * @subpackage simple-wp-smtp/admin
 */


/**
 * Admin menu hook
 * @since 1.0
 * */
add_action('admin_menu', 'simple_wp_smtp_setting_menu');
function simple_wp_smtp_setting_menu() { 
	add_menu_page( 
		'SMTP settings', 
		'SMTP settings', 
		'manage_options', 
		'smtp_settings', 
		'simple_wp_smtp_setting_menu_callback_function', 
		'dashicons-email' 

	);
	add_submenu_page( 
	    'smtp_settings',   //or 'options.php'
	    'Test mail',
	    'Test mail',
	    'manage_options',
	    'smtp_test_mail',
	    'simple_wp_smtp_test_mail'
	);
}


/**
 * Admin menu SMTP settings callback function
 * @since 1.0
 * */
function simple_wp_smtp_setting_menu_callback_function(){
	include_once plugin_dir_path( __FILE__ ).'smtp-settings-form.php';
}

/**
 * Admin submenu test mail callback function
 * @since 1.0
 * */
function simple_wp_smtp_test_mail(){
	include_once plugin_dir_path( __FILE__ ).'smtp-test-mail-form.php';
}
?>