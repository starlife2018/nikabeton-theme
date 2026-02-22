<?php
/**
 * Ajax Form Handler for NikaBeton
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nikabeton_process_contact_form() {
	// 1. Verify Nonce (optional but good practice, though we might not have it strictly set up on all static forms)
	// For now, simpler validation.

	$name    = isset($_POST['client_name']) && !empty($_POST['client_name']) ? sanitize_text_field($_POST['client_name']) : (isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '');
	$phone   = isset($_POST['client_phone']) && !empty($_POST['client_phone']) ? sanitize_text_field($_POST['client_phone']) : (isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '');
	$message = isset($_POST['client_message']) && !empty($_POST['client_message']) ? sanitize_textarea_field($_POST['client_message']) : (isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '');

	if ( empty($name) || empty($phone) ) {
		wp_send_json_error( array('message' => 'Будь ласка, заповніть обов\'язкові поля (Ім\'я та Телефон).') );
	}

	// Email settings
	$to = get_theme_mod('nikabeton_email', 'hello@nikabeton.com');
	if ( empty($to) || $to === '#' ) {
		$to = get_option('admin_email');
	}

	$subject = 'Нова заявка з сайту NikaBeton';
	
	$body = "Ви отримали нове звернення з сайту:\n\n";
	$body .= "Ім'я: " . $name . "\n";
	$body .= "Телефон: " . $phone . "\n";
	$body .= "Повідомлення:\n" . $message . "\n\n";
	$body .= "---\nВідправлено з форми на сайті NikaBeton.";

	$headers = array('Content-Type: text/plain; charset=UTF-8');
	$headers[] = 'From: NikaBeton Website <wordpress@' . $_SERVER['SERVER_NAME'] . '>';

	// Send Email
	$mail_sent = wp_mail( $to, $subject, $body, $headers );

	if ( $mail_sent ) {
		wp_send_json_success( array('message' => 'Дякуємо! Ваша заявка успішно відправлена. Ми зв\'яжемось з Вами найближчим часом.') );
	} else {
		wp_send_json_error( array('message' => 'Виникла помилка при відправці. Спробуйте пізніше або зателефонуйте нам.') );
	}
}

add_action( 'wp_ajax_nikabeton_send_mail', 'nikabeton_process_contact_form' );
add_action( 'wp_ajax_nopriv_nikabeton_send_mail', 'nikabeton_process_contact_form' );
