<?php
	require("../includes/template.inc");
	htmlHeader("Winchester RSCDS Home");
	htmlMenusFloat("tarblank.gif");
	?>

<!-- Page content starts here -->
  <?php insertGraphic("dancers"); ?>

  <h2>Who are we?</h2>
  <p class="indent">An active group of dancers who meet each week to dance and enjoy one another's company. As the official RSCDS Group in Winchester, we offer dancing at all levels from absolute beginner (Tuesdays only) to expert.
  </p>

  <h2>When do we meet?</h2>
  <p></p>
	<table class="indent">
           <tbody>
            <tr>
             <td>Mixed Ability (Teaching) Class:</td>
             <td>Tuesdays 8:00-10:00 pm</td>
            </tr>
            <tr>
             <td>Club Night (Dance practice):</td>
             <td>1st and 3rd Wednesdays 8:00-10:00 pm</td>
            </tr>
           </tbody>
          </table>
  <p class="indent">For Term Dates see <a href="programme.php">Programme</a>
  </p>

  <?php insertGraphic("thistle"); ?>

  <h2>Where do we meet?</h2>
  <p class="indent">St Peter's School Hall, Oliver's Battery Road North, Winchester, Hampshire, SO22 4JB</p>

  <p class="indent">Oliver's Battery Road North is at the top of Romsey Road.</p>

  <p class="indent">Enter by the wooden gate to the left of the church.</p>

  <p class="indent"><a href="map.php">Click here for map</a></p>

  <h2>Committee Members</h2>
  <p class="indent">(For meeting dates see Programme)</p>
  	<table class="indent">
          <tbody>
           <tr>
            <td>Chairman</td>
            <td>Alison Young</td>
           </tr>
           <tr>
            <td>Secretary</td>
            <td>Margaret Hamilton<br /><a href="mailto:hamilton@ilett.bbmax.co.uk">hamilton@ilett.bbmax.co.uk</a><br />01962 715868</td>
           </tr>
           <tr>
            <td>Treasurer</td>
            <td>Robert Morgan</td>
           </tr>
           <tr>
            <td>Members</td>
            <td>Wendy Mumford<br />
Catriona Warner<br />
Ailsa Greenlees<br />
            Marian Speakman<br />
            Adrian Cook<br />
            Margaret Linton</td>
           </tr>
           <tr>
            <td>Membership Secretary</td>
            <td>Marian Speakman</td>
           </tr>
          </tbody>
         </table>
  <p></p>

  <h2>For more information contact one of our RSCDS qualified teachers</h2>
  <p></p>
	<table class="indent">
           <tbody>
            <tr>
             <td><a href="mailto:wendy@mumford.com">wendy@mumford.com</a></td>
             <td>01264 363293</td>
            </tr>
            <tr>
             <td><a href="mailto:robert.fieldhead@tiscali.co.uk">robert.fieldhead@tiscali.co.uk</a></td>
             <td>01590 623849</td>
            </tr>
<?php /*
            <tr>
             <td><a href="mailto:marian@dovesfigary.com">marian@dovesfigary.com</a></td>
             <td>01794 513676</td>
            </tr> */
?>
           </tbody>
          </table>
  <p></p>

  <h2>Links</h2>
  <p></p>
  <ul class="links">
    <li><a href="http://www.rscds.org/">RSCDS</a> (Royal Scottish Country Dance Society)</li>
  <?php common_scd_links(); ?>
  <?php /*<li><a href="http://wendy.mumford.com/">Wendy Mumford's web site</a></li> Note: Wendy's site is not currently live (19.03.13)*/ ?>
  </ul>

<!-- Call the end of page tidying up function -->
<!-- The first parameter is the update message for the page.  If instead you use the keyword
       "file", it will:
       - use the first line of the contents of "updates.txt" as the update message *if* this page
         is "index.php"
       - otherwise, it will not display anything at all. -->
<!-- The second parameter is a boolean which switches off the "Return to Top" button if FALSE -->
<?php	htmlFooter("file", TRUE); ?>
