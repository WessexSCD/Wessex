<?php
/**
 * fees.php displays the fees for our new (version 2) Winchester web pages.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 18-02-2014, 19:34h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
   * You may uncomment it during development, but don't forget to comment it 
   * out again when the page goes live! */
  //ini_set("display_errors", 1);

  /* The next two lines bring in the webpage class and create a new instance.
   * Don't change these lines! */
  require("../library/webpage.php");
  $page = new webpage();
  
  /* If you need access to the database, you'll need to uncomment the next two lines 
   * to bring in the database class and create a new instance.  It must be done 
   * -before- we start streaming the HTML.
   * Don't change these lines! */
  //require("library/database.php");
  //$database = new database();
  
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
  
  /* The HTML section that follows is the space for you to put all your main page content.
   * Aim to use just <p> for paragrpahs, and just <h3> for sub-headings.  Let the CSS do 
   * all the work! */
?>
       <!-- The main page content starts here -->
       
        <!-- The next line inserts the Two Dancers graphic on the page.  Comment it out if 
            you don't want it displayed -->
       <?php $page->insertGraphic("dancers"); ?>
       
  <h2>Subscription Fees</h2>
  <p></p>

  <h2>Annual Membership</h2>
  <p></p>
            <table class="tbl">
              <colgroup>
                <col width="050" />
                <col width="120" />
                <col width="390" />
              </colgroup>
              <tbody>
                <tr class="top">
                 <td class="right">£21.00</td>
                  <td>Adult Full</td>
                  <td>(£16 RSDCS + £5 to Winchester Branch)</td>
                </tr>
                <tr class="top">
                  <td class="right">£36.00</td>
                  <td>Adult Joint</td>
                  <td>(£26 RSDCS + £10 to Winchester Branch)<br />Two members of same household receiving one magazine per household</td>
                </tr>
                <tr class="top">
                  <td class="right">£5.00</td>
                  <td>Country Full</td>
                  <td>(£5 to Winchester Branch, RSCDS paid elsewhere)<br />Reduced rates for younger members</td>
                </tr>
              </tbody>
            </table>

  <!-- ?php insertGraphic("thistle"); ? -->

            <h2>Club Night</h2>
	    <p></p>
            <table class="tblNarrow">
              <colgroup>
                <col width="050" />
                <col width="300" />
              </colgroup>
              <tbody>
                <tr  class="top">
                  <td class="right">£4.00</td>
                  <td>Non-members and visitors</td>
                </tr>
                <tr  class="top">
                  <td class="right">£3.00</td>
                  <td>Members and Country Members</td>
                </tr>
                <tr  class="top">
                  <td class="right">£1.50</td>
                  <td>Full time students</td>
                </tr>
              </tbody>
            </table>
	    <p></p>

            <h2>Teaching Night</h2>
	    <p></p>
            <table class="tblNarrow">
              <colgroup>
                <col width="050" />
                <col width="300" />
              </colgroup>
                <tr  class="top">
                  <td class="right">£4.00</td>
                  <td>Non-members and visitors  </td>
                </tr>
                <tr class="top">
                  <td class="right">£3.00</td>
                  <td>Members and Country Members  </td>
                </tr>
                <tr class="top">
                  <td class="right">£1.50</td>
                  <td>Full time students</td>
                </tr>
            </table>
        <!-- The next line inserts the Thistle graphic on the page.  Uncomment it if 
            you want it displayed -->
       <?php //$page->insertGraphic("thistle"); ?>
       
<?php
  /* The next three lines display a list of useful links. Uncomment them if you want them to display */
  /* echo("      <h2>Links</h2>\n      <p></p>\n      <ul class=\"links\">");
  $page->common_scd_links();
  echo("      </ul>\n"); */
  
  /* The next line displays a "Return to Top" button at the foot of the page
   * Uncomment it if you want it to display */
  echo("        <a class=\"doubleBottom\" href=\"".$_SERVER['PHP_SELF']."\">Return to top</a>\n");  

  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
