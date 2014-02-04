<?php
//---------------------------------------------------------------------------------------------
// File:    gallery.php
// Author:  David Argles (d.argles@gmx.com)
// Version: 17.05.2013 17.20h
// Purpose:
//   The standard "page-template.php" has got rather long with all of the potential bells and
//   whilstles added in.  The following page is produced as an example of what a gallery page 
//   could look with all the unneccesary code stripped out.  You will also need to include 
//   "viewer.php" as that is called by the displayGallery() function below.
//---------------------------------------------------------------------------------------------
	/* Bring in the template file from the includes directory */
	require("../includes/template.inc");
	/* Bring in the gallery file from the includes directory */
	require("../includes/gallery.inc");
        // setvars();
	/* Now set up the heading html.
	   This inlcudes the page title for the top of the browser bar */
	htmlHeader("My SCD Club: gallery"); //Don't forget to personalise this page title
	/* Now set up the menu bar. The background is specified in the parameter
	   and should be placed in the main graphics directory */
	htmlMenusFloat("tarblank.gif");
	?>

<!-- Page content starts here -->

  <?php displayGallery(); ?>

<!-- Call the end of page tidying up function -->
<!-- The first parameter is the update message for the page. -->
<!-- The second parameter is a boolean which switches on a "Return to Top" button if TRUE -->
<?php	htmlFooter("Structural edit Mon Mar 11 2013", TRUE); ?>
