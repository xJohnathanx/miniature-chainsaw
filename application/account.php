<?php
defined('DIRECT_ACCESS') || die('Direct access is not allowed');

function do_account($motto, $new_email, $old_pw, $new_pw, $config, $dbh) {
  if (!$config['account']) {
    $_SESSION['account_error'] = 'Our account editting system has been disabled, try again later.';
    redirect('account/?error');
  }
	$stmt = $dbh->prepare("SELECT password FROM users WHERE id = ?");
  $stmt->bind_param("i", $_SESSION['id']);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($password);
  $stmt->fetch();
  $stmt->close();
	$input_password = hash($config['algo'], $old_pw . $config['salt']);
	if ($input_password != $password) {
		$_SESSION['account_error'] = 'The password does not match the currently logged users account.';
    redirect('account/?error');	
	}
	if ($new_pw == '') {
		$stmt = $dbh->prepare("UPDATE users SET mail = ?, motto = ?");
		$stmt->bind_param("ss", $new_email, $motto);
    $stmt->execute();
	  $stmt->close();
		$_SESSION['account_success'] = 'The account has been successfully updated.';
    redirect('account/?success');
	} else {
		if (strlen($new_pw) < 7) {
			$_SESSION['account_error'] = 'Your new password must contain 7 characters.';
      redirect('account/?error');
		}
		$stmt = $dbh->prepare("UPDATE users SET mail = ?, motto = ?, password = ?");
		$stmt->bind_param("sss", $new_email, $motto, $new_pw);
    $stmt->execute();
	  $stmt->close();
		$_SESSION['account_success'] = 'The account has been successfully updated.';
    redirect('account/?success');
	}
}

?>

