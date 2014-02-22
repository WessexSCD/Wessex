<?php
/**
 * clubs.php showcases the clubs in the Wessex group.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 14-02-2014, 21:18h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
   * Uncomment it during development. */
  ini_set("display_errors", 1);

  /* The next two lines bring in the webpage class and create a new instance.
   * Don't change these lines! */
  require("library/webpage.php");
  $page = new webpage();
  /* Now we need to bring in the database class and create a new instance.
   * It must be done -before- we start streaming the HTML.
   * Don't change these lines! */
  require("library/database.php");
  $database = new database($page->rootpath);
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
  /* The next line inserts the Two Dancers graphic on the page.  Comment it out if 
   * you don't want it displayed */
  $page->insertGraphic("dancers");
?>

        <h3>Table of Wessex Clubs</h3>
        <p>All the groups on the Wessex Scottish Country Dancing website are listed in the 
        	table below, or if you prefer, you can see the <a href="#map">club locations marked on a 
        	map</a>.  In either case, please click on the links for the pages of the groups in which 
        	you are interested.</p>
        	
        <p>On these pages you will find the details of what each group offers, whether it's basic 
        	tuition for newcomers, classes for adults and/or children, ceilidh dancing or social 
        	evenings. If you'd like to dance with a group, please get in touch with the person 
        	listed as the group contact to check that the information on classes and events is 
        	right up to date. You may like to look at the list of Local Dances as well.</p>
        
        <p>If you dance in the Wessex region and would like information about your group's 
        	activities, plus maps and photos, to be displayed on the Wessex Scottish Country 
        	Dancing webpages, please email <a href="mailto:wessex.scd@gmail.com">wessex.scd@gmail.com</a> 
        	for information on setting up etc.</p>

      	<?php 
      	  $database->query("SELECT * FROM clubs 
      	    INNER JOIN contacts ON clubs.contacts_idcontacts = contacts.idcontacts
      	    ORDER BY clubs.day");
		  /* SELECT * FROM  clubs, contacts WHERE clubs.contacts_idcontacts = contacts.idcontacts */
		  /*echo("<pre>");
		  print_r($database->result);
          echo("</pre>");*/	  
      	?>
	  	
	  <table>
	  	<tr><th>Club</th><th>Day and Time</th><th>Contact</th></tr>
	  	<?php
	  	  while ($row = $database->result->fetch_object()) 
		  {
		  	if($row->name != "To be confirmed") 
		  	{
		  /*echo("<pre>");
		  print_r($row);
          echo("</pre>");*/	  
			  $tidyStartTime = strftime('%l.%M%P',strtotime($row->startTime));
			  $tidyEndTime = strftime('%l.%M%P',strtotime($row->endTime));
		  	  printf("<tr><td><a href=$row->url>$row->name</a></td><td>$row->day<br />
		  	  <i>$tidyStartTime - $tidyEndTime</i></td><td>$row->cname<br /><i>$row->telephone</i></td></tr>");
			}
		  }
	  	?>
	  </table>
	  
        <h3><a name="map">Map of Club Locations</a></h3>
        <p>Click on the red pins in the map below to see the name and location of the group.</p>
	  
	  <figure>
	    <iframe class="map" src="https://mapsengine.google.com/map/u/2/embed?mid=z79UgzAnPKII.k1GQYf_R-Zo0"></iframe>
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
