<?php
/**
 * 
 * Configuration / envoi d'email
 * 
 */

/*============================
=            SMTP            =
============================*/

add_action( 'phpmailer_init', 'pc_mail_smtp_settings' );

function pc_mail_smtp_settings( $phpmailer ) {

	global $settings_pc;

	if ( isset( $settings_pc['smtp-active'] ) ) {

		$phpmailer->isSMTP();  
		$phpmailer->Host = $settings_pc['smtp-server'];

		$phpmailer->SMTPAuth = true;
		$phpmailer->SMTPSecure = $settings_pc['smtp-type'];
		$phpmailer->Port = $settings_pc['smtp-port'];
		$phpmailer->Username = $settings_pc['smtp-username'];
		$phpmailer->Password = $settings_pc['smtp-password'];


		$phpmailer->From = $settings_pc['smtp-fromemail'];
		$phpmailer->FromName = $settings_pc['smtp-fromname'];

	}

}


/*=====  FIN SMTP  =====*/