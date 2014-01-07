<?php
	require("../includes/template.inc");
	htmlHeader("Winchester RSCDS: about us");
	htmlMenusFloat("tarblank.gif");
	?>

  <!-- Page content starts here -->
  <?php insertGraphic("dancers"); ?>

  <h2>About Scottish Country Dancing</h2>
  <p class="indent">We are members of the Winchester Branch of the RSCDS, which stands for the Royal Scottish Country Dance Society. There are many Branches and affiliated groups worldwide. The Scottish Country Dance Society was formed in 1923 but the Royal title was bestowed by King George VI in 1951. The Queen is a keen dancer herself as was her late mother, the Queen Mother.
  </p>

  <!-- ?php insertGraphic("thistle"); ? -->

  <p class="indent">Our particular Branch was formed over fifty years ago. We run many events throughout the year, some strictly for dancers and others for anyone who wants to try Scottish Country Dancing as a hobby. You do not have to be Scottish to join.</p>

  <p class="indent">There are clubs in almost every country in the world so we take our dancing shoes with us when we are travelling. It is a great way to make friends and also keeps you fit. You are also guaranteed to have a good laugh too - it is such good fun.</p>

<!-- Call the end of page tidying up function -->
<!-- The first parameter is the update message for the page.  If instead you use the keyword
       "file", it will:
       - use the first line of the contents of "updates.txt" as the update message *if* this page
         is "index.php"
       - otherwise, it will not display anything at all. -->
<!-- The second parameter is a boolean which switches off the "Return to Top" button if FALSE -->
<?php	htmlFooter("file", FALSE); ?>
