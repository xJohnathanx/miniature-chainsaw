<?php
defined('DIRECT_ACCESS') || define('DIRECT_ACCESS', 'ALLOWED');
include 'application/global.php';

	$_SESSION['vip_error'] = 'VIP is currently unavaliable because tomas still needs to create a paypal account.';
  redirect('dashboard/?error');

?>