<?php
defined('DIRECT_ACCESS') || define('DIRECT_ACCESS', 'ALLOWED');
include 'application/global.php';
if (!is_logged_in()) {
  redirect('login');
}

$stmt = $mysqli->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 1) {
  $stmt->bind_result($username);
  $stmt->fetch();
} else {
  $username = '';
}
$stmt->close();

// get the users rank
$stmt = $mysqli->prepare("SELECT mail, rank, look, motto, last_online FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 1) {
  $stmt->bind_result($users_email, $rank, $look, $motto, $last_online);
  $stmt->fetch();
} else {
  $rank = '';
}
$stmt->close();

$user_id = $_SESSION['id'];

$online_data = '1';
$stmt = $mysqli->prepare("SELECT * FROM users WHERE online = ?");
$stmt->bind_param("s", $online_data);
$stmt->execute();
$stmt->store_result();
$online_num = $stmt->num_rows;
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Clubbo - Account Settings - <?php echo e($username); ?></title>
        
        <link rel="stylesheet" href="https://clubbohotel.co.uk/app/tpl/skins/Habbo/styles/common.css" type="text/css">
        <script type="text/javascript" src="https://clubbohotel.co.uk/app/tpl/skins/Habbo/js/libs2.js"></script>
        <script type="text/javascript" src="https://clubbohotel.co.uk/app/tpl/skins/Habbo/js/visual.js"></script>
        <script type="text/javascript" src="https://clubbohotel.co.uk/app/tpl/skins/Habbo/js/libs.js"></script>
        <script type="text/javascript" src="https://clubbohotel.co.uk/app/tpl/skins/Habbo/js/common.js"></script>
        <script type="text/javascript" src="https://clubbohotel.co.uk/app/tpl/skins/Habbo/js/fullcontent.js"></script>
        
        <script type="text/javascript">
            document.habboLoggedIn = true;
            var habboName = "<?php echo e($username); ?>";
            var habboId = <?php echo $_SESSION['id']; ?>;
            var habboReqPath = "";
            var habboStaticFilePath = "https://clubbohotel.co.uk/application/";
            var habboImagerUrl = "http://www.habbo.com/habbo-imaging/";
            var habboPartner = "";
            var habboDefaultClientPopupUrl = "https://clubbohotel.co.uk/client";
            window.name = "habboMain";
            if (typeof HabboClient != "undefined") {
                HabboClient.windowName = "eac955c8dbc88172421193892a3e98fc7402021a";
                HabboClient.maximizeWindow = true;
            }
        </script>
<link rel="stylesheet" href="https://clubbohotel.co.uk/app/tpl/skins/Habbo/styles/lightweightmepage.css" type="text/css" />


<script src="https://clubbohotel.co.uk/app/tpl/skins/Habbo/js/lightweightmepage.js" type="text/javascript"></script>

								<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/941/web-gallery/static/js/moredata.js" type="text/javascript"></script>



<!--[if IE 8]>
<link rel="stylesheet" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/941/web-gallery/static/styles/ie8.css" type="text/css" />
<![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/941/web-gallery/static/styles/ie.css" type="text/css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/941/web-gallery/static/styles/ie6.css" type="text/css" />
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/941/web-gallery/static/js/pngfix.js" type="text/javascript"></script>
<script type="text/javascript">
try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
</script>

<style type="text/css">
body { behavior: url(/js/csshover.htc); }
</style>
<![endif]-->
<style>
.alert{padding:15px;margin-bottom:20px;border:1px solid transparent;border-radius:4px}.alert h4{margin-top:0;color:inherit}.alert .alert-link{font-weight:700}.alert>p,.alert>ul{margin-bottom:0}.alert>p+p{margin-top:5px}.alert-dismissable,.alert-dismissible{padding-right:35px}.alert-dismissable .close,.alert-dismissible .close{position:relative;top:-2px;right:-21px;color:inherit}.alert-success{color:#3c763d;background-color:#dff0d8;border-color:#d6e9c6}.alert-success hr{border-top-color:#c9e2b3}.alert-success .alert-link{color:#2b542c}.alert-info{color:#31708f;background-color:#d9edf7;border-color:#bce8f1}.alert-info hr{border-top-color:#a6e1ec}.alert-info .alert-link{color:#245269}.alert-warning{color:#8a6d3b;background-color:#fcf8e3;border-color:#faebcc}.alert-warning hr{border-top-color:#f7e1b5}.alert-warning .alert-link{color:#66512c}.alert-danger{color:#a94442;background-color:#f2dede;border-color:#ebccd1}.alert-danger hr{border-top-color:#e4b9c0}.alert-danger .alert-link{color:#843534}
</style>
<meta name="build" content="63-BUILD1228 - 27.03.2012 12:15 - com" />
<meta name="clubbo_build" content="PRODUCTION_VERSION__ID__82719847192386497123976" />
</head>


<body id="profile">
<?php
          if (isset($_GET['error'])) {
            if (isset($_SESSION['account_error'])) {
              echo '
	              <div class="alert alert-dismissible alert-danger" style="margin-bottom:0;border-radius:0px;background-color:#c0392b;border-color:#e74c3c;color:#fff;">
                  <center><strong>Updating account failed!</strong> ' . $_SESSION['account_error'] . '</center>
                </div>
              ';
              unset($_SESSION['account_error']);
            }
          }
          if (isset($_GET['success'])) {
	          if (isset($_SESSION['account_success'])) {
              echo '
                <div class="alert alert-dismissible alert-success" style="margin-bottom:0;border-radius:0px;background-color:#27ae60;border-color:#2ecc71;color:#fff;">
                  <center><strong>Updating account success!</strong> ' . $_SESSION['account_success'] . '</center>
                </div>
	            ';
              unset($_SESSION['account_success']);
            }
          }
          ?>
        <div id="overlay"></div>
        <div id="header-container">
            <div id="header" class="clearfix">
                <h1><a href="https://clubbohotel.co.uk/"></a></h1>
                <div id="subnavi">
                    <div id="subnavi-user">
                                           <div style="margin-top:7px"><b>Fact:</b> <script language="JavaScript">


var r_text = new Array ();


r_text[0] = "Telling your friends about Clubbo will make it even more fun!";
r_text[1] = "Clubbo Hotel strives to remain as professional as possible.";
r_text[2] = "Clubbo Hotel will only keep on growing if you vote daily!";
r_text[3] = "You can buy VIP to help cover our server bills, and gain lots of rewards!";
r_text[4] = "Clubbo Hotel staff loves you!";

var i = Math.floor(5*Math.random())





document.write(r_text[i]);





</script>
</div>
                    </div>
                    <div id="subnavi-search">
                        <div id="subnavi-search-upper">
                            <ul id="subnavi-search-links">
                                <li><a href="..//logout" style="color:#000">Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="to-hotel">
                        <a href="..//api.php" class="new-button green-button" target="eac955c8dbc88172421193892a3e98fc7402021a" onclick="HabboClient.openOrFocus(this); return false;"><b>Enter Clubbo Hotel</b><i></i></a>
                    </div>
                </div>
                <ul id="navi">
                    <li class="selected"><a href="../dashboard"><?php echo e($username); ?> <img src="https://clubbohotel.co.uk/app/tpl/skins/Habbo/images/id.png" style="vertical-align: middle;"></a><span></span></li>
                    <li><a href="../community">Community</a><span></span></li>
					<li><a href="../badgeshop">BadgeShop</a><span></span></li>
					
					<li><a href="../values">Rare Values</a><span></span></li>
					<li><a href="../vip">VIP</a><span></span></li>
					<?php if ($logged_config['hk'] == 1 && $logged_config['hk_min_rank'] <= $rank) { ?>
										<li><a href="..//hk_access/auth">Housekeeping</a><span></span></li>
					

					<?php } ?>
                </ul>
                <div id="habbos-online"><div class="" style="border-radius:6px;"><span style="border-radius:6px;"><?php echo $online_num; ?> Online</span></div></div>
            </div>
        </div>
        <div id="content-container">
            <div id="navi2-container" class="pngbg">
                <div id="navi2" class="pngbg clearfix">
                    <ul>
                        <li class=" "><a href="../dashboard">Home</a></li>
                        <li class=" selected last">Account Settings</li>
                    </ul>
                </div>
            </div>
<div class="habblet-container" style="position: relative; left: 0px; top: 0px; width: 83%;"

<div id="habboclub-info" class="box-content">

</div>
</div>
</div>
            <div id="container">
                <div id="content" style="position: relative" class="clearfix">
                    <div>
                        <div class="content">
                            <div class="habblet-container" style="float:left; width:210px;">
                                <div class="cbb settings">
                                    <h2 class="title">Account Settings</h2>
                                    <div class="box-content">
                                        <div id="settingsNavigation">
                                            <ul>
                                                <li class="selected">My Account</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="habblet-container " style="float:left; width: 560px;">
                                <div class="cbb clearfix settings">
                                    <h2 class="title">Change your profile</h2>
                                    <div class="box-content">
                                        <form method="post" action="../application/process.php">
                                            <h3>Your motto</h3>
                                            <p>Your motto is what other users will see on your Clubbo Home page and when clicking your user in the Hotel.</p>
                                            <p><label>Motto: <input type="text"  name="acc_motto" size="32" maxlength="32" value="<?php echo e($motto); ?>" id="avatarmotto"></label></p>
                                            <h3>Your email address</h3>
                                            <p>Your email address is what you may need to reset your password incase you forget it.</p>
                                            <p><label>Email: <input type="text" name="acc_email" size="32" value="<?php echo e($users_email); ?>" id="avatarmotto"></p>
																						<h3>Current Password</h3>
                                            <p>Your current password is the password you use to login to the main website. Only fill this in if you wish to change your login password. <b>Must</b> be more than 7 letters/numbers.</p>
                                            <p><label>Password: <input type="password"  name="acc_old_password" value="" id="avatarmotto"></p>
                                            <h3>New Password</h3>
                                            <p>Please only change this field if you wish to change your login password.</p>
                                            <p><label>New Password: <input type="password" name="acc_new_password" value="" id="avatarmotto"></p>
																						<br />
																						<?php if ($google_config['recaptcha_required'] == 1) { ?>

                    <div class="g-recaptcha" id="check" data-sitekey="<?php echo $google_config['recap_site_key']; ?>"></div>

								<?php } ?>
                                            <br /><br />
																						<div class="settings-buttons">
                                                <input type="submit" value="Save changes" name="btn-account" class="submit" style="float:right">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    document.observe('dom:loaded', function() {
                        CurrentRoomEvents.init();
                    });
                </script>
								<script src='https://www.google.com/recaptcha/api.js'></script>
            </div>
            <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
            <script type="text/javascript">
                HabboView.run();
            </script>
            <!--[if lt IE 7]>
               <script type="text/javascript">
                    Pngfix.doPngImageFix();
                </script>
            <![endif]-->
        </div>
        
                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/libs/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<div id="footer">
<a href="..//privacy_policy.php" target="_new">Privacy Policy</a>  |
        <a href="../community" target="_new">Community</a> |
        <a href="../api.php">Client</a></div>
    </body>
</html>
