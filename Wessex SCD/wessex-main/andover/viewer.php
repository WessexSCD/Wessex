<?php
/**
 * vieweer.php is the new (version 2) picture viewer for our wessex web pages.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & displays the selected picture.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 25-02-2014, 00:22h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
   * You may uncomment it during development, but don't forget to comment it 
   * out again when the page goes live! */
  //ini_set("display_errors", 1);

  /* The next two lines bring in the webpage class and create a new instance.
   * Don't change these lines! */
  require("../library/webpage.php");
  $page = new webpage();
  
  /**
   * All of this first bit needs to be done BEFORE we do any HTML etc.
   * Nothing to change here - leave well alone!
   */

        $picdir = $_GET['picdir'];
        $picname = $_GET['picname'];
        $retPage = $_GET['retpage'];

        /* First, we need to read the picture directory and list the pictures in it */
        $handlePicDir=opendir($picdir);
        /* We'll use $picCounter to count the no of pictures in this dir */
        $picCounter = 0;
        /* $thispic will point to the curently displayed picture */
        $thispic = 0;
        /* Get the next entry in the picture sub-directory */
        while($picitem=readdir($handlePicDir)) 
        {
          /* Is this a full-sized picture? */
          if(strstr($picitem, ".jpg", FALSE) && !strpos($picitem, "_t."))
          {
            /* If so, we need to remember the filename */
            $piclist[$picCounter] = $picitem;
            /* Is this item the curent picture? */
            if($picitem == $picname) $thispic = $picCounter;
            /* Update $picCounter */
            $picCounter++;
          }
        }
        /* Is there a corresponding picture description? */
        $picdesc = $picname;
        $picDescFile = strstr($picname, ".jpg", TRUE).".txt";
        /* Try opening the file */
        $fullname = $picdir."/".$picDescFile;
        @$desc_handle = fopen($fullname, "r");
        /* If it's there, we need to update $picDescription and close the file */
        if($desc_handle)
        {
          $picdesc = "";
          while(!feof($desc_handle))
          {
            /* Spool it into $picDescription */
            $picdesc .= fgets($desc_handle);
          }
          fclose($desc_handle);
        }
  
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
  
  /* The HTML section that follows is the space for you to put all your main page content.
   * Aim to use just <p> for paragrpahs, and just <h3> for sub-headings.  Let the CSS do 
   * all the work! */
?>
       <!-- The main page content starts here -->
       
<!-- Don't touch the following stuff, just use it -->
<!-- Page content starts here -->
<figure>

<table width="90%">
  <tbody>
    <tr>
      <td align="left">
      <?php 
        if($thispic>0)
        {
          $backurl = "viewer.php?picdir=".$picdir."&amp;picname=".$piclist[$thispic-1]."&amp;retpage=".$retPage;
          echo("<h4><a href=\"".$backurl."\">prev</a></h4>");
        }
      ?>
      </td>
      <td align="center">
      <h4><?php /* echo($picname); */ ?></h4>
      </td>
      <td align="right">
      <?php 
        if($thispic<($picCounter-1))
        {
          $nexturl = "viewer.php?picdir=".$picdir."&amp;picname=".$piclist[$thispic+1]."&amp;retpage=".$retPage;
          echo("<h4><a href=\"".$nexturl."\">next</a></h4>");
        }
      ?>
      </td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<p class="centre">
  <?php echo("<img class=\"gallery\" src=\"".$picdir."/".$picname."\" alt=\"".$picname."\" />"); ?>
</p>
<p class="centre"><?php echo($picdesc); ?></p>
<h4 class="centre"><?php echo("<a href=\"".$retPage."\">"); ?>Back to Gallery</a></h4>
</figure>
       
<?php  
  /* The next line displays a "Return to Top" button at the foot of the page
   * Uncomment it if you want it to display */
  // echo("        <a class=\"doubleBottom\" href=\"".$_SERVER['PHP_SELF']."\">Return to top</a>\n");  

  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
