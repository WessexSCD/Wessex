<?php
//---------------------------------------------------------------------------------------------
// File:    viewer.php
// Author:  David Argles (d.argles@gmx.com)
$viewerVersion = "29.07.2013 21.42h";
// Purpose:
//   This page contains loads of code to display individual pictures from the gallery display. 
//   You will need to include it if you are going to display a gallery - it is called by 
//   the "displayGallery()" function in gallery.php, or you can use "displayMedia("dirname")" 
//   in any page, where dirname is the name of the directory for the media files for that page.
//
// NOTE:
//   There are some parts that need updating (e.g. page title, tartan etc).  Look carefully below.
//---------------------------------------------------------------------------------------------
//
// All of this first bit needs to be done BEFORE we do any HTML etc.
// Nothing to change here - leave well alone!
//
	/* Bring in the template file from the includes directory */
	require("../includes/template.inc");
        // setvars();
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
//---------------------------------------------------------------------------------------------
// Now we need to set up the page.  The next two active lines of code need updating to suit
// your site.
//---------------------------------------------------------------------------------------------
	/* Now set up the heading html.
	   This inlcudes the page title for the top of the browser bar */
	htmlHeader("My SCD Club: picture viewer"); //Don't forget to personalise this page title
	/* Now set up the menu bar. The background is specified in the parameter
	   and should be placed in the main graphics directory */
	htmlMenusFloat("tarblank.gif");
	?>

<!-- Don't touch the following stuff, just use it -->
<!-- Page content starts here -->
<div class="centre">

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
</div>

<?php
//---------------------------------------------------------------------------------------------
// Now the final stuff; you may change this for your site if you wish.
//---------------------------------------------------------------------------------------------
?>
<!-- Call the end of page tidying up function -->
<!-- The first parameter is the update message for the page. -->
<!-- The second parameter is a boolean which switches on a "Return to Top" button if TRUE -->
<?php	htmlFooter("file", FALSE); ?>
