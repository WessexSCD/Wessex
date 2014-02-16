<?php
/**
 * template.php is the template page for our new (version 2) wessex web pages.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 15-02-2014, 23:34h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
   * Uncomment it during development, but don't forget to comment it out again when 
   * the page goes live! */
  ini_set("display_errors", 1);

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
      <p>This is Alderbury's home page...</p>

<?php
  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
