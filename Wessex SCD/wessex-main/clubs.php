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
  $database = new database();
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
?>

      <p>This is the clubs page...</p>

      	<?php 
      	  $database->query("SELECT * FROM  clubs, contacts WHERE clubs.contacts_idcontacts = contacts.idcontacts");
		  
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
		  	  printf("<tr><td><a href=$row->url>$row->name</a></td><td>$row->day<br />$row->startTime - $row->endTime</td><td>$row->cname</td></tr>");
			}
		  }
	  	?>
	  </table>
<?php
  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>