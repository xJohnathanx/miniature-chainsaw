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
        <title>Clubbo - Rules - <?php echo e($username); ?></title>
        
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
                        <li><a href="..//staff">Staff</a></li>
						<li class="class"><a href="../rules"><font color="red"><strong>Hotel Rules</strong></font></a></li>
						
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

<div class="cbb clearfix green ">

<h2 class="title">Rules <small>(aka Clubbo Policy)</small></h2>

<div id="notfound-content" class="box-content"> <center> 
<FONT COLOR="green"><span style="font-weight:bold;">Hello There!</span></FONT> 
<br><br>

 Welcome to the rules of Clubbo! Here at Clubbo we try our best to develop the community to be not only fun but safe at the same time. Here are our rules to avoid you from being sanctioned. 

<br><br>
<FONT COLOR="red"><span style="font-weight:bold;">Rule #1:</span></FONT>  Never threaten a staff member or member of the Clubbo Community 
<br><br>
Failure to follow this rule can result in disciplinary consequences, which include three warnings, then a 24 hour ban. Continue to break the rule each time you’re banned for 24 hours, will result in a permanent ban.
<br><br>

<FONT COLOR="red"><span style="font-weight:bold;">Rule #2:</span></FONT> Inappropriate Actions Or Requests 
<br><br>
Here at Clubbo we want to make sure that our members are feeling comfortable at all times while they spend their time on the hotel. Therefore, if any member is caught requesting inappropriate actions or requests such as (i.e Nude Pictures, Webcam, etc), this rule can result in three warnings then a 48 hour ban. 
<br><br>

<FONT COLOR="red"><span style="font-weight:bold;">Rule #3:</span></FONT> Scamming 
<br><br>
Scamming on Clubbo Hotel is not permitted, if you’re caught scamming, we will remove the furniture from you’re account manually. However, if you see scamming is happening, it is best that you have screenshots and be prepared to show our moderation staff as proof. 

<br><br>
<FONT COLOR="red"><span style="font-weight:bold;">Rule #4:</span></FONT> Hacking 
<br><br>
Although this is almost impossible, and we are gradually improving our system more and more every day on Clubbo; do not even attempt it. Each individual account is secure, and encrypted. If you have taken over another person's account, and you are caught - you will be IP banned from Clubbo. You will not be allowed back under any circumstances. If someone gives you the password to their account, it is best that you alert a moderator immediately! If you are found to be using any cheats or hacks, like duping tricks and you are teaching others - you will be banned permanently.
<br><br>


<FONT COLOR="red"><span style="font-weight:bold;">Rule #5:</span></FONT> User Harassment 
<br><br>
Here on Clubbo we do not tolerate user harassment and you will receive an automatic ban for 24 hours if caught by the moderation team. This means that you must keep in mind that there are people with other religions, views, genders, and races playing on our hotel. Be friendly and enjoy the game! Failure to follow this rule will result in two warnings, then a 48 hour ban from the hotel. 
<br><br>
<FONT COLOR="red"><span style="font-weight:bold;">Rule #6:</span></FONT> Report System Abuse 
<br><br>
You may not abuse the report system by reporting an Clubbo user multiple times and reporting useless actions or words in addition to, how to make a room or he said / she said. We need concrete proof before you make a report. Failure to follow this rule will result in three warnings, then a 24 hour ban. 
<br><br>

<FONT COLOR="red"><span style="font-weight:bold;">Rule #7:</span></FONT> Trans-Hotel Trading 
<br><br>
According to this rule you may not trade Clubbo in-game items for items on another server and vice-versa. You also may not sell items for real money that you have on Clubbo. If you are caught by our staff, you will receive an IP ban from Clubbo. 

<br><br>
<FONT COLOR="red"><span style="font-weight:bold;">Rule #8:</span></FONT> Racist Comments/Remarks
<br><br>
Racial comments on Clubbo to offend another user will be dealt seriously and a ban of 3 days if directly hurt/upset another user. If you get reported to us you will face major consequences by Clubbo Staff Team.
<br><br>
<FONT COLOR="red"><span style="font-weight:bold;">Rule #9:</span></FONT> PayPal Disputes
<br><br>
Disputing a VIP payment on PayPal to receive your money back? You will automatically receive a permanent ban from Clubbo. This may cause you being either IP-Banned or account permanently banned till we receive our payment back you will not be allowed to be apart of Clubbo's community.
<br><br>
<FONT COLOR="red"><span style="font-weight:bold;">Rule #10:</span></FONT> Asking or bugging a staff member?
<br><br>
Do not ask lots of questions to the staff management or to the owners. They have a lot of work to do. If you want to ask questions, ask once. Do not repeat yourself over and over again. This will annoy the staff member and cause for you to be banned for as minimum as 1-2 hours. Staff team nor Owners have the time to answer questions that has been asked more than 3 times. 
<br><br>

<br><br>

<FONT COLOR="red"><span style="font-weight:bold;">STAFF - WISE:</span></FONT>
<br><br>
If you are a staff member. Remember that you only get the things that the owner of Clubbo has given you. If you ask for stuff you will be removed from the staff team. Asking for a catalogue or more commands will de-rank you back to rank 1 (free vip). I hope you understand what may happen if you ask for more than what you get. You will not be given it nor will be on the staff team anymore. Thanks for reading our Rules.
<br><br><b>Clubbo Administration, Reserves The Right To Change Rules & Regulations At Any Given Time.</b></div>
                     </center></a>
					 </div>
					
					</div>
					<div class="habblet-container ">
</div>
 <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
                    </div>

<div id="column2" class="column">                         <div class="habblet-container "><div class="cbb clearfix red"><h2 class="title">Report Abuse to Us!</h2><center><br><img src="../../app/tpl/skins/habbo/images/figure.gif"><br><br><b>Is a Clubbo member breaking the rules?</b><br>Don't take matters into your own hands!<br>Report the member to one of our staff members and get respect.<br><br></div>
                    
							
		
		

		
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
<a href="/privacy_policy.php" target="_new">Privacy Policy</a>  |
        <a href="/community" target="_new">Community</a> |
        <a href="/api.php">Client</a>
</div>
    </body>