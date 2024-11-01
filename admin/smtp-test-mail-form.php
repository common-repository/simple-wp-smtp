<?php
/**
 * SMTP test mail form
 */
echo _e('<h1>Test Mail</h1>','simple-wp-smtp');
if(isset($_POST['submit'])){
	if ( ! isset( $_POST['smtp_test_mail'] ) 
	    || ! wp_verify_nonce( $_POST['smtp_test_mail'], 'smtp_test_mail' ) 
	) {
		echo _e('<div class="notice notice-error ">
				   	<p>Something went wrong please try again.</p>
				</div>','simple-wp-smtp');
	} else {
		$mail_to = sanitize_email($_POST['mail_to']);
	    $mail_subject = sanitize_text_field($_POST['mail_subject']);
	    $mail_message = sanitize_text_field($_POST['mail_message']);

	    $res = wp_mail($mail_to, $mail_subject, $mail_message);
	    if($res){
			echo _e('<div class="notice notice-success ">
						   	<p>Mail sent.</p>
						</div>','simple-wp-smtp');
		}else{
			echo _e('<div class="notice notice-error ">
					   	<p>Something went wrong please check your SMTP details.</p>
					</div>','simple-wp-smtp');
		}
	}
}
?>
<form class="form" method="post" action="">
	<?php wp_nonce_field( 'smtp_test_mail', 'smtp_test_mail' ); ?>
	<div class="form__linput">
		<label class="form__label" for="mail_to"><?php echo _e('To','simple-wp-smtp'); ?></label>
		<input type="text" name="mail_to" id="mail_to" class="mail_to form__input">
	</div>
	<div class="form__linput">
		<label class="form__label" for="mail_subject"><?php echo _e('Subject','simple-wp-smtp'); ?></label>
		<input type="text" name="mail_subject" id="mail_subject" class="mail_subject form__input">
	</div>
	<div class="form__linput">
		<label class="form__label" for="mail_message"><?php echo _e('Message','simple-wp-smtp'); ?></label>
		<textarea name="mail_message" id="mail_message" class="mail_message form__input"></textarea>
	</div>
	<div class="form__linput">
		<input type="submit" name="submit" id="submit" class="submit primary-button form__button" value="<?php echo _e('Send','simple-wp-smtp'); ?>">
	</div>
</form>