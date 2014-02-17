<?php
/**
 * map.php shows us how to display a Google map indicating the location of the club.
 *
 * First we do the standard stuff and call our class, webpage, set the title for our 
 * page, set the page content, & stream the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 17-02-2014, 23:29h
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
  
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
  
  /* The HTML section that follows is the space for you to put all your main page content.
   * Aim to use just <p> for paragrpahs, and just <h3> for sub-headings.  Let the CSS do 
   * all the work! */
?>
      <!-- The main page content starts here -->
      
      <!-- A Google map follows.  We wrap it in a <figure> so we can get everything centred easily -->
      <figure>
	      <!-- The next bit is introductory text.  Edit as appropriate for your club -->
	      <h4>How to Find Us</h4>
	      <p>We meet at Willow Bank, Oak Drive, Alderbury SP5 3AJ.<br />The green arrow gives the destination.</p>
	
	      <!-- Google map follows -->
	      <!-- Note: remove the formatting info from Google's code paste and insert 'class="map"'
	            instead - otherwise it won't display properly! -->
	      <iframe class="map" src="https://maps.google.co.uk/maps?q=51.0407N,+1.7335W&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=51.0407,-1.7335&amp;output=embed">
	      </iframe>
	
	      <br />
	      <small><a href="https://maps.google.co.uk/maps?q=51.0407N,+1.7335W&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=51.0407,-1.7335&amp;source=embed" style="color:#0000FF;text-align:left" target="_blank">View on Google Maps</a></small>
	      <!-- End of Google map -->
	      <br />
	      <small><a href="http://www.streetmap.co.uk/map.srf?X=418785&Y=126859&A=Y&Z=115" target="_blank">View on Streetmap</a></small>
      <!-- Now we've finished the map and related stuff, close the <figure> -->
      </figure>
      
<?php
  /* The next line displays a "Return to Top" button at the foot of the page
   * Uncomment it if you want it to display */
  echo("        <a class=\"doubleBottom\" href=\"".$_SERVER['PHP_SELF']."\">Return to top</a>\n");  /* The final line streams the final html.  Don't change this. */
  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
