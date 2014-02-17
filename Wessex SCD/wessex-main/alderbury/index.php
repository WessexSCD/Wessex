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
  $page->insertGraphic("dancers");
?>
      <!-- The main page content starts here -->
  <h3>Who are we?</h3>
  <p>We are a Scottish Country 
    Dancing group that meets in Alderbury. It&apos;s fun, with great music and 
    friendly dancers. The sessions are especially suitable for newcomers to 
    dancing and for everyone wanting to refresh their skills. All you need to 
    start is a pair of soft shoes. Alison is a qualified teacher with the Royal 
    Scottish Country Dance Society. This is a Winchester RSCDS Branch 
    activity.
  </p>

  <h3>Where do we meet?</h3>
  <p>We meet at Willow Bank, Oak Drive, Alderbury SP5 3AJ.</p> 

  <p><a href="map.php">Click for map.</a></p>

  <p>We meet on Monday evenings from 8.00pm to 9.30 pm. We finish with a chat.</p>

  <p>There is no charge for the teaching, but contributions of &pound;1 to &pound;2 
  	are made to cover tea, coffee and biscuits.</p>

  <p>Contact: Mrs Alison Malcolm by phone on 01722 710356</p>

  <h3>Scottish country dancing links</h3>
  
  <ul class="links">        
<?php $page->common_scd_links(); ?>  
  </ul>

<?php
  /* The next line displays a "Return to Top" button at the foot of the page
   * Uncomment it if you want it to display */
  echo("        <a class=\"doubleBottom\" href=\"".$_SERVER['PHP_SELF']."\">Return to top</a>\n");  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
