<?php
/**
 * newsletters.php is the newsletters page for our new (version 2) Winchester web pages.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 19-02-2014, 18:21h
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
  
  /* If you need access to the database, you'll need to uncomment the next two lines 
   * to bring in the database class and create a new instance.  It must be done 
   * -before- we start streaming the HTML.
   * Don't change these lines! */
  //require("library/database.php");
  //$database = new database();
  
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
  
  /* The HTML section that follows is the space for you to put all your main page content.
   * Aim to use just <p> for paragrpahs, and just <h3> for sub-headings.  Let the CSS do 
   * all the work! */
?>
       <!-- The main page content starts here -->
       
        <!-- The next line inserts the Two Dancers graphic on the page.  Comment it out if 
            you don't want it displayed -->
       <?php $page->insertGraphic("dancers"); ?>
       
  <h2>Newsletters and Application Forms</h2>
  <p>Newsletters for RSCDS Winchester Branch events will be published here as they become 
  	available. Please download any Application Forms and follow the instructions on the 
  	individual forms. In case of difficulty or if you have any questions, please use the 
  	contact address on the Home page.</p>

  <h2>Newsletters</h2>
  <p>These are listed below in reverse order with the most recent listed first.</p>

  <!-- The next line inserts the Thistle graphic on the page.  Uncomment it if 
            you want it displayed -->
  <?php $page->insertGraphic("thistle"); ?>
       
  <?php $page->dir_list("newsletters", ".doc", 1); ?>

  <h2>Application Forms</h2>

  <?php $page->dir_list("application-forms", ".pdf", 0); ?>



<?php
  /* The next three lines display a list of useful links. Uncomment them if you want them to display */
  /* echo("      <h2>Links</h2>\n      <p></p>\n      <ul class=\"links\">");
  $page->common_scd_links();
  echo("      </ul>\n"); */
  
  /* The next line displays a "Return to Top" button at the foot of the page
   * Uncomment it if you want it to display */
  echo("        <a class=\"doubleBottom\" href=\"".$_SERVER['PHP_SELF']."\">Return to top</a>\n");  

  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
