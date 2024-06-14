<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);
	
        include("GameEngine/Village.php");
        $start = $generator->pageLoadTimeStart();
        if(isset($_GET['newdid'])) {
            $_SESSION['wid'] = $_GET['newdid'];
            header("Location: ".$_SERVER['PHP_SELF']);
        }
    
?>
<!DOCTYPE html>
<html>
    <head>
        
        <title><?php echo SERVER_NAME ?></title>
        <link rel="shortcut icon" href="favicon.ico" />
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="imagetoolbar" content="no" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <script src="mt-full.js?0faaa" type="text/javascript"></script>
        <script src="unx.js?0faaa" type="text/javascript"></script>
        <script src="new.js?0faaa" type="text/javascript"></script>
        <link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7c" rel="stylesheet" type="text/css" />
        <link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7c" rel="stylesheet" type="text/css" />
        <?php
            if($session->gpack == null || GP_ENABLE == false) {
            echo "
            <link href='".GP_LOCATE."travian.css?e21d2' rel='stylesheet' type='text/css' />
            <link href='".GP_LOCATE."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
            } else {
            echo "
            <link href='".$session->gpack."travian.css?e21d2' rel='stylesheet' type='text/css' />
            <link href='".$session->gpack."lang/en/lang.css?e21d2' rel='stylesheet' type='text/css' />";
            }
        ?>
        <script type="text/javascript">
            window.addEvent('domready', start);
        </script>
    </head>


    <body class="v35 ie ie8">
        <div class="wrapper">
            <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
            <div id="dynamic_header">
            </div>
            <?php include("Templates/header.tpl"); ?>
            <div id="mid">
                <?php include("Templates/menu.tpl"); ?>
                <div id="content" class="village2">
                    <?php //include("Templates/rules.tpl"); ?>
                    <center>
                        <span style="font-size:  80px;">Vote<span style="font-size:  125px; color:  red;">4</span>Gold</span>
                    <br />
                    <div style="height: 5px; background: red; width:  300px;"></div>
                    <br />                    
                        <a href="http://www.mmorpgprivateserver.com/Travian-Private-Server/?v=Hoxer&incentive=<? echo $session->username; ?>" title="Travian Private Server" rev="vote-for" rel="directory" target="_blank"><img src="http://www.mmorpgprivateserver.com/Travian-Private-Server.gif" alt="" /></a><noscript><a href="http://www.mmorpgprivateserver.com/" title="" rev="vote-for" rel="tag directory"></a><a href="http://www.mmorpgprivateserver.com/Travian-Private-Server/" title="Travian" rev="vote-for" rel="tag directory">Travian Private Server</a></noscript><!-- End MmorpgPrivateServer voting code -->                    
                    <br />
                        <span style="color:  rgba(0,0,0,0.3)">Click on the image above to vote!</span>
                        <br />
                        <br />
                    <div style="height: 5px; background: red; width:  300px;"></div>
                    <br />
                    Voting will award you with 25 gold.

                    </center>
                    <?
                        ###################################################################################################################
                        // VOTE (CREATED BY HOXER PLEASE LEAK VOTE.PHP WITHOUT IT IF U DO
                        // LOL JK IF U LEAK ILL KILL U)
                        
                        // SQL STUFF
								$uservoted = $_GET['u'];
                                $currentuser = $session->username;
                                $addgold = "UPDATE s1_users SET gold = gold + 25 WHERE username = '$uservoted'";
                                $setvoted = "UPDATE s1_users SET voted = 1 WHERE username = '$uservoted'";
                                $checkvoted = "SELECT voted FROM s1_users WHERE username = '$currentuser'";
                                ####
                                //$didvote = mysql_query($checkvoted);
                                //$didvoteresult = mysql_fetch_array($didvote);
                                ####                                               
                            // CHECK IF USER OR IPN
                                if(isset($_GET['u']))
                                {
                                    //if ($didvoteresult['voted'] == 0)
                                    //{
                                        $r =  mysql_query($addgold); //add 25 gold
                                        //$rr =  mysql_query($setvoted); //set "voted" to 1
                                    //} 
                                    //else if ($didvoteresult['voted'] == 1)
                                    //{
                                        //echo 'ERROR: USER ALREADY VOTED';
                                   // }
                                } 
                        //###################################################################################################################
                    ?>



                </div>
</br></br></br></br>
                <div id="side_info">
                    <?php
                        include("Templates/multivillage.tpl");
                        include("Templates/quest.tpl");
                        include("Templates/news.tpl");
                        include("Templates/links.tpl");
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="footer-stopper"></div>
            <div class="clear"></div>
            <?php
                include("Templates/footer.tpl");
                include("Templates/res.tpl");
            ?>
            <div id="stime">
                <div id="ltime">
                    <div id="ltimeWrap">
Calculated in <b><?php
    echo round(($generator->pageLoadTimeEnd()-$start)*1000);
                            ?></b> ms
                        <br />Server time: <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
                    </div>
                </div>
            </div>
            <div id="ce"></div>
    </body>
</html>
