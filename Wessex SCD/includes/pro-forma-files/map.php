<?php
//---------------------------------------------------------------------------------------------
// File:    map.php
// Author:  David Argles (d.argles@gmx.com)
// Version: 29.07.2013 21.01h
// Purpose:
//   Inserting a map is just a little bit different, so here is an example to give the idea. 
//   This example is based on the Winchester RSCDS site.
//---------------------------------------------------------------------------------------------
    /* Bring in the template file from the includes directory */
    require("../includes/template.inc");
    /* NOTE: Any pre-display php code needs to go here (e.g. setting up session variables) */
    /* Now set up the heading html.
        This inlcudes the page title for the top of the browser bar */
    htmlHeader("My SCD Club: How to find us"); //Don't forget to personalise this page title
    /* NOTE: Do not put ANY html code before this point - including comments! */
    /* Now set up the menu bar. The background is specified in the parameter
        and should be placed in the main graphics directory */
    htmlMenusFloat("tarblank.gif"); /* Change the tartan graphic if you wish.  It is expecting
                                        to find it in the main graphics directory */
?>

<!-- Page content starts here -->

<div class="centre">
  <h4>How to Find Us</h4>
  <p>Oliver's Battery Road North is at the top of Romsey Road.  Enter by the wooden gate to the left of the church.</p>

  <!-- Google map follows -->
  <!-- Note: remove the formatting info from Google's code paste and insert 'class="map"'
        instead - otherwise it won't display properly! -->
  <iframe class="map" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=St+Peter's+School,+Oliver's+Battery+Road+North,+Winchester,+Hampshire,+SO22+4JB&amp;aq=&amp;sll=51.03302,-1.470238&amp;sspn=0.702997,1.783905&amp;ie=UTF8&amp;hq=&amp;hnear=St+Peters+School,+Oliver's+Battery+Rd+N,+Winchester+SO22+4JB,+United+Kingdom&amp;ll=51.051132,-1.346643&amp;spn=0.00549,0.013937&amp;t=m&amp;z=14&amp;output=embed">
  </iframe>
  <br />
  <small><a href="https://maps.google.co.uk/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=St+Peter's+School,+Oliver's+Battery+Road+North,+Winchester,+Hampshire,+SO22+4JB&amp;aq=&amp;sll=51.03302,-1.470238&amp;sspn=0.702997,1.783905&amp;ie=UTF8&amp;hq=&amp;hnear=St+Peters+School,+Oliver's+Battery+Rd+N,+Winchester+SO22+4JB,+United+Kingdom&amp;ll=51.051132,-1.346643&amp;spn=0.00549,0.013937&amp;t=m&amp;z=14" style="color:#0000FF;text-align:left" target="_blank">View on Google Maps</a></small>
  <!-- End of Google map -->
  <br />
  <small><a href="http://www.streetmap.co.uk/map.srf?x=445893&y=128179&z=0&sv=SO22+4JB&st=2&pc=SO22+4JB&mapp=map.srf&searchp=ids.srf" target="_blank">View on Streetmap</a></small>
</div>

<!-- Call the end of page tidying up function -->
<!-- The first parameter is the update message for the page. -->
<!-- The second parameter is a boolean which switches on a "Return to Top" button if TRUE -->
<?php	htmlFooter("file", FALSE); ?>
