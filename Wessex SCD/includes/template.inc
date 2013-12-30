<?php
############################################################
# LIBRARY FUNCTIONS FOR WEBSITES
# Lots of ideas nicked from others and modified by David Argles (daargles@gmail.com)
# Thanks to: Andy Landells, Russell Newmann, Seb Skuse, Thomas Deamer - I owe all of you!
$version = "11Dec2013, 08:35h";
############################################################
# This sets the global module variables for all pages.
# Note: it MUST be called before starting to stream any HTML (i.e. before including
#  any HTML code on your page).  This INCLUDES COMMENTS!
#-----------------------------------------------------------
function setVars() { 
	# Following line enables all error reporting - only uncomment when testing
   	#error_reporting(E_ALL);
	# Enable persistent session variables
    	# session_start(); 
	# Global variables: list these below
	# $browser will tell us what browser the user is using
	global $browser;
        $browser = $_SERVER['HTTP_USER_AGENT'];
}
############################################################
# There are two variants of the html header function, which 
# share -nearly- identical code. So the common stuff is here -
# makes for safer updating
#-----------------------------------------------------------
function HeaderCommon ($t){
global $version, $galleryVersion, $viewerVersion, $browser, $browserVersion;
/* The following line gives the basic strict 1.0 xhtml header */ ?>
<!DOCTYPE html PUBLIC
    "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <!-- Tell device to scale fonts etc to normal size: Responsive Layout part 1! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Specify charset, etc -->		
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <!-- Name the page authors -->
    <meta name="author" content="Donald Mackay and David Argles" />
    <!-- Name the code version -->
    <?php echo("<meta name=\"generator\" content=\"Wessex SCD page generator, version ".$version."\" />\n");
    if(isset($galleryVersion))echo("    <!-- NOTE: this page is also using Wessex SCD gallery, version ".$galleryVersion." -->\n");
    if(isset($viewerVersion))echo("    <!-- NOTE: this page is also using Wessex SCD viewer, version ".$viewerVersion." -->\n"); ?>
    <!-- Copy the page title from the $title parameter -->
    <title><?php print $t; ?></title>
    <!-- Also link to the stylesheets; first: reset.css held in /includes -->
    <link rel="stylesheet" href="../includes/reset.css" type="text/css" />
    <!-- Next: gallery.css also held in /includes -->
    <link rel="stylesheet" href="../includes/gallery.css" type="text/css" />
<?php 
      $browser = "other";
      $browserVersion = 10;
      if($pos=strpos($_SERVER['HTTP_USER_AGENT'], "MSIE"))
      {
        $browser = "MSIE";
        $browserVer = strstr($_SERVER['HTTP_USER_AGENT'], "MSIE", FALSE);
        $browserVersion = (int)strstr($browserVer, " ", FALSE);
      }
      if(strstr($_SERVER['PHP_SELF'], "test.php", TRUE))echo("<!-- Browser: ".$browser." | ".$_SERVER['HTTP_USER_AGENT']." -->\n    <!-- Version: ".$browserVersion." -->\n");
?>
<?php
}
############################################################
# This is a generic HTML header. It takes an individual page 
# title as an argument, and prints out the standard HTML 
# required for the <head> section with an individualised title
#-----------------------------------------------------------
function htmlHeader ($title){
    global $browser, $browserVersion;
    HeaderCommon($title);
    echo("    <!-- Browser: ".$browser.", Version: ".$browserVersion." -->\n");
    if(($browser == "MSIE") && ($browserVersion<9))
    {
      echo("    <!-- Now link to the MSIE stylesheet; msie.css held in /includes -->\n");
      echo("    <link rel=\"stylesheet\" href=\"../includes/msie6.css\" type=\"text/css\" title=\"3dmenu\" />\n");
    }
    else
    {
      echo("    <!-- Now link to the main stylesheet; normal.css held in /includes -->\n");
      echo("    <link rel=\"stylesheet\" href=\"../includes/normal.css\" type=\"text/css\" />\n");
    }
    echo("  </head>\n");
}
############################################################
# This is a generic HTML header. This version is amended so it 
# works for any file placed in the root directory
#-----------------------------------------------------------
function htmlHeaderRootdir ($title){
    HeaderCommon($title);
    echo("    <link rel=\"stylesheet\" href=\"/includes/normal.css\" type=\"text/css\" />\n");
    echo("  </head>\n");
}
############################################################
# This is a generic HTML header. It takes an individual page 
# title as an argument, and prints out the standard HTML 
# required for the <head> section with an individualised title
#-----------------------------------------------------------
function htmlHeaderVariant ($title, $stylesheet){ 
    HeaderCommon($title);
    /* Link to the stylesheet; $stylesheet held in /includes */
    $browser=$_SERVER['HTTP_USER_AGENT'];
    if(strpos($browser, "MSIE") && strpos($browser, " 6.")) echo("<link rel=\"stylesheet\" href=\"../includes/msie6.css\" type=\"text/css\" title=\"3dmenu\" />");
    else echo("    <link rel=\"stylesheet\" href=\"../includes/".$stylesheet."\" type=\"text/css\" />\n");
    echo("  </head>\n");
}
############################################################
# Menu stuff for every page.  The menu changes from club site
# to club site, so it pulls in a file called "menu.inc" which 
# needs to be located in the same directory as the calling 
# page.  The $background parameter provided by the calling 
# page specifies a background (tartan) image which must be 
# located in the "graphics" directory in the base public_html 
# directory
#-----------------------------------------------------------
function htmlMenus($background) { 
?>
    <?php
	/* Set up the main page body */
	  echo("<body style=\"background-image: url(../graphics/".$background.");\" id=\"top\">\n");
	  echo("      <!-- Now set up a main div container to hold the entire page -->\n");
	  echo("      <div class=\"container\" style=\"background-image: url(../graphics/".$background.")\">\n");
	  echo("      <!-- set up a menu bar div which floats to the left of the main container -->");
	  echo("      <div class=\"menuBar\" style=\"background-image: url(../graphics/".$background.")\">\n");
	/* Now pull in the button definitions from menu.ins */
	include("menu.ins"); 
    ?>
        </div> <!-- end of menuBar -->
    <!-- Main page content follows -->
    <div id="content">
    <?php
}
############################################################
# Menu stuff for every page.  
# * The menu changes from club site to club site, so it pulls in a file called 
#   "menu.inc" which needs to be located in the same directory as the calling page. 
# * The $background parameter provided by the calling page specifies a background 
#   (tartan) image which must be located in the "graphics" directory in the base 
#   public_html directory.
# * The function also searches for a "site-title.txt" file (again in the same
#   directory as the calling page).  If it finds one, it uses this as the page 
#   title in the main content area of the page.
# This version gives a floating layout.
#-----------------------------------------------------------
function htmlMenusFloat($background) { 
?>
<?php
  /* Set up the main page body */
  echo("  <body class=\"float\">\n");
  echo("    <!-- Now set up a main div container to hold the entire page -->\n");
  echo("    <div class=\"containerFloat\" style=\"background-image: url(../graphics/".$background.")\">\n");
?>

      <!-- set up a menu bar div which floats to the left of the main container -->
      <div class="menuBar">

<?php
    /* Now pull in the button definitions from menu.ins */
    include("menu.ins"); 
?>

      </div> <!-- end of menuBar -->
      
      <!-- Main page content follows -->

      <div class="contentFloat">

<?php
     /* Now get the site name if there is one */
     $filename = "site-title.txt";
     /* (The leading @ suppresses error reporting if the file's not there) */
     @$file_handle = fopen($filename, "r");
     /* If so, we need only the first line of the file (it's a one liner...) */
     if($file_handle)
     {
       /* Now display it on the page */
       echo("        <h1>".fgets($file_handle)."        </h1>\n");
       fclose($file_handle);
     }
     /* Get the site place if there is one */
     $filename = "site-location.txt";
     /* (The leading @ suppresses error reporting if the file's not there) */
     @$file_handle = fopen($filename, "r");
     /* If so, we need only the first line of the file (it's a one liner...) */
     if($file_handle)
     {
       /* Now display it on the page */
       echo("        <p class=\"mini-head\">".fgets($file_handle)."        </p>\n");
       fclose($file_handle);
     }
}
############################################################
# This function inserts either the "two dancers" graphic or the "thistle"
# graphic into the main page.  A separate function is provided for this so
# that the person updating the page doesn't have to worry about things like
# the copyright get-out clauses!

# $graphic MUST be either "dancers" or "thistle".  Anything else will 
# display nothing at all.
#-----------------------------------------------------------
function insertGraphic($graphic) {
  if ($graphic == "dancers") {
    echo("<img class=\"picWideRight\" src=\"../graphics/2Couples.png\" alt=\"[Two Couples Dancing]\" title=\"We believe this graphic to be in the public domain.  If you know anything about its origin, do please contact us and let us know.\" />\n");
  }
  else if ($graphic == "thistle") {
    echo("<img class=\"picRight\" src=\"../graphics/thistle.png\" alt=\"[Thistle graphic]\" title=\"We believe this graphic to be in the public domain.  If you know anything about its origin, do please contact us and let us know.\" />\n");
  }
}
############################################################
# This function prints link URLs that are common for every club
# NOTE!  It assumes you are in a list when called
#-----------------------------------------------------------
function common_scd_links() { 
  ?>  
  <li><a href="http://www.scottish-country-dancing-dictionary.com/">Scottish Country Dancing Dictionary</a> - Instructions and Diagrams for Steps, Sets and Figures</li>
  <li><a href="http://www.scottishdance.net">Grand Chain</a> - a set of resources for Scottish Dancers the world over</li>
  <li><a href="http://www.minicrib.org.uk/">"MINICRIB"</a> - a crib with more than 2000 Scottish Country Dances</li>
  <li><a href="http://www.strathspey.org/">Strathspey Server</a> - resource for Scottish country dance and music</li>
  <?php
}
############################################################
# This function prints a list of the files in the given 
# directory.
# $path is the path to the required directory;
# $suppress suppresses the given string. It's intended for suppressing
#  the expected file format from the display (e.g. ".doc")
# $order determines 
#  - alphabetic (0, or SCANDIR_SORT_ASCENDING)
#  - reverse alphabetic (1, or SCANDIR_SORT_DESCENDING)
#  - none (SCANDIR_SORT_NONE)
# Prints all the directory contents minus the . and .. entries
# Notes:
# * "-" in the filename is exchanged for a space
# * "_" in the filename is exchanged for a space (but it comes in a
#     different place in the alphabet, so it can be used to change
#     file order)
# * The expectation is that ".doc" is removed.  any remaining dots
#     and ensuing file formats are then re-expressed as "(xxx format)"
#-----------------------------------------------------------
function dir_list($path, $suppress, $order) {
  /* Get the sorted directory listing into an array, $result; flag error if path is wrong */
  if (!$result=scandir($path, $order)) echo("<p class=\"indent\">Error: wrong directory path!\n</p>");
  /* If that worked OK... */

  else{
    /* remove the . and .. entries */
    $sorted_dirlist = array_diff($result, array('.','..'));
    /* $dirsize gets the size of the directory listing */
    $dirsize = count($sorted_dirlist);
    /* If there's no other entries, give a suitable message */
    if ($dirsize<1) echo("    <p>None found</p>\n");
    /* Otherwise... */
    else {
        /* This is a kludge to sort out the removed entries. It ought to be sorted properly */
        $start = 2 - ($order * 2);
        /* Select the next directory item */
        for ($i=$start; $i<=(count($sorted_dirlist) + $start); $i++) {
        /* Change "-" to space */
        $next = str_replace("-", " ", $sorted_dirlist[$i]);

        /* Change "_" to space */
        $next = str_replace("_", " ", $next);
        /* Remove $suppress */
        $next = str_replace($suppress, "", $next);
        /* change ".xxx" to " (xxx format)" */
        if (strpos($next, ".")){
          $next = strstr($next, ".", TRUE)." ( ".strstr($next, ".", FALSE)." format)";
        }
        /* Now print it out */
        echo("    <p><a href=\"".$path."/".$sorted_dirlist[$i]."\">".$next."</a></p>\n");



      }
    }


  }
}
############################################################
# This function loads a CSV file with the filename given as a parameter and displays
# it.  
# - The assumption is that the first column is a date and will be displayed as such.
# - Dates before 'today' will be ignored.
#-----------------------------------------------------------
function displayCSV($filename)
{
  date_default_timezone_set("UTC");
  $today = date('l jS M Y');
  /* echo("<i>Today's date: ".$today."</i><br />"); */
  @$file_handle = fopen($filename, "r");
  if(!$file_handle) echo("<p>Events file not found</p>");
  else
  {
    echo("<table class=\"events\">");
    while (!feof($file_handle) )
    {
      $line_of_text = fgetcsv($file_handle);
      if (strtotime($line_of_text[0]) >= strtotime($today)) { echo("<tr><td class=\"events\">".date_format(date_create($line_of_text[0]), 'l jS M Y'). "</td><td>" . $line_of_text[1]. "</td><td>" . $line_of_text[2] . "</td><td>" . $line_of_text[3] . "</td></tr>"); } 
    }
    echo("</table>");
    fclose($file_handle);
  }
}
############################################################
# This function loads a CSV file with the filename given as a parameter and displays
# it.  
# - The assumption is that the first column is a date and will be displayed as such.
# - Dates before 'today' will be ignored.
#-----------------------------------------------------------
function displayAnyCSV($filename)
{
  @$file_handle = fopen($filename, "r");
  if(!$file_handle) echo("<p>File not found</p>");
  else
  {
    echo("<table class=\"events\">");
    while (!feof($file_handle) )
    {
      $line_of_text = fgetcsv($file_handle);
      echo("<tr>");
      for($i=0;$i<7;$i++) echo("<td>" . $line_of_text[$i]. "</td>");
      echo("</tr>"); 
    }
    echo("</table>");
    fclose($file_handle);
  }
}
############################################################
# This function adds a footer to the end of the page, but also
# adds the required closing HTML to finish it off tidily.  The 
# idea is to set up the calling pages so that you only have to 
# specify html for the page content - the enclosing functions
# htmlHeader, htmlMenus and htmlFooter handle all the rest.
#
# There are now two parameters on this function (as of 01/02/13).
# The first ($updateMessage) is the update message for the foot
# of the page; it could be null ("") if you wish.  The second
# parameter ($toTop) is a boolean which switches on or off a 
# "Return to Top" button.  Set it to TRUE to get the button
# showing, or FALSE to hide it.
#-----------------------------------------------------------
function htmlFooter($updateMessage, $toTop) { 
?>  

        <p>&nbsp;</p>
<?php
    /* If $toTop is set to TRUE, display the "Return to Top" button */
    if($toTop) echo("        <a class=\"menuButtonDoubleBottom\" href=\"".$_SERVER['PHP_SELF']."\">Return to top</a>\n");
?>
        <!-- Now display the update message from $updateMessage -->
        <p><?php 
                 if($updateMessage!="file")echo($updateMessage);
                 else if(strstr($_SERVER['PHP_SELF'], "index.php", TRUE))
                 {
                   /* Open the updates.txt file if there is one */
                   $filename = "updates.txt";
                   /* (The leading @ suppresses error reporting if the file's not there) */
                   @$file_handle = fopen($filename, "r");
                   /* If so, we only want the first line of the file */
                   if($file_handle)
                   {
                     /* Display it on the page */
                     echo("LAST UPDATED ".fgets($file_handle));
                     fclose($file_handle);
                   }
                 }
           ?></p>

        <?php if(strstr($_SERVER['PHP_SELF'], "index.php", TRUE))
        {
          echo("<!-- Now display the W3 consortium validation icons -->\n        ");
          echo("<p>\n        ");
          echo("  <a href=\"http://validator.w3.org/check?uri=referer\">\n        ");
          echo("    <img src=\"http://www.w3.org/Icons/valid-xhtml10\"\n            ");
          echo("alt=\"Valid XHTML 1.0!\" height=\"31\" width=\"88\" />\n        ");
          echo("  </a>\n        ");
          echo("  <a href=\"http://jigsaw.w3.org/css-validator/check/referer\">\n        ");
          echo("    <img style=\"border:0;width:88px;height:31px\"\n            ");
          echo("src=\"http://jigsaw.w3.org/css-validator/images/vcss\" ");
          echo("alt=\"Valid CSS!\" />\n        ");
          echo("  </a>\n        ");
          echo("</p>\n        ");
        }
              else echo("<p>&nbsp;</p>");
        ?>

	<!-- A bit of fun - let's display a footer.  Edit this as you wish -->
        <p class="footer">&copy;2013, Wessex SCD</p>

      </div> <!-- end of content -->
    </div> <!-- end of container -->
  </body>
</html>
<?php
}
############################################################
# 	--- END OF CODE FILE ---
############################################################
