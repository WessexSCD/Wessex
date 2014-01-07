<?php
	require("../includes/template.inc");
	htmlHeader("Winchester RSCDS: Programme");
	htmlMenusFloat("tarblank.gif");
	?>

<!-- Page content starts here -->
 
  <?php /* insertGraphic("dancers"); */ ?>

	<!-- h2>2013 Programme</h2>
  <p></p>
  <?php displayCSV("winchester-programme.csv"); ?>
  <p></p -->
	<h2>2014 Programme</h2>
  <p></p>
  <?php displayCSV("programme-2014.csv"); ?>

<!-- Call the end of page tidying up function -->
<!-- The first parameter is the update message for the page.  If instead you use the keyword
       "file", it will:
       - use the first line of the contents of "updates.txt" as the update message *if* this page
         is "index.php"
       - otherwise, it will not display anything at all. -->
<!-- The second parameter is a boolean which switches off the "Return to Top" button if FALSE -->
<?php	htmlFooter("file", FALSE); ?>
