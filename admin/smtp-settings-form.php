<?php
/**
 * SMTP settings form
 */
?>
<div class="wrap">
<?php
	echo _e('<h1 class="wp-heading-inline">SMTP Settings</h1>','simple-wp-smtp');
	if(isset($_POST['submit'])){
		if ( ! isset( $_POST['smtp_settings'] ) 
		    || ! wp_verify_nonce( $_POST['smtp_settings'], 'smtp_settings' ) 
		) {
			echo _e('<div class="updated notice-error">
					   	<p>Something went wrong please try again.</p>
					</div>','simple-wp-smtp');
		} else {
		   	$data = get_option('simple-wp-smtp-settings');
			$data['mail_to'] = sanitize_email($_POST['mail_to']);
		    $data['mail_from_email'] = sanitize_email($_POST['mail_from_email']);
		    $data['mail_from_name'] = sanitize_text_field($_POST['mail_from_name']);
		    $data['mail_to_bcc'] = sanitize_email($_POST['mail_to_bcc']);
		    $data['mail_replay'] = sanitize_email($_POST['mail_replay']);
		    $data['smtp_host'] = sanitize_text_field($_POST['smtp_host']);
		    $data['encryption_type'] = sanitize_text_field($_POST['encryption_type']);
		    $data['port'] = sanitize_text_field($_POST['port']);
		    $data['authentication'] = sanitize_text_field($_POST['authentication']);
		    $data['username'] = sanitize_text_field($_POST['username']);
		    if(sanitize_text_field($_POST['password']) != '#simplewpsmtp#'){
		    	$data['password'] = simple_wp_smtp_stringEncryption('encrypt',sanitize_text_field($_POST['password']));
		    }
			update_option( 'simple-wp-smtp-settings', $data, '', 'yes' );
			echo _e('<div class="updated notice-success">
					   	<p>Data saved.</p>
					</div>','simple-wp-smtp');
		}
	}
	$data = get_option('simple-wp-smtp-settings');
	?>
	<form class="form" method="post" action="">
		<?php wp_nonce_field( 'smtp_settings', 'smtp_settings' ); ?>
		<div class="form__linput">
			<label class="form__label" class="form__label" for="mail_to"><?php echo _e('To','simple-wp-smtp'); ?></label>
			<input type="text" name="mail_to" id="mail_to" class="mail_to form__input" value="<?php echo ($data['mail_to'])?esc_attr($data['mail_to']):''; ?>">
		</div>
		<div class="form__linput">
			<label class="form__label" for="mail_from_email"><?php echo _e('From Email','simple-wp-smtp'); ?></label>
			<input type="text" name="mail_from_email" id="mail_from_email" class="mail_from_email form__input" value="<?php echo ($data['mail_from_email'])?esc_attr($data['mail_from_email']):''; ?>">
		</div>
		<div class="form__linput">
			<label class="form__label" for="mail_from_name"><?php echo _e('From Name','simple-wp-smtp'); ?></label>
			<input type="text" name="mail_from_name" id="mail_from_name" class="mail_from_name form__input" value="<?php echo ($data['mail_from_name'])?esc_attr($data['mail_from_name']):''; ?>">
		</div>
		<div class="form__linput">
			<label class="form__label" for="mail_to_bcc"><?php echo _e('Bcc Email','simple-wp-smtp'); ?></label>
			<input type="text" name="mail_to_bcc" id="mail_to_bcc" class="mail_to_bcc form__input" value="<?php echo ($data['mail_to_bcc'])?esc_attr($data['mail_to_bcc']):''; ?>">
		</div>
		<div class="form__linput">
			<label class="form__label" for="mail_replay"><?php echo _e('Replay To Email','simple-wp-smtp'); ?></label>
			<input type="email" name="mail_replay" id="mail_replay" class="mail_replay form__input" value="<?php echo ($data['mail_replay'])?esc_attr($data['mail_replay']):''; ?>">
		</div>
		<div class="form__linput">
			<label class="form__label" for="smtp_host"><?php echo _e('SMTP Host','simple-wp-smtp'); ?></label>
			<input type="text" name="smtp_host" id="smtp_host" class="smtp_host form__input" value="<?php echo ($data['smtp_host'])?esc_attr($data['smtp_host']):''; ?>">
		</div>
		<div class="form__linput">
			<label class="form__label" for="encryption_type"><?php echo _e('Encryption Type','simple-wp-smtp'); ?></label>
			<select name="encryption_type" id="encryption_type" class="encryption_type form__input">
				<option value="none" <?php echo (($data['encryption_type']!='ssl') && ($data['encryption_type']!='tls'))?'selected':''; ?>><?php echo _e('None','simple-wp-smtp'); ?></option>
				<option value="ssl" <?php echo ($data['encryption_type']=='ssl')?'selected':''; ?>><?php echo _e('SSL','simple-wp-smtp'); ?></option>
				<option value="tls" <?php echo ($data['encryption_type']=='tls')?'selected':''; ?>><?php echo _e('TLS','simple-wp-smtp'); ?></option>
			</select>
		</div>
		<div class="form__linput">
			<label class="form__label" for="port"><?php echo _e('Port','simple-wp-smtp'); ?></label>
			<input type="text" name="port" id="port" class="port form__input" value="<?php echo ($data['port'])?esc_attr($data['port']):''; ?>">
		</div>
		<div class="form__linput">
			<label class="form__label" for="authentication"><?php echo _e('Authentication','simple-wp-smtp'); ?></label>
			<div class="form__input">
				<input type="Radio" name="authentication" class="authentication" value="yes" <?php echo ($data['authentication']!='no')?'checked':''; ?>> <?php echo _e('Yes','simple-wp-smtp'); ?>
				<input type="Radio" name="authentication" class="authentication" value="no" <?php echo ($data['authentication']=='no')?'checked':''; ?>> <?php echo _e('No','simple-wp-smtp'); ?>
			</div>
		</div>
		<div class="form__linput">
			<label class="form__label" for="username"><?php echo _e('Username','simple-wp-smtp'); ?></label>
			<input type="text" name="username" id="username" class="username form__input" value="<?php echo ($data['username'])?esc_attr($data['username']):''; ?>">
		</div>
		<div class="form__linput">
			<label class="form__label" for="password"><?php echo _e('Password','simple-wp-smtp'); ?></label>
			<input type="password" name="password" id="password" class="password form__input" value="<?php echo ($data['password'])?'#simplewpsmtp#':''; ?>">
		</div>
		<div class="form__linput">
			<input type="submit" name="submit" id="submit" class="submit primary-button form__button" value="<?php echo _e('Save','simple-wp-smtp'); ?>">
		</div>
	</form>
</div>