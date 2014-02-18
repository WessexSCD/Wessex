<?php
/**
 * index.php is the home page for our new (version 2) Winchester web pages.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 18-02-2014, 17:20h
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
  
  /* The next line inserts the Two Dancers graphic on the page.  Comment it out if 
   * you don't want it displayed */
  $page->insertGraphic("dancers");
      
  /* The HTML section that follows is the space for you to put all your main page content.
   * Aim to use just <p> for paragrpahs, and just <h2> for sub-headings.  Let the CSS do 
   * all the work! */
?>
      <!-- The main page content starts here -->
	  <h2>Who are we?</h2>
	  <p>An active group of dancers who meet each week to dance and enjoy one another's company. 
	    As the official RSCDS Group in Winchester, we offer dancing at all levels from absolute 
	    beginner (Tuesdays only) to expert.
	  </p>

	  <h2>When do we meet?</h2>
	  <p></p>
		<table>
	      <tbody>
	        <tr>
	          <td>Mixed Ability (Teaching) Class:</td>
	          <td>Tuesdays 8:00-10:00 pm</td>
	        </tr>
	        <tr>
	          <td>Club Night (Dance practice):</td>
	          <td>1st and 3rd Wednesdays 8:00-10:00 pm</td>
	        </tr>
	      </tbody>
	    </table>
	    
  <p>For Term Dates see <a href="programme.php">Programme</a>
  </p>

<?php
  /* The next line inserts the Thistle graphic on the page.  Comment it out if 
   * you don't want it displayed */
  $page->insertGraphic("thistle");
?>
      
  <!-- img class="picRight" src="../graphics/thistle.png" alt="[Thistle graphic]" title="We believe this graphic to be in the public domain.  If you know anything about its origin, do please contact us and let us know." / -->

  <h2>Where do we meet?</h2>
  <p>St Peter's School Hall, Oliver's Battery Road North, Winchester, Hampshire, SO22 4JB</p>

  <p>Oliver's Battery Road North is at the top of Romsey Road.</p>

  <p>Enter by the wooden gate to the left of the church.</p>

  <p><a href="map.php">Click here for map</a></p>

  <h2>Committee Members</h2>
  <p class="indent">(For meeting dates see Programme)</p>
  	<table class="indent">
          <tbody>
           <tr>
            <td>Chairman</td>
            <td>Alison Young</td>
           </tr>
           <tr>
            <td>Secretary</td>
            <td>Margaret Hamilton<br /><a href="mailto:hamilton@ilett.bbmax.co.uk">hamilton@ilett.bbmax.co.uk</a><br />01962 715868</td>
           </tr>
           <tr>
            <td>Treasurer</td>
            <td>Robert Morgan</td>
           </tr>
           <tr>
            <td>Members</td>
            <td>Wendy Mumford<br />
Catriona Warner<br />
Ailsa Greenlees<br />
            Marian Speakman<br />
            Adrian Cook<br />
            Margaret Linton</td>
           </tr>
           <tr>
            <td>Membership Secretary</td>
            <td>Marian Speakman</td>
           </tr>
          </tbody>
         </table>
  <p></p>

  <h2>For more information contact one of our RSCDS qualified teachers</h2>
  <p></p>
	<table class="indent">
           <tbody>
            <tr>
             <td><a href="mailto:wendy@mumford.com">wendy@mumford.com</a></td>
             <td>01264 363293</td>
            </tr>
            <tr>
             <td><a href="mailto:robert.fieldhead@tiscali.co.uk">robert.fieldhead@tiscali.co.uk</a></td>
             <td>01590 623849</td>
            </tr>
           </tbody>
          </table>
  <p></p>

<?php
  /* The next three line display a list of useful links. Uncomment them if you want them to display */
  echo("      <h2>Links</h2>\n      <p></p>\n      <ul class=\"links\">");
  echo("        <li><a href=\"http://www.rscds.org/\">RSCDS</a><br />Royal Scottish Country Dance Society</li>");
  $page->common_scd_links();
  echo("      </ul>\n");
  
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
