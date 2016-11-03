<?php
defined('DIRECT_ACCESS') || die('Direct access is not allowed');
defined('BASE_URL') || define('BASE_URL', 'https://localhost');
$database_config = array(
  'hostname' => 'localhost',
  'username' => 'nicholas',
  'password' => 'Aqua0820',
  'database' => 'test',
  'port' => '' // you can leave this blank if your are using localhost
);
$session_config = array(
  'use_only_cookies' => true,
  'http_only' => true,
  'secure' => false,
);
$login_config = array(
  'login_with_username' => true,
  'login_with_email' => true,
  'remember_me' => true,
  'max_attempts' => 10, // feature is not yet ready
  'login' => true,
	'account' => true,
  'algo' => 'sha512',
  'salt' => '(#$Tn#NFI#n4mrifnm#$MRC@NMI#RNMDin3mreiN' // dont change
);
$register_config = array(
  'register' => true,
  'algo' => $login_config['algo'],
  'salt' => $login_config['salt'],
  'allowed' => array(
    '.',
    '-',
    '_'
  ),
	'look' => '-',
	'vip_rank' => 1,
	'motto' => 'I am new to Clubbo Hotel!'
);
$google_config = array(
  'recap_site_key' => '6LdZ3QoUAAAAACVTb-xP3Dt_QajXUtZUrUF5pEmg', // dont change or will not work
  'recaptcha_required' => true
);
$logged_config = array(
  'hk' => true,
  'hk_min_rank' => 5 // THIS HAS TO BE AN NUMBER OR HK WILL NOT WORK
);

?>
