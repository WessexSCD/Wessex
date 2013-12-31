<?php
/**
 * notfound.php handles any "404 Not Found" errors
 *
 * It operates as follows:
 * - First, it sets the "who to send to" email address.
 * - Then it gathers all the information it can find relating to the Not Found error.
 * - Next, it sets up a few targetted messages so we can be a bit specific in offering 
 *   advice to the user about what might have gone wrong.
 * - It now ploughs through the available info checking various possibilities and 
 *   decides:
 *   (a) what sort of error has occurred, and 
 *   (b) whether we need to know about it (i.e. should an email be sent)
 *   During this process, if the visitor has asked for <robots.txt>, a log is updated 
 *   (or created if it's not there) called <bots-log.txt>.  It's not necessary, but 
 *   it's quite interesting to see what bots are visiting the site and how often.
 * - Having worked through the various possibilities, we now either:
 *   (i)  send an email to the site administrators; or 
 *   (ii) record the incident in a file called <notfound-log.csv>
 *   Again, if <notfound-log.csv> doesn't exist, it will be created.
 * - Finally we display the resulting page.
 * 
 * At the moment (31 dec 2013), <notfound-log.csv> is quite helpful for debugging 
 * purposes - getting the logic right for deciding what we need to know about is 
 * a fun challenge.  However, the file is growing fast - we have had around 1000 
 * entries to the log in just one week.  Of these, there was just one issue we 
 * needed to know about which generated just a handful of those incidents.  So 
 * it might prove to be necessary to turn this log off to stop us generating a 
 * massive file that becomes unweildy. 
 * 
 * @author Donald MacKay and David Argles <wessex.scd@gmail.com>
 * @version 31-12-2013, 07:41h
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

  /* The next section determines what sort of error has occurred, sets an appropriate 
   * error message, and switches off the "Send email" flag unless we really need to 
   * know about the problem.
   * 
   * Note: In the following, the 'ignore the error' rules are as follows:
   * - If there is a referer specified but it doesn't actually exist, it's a person or 
   *   a bot working from an old, cached link
   * - referer='': that means it's someone (eg a bot) probing, not a broken link
   * - robots.txt: again, only triggered by bots.  We probably don't want a robots.txt, 
   *   since the (hostile) hosts we want to read it will probably ignore it
   * - requester includes 'modernizr': this is a known error on the old site and is 
   *   driving me bonkers with loads of reported errors!  It's not seen by human 
   *   visitors and can be safely ignored as an error. 
   * - favicon.ico: we might want one of these at some stage, but it's only flagged as 
   *   an error by robots
   */
  
  /* If there is a referer specified but it doesn't actually exist, it's a person or 
   * a bot working from an old, cached link */
  @$validRef = fopen($referer, 'r');
  if (($validRef != FALSE)) fclose($validRef);
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
    /* If so, create/update the bots-log.txt file */
    $line = date("d/m/Y")." ".strftime("%T")." : ".$hostname."\n";
    file_put_contents($botslog, $line, FILE_APPEND);
	/* We'll also create/update  file that records the last bot to visit the site.  Why? See below 
    file_put_contents($lastbotlog, $hostname); */
    /* Set up the relevant 404 message */
    $htmlMessage = $botMessage;
	$sendemail = FALSE;
  }
  /*else
  {
    * If $hostname is the same as the entry in bots-last.txt, it's a search engine *
	@$file_handle = fopen($lastbotlog, "r");
    if(!$file_handle) echo("<p>Last bot log not found.</p>");
    else
    {
     $visitor = file_get_contents($lastbotlog);
	if($hostname == $visitor)
    {
      $sendemail = FALSE;	  
	}
  }*/
  
  /* Is the visitor asking for "js/libs/modernizr"? That's a temporary problem that 
   * we'll just ignore for now
   * I -think- this can disappear now we've switched to the new sites */
  if (strpos($requester, "js/libs/modernizr")) $sendemail = FALSE;

  /* Is the visitor asking for "favicon.ico"? For now, we're not intending to provide 
   * one.  We can safely just ignore it */
  if ($requester == "/favicon.ico") $sendemail = FALSE;

  
  /* The following section sends an email =if= there really looks to be a broken link 
   * that we need to know about.
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

