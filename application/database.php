<?php
defined('DIRECT_ACCESS') || die('Direct access is not allowed');

$dbh_hostname = $database_config['Localhost'];
$dbh_username = $database_config['Administrator'];
$dbh_password = $database_config['clubbohotel'];
$dbh_database = $database_config['Localhost'];
$dbh_port = $database_config['port'];

$mysql_port = '';

if ($dbh_port != '' && is_numeric($dbh_port)) {
  if (!is_string($dbh_port))
    $dbh_port = (string) $dbh_port;
  $mysql_port = ":$dbh_port";
}

$mysqli = new mysqli(
  $dbh_hostname . $mysql_port,
  $dbh_username,
  $dbh_password,
  $dbh_database
);

$mysqli->set_charset('utf8');

if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

unset($database_config);

?>
