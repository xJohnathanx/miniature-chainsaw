<?php
defined('DIRECT_ACCESS') || die('Direct access is not allowed');

function is_logged_in() {
  if (!isset($_SESSION['id']) || !isset($_SESSION['login_fingerprint'])) {
    return false;
  }
  if ($_SESSION['login_fingerprint'] != fingerprint()) {
    destroy_session();
    redirect('login');
  }
  return true;
}

function do_login($login_id, $login_password, $config, $mysqli, $rm) {
  if ($config['login'] != true) {
    $_SESSION['login_error'] = 'The login has been disabled, check back later.';
    redirect('login/?error');
  }
  if ($login_id == '') {
    $msg = 'Please fill in your login id.';
    $_SESSION['login_error'] = $msg;
    redirect('login/?error');
  }
  if ($login_password == '') {
    $_SESSION['login_error'] = 'Please fill in your password.';
    redirect('login/?error');
  }
  /* if ($config['max_attempts'] != 0) {
    if (is_brute($login_id, $config['max_attempts'])) {
      $_SESSION['login_error'] = 'Too many login attempts, try again tomorrow.';
      redirect('login/?error');
    }
  } */
  if ($config['login_with_username'] == true && $config['login_with_email'] == true) {
    if (email_valid($login_id)) {
      $stmt = $mysqli->prepare("SELECT id, salt FROM users WHERE mail = ? AND password = ?");
    } else {
      $stmt = $mysqli->prepare("SELECT id, salt FROM users WHERE username = ? AND password = ?");
    }
  } elseif ($config['login_with_username'] == true) {
    $stmt = $mysqli->prepare("SELECT id, salt FROM users WHERE username = ? AND password = ?");
  } else {
    $stmt = $mysqli->prepare("SELECT id, salt FROM users WHERE mail = ? AND password = ?");
  }
  $login_password = hash($config['algo'], $login_password . $config['salt']);
  $stmt->bind_param("ss", $login_id, $login_password);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows == 1) {
    $stmt->bind_result($id, $n_salt);
    $stmt->fetch();
    $stmt->close();
    $_SESSION['id'] = $id;
    $_SESSION['login_fingerprint'] = fingerprint();
    if ($rm == true) {
      setcookie('login_auth', $n_salt, time() + (86400 * 30), "/");
      setcookie('login_id', $login_id, time() + (86400 * 30), "/");
    }
		$timestamp = time();
		$stmt = $mysqli->prepare("UPDATE users SET last_online = ?, ip_last = ? WHERE id = ?");
		$stmt->bind_param("ssi", $timestamp, $_SERVER['REMOTE_ADDR'], $id);
    $stmt->execute();
		$stmt->close();
    session_regenerate();
    redirect('dashboard');
  } else {
    $stmt->close();
    $msg = '';
    if ($config['login_with_username'] == true && $config['login_with_email'] == true) {
      $msg .= 'Wrong username/email or password entered, please check to see if you entered them correctly.';
    } elseif ($config['login_with_username'] == true) {
      $msg .= 'Wrong username or password entered, please check to see if you entered them correctly.';
    } else {
      $msg .= 'Wrong email or password entered, please check to see if you entered them correctly.';
    }
    $_SESSION['login_error'] = 'Wrong username/email or password entered, please check to see if you entered them correctly.';
    redirect('login/?error');
  }
}

function rm_it($rm_auth, $rm_id, $mysqli) {
  if (!email_valid($rm_auth))
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ? AND salt = ?");
  else
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE mail = ? AND salt = ?");
  $stmt->bind_param("ss", $rm_id, $rm_auth);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows == 1) {
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();
    $_SESSION['id'] = $user_id;
    $_SESSION['login_fingerprint'] = fingerprint();
    session_regenerate();
    redirect('dashboard');
  }
  setcookie("login_auth", "", time() - 3600, "/");
  setcookie("login_id", "", time() - 3600, "/");
  return;
}

?>
