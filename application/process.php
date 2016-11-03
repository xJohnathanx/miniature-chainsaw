<?php
defined('DIRECT_ACCESS') || define('DIRECT_ACCESS', 'ALLOWED');

include '../application/global.php';

if (isset($_POST['btn_login'])) {
  $rem_me = false;
  if (isset($_POST['rem_me']))
    $rem_me = true;
  do_login($_POST['login_id'], $_POST['login_password'], $login_config, $mysqli, $rem_me);
}

if (isset($_POST['btn_register'])) {
  $_SESSION['register_email'] = $_POST['register_email'];
  $_SESSION['register_username'] = $_POST['register_username'];
	if ($google_config['recaptcha_required']) {
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
      $secret = $google_config['recap_site_key'];
      $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
      $response_data = json_decode($verify_response);
      if ($response_data->success) {
      } else {
        $_SESSION['register_error'] = 'Google reCAPTCHA failed.';
        redirect('register/?error');
      }
    } else {
      $_SESSION['register_error'] = 'Google reCAPTCHA required.';
      redirect('register/?error');
    }
  }
  do_register($_POST['register_email'], $_POST['register_username'], $_POST['register_password'], $_POST['register_password_confirm'], $register_config, $mysqli);
}

if (isset($_POST['btn-account'])) {
  $_SESSION['account_new_email'] = $_POST['acc_email'];
	if ($google_config['recaptcha_required']) {
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
      $secret = $google_config['recap_site_key'];
      $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
      $response_data = json_decode($verify_response);
      if ($response_data->success) {
      } else {
        $_SESSION['account_error'] = 'Google reCAPTCHA failed.';
        redirect('account/?error');
      }
    } else {
      $_SESSION['account_error'] = 'Google reCAPTCHA required.';
      redirect('account/?error');
    }
  }
	
  do_account($_POST['acc_motto'], $_POST['acc_email'], $_POST['acc_old_password'], $_POST['acc_new_password'], $login_config, $mysqli);

}

?>
