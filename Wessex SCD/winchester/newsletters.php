<?php
	require("../includes/template.inc");
	htmlHeader("Winchester RSCDS: Newsletters");
	htmlMenusFloat("tarblank.gif");
	?>

<!-- Page content starts here -->

  <?php insertGraphic("dancers"); ?>

  <h2>Newsletters and Application Forms</h2>
  <p class="indent">Newsletters for RSCDS Winchester Branch events will be published here as they become available. Please download any Application Forms and follow the instructions on the individual forms. In case of difficulty or if you have any questions, please use the contact address on the Home page.</p>

  <h2>Newsletters</h2>
  <div class="indent">
    <p>These are listed below in reverse order with the most recent listed first.</p>
    <?php insertGraphic("thistle"); ?>

<?php dir_list("newsletters", ".doc", 1); ?>
    <p>&nbsp;</p>
  </div>

  <h2>Application Forms</h2>
  <div class="indent">

<?php dir_list("application-forms", ".pdf", 0) ?>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
<!-- Call the end of page tidying up function -->
<!-- The first parameter is the update message for the page.  If instead you use the keyword
       "file", it will:
       - use the first line of the contents of "updates.txt" as the update message *if* this page
         is "index.php"
       - otherwise, it will not display anything at all. -->
<!-- The second parameter is a boolean which switches off the "Return to Top" button if FALSE -->
<?php	htmlFooter("file", TRUE); ?>
