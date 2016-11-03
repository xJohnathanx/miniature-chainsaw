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
    <title>Register with Clubbo</title>

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
  <body>
        <?php
          if (isset($_GET['error'])) {
            if (isset($_SESSION['register_error'])) {
              echo '
	              <div class="alert alert-dismissible alert-danger" style="margin-bottom:0;border-radius:0px;background-color:#c0392b;border-color:#e74c3c;color:#fff;">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <center><strong>Register failed!</strong> ' . $_SESSION['register_error'] . '</center>
                </div>
              ';
              unset($_SESSION['register_error']);
            }
          }
          if (isset($_GET['success'])) {
	          if (isset($_SESSION['register_success'])) {
              echo '
                <div class="alert alert-dismissible alert-success" style="margin-bottom:0;border-radius:0px;background-color:#27ae60;border-color:#2ecc71;color:#fff;">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <center><strong>Register success!</strong> ' . $_SESSION['register_success'] . '</center>
                </div>
	            ';
              unset($_SESSION['register_success']);
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
        <div class="col-md-8 col-md-offset-2">
				<center><a href="../index/"><img src="http://habbofont.com/font/blue/Clubbo%20Hotel.gif" alt="logo" style="margin-bottom:10px;" /></a></center>
          <!-- form validation errors -->
          
          <div class="well" style="background-color:#34495e;border-color:#2c3e50;color:#fff;border-width:2px;padding-bottom:0;">
	          <form class="form-horizontal" method="POST" action="../application/process.php">
              <fieldset>
                <legend style="border-color:#3498db;color:#fff;"></legend>
	        <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                  <div class="col-lg-10">
                    <input type="text" name="register_email" class="form-control" id="inputEmail" placeholder="Enter Email" autofocus />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputUsername" class="col-lg-2 control-label">Username</label>
                  <div class="col-lg-10">
                    <input type="text" name="register_username" class="form-control" id="inputUsername" placeholder="Enter Username" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                  <div class="col-lg-10">
                    <input type="password" name="register_password" class="form-control" id="inputPassword" placeholder="Password">
										<small focus-show-help-block>
								      <p class="help-block" style="color:#fff;"><span class="label label-default">Note</span> Password must be contain at least 7 characters, and we suggest including at least 1 number and includes both lower and uppercase letters and special characters e.g # ,@ ,? ,!.</p>
							      </small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPasswordTwo" class="col-lg-2 control-label">Retype</label>
                  <div class="col-lg-10">
                    <input type="password" name="register_password_confirm" class="form-control" id="inputPasswordTwo" placeholder="Retype Password">
                  </div>
                </div>
								<?php if ($google_config['recaptcha_required'] == 1) { ?>
								<div class="form-group">
                  <label for="check" class="col-lg-2 control-label">Check</label>
                  <div class="col-lg-10">
                    <div class="g-recaptcha" id="check" data-sitekey="<?php echo $google_config['recap_site_key']; ?>"></div>
	                </div>
                </div>
								<?php } ?>
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
		                <a href="../login" class="btn btn-info"><i class="fa fa-sign-in"></i> Login</a>
                    <button type="submit" name="btn_register" class="btn btn-primary"><i class="fa fa-user-plus"></i> Register</button>
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
		<script src='https://www.google.com/recaptcha/api.js'></script>
		
		<script>
	  $(function(){autosize($("textarea[auto-size]"))}),$(function(){var a=$('input[type="search"]');a.putCursorAtEnd().on("focus",function(){a.putCursorAtEnd()})}),$(function(){$('[data-toggle="tooltip"]').tooltip()}),$(function(){var a=$('div[input-group="hidden"]');a.each(function(){var a=$(this).find('input[type="password"]');a.bind("keyup focus blur paste",function(){var a=$(this).val();""!=a?($(this).parent().addClass("input-group"),$(this).parent().find("span.input-group-btn").removeClass("hidden")):($(this).parent().removeClass("input-group"),$(this).parent().find("span.input-group-btn").addClass("hidden"))});var b=$(this).parent().find('span.input-group-btn.hidden button[button-type="visibility-toggle"]');b.mousedown(function(){a.attr("type","text"),b.html('<i class="fa fa-eye-slash" aria-hidden="true"></i>')}),b.bind("mouseup mouseleave",function(){a.attr("type","password"),b.html('<i class="fa fa-eye" aria-hidden="true"></i>')})})}),$(function(){var a=$('input[type="search"][search-field-reset]');""!=a.val()&&$("[btn-reset].btn.btn-default").removeClass("hidden"),a.bind("focus keyup blur paste",function(){var b=a.val(),c=$("[btn-reset].btn.btn-default");""!=b?c.removeClass("hidden"):c.addClass("hidden")})}),$(function(){var a=$("div.alert[auto-close]");a.each(function(){var a=$(this),b=a.attr("auto-close");setTimeout(function(){a.fadeTo(500,0).slideUp(500,function(){$(this).alert("close")})},b)})}),$(function(){var a=$("div[focus-show-help-block].form-group");a.each(function(){var a=$(this).find("small[focus-show-help-block]");a.hide();var b=$(this).find("input.form-control");b.bind("focus",function(){a.show(100)})})});
		</script>
  </body>
</html>
