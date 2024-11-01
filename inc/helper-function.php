<?php
/**
 * Provide helper functions
 *
 * @link       https://indianic.com
 * @since      1.0.0
 *
 * @package    simple-wp-smtp
 * @subpackage simple-wp-smtp/inc
 */

/**
 * Encription & Description function
 * @since 1.0
 * */
function simple_wp_smtp_stringEncryption($action, $string){
	$output = false;
	$encrypt_method = 'AES-256-CBC';
	$secret_key = 'gM#Fy$vSF@qH402T';
	$secret_iv = '5%00VpHTy%K5TG^Y';
	$key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ( $action == 'encrypt' ) {
		  $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		  $output = base64_encode($output);
	} else if ( $action == 'decrypt' ){
	  	$output = stripslashes(openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv));
	}
	return $output;
}

/**
 * SMTP configration
 * @since 1.0
 * */
add_action( 'phpmailer_init', 'simple_wp_smtp_configuresmtp', 999 );
function simple_wp_smtp_configuresmtp( $phpmailer ){
	$data = get_option('simple-wp-smtp-settings');
	$password = simple_wp_smtp_stringEncryption('decrypt', $data['password']);
    $phpmailer->isSMTP();
    $phpmailer->Host       = sanitize_text_field($data['smtp_host']);
    $phpmailer->SMTPAuth   = sanitize_text_field($data['authentication']);
    $phpmailer->Port       = sanitize_text_field($data['port']);
    $phpmailer->Username   = sanitize_text_field($data['username']);
    $phpmailer->Password   = sanitize_text_field($password);
    $phpmailer->SMTPSecure = sanitize_text_field($data['encryption_type']);
    $phpmailer->From       = sanitize_text_field($data['mail_from_email']);
    $phpmailer->FromName   = sanitize_text_field($data['mail_from_name']);
}
?>