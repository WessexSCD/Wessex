<?php
/**
 * dances.php lists forthcoming dances in the Wessex region.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 08-02-2014, 00:31h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
     Uncomment it during development. */
  ini_set("display_errors", 1);

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
  $page->insertGraphic("dancers");
?>

      <p>This is the dance page...</p>
     	<?php 
      	  $database->query("SELECT * FROM dances 
      	    INNER JOIN venues ON dances.venues_idvenues = venues.idvenues
      	    INNER JOIN clubs ON dances.clubs_idclubs = clubs.idclubs");
		  
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
		  	  printf("<tr>
		  	    <td>$row->date<br />$row->dstartTime - $row->dendTime</td>
		  	    <td><a href=$row->url>$row->name</a><br />$row->title</td>
		  	    <td>$row->vname</td>
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
