<?php
/**
 * about.php presents the excitement of Scottish Country Dancing to newcomers.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 12-02-2014, 17:59h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
     Uncomment it during development. */
  ini_set("display_errors", 1);

  /* The next two lines bring in the webpage class and create a new instance.
     Don't change these lines! */
  require("library/webpage.php");
  $page = new webpage();
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
?>

      <p>This is the about page...</p>
	  	
<?php
  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
