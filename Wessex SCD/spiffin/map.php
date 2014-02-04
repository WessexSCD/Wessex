<?php
//---------------------------------------------------------------------------------------------
// File:    map.php
// Author:  David Argles (d.argles@gmx.com)
// Version: 17.05.2013 17.58h
// Purpose:
//   Inserting a map is just a little bit different, so here is an example to give the idea. 
//   This example is based on the Winchester RSCDS site.
//---------------------------------------------------------------------------------------------
    /* Bring in the template file from the includes directory */
    require("../includes/template.inc");
    /* NOTE: Any pre-display php code needs to go here (e.g. setting up session variables) */
    /* Now set up the heading html.
        This inlcudes the page title for the top of the browser bar */
    htmlHeader("Spiffin SCDs: How to find us"); //Don't forget to personalise this page title
    /* NOTE: Do not put ANY html code before this point - including comments! */
    /* Now set up the menu bar. The background is specified in the parameter
        and should be placed in the main graphics directory */
    htmlMenusFloat("tarblank.gif"); /* Change the tartan graphic if you wish.  It is expecting
                                        to find it in the main graphics directory */
?>

<!-- Page content starts here -->

<div class="centre">
  <h4>How to Find Us</h4>
  <p>The hall is on the corner of St James Road and Colebrook Avenue.</p>

  <!-- Google map follows -->
  <!-- Note: remove the formatting info from Google's code paste and insert 'class="map"'
        instead - otherwise it won't display properly! -->
<iframe class="map" src="https://maps.google.co.uk/maps?f=d&amp;source=s_d&amp;saddr=50.925646,-1.428072&amp;daddr=&amp;hl=en&amp;geocode=&amp;sll=50.9257,-1.427965&amp;sspn=0.005789,0.013937&amp;mra=mift&amp;mrsp=0&amp;sz=17&amp;ie=UTF8&amp;t=m&amp;ll=50.9257,-1.427965&amp;spn=0.005789,0.013937&amp;output=embed"></iframe>
<br />
<small><a href="https://maps.google.co.uk/maps?f=d&amp;source=embed&amp;saddr=50.925646,-1.428072&amp;daddr=&amp;hl=en&amp;geocode=&amp;sll=50.9257,-1.427965&amp;sspn=0.005789,0.013937&amp;mra=mift&amp;mrsp=0&amp;sz=17&amp;ie=UTF8&amp;t=m&amp;ll=50.9257,-1.427965&amp;spn=0.005789,0.013937" style="color:#0000FF;text-align:left" target="_blank">View on Google Maps</a></small>

<!-- iframe class="map" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=St+James+parish+church+hall,+shirley,+southampton&amp;aq=&amp;sll=52.8382,-2.327815&amp;sspn=10.879723,10.415039&amp;ie=UTF8&amp;hq=St+James+parish+church+hall,&amp;hnear=Shirley,+Southampton,+United+Kingdom&amp;ll=50.926677,-1.428388&amp;spn=0.022019,0.055747&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=18202290906764313274&amp;output=embed"></iframe>
<br />
<small><a href="https://maps.google.co.uk/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=St+James+parish+church+hall,+shirley,+southampton&amp;aq=&amp;sll=52.8382,-2.327815&amp;sspn=10.879723,10.415039&amp;ie=UTF8&amp;hq=St+James+parish+church+hall,&amp;hnear=Shirley,+Southampton,+United+Kingdom&amp;ll=50.926677,-1.428388&amp;spn=0.022019,0.055747&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=18202290906764313274" style="color:#0000FF;text-align:left" target="_blank">View on Google Maps</a></small -->

  <!-- End of Google map -->
  <br />
  <small><a href="http://www.streetmap.co.uk/map.srf?x=440329&y=114173&z=110&sv=440329,114173&st=4&ar=y&mapp=map.srf&searchp=ids.srf&dn=719&ax=440329&ay=114173&lm=0" target="_blank">View on Streetmap</a></small>
</div>

<!-- Call the end of page tidying up function -->
<!-- The first parameter is the update message for the page. -->
<!-- The second parameter is a boolean which switches on a "Return to Top" button if TRUE -->
<?php	htmlFooter("file", FALSE); ?>
