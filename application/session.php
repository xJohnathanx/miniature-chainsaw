<?php
defined('DIRECT_ACCESS') || die('Direct access is not allowed');

function start_session($config = array()) {
  ini_set('session.use_only_cookies', $config['use_only_cookies']);
  $session_params = session_get_cookie_params();
  session_set_cookie_params(
    $session_params['lifetime'], 
    $session_params['path'], 
    $session_params['domain'], 
    $config['secure'], 
    $config['http_only']
  );
  session_start();
}

function destroy_session() {
  session_unset();
  $session_params = session_get_cookie_params();
  setcookie(
    session_name(), 
    '', 
    time() - 42000, 
    $session_params['path'], 
    $session_params['domain'], 
    $session_params['secure'], 
    $session_params['httponly']
  );
  setcookie("login_auth", "", time() - 3600, "/");
  setcookie("login_id", "", time() - 3600, "/");
  session_destroy();
}

function session_regenerate() {
  session_regenerate_id(TRUE);
}

start_session($session_config);

unset($session_config);

?>
