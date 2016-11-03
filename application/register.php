<?php
defined('DIRECT_ACCESS') || die('Direct access is not allowed');

function do_register($email, $username, $pw, $pw_confirm, $config, $dbh) {
  if (!$config['register']) {
    $_SESSION['register_error'] = 'Our register page has been disabled, check back later.';
    redirect('register/?error');
  }
  if ($email == '') {
    $_SESSION['register_error'] = 'Please fill in the email field.';
    redirect('register/?error');
  }
  if ($username == '') {
    $_SESSION['register_error'] = 'Please fill in the username field.';
    redirect('register/?error');
  }
  if ($pw == '') {
    $_SESSION['register_error'] = 'Please fill in the password field.';
    redirect('register/?error');
  }
  if ($pw_confirm == '') {
    $_SESSION['register_error'] = 'Please fill in the confirm password field.';
    redirect('register/?error');
  }
  if (!email_valid($email)) {
    $_SESSION['register_error'] = 'Please enter a valid email address.';
    redirect('register/?error');
  }
  if (!ctype_alnum(str_replace($config['allowed'], '', $username))) {
    $_SESSION['register_error'] = 'Please fill in a valid username.';
    redirect('register/?error');
  }
  $stmt = $dbh->prepare("SELECT * FROM users WHERE mail = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows == 1) {
    $stmt->close();
    $_SESSION['register_error'] = 'Someone already has the email (' . $email . ').';
    redirect('register/?error');
  }
  $stmt->close();
  $stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows == 1) {
    $stmt->close();
    $_SESSION['register_error'] = 'Someone already has the username (' . $username . ').';
    redirect('register/?error');
  }
  $stmt->close();
  if ($pw != $pw_confirm) {
    $_SESSION['register_error'] = 'The passwords do not match.';
    redirect('register/?error');
  }
	if (strlen($new_pw) < 7) {
    $_SESSION['register_error'] = 'Your new password must contain 7 characters.';
    redirect('register/?error');
  }
	$look = $config['look'];
	$motto = $config['motto'];
	$vipr = $config['vip_rank'];
	$cur_ip = $_SERVER['REMOTE_ADDR'];
  $pw = hash($config['algo'], $pw . $config['salt']);
  $salt = hash($config['algo'], $pw . time() . $config['salt']);
  $stmt = $dbh->prepare("INSERT INTO users (username, password, mail, rank_vip, look, motto, ip_reg, salt) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssissss", $username, $pw, $email, $vipr, $look, $motto, $cur_reg, $salt);
  $stmt->execute();
  $stmt->close();
  $_SESSION['register_success'] = 'Your account was successfully created. <a href=\'../login\' class=\'alert-link\' style="color:#fff;">You can now log in</a>.';
  redirect('register/?success'); 
}

?>
