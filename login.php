<?php
defined('DIRECT_ACCESS') || define('DIRECT_ACCESS', 'ALLOWED');
include 'application/global.php';
if (is_logged_in()) {
  redirect('dashboard');
}

if (isset($_COOKIE['login_auth']) && isset($_COOKIE['login_id'])) {
  rm_it($_COOKIE['login_auth'], $_COOKIE['login_id'], $mysqli);
} else {
  setcookie("login_auth", "", time() - 3600, "/");
  setcookie("login_id", "", time() - 3600, "/");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Clubbo Login</title>
    <!-- Bootstrap & other files -->
    <link href="../assets/libs/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/libs/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
		
    <!-- Optional theme -->
    <!-- <link href="../assets/libs/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" /> -->
		
		<style>
		html, body { 
      background: url(http://prixima.youhost.es/web-gallery/v2/images/styles/tck_hotel/bg.png) no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
		</style>
		
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="">
	<?php
          if (isset($_GET['error'])) {
            if (isset($_SESSION['login_error'])) {
              echo '
	              <div class="alert alert-dismissible alert-danger" style="margin-bottom:0;border-radius:0px;background-color:#c0392b;border-color:#e74c3c;color:#fff;">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <center><strong>Login failed!</strong> ' . $_SESSION['login_error'] . '</center>
                </div>
	            ';
              unset($_SESSION['login_error']);
	          }
          }
          ?>
	  <div class="alert alert-dismissible alert-warning" style="margin-bottom:0;border-radius:0px;background-color:#2c3e50;border-color:#34495e;color:#fff;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <center><strong>Current users listen up!</strong> This CMS is new and we have a new password hash/encryption system and you need to update your password. <a href="../recover/password" class="alert-link" style="color:#fff;">Click here to update password</a>!</center>
    </div>
    <div class="container">
		  
      <div class="row">
			<br />
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				  <center><a href="../index/"><img src="http://habbofont.com/font/blue/Clubbo%20Hotel.gif" alt="logo" style="margin-bottom:10px;" /></a></center>
          <!-- form validation errors -->
          
					
          <div class="well" style="background-color:#34495e;border-color:#2c3e50;color:#fff;border-width:2px;padding-bottom:0;">
	          <form class="form-horizontal" method="POST" action="../application/process.php">
              <fieldset>
							  <center>
                  <legend style="border-color:#3498db;color:#fff;"></legend>
							  </center>
                <div class="form-group">
                  <label for="inputUsernameOrEmail" class="col-lg-2 control-label">Login ID</label>
                  <div class="col-lg-10">
                    <input type="text" name="login_id" class="form-control" id="inputUsernameOrEmail" placeholder="<?php if ($login_config['login_with_username'] == true && $login_config['login_with_email'] == true) { echo "Enter username or email"; } elseif ($login_config['login_with_username'] == true) { echo "Enter username"; } else { echo "Enter email"; } ?>" autofocus />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                  <div class="col-lg-10">
                    <input type="password" name="login_password" class="form-control" id="inputPassword" placeholder="Password">
		                <?php if ($login_config['remember_me']) { ?>
                    <div class="checkbox">
                      <label title="Check only if this is a personal computer">
                        <input type="checkbox" name="rem_me" value="rem"> Remember Me
                      </label>
                    </div>
	                  <?php } ?>
	                </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
		                <a href="../register" class="btn btn-info"><i class="fa fa-user-plus"></i> Register</a>
                    <button type="submit" name="btn_login" class="btn btn-primary"><i class="fa fa-sign-in"></i> Login</button>
                  </div>
                </div>
              </fieldset>
            </form>
						<legend style="border-color:#3498db;color:#fff;"></legend>
						<center><p style="margin-top:-6px;">Clubbo Hotel &copy; 2016 - <?php echo date("Y"); ?></p></center>
          </div>
        </div>
      </div>
			
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/libs/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </body>
</html>
