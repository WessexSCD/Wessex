<?php
/**
 * This index.php is the home page that gives us access to the husekeeping 
 * functions for the Wessex SCD database.
 *
 * It instantiates out webpage class, then gives access to the various 
 * housekeeping functions required to maintain our database.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 03-03-2014, 12:17h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
   * You may uncomment it during development, but don't forget to comment it 
   * out again when the page goes live! */
  ini_set("display_errors", 1);

  /* The next two lines bring in the webpage class and create a new instance.
   * Don't change these lines! */
  require("../library/webpage.php");
  $page = new webpage();
  
  /* If you need access to the database, you'll need to uncomment the next two lines 
   * to bring in the database class and create a new instance.  It must be done 
   * -before- we start streaming the HTML.
   * Don't change these lines! */
  require("../library/database.php");
  $database = new database($page->rootpath);
  
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
  
  /* The HTML section that follows is the space for you to put all your main page content.
   * Aim to use just <p> for paragrpahs, and just <h3> for sub-headings.  Let the CSS do 
   * all the work! */
?>
       <!-- The main page content starts here -->
       
        <!-- The next line inserts the Two Dancers graphic on the page.  Comment it out if 
            you don't want it displayed -->
       <?php //$page->insertGraphic("dancers"); ?>
       
       <h3>Database Admin</h3>
       <p>The Wessex SCD database consists of five tables.  Four of these are unlikely to 
       	change much during any given year; they are "bands", "venues", "clubs" and 
       	"contacts."  The fifth table, "dances", will probably have two major updates a 
       	year, with minor updates being required periodically during the year.</p>

       <p>There are two management functions for the database that may be required for 
       	the database.  It would be a good idea to create a <a href="db_dump.php">backup</a> 
       	from time to time; 
       	maybe a good time would be immediately after the (biannual) major dances update.  
       	At the moment, any backup will overwrite previous backups, so copying current 
       	backup files to a different sub-directory before beginning might be a good idea.  
       	But I'll aim to automate this eventually to a "grandfather-father-son" approach.</p>
       	
       	<p>The second management function is an option to <a href="rebuild.php">rebuild</a> 
       	the database from the 
       	latest backup.  This will be most useful if the database is corrupted somehow.  
       	However, it also provides an alternative method for inputting data to the 
       	database.  Updating the backup files manually allows new data to be added in.  
       	There will be error messages reported noting that old data couldn't be inserted 
       	because it already exists, but it will still work.  But it is not an ideal way 
       	to input data because it doesn't decode keys to other tables - you have to know 
       	what these are!</p>
       	
       	<p>The easy way to <a href="modify.php">modify</a> or add a record to a particular 
       	table is to use the 
       	form provided.  But this will be tedious if there are a lot of records to add.</p>
       	
       	
       <?php 
         //$database->dumpCSV();
       ?>

       <!-- The next line inserts the Thistle graphic on the page.  Uncomment it if 
            you want it displayed -->
       <?php //$page->insertGraphic("thistle"); ?>
       
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
