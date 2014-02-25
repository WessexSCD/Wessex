<?php
/**
 * dances.php lists forthcoming dances in the Wessex region.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 25-02-2014, 13:16h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
     Uncomment it during development. */
  //ini_set("display_errors", 1);

  /* The next two lines bring in the webpage class and create a new instance.
     Don't change these lines! */
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
  //$page->insertGraphic("dancers");
?>

      <p>The following is a list of dances coming up in the Wessex Area:</p>
     	<?php 
      	  $database->query("SELECT * FROM dances 
      	    INNER JOIN venues ON dances.venues_idvenues = venues.idvenues
      	    INNER JOIN clubs ON dances.clubs_idclubs = clubs.idclubs
      	    INNER JOIN contacts ON dances.contacts_idcontacts = contacts.idcontacts
      	    ORDER BY dances.date");
		  
		  /* SELECT * FROM  dances, bands WHERE dances.bands_idband = bands.idband */
		  /*  JOIN clubs_idclubs ON clubs.idclubs */
		  
		  /*echo("<pre>");
		  print_r($database->result);
          echo("</pre>");*/		  
      	?>
	  	
	  <table>
	  	<tr><th>Date</th><th>Dance</th><th>Venue</th></tr>
	  	<?php
	  	  $today = date('l jS M Y');
	  	  while ($row = $database->result->fetch_object()) 
		  {
		  	if(strtotime($row->date) >= strtotime($today)) 
		  	{
		  	  $tidyDate = date_format(date_create($row->date), 'l jS M Y');
			  $tidyStartTime = strftime('%l.%M%P',strtotime($row->dstartTime));
			  $tidyEndTime = strftime('%l.%M%P',strtotime($row->dendTime));

		  /*echo("<pre>");
		  print_r($row);
          echo("</pre>");*/
		  	  
		  	  printf("<tr>
		  	    <td class=\"clubDances\">$tidyDate<br />&nbsp;&nbsp;$tidyStartTime - $tidyEndTime</td>
		  	    <td><a href=$row->url>$row->name</a><br />$row->title<br />");
		  	  if($row->flier != "") printf("<a href='$row->url/$row->flier'>Dance flier</a>");
			  printf("</td><td>$row->vname<br />Cost: &pound;$row->cost<br />Contact: $row->telephone</td>
		  	    </tr>");
			}
		  }
	  	?>
	  </table>
	  	
<?php
  /* The next line displays a "Return to Top" button at the foot of the page
   * Uncomment it if you want it to display */
  // echo("        <a class=\"doubleBottom\" href=\"".$_SERVER['PHP_SELF']."\">Return to top</a>\n");  /* The final line streams the final html.  Don't change this. */
  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
