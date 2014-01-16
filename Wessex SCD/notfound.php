<?php
/**
 * notfound.php handles any "404 Not Found" errors
 *
 * It gathers all the information it can find relating to the Not Found error.  It operates 
 * as follows:
 * - If the visitor is looking for "robots.txt", it's probably a (good) search engine 
 *    bot.  It's good to know about the visit, so we create/update a file called 
 *    "bots-log.txt" in the root directory with details of the bot's visit.  We then 
 *    set an appropriate message for the 404 page.
 * - If the visitor hasn't followed a known link, they may have typed the URL directly 
 *    into the bar at the top of the browser and made a mistake.  So let's set up a 
 *    helpful 404 message for them.
 * - If it looks like there might be a case problem, we need to flag that and add a 
 *    suitable "try this" option to the final 404 page message.
 * - If the visitor has followed a known link, then we'd better know about the problem. 
 *    So we send an email to wessex.scd@gmail.com (except during testing) and then set 
 *    up a suitable message for the 404 page.
 * Then we display the resulting page.
 * 
 * @author Donald MacKay and David Argles <wessex.scd@gmail.com>
 * @version 23-12-2013, 15:36h
 * @copyright 2013 Wessex SCD
 */

  /* First, we ought to set the recipient for any emails.
   * Change this for testing, but don't forget to set it back again afterwards!
   * Default is: wessex.scd@gmail.com */
  $to = "d.argles@gmx.com"; //"wessex.scd@gmail.com" "d.argles@gmx.com";

  /* Now let's get the relevant information */
  $requester = $_SERVER['REQUEST_URI'];
  $requesterLower = strtolower($requester);
  $remoteAddr = $_SERVER['REMOTE_ADDR'];
  $hostname = gethostbyaddr($remoteAddr);
  $referer = $_SERVER['HTTP_REFERER'];
  $remoteHost = $_SERVER['REMOTE_HOST'];
  $remoteUser = $_SERVER['REMOTE_USER'];
  $botslog = "bots-log.txt";
  $lastbotlog = "bots-last.txt";
  $notfoundlog = "notfound-log.csv";
  $sendemail = TRUE;

  /* Set up an extra comment if we think there might be a .html or case problem */
  $urlComment = "";
  /* First, let's make sure we're looking for a php page, not an html one */
  $newURL = str_replace(".html", ".php", $requesterLower);
  /* Now let's check that the page we're going to suggest actually exists */
  if(($requester != $newURL) && file_exists(substr($newURL, 1))) $urlComment = "<li>Try this page instead: <a href=\"".$newURL."\">".$newURL."</a></li>\n";
  /* Now set up the various error messages for the 404 page */
  /* First, a message for those looking for robots.txt */
  $botMessage = "
    <h1>Oops!</h1>
    <p>The page you asked for doesn't exist.  It looks as though you are a search engine requesting robots.txt.  If so, you are probably a good bot, and you are most welcome anywhere in our site.  Mind you, if you're a search engine, you won't be reading this page, so this is a waste of time.  Ah well, such is life...</p>
    <p>If you are a human being - why are you looking for robots.txt?  We'd be most interested to know.  Please email us on <a href=\"mailto:wessex.scd@gmail.com\">wessex.scd@gmail.com</a>, we'd love to hear from you.  Otherwise, feel free to visit our home page at <a href=\"http://wessex-scd.org.uk/\">http://wessex-scd.org.uk/</a> and search from there.</p>";
  /* Now a message for anyone who may have (mis-)typed the URL rather than following a link */
  $noRefererMessage = "
    <h1>Oops!</h1>
    <p>The page you asked for doesn't exist.  It looks as though you typed the web address into the bar at the top of your browser and maybe mis-typed it.  Our suggestions would be:</p>
    <ul>".$urlComment."
      <li>Go to our home page at <a href=\"http://wessex-scd.org.uk/\">http://wessex-scd.org.uk/</a> and follow the links from there</li>
      <li>You might want to email us at <a href=\"mailto:wessex.scd@gmail.com\">wessex.scd@gmail.com</a> to talk to us or ask a question - we'd love to hear from you</li>
      <li>Sort things out yourself (try Google, use the back button on your browser... whatever...)</li>
    </ul>
";
  $oldLinkMessage = "
    <h1>Oops!</h1>
    <p>The page you asked for doesn't exist.  It looks as though you're following an old, cached link.  For example you might have a page stored in your browser's memory, and it might be looking for something we've updated.<p>
    <p>Our suggestions would be:</p>
    <ul>".$urlComment."
      <li>Go to our home page at <a href=\"http://wessex-scd.org.uk/\">http://wessex-scd.org.uk/</a> and follow the links from there</li>
      <li>You might want to email us at <a href=\"mailto:wessex.scd@gmail.com\">wessex.scd@gmail.com</a> to talk to us or ask a question - we'd love to hear from you</li>
      <li>Sort things out yourself (try Google, use the back button on your browser... whatever...)</li>
    </ul>
";
  /* This is the message folks need to see if they've followed a link and it's broken */
  $brokenLinkMessage = "
    <h1>Oops!</h1>
    <p>The page you asked for doesn't exist.  This is probably our problem rather than your mistake - if so, we'll aim to fix this as soon as we can.  A message has already been sent to tell us that something needs sorting out, but in the meantime you could:</p>
    <ul>".$urlComment."
      <li>email us at <a href=\"mailto:wessex.scd@gmail.com\">wessex.scd@gmail.com</a> to talk to us about the problem</li>
      <li>Go back to the <a href=\"http://wessex-scd.org.uk/\">main Wessex site</a> and start again</li>
      <li>Sort it out yourself (try Google, use the back button on your browser... whatever...)</li>
    </ul>
";
  /* Default is the broken link message */
  $htmlMessage = $brokenLinkMessage;

  /* If the referer exists, it's a person or a bot working from an old, cached link */
  //@$validRequ = fopen($requester, 'r');
  @$validRef = fopen($referer, 'r');
  if (($validRef != FALSE) /* && ($validRequ == FALSE) */)
  {
    //$htmlMessage = $oldLinkMessage;
	//$sendemail = TRUE;
    fclose($validRef);
  }
  else if ($referer != "")
  {
    $htmlMessage = $oldLinkMessage;
	$sendemail = FALSE;
  }
  
  /* We need to trap the case where there's no referer (i.e. a mis-typed URL) */
  if ($referer=="")
  {
    $htmlMessage = $noRefererMessage;
	$sendemail = FALSE;
  }

  /* Is the visitor asking for "robots.txt"? */
  if($requester=="/robots.txt")
  {
    /* If so, create/update the bots-log.txt file in the root directory */
    $line = date("d/m/Y")." ".strftime("%T")." : ".$hostname."\n";
    file_put_contents($botslog, $line, FILE_APPEND);
	/* We'll also create/update  file that records the last bot to visit the site.  Why? See below */
    file_put_contents($lastbotlog, $hostname);
    /* Set up the relevant 404 message */
    $htmlMessage = $botMessage;
	$sendemail = FALSE;
  }
  else
  {
    /* If $hostname is the same as the entry in bots-last.txt, it's a search engine */
	/*@$file_handle = fopen($lastbotlog, "r");
    if(!$file_handle) echo("<p>Last bot log not found.</p>");
    else
    {*/
    /* $visitor = file_get_contents($lastbotlog);
	if($hostname == $visitor)
    {
      $sendemail = FALSE;	  
	} */
  }
  
  /* Is the visitor asking for "js/libs/modernizr"? That's a temporary problem that we'll just ignore
     for now*/
  if (strpos($requester, "js/libs/modernizr"))
  {
    $sendemail = FALSE;
  }

  /* Is the visitor asking for "favicon.ico"? For now, we're not intending to provide one*/
  if ($requester == "/favicon.ico")
  {
    $sendemail = FALSE;
  }

  
  /* The following section sends an email =if= there really looks to be a broken link that 
      we need to know about.
     Note: In the following, the 'ignore the error' rules are as follows:
     - favicon.ico: we might want one of these at some stage, but it's only flagged as an error by robots
     - robots.txt: again, only triggered by bots.  We probably don't want a robots.txt, since the (hostile) hosts we want to read it will probably ignore it
     - referer='': that means it's someone (eg a bot) probing, not a broken link
     - requester includes 'modernizr': this is a known error on the old site and is driving me bonkers with loads of reported errors!  It's not seen by human visitors and can be safely ignored as an error. 
  */
  if($sendemail) /* was $requester!="/favicon.ico" && $requester!="/robots.txt" && $referer!="" && !strpos($requester, "js/libs/modernizr") */
  {
    /* Note: $to is set at the head of this file */
    $subject = "Wessex SCD: Not Found Problem";
    $message = "There has been a Not Found problem on the wessex-scd site.\r\n\r\nRequester: ".$requester."\r\nRemote Address: ".$remoteAddr."\r\nRemote Host: ".$hostname."\r\nReferer: ".$referer."\r\nRemote User: ".$remoteUser;
    $message = wordwrap($message, 70, "\r\n");
    mail($to, $subject, $message);
  }
  else 
  {
    /* If we're not sending an email, let's record the issue in a log.  It will get =BIG= 
	 * but I want to know for now... */
    $line = '"'.date("d/m/Y").'","'.strftime("%T").'","'.$hostname.'","'.$remoteAddr.'","'.$requester.'","'.$referer."\"\n";
    file_put_contents($notfoundlog, $line, FILE_APPEND);
	
  }

  /* Now stream the html for the 404 page */
  require("includes/template.inc");
  htmlHeader("404 Not Found");
  htmlMenusFloat("tarblank.gif");
  echo ($htmlMessage);
  htmlFooter("", FALSE); 
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>

