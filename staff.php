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
        <title>Clubbo - Staff List - <?php echo e($username); ?></title>
        
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

<body id="home">
    
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
                    <li><a href="../dashboard"><?php echo e($username); ?> <img src="https://clubbohotel.co.uk/app/tpl/skins/Habbo/images/id.png" style="vertical-align: middle;"></a><span></span></li>
                    <li class="selected"><a href="../community">Community</a><span></span></li>
					<li><a href="../badgeshop">BadgeShop</a><span></span></li>
					
					<li><a href="../values">Rare Values</a><span></span></li>
					<li><a href="../vip">VIP</a><span></span></li>
					<?php if ($logged_config['hk'] == 1 && $logged_config['hk_min_rank'] <= $rank) { ?>
										<li><a href="..//hk_access/auth">Housekeeping</a><span></span></li>
					

					<?php } ?>
                </ul>
					                <div id="habbos-online">
													<div class="" style="border-radius:6px;"><span style="border-radius:6px;"><?php echo $online_num; ?> Online</span></div></div>
            </div>
        </div>
        <div id="content-container">
            <div id="navi2-container" class="pngbg">
                <div id="navi2" class="pngbg clearfix">
                    <ul>
                        <li><a href="..//community">Community</a></li>
                        <li><a href="..//news">News</a></li>
                        <li class="selected"><a href="..//staff">Staff</a></li>
						<li class=" last"><a href="..//rules"><font color="red"><strong>Hotel Rules</strong></font></a></li>
						
                    </ul>
                </div>
            </div>
			
			
			<div id="container">


</div>
</div>
</div>
            <div id="container">
                <div id="content" style="position: relative" class="clearfix">
                    <div id="column1" class="column">
                        <div class="habblet-container ">
												<div class="cbb clearfix pixeldarkblue ">
												<h2 class="title">Owners</h2>
												<div style="padding:5px">
												<?php
																		
																		$query = "SELECT username, motto, look, last_online, online FROM users WHERE rank = 9";
																		$stmt = $mysqli->prepare($query);
																		
																		$stmt->execute();
$stmt->store_result();

  $stmt->bind_result($staff9_username, $staff9_motto, $staff9_look, $staff9_last_online, $staff9_online);
  while ($stmt->fetch()) {
		echo '
		  <p>
			<img style="position:absolute;" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $staff9_look . '&action=wav&direction=2&head_direction=3&gesture=srp&size=m">
			
			<p style="margin-left:80px;margin-top:20px;">Username: <strong>' . $staff9_username . '</strong><br>Motto: <strong>' . $staff9_motto . '</strong><br><small>Last Online: ' . date("D, d F Y H:i (P)", $staff9_last_online) . '</small></p><p style="float:right;margin-top:-30px;margin-right:5px;"><br><br>
			';
			if ($staff9_online == '0') {
				echo '<font color="darkred"><b>Offline</b></font></p><br><br><br>';
			} else {
				echo '<font color="lightgreen"><b>Online</b></font></p><br><br><br>';
			}
	}
	
$stmt->close();
																		
																		?>
																		</div></div></div>
																		
																		<div class="habblet-container ">
												<div class="cbb clearfix green ">
												<h2 class="title">Co-Owners</h2>
												<div style="padding:5px">
												<?php
																		
																		$query = "SELECT username, motto, look, last_online, online FROM users WHERE rank = 8";
																		$stmt = $mysqli->prepare($query);
																		
																		$stmt->execute();
$stmt->store_result();

  $stmt->bind_result($staff9_username, $staff9_motto, $staff9_look, $staff9_last_online, $staff9_online);
  while ($stmt->fetch()) {
		echo '
		  <p>
			<img style="position:absolute;" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $staff9_look . '&action=wav&direction=2&head_direction=3&gesture=srp&size=m">
			
			<p style="margin-left:80px;margin-top:20px;">Username: <strong>' . $staff9_username . '</strong><br>Motto: <strong>' . $staff9_motto . '</strong><br><small>Last Online: ' . date("D, d F Y H:i (P)", $staff9_last_online) . '</small></p><p style="float:right;margin-top:-30px;margin-right:5px;"><br><br>
			';
			if ($staff9_online == '0') {
				echo '<font color="darkred"><b>Offline</b></font></p><br><br><br>';
			} else {
				echo '<font color="lightgreen"><b>Online</b></font></p><br><br><br>';
			}
	}
	
$stmt->close();
																		
																		?>
																		</div></div></div>
																		
																		<div class="habblet-container ">
												<div class="cbb clearfix orange ">
												<h2 class="title">Developers</h2>
												<div style="padding:5px">
												<?php
																		
																		$query = "SELECT username, motto, look, last_online, online FROM users WHERE rank = 7";
																		$stmt = $mysqli->prepare($query);
																		
																		$stmt->execute();
$stmt->store_result();

  $stmt->bind_result($staff9_username, $staff9_motto, $staff9_look, $staff9_last_online, $staff9_online);
  while ($stmt->fetch()) {
		echo '
		  <p>
			<img style="position:absolute;" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $staff9_look . '&action=wav&direction=2&head_direction=3&gesture=srp&size=m">
			
			<p style="margin-left:80px;margin-top:20px;">Username: <strong>' . $staff9_username . '</strong><br>Motto: <strong>' . $staff9_motto . '</strong><br><small>Last Online: ' . date("D, d F Y H:i (P)", $staff9_last_online) . '</small></p><p style="float:right;margin-top:-30px;margin-right:5px;"><br><br>
			';
			if ($staff9_online == '0') {
				echo '<font color="darkred"><b>Offline</b></font></p><br><br><br>';
			} else {
				echo '<font color="lightgreen"><b>Online</b></font></p><br><br><br>';
			}
	}
	
$stmt->close();
																		
																		?>
																		</div></div></div>
																		
																		<div class="habblet-container ">
												<div class="cbb clearfix settings ">
												<h2 class="title">Managers</h2>
												<div style="padding:5px">
												<?php
																		
																		$query = "SELECT username, motto, look, last_online, online FROM users WHERE rank = 6";
																		$stmt = $mysqli->prepare($query);
																		
																		$stmt->execute();
$stmt->store_result();

  $stmt->bind_result($staff9_username, $staff9_motto, $staff9_look, $staff9_last_online, $staff9_online);
  while ($stmt->fetch()) {
		echo '
		  <p>
			<img style="position:absolute;" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $staff9_look . '&action=wav&direction=2&head_direction=3&gesture=srp&size=m">
			
			<p style="margin-left:80px;margin-top:20px;">Username: <strong>' . $staff9_username . '</strong><br>Motto: <strong>' . $staff9_motto . '</strong><br><small>Last Online: ' . date("D, d F Y H:i (P)", $staff9_last_online) . '</small></p><p style="float:right;margin-top:-30px;margin-right:5px;"><br><br>
			';
			if ($staff9_online == '0') {
				echo '<font color="darkred"><b>Offline</b></font></p><br><br><br>';
			} else {
				echo '<font color="lightgreen"><b>Online</b></font></p><br><br><br>';
			}
	}
	
$stmt->close();
																		
																		?>
																		</div></div></div>
																		
																		<div class="habblet-container ">
												<div class="cbb clearfix pixellightblue ">
												<h2 class="title">Admins</h2>
												<div style="padding:5px">
												<?php
																		
																		$query = "SELECT username, motto, look, last_online, online FROM users WHERE rank = 5";
																		$stmt = $mysqli->prepare($query);
																		
																		$stmt->execute();
$stmt->store_result();

  $stmt->bind_result($staff9_username, $staff9_motto, $staff9_look, $staff9_last_online, $staff9_online);
  while ($stmt->fetch()) {
		echo '
		  <p>
			<img style="position:absolute;" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $staff9_look . '&action=wav&direction=2&head_direction=3&gesture=srp&size=m">
			
			<p style="margin-left:80px;margin-top:20px;">Username: <strong>' . $staff9_username . '</strong><br>Motto: <strong>' . $staff9_motto . '</strong><br><small>Last Online: ' . date("D, d F Y H:i (P)", $staff9_last_online) . '</small></p><p style="float:right;margin-top:-30px;margin-right:5px;"><br><br>
			';
			if ($staff9_online == '0') {
				echo '<font color="darkred"><b>Offline</b></font></p><br><br><br>';
			} else {
				echo '<font color="lightgreen"><b>Online</b></font></p><br><br><br>';
			}
	}
	
$stmt->close();
																		
																		?>
																		</div></div></div>
																		
																		<div class="habblet-container ">
												<div class="cbb clearfix blue">
												<h2 class="title">Senior Moderators</h2>
												<div style="padding:5px">
												<?php
																		
																		$query = "SELECT username, motto, look, last_online, online FROM users WHERE rank = 4";
																		$stmt = $mysqli->prepare($query);
																		
																		$stmt->execute();
$stmt->store_result();

  $stmt->bind_result($staff9_username, $staff9_motto, $staff9_look, $staff9_last_online, $staff9_online);
  while ($stmt->fetch()) {
		echo '
		  <p>
			<img style="position:absolute;" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $staff9_look . '&action=wav&direction=2&head_direction=3&gesture=srp&size=m">
			
			<p style="margin-left:80px;margin-top:20px;">Username: <strong>' . $staff9_username . '</strong><br>Motto: <strong>' . $staff9_motto . '</strong><br><small>Last Online: ' . date("D, d F Y H:i (P)", $staff9_last_online) . '</small></p><p style="float:right;margin-top:-30px;margin-right:5px;"><br><br>
			';
			if ($staff9_online == '0') {
				echo '<font color="darkred"><b>Offline</b></font></p><br><br><br>';
			} else {
				echo '<font color="lightgreen"><b>Online</b></font></p><br><br><br>';
			}
	}
	
$stmt->close();
																		
																		?>
																		</div></div></div>
																		
																		<div class="habblet-container ">
												<div class="cbb clearfix brown ">
												<h2 class="title" >Moderators</h2>
												<div style="padding:5px">
												<?php
																		
																		$query = "SELECT username, motto, look, last_online, online FROM users WHERE rank = 3";
																		$stmt = $mysqli->prepare($query);
																		
																		$stmt->execute();
$stmt->store_result();

  $stmt->bind_result($staff9_username, $staff9_motto, $staff9_look, $staff9_last_online, $staff9_online);
  while ($stmt->fetch()) {
		echo '
		  <p>
			<img style="position:absolute;" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $staff9_look . '&action=wav&direction=2&head_direction=3&gesture=srp&size=m">
			
			<p style="margin-left:80px;margin-top:20px;">Username: <strong>' . $staff9_username . '</strong><br>Motto: <strong>' . $staff9_motto . '</strong><br><small>Last Online: ' . date("D, d F Y H:i (P)", $staff9_last_online) . '</small></p><p style="float:right;margin-top:-30px;margin-right:5px;"><br><br>
			';
			if ($staff9_online == '0') {
				echo '<font color="darkred"><b>Offline</b></font></p><br><br><br>';
			} else {
				echo '<b><marquee width=48 behavior=alternate><font color=darkgreen>Online</font></marquee></b></p><br><br><br>';
			}
	}
	
$stmt->close();
																		
																		?>
																		</div></div></div>
																		
																		<div class="habblet-container ">
												<div class="cbb clearfix orange ">
												<h2 class="title" style="background-color:#ffbf80;">T-Moderators</h2>
												<div style="padding:5px">
												<?php
																		
																		$query = "SELECT username, motto, look, last_online, online FROM users WHERE rank = 2";
																		$stmt = $mysqli->prepare($query);
																		
																		$stmt->execute();
$stmt->store_result();

  $stmt->bind_result($staff9_username, $staff9_motto, $staff9_look, $staff9_last_online, $staff9_online);
  while ($stmt->fetch()) {
		echo '
		  <p>
			<img style="position:absolute;" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $staff9_look . '&action=wav&direction=2&head_direction=3&gesture=srp&size=m">
			
			<p style="margin-left:80px;margin-top:20px;">Username: <strong>' . $staff9_username . '</strong><br>Motto: <strong>' . $staff9_motto . '</strong><br><small>Last Online: ' . date("D, d F Y H:i (P)", $staff9_last_online) . '</small></p><p style="float:right;margin-top:-30px;margin-right:5px;"><br><br>
			';
			if ($staff9_online == '0') {
				echo '<font color="darkred"><b>Offline</b></font></p><br><br><br>';
			} else {
				echo '<font color="lightgreen"><b>Online</b></font></p><br><br><br>';
			}
	}
	
$stmt->close();
																		
																		?>
																		</div></div></div>
																		
																		
																		
												
												</div>

<div id="column2" class="column">                         <div class="habblet-container "><div class="cbb clearfix red"><h2 class="title">Staff Needed</h2><center><img src="http://www.habbo.com/habbo-imaging/avatarimage?user=hlrules&action=drk=33&direction=4&head_direction=3&gesture=sml&size=1"><br><br><b>Us at Clubbo are looking for Staff!</b><br>Get in contact with one of our team for an application.<br><br></div>
                    
							
		
		

		
        <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
        <script type="text/javascript">
            HabboView.run();
        </script>

        <!--[if lt IE 7]>
            <script type="text/javascript">
                Pngfix.doPngImageFix();
            </script>
        <![endif]-->
        
       
    </body>
</html>
</div></div></div>
<div id="footer">
<a href="..//privacy_policy.php" target="_new">Privacy Policy</a>  |

        <a href="../community" target="_new">Community</a> |
        <a href="..//api.php">Client</a></div>
    </body>
