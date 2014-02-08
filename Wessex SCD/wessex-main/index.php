<?php
/**
 * index.php introduces wessex-scd.org.uk
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 07-02-2014, 20:33h
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

      <p>Welcome. All the groups on the Wessex Scottish Country Dancing website are listed below. 
      	Please click on the links for the pages of the groups in which you are interested.</p>

	  <p>On these pages you will find the details of what each group offers, whether it's basic 
	  	tuition for newcomers, classes for adults and/or children, ceilidh dancing or social 
	  	evenings. If you'd like to dance with a group, please get in touch with the person listed 
	  	as the group contact to check that the information on classes and events is right up to 
	  	date. You may like to look at the list of Local Dances as well.</p>

	  <p>If you dance in the Wessex region and would like information about your group's 
	  	activities, plus maps and photos, to be displayed on the Wessex Scottish Country Dancing 
	  	webpages, please email: wessex.scd@gmail.com for information on setting up etc.</p>
	  	
<?php
  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
