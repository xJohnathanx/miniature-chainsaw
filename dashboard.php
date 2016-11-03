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
$stmt = $mysqli->prepare("SELECT rank, look, motto, last_online FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 1) {
  $stmt->bind_result($rank, $look, $motto, $last_online);
  $stmt->fetch();
} else {
  $rank = '';
}
$stmt->close();

$user_id = $_SESSION['id'];

$query = "SELECT title, id, published, shortstory, image FROM cms_news ORDER BY id DESC LIMIT 5";

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
        <title>Clubbo - Home - <?php echo e($username); ?></title>
        
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
				<style>
.alert{padding:15px;margin-bottom:20px;border:1px solid transparent;border-radius:4px}.alert h4{margin-top:0;color:inherit}.alert .alert-link{font-weight:700}.alert>p,.alert>ul{margin-bottom:0}.alert>p+p{margin-top:5px}.alert-dismissable,.alert-dismissible{padding-right:35px}.alert-dismissable .close,.alert-dismissible .close{position:relative;top:-2px;right:-21px;color:inherit}.alert-success{color:#3c763d;background-color:#dff0d8;border-color:#d6e9c6}.alert-success hr{border-top-color:#c9e2b3}.alert-success .alert-link{color:#2b542c}.alert-info{color:#31708f;background-color:#d9edf7;border-color:#bce8f1}.alert-info hr{border-top-color:#a6e1ec}.alert-info .alert-link{color:#245269}.alert-warning{color:#8a6d3b;background-color:#fcf8e3;border-color:#faebcc}.alert-warning hr{border-top-color:#f7e1b5}.alert-warning .alert-link{color:#66512c}.alert-danger{color:#a94442;background-color:#f2dede;border-color:#ebccd1}.alert-danger hr{border-top-color:#e4b9c0}.alert-danger .alert-link{color:#843534}
</style>
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
<meta name="build" content="63-BUILD1228 - 27.03.2012 12:15 - com" />
<meta name="clubbo_build" content="PRODUCTION_VERSION__ID__82719847192386497123976" />
</head>
<body id="home">
<?php
          if (isset($_GET['error'])) {
            if (isset($_SESSION['vip_error'])) {
              echo '
	              <div class="alert alert-dismissible alert-danger" style="margin-bottom:0;border-radius:0px;background-color:#c0392b;border-color:#e74c3c;color:#fff;">
                  <center><strong>VIP Disabled!</strong> ' . $_SESSION['vip_error'] . '</center>
                </div>
              ';
              unset($_SESSION['vip_error']);
            }
          }
					
					if (isset($_GET['values_error'])) {
            if (isset($_SESSION['values_error'])) {
              echo '
	              <div class="alert alert-dismissible alert-danger" style="margin-bottom:0;border-radius:0px;background-color:#c0392b;border-color:#e74c3c;color:#fff;">
                  <center><strong>Value Disabled!</strong> ' . $_SESSION['values_error'] . '</center>
                </div>
              ';
              unset($_SESSION['values_error']);
            }
          }
					
					if (isset($_GET['badgeshop_error'])) {
            if (isset($_SESSION['badgeshop_error'])) {
              echo '
	              <div class="alert alert-dismissible alert-danger" style="margin-bottom:0;border-radius:0px;background-color:#c0392b;border-color:#e74c3c;color:#fff;">
                  <center><strong>BadgeShop Error!</strong> ' . $_SESSION['badgeshop_error'] . '</center>
                </div>
              ';
              unset($_SESSION['dadgeshop_error']);
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
                                <li><a href="../logout" style="color:#000">Sign Out</a></li>
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
                        <li class="selected">Home</li>
						
                        <li class=" last"><a href="../account">Account Settings</a></li>
				
                </div>
            </div>

<div id="container">

	<div id="content" style="position: relative" class="clearfix">
	
    <div id="wide-personal-info">

<div id="habbo-plate">

            <a href="https://clubbohotel.co.uk/me">

            <img alt="<?php echo e($username); ?>" src="https://www.habbo.nl/habbo-imaging/avatarimage?figure=<?php echo $look; ?>&direction=2999995&head_direction=3&gesture=sml">


        </a>

    </div>



  <div id="name-box" class="info-box">

        <div class="label">Name:</div>

        <div class="content"><?php echo e($username); ?></div>

    </div>

    <div id="motto-box" class="info-box">

        <div class="label">Motto:</div>

        <div class="content"><?php echo e($motto); ?></div>

    </div>

    <div id="last-logged-in-box" class="info-box">

        <div class="label">Last signed in:</div>

        <div class="content"><?php echo date('M j, Y H:i:s A', $last_online); ?></div>

    </div>



<div class="enter-hotel-btn">
    <div class="open enter-btn">
            <a href="..//api.php" target="84ebd05b9eac6717671e77c01c6209a4c8e06d54" onclick="HabboClient.openOrFocus(this); return false;">Enter Clubbo Hotel<i></i></a>
        <b></b>
    </div>
</div>


</div>
<div id="column1" class="column">

					 
				
				
					<div class="habblet-container ">


<div class="cbb clearfix green ">
<h2 class="title">What's going on?</h2>
<div id="hotcampaigns-habblet-list-container">
<ul id="hotcampaigns-habblet-list">
<li class="even">
<div class="hotcampaign-container">
<a href="http://www.facebook.com/EpicHosts">
<img src="https://clubbohotel.co.uk/app/tpl/skins/Habbo/images/facebookconnect.gif" align="left" alt="Join us on Facebook" /></a>
<h3>Join us on Facebook</h3>
<p>Like us on Facebook for all the gossip, news and updates!</p>
<p class="link"><a href="http://www.facebook.com/EpicHosts">Go there &raquo;</a></p>
</div>
</li> <li class="odd">
<div class="hotcampaign-container">
<a href="/vip">
<img src="https://clubbohotel.co.uk/app/tpl/skins/Habbo/images/wcn0up.png" align="left" alt="Buy VIP and coins" /></a>
<h3>Buy Clubbo VIP!</h3>
<p>Buy VIP today and get loads of cool features added to your account!</p>
<p class="link"><a href="VIP">Go there &raquo;</a></p>
</div>
</li> </ul>


</div>
</div>
</div>
<div class="habblet-container "> 

<div class="cbb clearfix blue ">

 <h2 class="title">Clubbo FM! </h2>
 <center>
 <a class="title" href="http://clubbohotel.caster.fm" target="_blank"><img src="https://habbox.com/text/101/Radio" /></a>
</center></div>

<div>

<div id="notfound-content" class="box-content"> <center> 


<div id="cstrpdiv"></div>

</div>
                     </center></a>
					 </div>
					
					 </div>
					 
					<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
                    </div>
                    <div id="column2" class="column">
                        <div class="habblet-container "></div>
                        <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
                        <div class="habblet-container news-promo">		
                            <div class="cbb clearfix notitle ">
                                <div id="newspromo">
                                    <div id="topstories">
																		<?php
																		
																		$query = "SELECT title, id, published, shortstory, image FROM cms_news ORDER BY id DESC LIMIT 5";
																		$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->store_result();

  $stmt->bind_result($news_title, $news_id, $news_published, $news_shortstory, $news_image);
	$x = 0;
  while ($stmt->fetch()) {
		$add_info = '';
		if ($x != 0) {
			$add_info .= 'display:none;';
		} else {
			$add_info .= '';
		}
		
		echo '
		  
		  <div class="topstory" style="background-image: url(../../game/c_images/Top_Story_Images/' . $news_image . ';' . $add_info . '">
                                            <h4>Latest news</h4>
                                            <h3><a href="../news/?id=' . $news_id . '">' . $news_title . '</a></h3>
                                            <p class="summary">
                                                ' . $news_shortstory . '
                                            </p>
                                            <p>
                                                <a href="../news/?id=' . $news_id . '">Read more &raquo;</a>
                                            </p>
                                        </div>
		
		';
		$x++;
	}
	
$stmt->close();
																		
																		?>
                                        
                                        
                                        <div id="topstories-nav" style="display: none"><a href="#" class="prev">&laquo; Previous</a><span>1</span> / 5<a href="#" class="next">Next &raquo;</a></div>
                                    </div>
                                    <ul class="widelist">
                                        <li class="last"><a href="../news">More news &raquo;</a></li>            
                                    </ul>
                                </div>
                                <script type="text/javascript">
                                    document.observe("dom:loaded", function() { NewsPromo.init(); });
                                </script>
                            </div>
                        </div>
						
					

				
				
				
					 
					 
					 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
			 

			     						
				
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
				
				
				
				
			 

</div>
<!--[if lt IE 7]>
<script type="text/javascript">
Pngfix.doPngImageFix();
</script>
<![endif]-->
    </div>
			 
<div id="footer">
<a href="..//privacy_policy.php" target="_new">Privacy Policy</a>  |
        <a href="../community" target="_new">Community</a> |
        <a href="..//api.php">Client</a>
</div>

  </body>
</html>
