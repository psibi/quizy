<?php
require_once('lib/userauth.class.php');
require_once('question.php');
require_once ('points.php');
$user->is('ADMIN,USER');
$email=$user->getProperty('email');
$point->check_registered($email);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width=1024, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <title>Enigma</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="./css/reset.css" />
    <link rel="stylesheet" href="./css/icons.css" />
    <link rel="stylesheet" href="./css/formalize.css" />
    <link rel="stylesheet" href="./css/checkboxes.css" />
    <link rel="stylesheet" href="./css/sourcerer.css" />
    <link rel="stylesheet" href="./css/jqueryui.css" />
    <link rel="stylesheet" href="./css/tipsy.css" />
    <link rel="stylesheet" href="./css/calendar.css" />
    <link rel="stylesheet" href="./css/tags.css" />
    <link rel="stylesheet" href="./css/visualize.css" />
    <link rel="stylesheet" href="./css/fonts.css" />
    <link rel="stylesheet" href="./css/selectboxes.css" />
    <link rel="stylesheet" href="./css/960.css" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="stylesheet" media="all and (orientation:portrait)" href="./css/portrait.css" />
    <link rel="apple-touch-icon" href="./apple-touch-icon-precomposed.png" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    
    <!--[if lt IE 9]>
    <script src="./js/html5shiv.js"></script>
    <script src="./js/excanvas.js"></script>
    <![endif]-->
    
    <!-- JavaScript -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jqueryui.min.js"></script>
    <script src="./js/jquery.cookies.js"></script>
    <script src="./js/jquery.pjax.js"></script>
    <script src="./js/formalize.min.js"></script>
    <script src="./js/jquery.metadata.js"></script>
    <script src="./js/jquery.validate.js"></script>
    <script src="./js/jquery.checkboxes.js"></script>
    <script src="./js/jquery.chosen.js"></script>
    <script src="./js/jquery.fileinput.js"></script>
    <script src="./js/jquery.datatables.js"></script>
    <script src="./js/jquery.sourcerer.js"></script>
    <script src="./js/jquery.tipsy.js"></script>
    <script src="./js/jquery.calendar.js"></script>
    <script src="./js/jquery.inputtags.min.js"></script>
    <script src="./js/jquery.wymeditor.js"></script>
    <script src="./js/jquery.livequery.js"></script>
    <script src="./js/jquery.flot.min.js"></script>
    <script src="./js/application.js"></script>
  </head>
  
  <body>

    <!-- Primary navigation -->
    <nav id="primary">
      <ul>
        <li class="bottom">
          <a href="account.php?do=logout">
            <span class="glyph quit"></span>
            Log out
          </a>
        </li>
      </ul>
    </nav>
    
    
    <section id="maincontainer">
      <div id="main" class="container_12">
      
      <div class="box">
  <div class="box-header">
    <h1>Theta'12 Enigma</h1>
    
    <ul>
      <li class="active"><a href="#one">Enigma Quiz</a></li>
       <li><a href="#two">Ranks</a></li>
           <li><a href="#three">Instructions</a></li>
                  <li><a href="#four">Notifications</a></li>
    </ul>
  </div>
  
  <div class="box-content">
    <div class="tab-content" id="one">
      
      <form action="check.php" method="post">
        
        <div class="column-left">
        <?php 
        $lev = $point->get_points($email);
        echo "<h3> Level $lev  </h3> ";
        $question= $ques->get_question($email);
        $tques = $question['0'];
        $iques = $question['1'];
        if ($iques!="0")
        {
        	$path = "./qimage/" . $iques . ".jpg";
        	echo "<img src=\"$path\" width=\"400\" height=\"400\" />";       	
        }
        $rques= str_replace("\n","\n<br>","$tques");
        echo nl2br($rques);
        //echo $rques;
        
        ?>
          <div class="combined">
           
          </div>
        
          <p>
          
          </p>
        
        </div>
      
        <div class="column-right">
          <p>
            <textarea id="textarea" name="textarea" class="{validate:{required:true}}">Write your Answer here.</textarea>
          </p>

       
       
          
      
        </div>

        <div class="clear"></div>
        
        <div class="action_bar">
          <input type="submit" class="button blue" value="Submit Answer" />
         
        </div>
        
      </form>
      
    </div>
     <div class="tab-content" id="two">
    <?php 
    $value = $point->top_ranks();
    $num_rows = mysql_num_rows($value);
    if ($num_rows > 10)
    {
    	$last = 10;    	
    }
    else
    {
    	$last = $num_rows;
    }
    echo "<h1> Current Ranking (Email with Points) </h1>";
    echo "<br />";
    for ($i=0;$i<=$last;$i++)
    {
    	$row = mysql_fetch_array($value);
    	echo $row['email']. ":         ". $row['point'];
    	echo "<br /><br />";
    }
    ?>
     
    </div>
     <div class="tab-content" id="three">
    <h1>Instructions:</h1>
<ul>
<li>The answers should be in lower case.</li>
<li>No answers have special characters in them. The special characters here referred include blank spaces and comma(,) as well.
Example: Say the answer is "Gulliver's Travels". When entered in the answer box, it should be of the following form: "gulliverstravels". For those out there with an Einstein like IQ, the apostrophe used above is to show out the  answer. They arent allowed either.</li>
<li>The answers could be text and numerical and alphanumeric as well.</li>
<li>Google, Reverse image search engines should make your life a lot easier.</li>
<li>Eyes are deceptive. See with your brains.</li>
</ul>
         </div>
             <div class="tab-content" id="four">
    <h1>Notifications:</h1>
<ul>
<li>This event will get over by  21:00 hours of 29th February.</li>
<li>There will be a winner and a runner.</li>
<li>The contestants are not expected to solve all the levels.</li>
<li>The winner and the runner will be given appropriate prizes and those coming third, fourth and fifth will be given participation certificates</li>
<li>The participants in the top two level will be the winner and the runner. In case many participants are in the same level, the first two to reach it will be the winner and the runner. They will be notified through mail and they are supposed to give in all the detail about themselves and their college.</li>
</ul>
         </div>

  </div>
</div>



      
      </div>
    </section>
    
  
  </body>
</html>