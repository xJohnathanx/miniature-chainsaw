<?php
defined('DIRECT_ACCESS') || die('Direct access is not allowed');

function redirect($location) {
  $location_script = BASE_URL . "/$location";
  if (!headers_sent()) {
    header('Location: ' . $location_script, TRUE, 302);
  } else {
    echo "<script type=\"text/javascript\">";
    echo "window.location.href=\"$location_script\";";
    echo "</script>";
    echo "<noscript>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=\"$location_script\" />";
    echo "</noscript>";
  }
  exit;
}

function e($value) {
  return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
}

function fingerprint() {
  $user_ip = $_SERVER['REMOTE_ADDR'];
  $user_browser = $_SERVER['HTTP_USER_AGENT'];
  $login_fingerprint = hash('sha512', $user_ip . $user_browser);
  return $login_fingerprint;
}

function email_valid($email) {
  return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email);
}


?>
