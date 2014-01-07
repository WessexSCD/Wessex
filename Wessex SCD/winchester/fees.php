<?php
	require("../includes/template.inc");
	htmlHeader("Winchester RSCDS: Fees");
	htmlMenusFloat("tarblank.gif");
	?>

<!-- Page content starts here -->

  <?php insertGraphic("dancers"); ?>

  <h2>Subscription Fees</h2>
  <p></p>

  <h2>Annual Membership</h2>
  <p></p>
            <table class="tbl">
              <colgroup>
                <col width="050" />
                <col width="105" />
                <col width="390" />
              </colgroup>
              <tbody>
                <tr class="top">
                 <td class="right">£21.00</td>
                  <td>Adult Full</td>
                  <td> (£16 RSDCS + £5 to Winchester Branch)  </td>
                </tr>
                <tr class="top">
                  <td class="right">£36.00</td>
                  <td>Adult Joint  </td>
                  <td> (£26 RSDCS + £10 to Winchester Branch)<br />Two members of same household receiving one magazine per household </td>
                </tr>
                <tr class="top">
                  <td class="right">£5.00</td>
                  <td>Country Full  </td>
                  <td> (£5 to Winchester Branch, RSCDS paid elsewhere)<br /><br />Reduced rates for younger members </td>
                </tr>
              </tbody>
            </table>

  <!-- ?php insertGraphic("thistle"); ? -->

            <h2>Club Night</h2>
	    <p></p>
            <table class="tblNarrow">
              <colgroup>
                <col width="050" />
                <col width="210" />
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
                <col width="210" />
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
                  <td>Full time students<br /><br /> </td>
                </tr>
            </table>

<!-- Call the end of page tidying up function -->
<!-- The first parameter is the update message for the page.  If instead you use the keyword
       "file", it will:
       - use the first line of the contents of "updates.txt" as the update message *if* this page
         is "index.php"
       - otherwise, it will not display anything at all. -->
<!-- The second parameter is a boolean which switches off the "Return to Top" button if FALSE -->
<?php	htmlFooter("file", FALSE); ?>
