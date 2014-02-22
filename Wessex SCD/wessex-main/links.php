<?php
/**
 * links.php gives useful links relating to Scottish Country Dancing.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 22-02-2014, 23:05h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
     Uncomment it during development. */
  //ini_set("display_errors", 1);

  /* The next two lines bring in the webpage class and create a new instance.
     Don't change these lines! */
  require("library/webpage.php");
  $page = new webpage();
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
  /* The next line inserts the Two Dancers graphic on the page.  Comment it out if 
   * you don't want it displayed */
  $page->insertGraphic("dancers");
?>

      <h3>Links</h3>
      <p>The following is a list of links to other sites you might find useful.</p>
      
      <ul class="links">
        <li><a href="http://www.carswellian.net/">The Carswellian</a><br />Scottish Dancing in the South West.</li>
        <li><a href="http://my.strathspey.org/dd/dancevideo/">The Strathspey Dance Video Collection</a><br />
          800+ SCD dance videos - out of 13,000+ dances</li>
        <?php $page->common_scd_links(); ?>
      </ul>
	  	
<?php
  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
