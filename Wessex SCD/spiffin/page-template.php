<?php
//---------------------------------------------------------------------------------------------
// File: page-template.php
// Author:  David Argles (d.argles@gmx.com)
// Version: 17.05.2013 17.02h
// Purpose:
//   The following page is designed to give a responsive layout and links with:
//   - "template.inc", a php file that includes functions that handle layout and code that is
//     common to most pages.  It works in conjunction with:
//   - "reset.css" which contains all the css necessary to reset browser defaults.
//   - "gallery.css" which contains all the formatting nessary if a gallery is included
//   - "normal.css" which is desgned, as far as possible, to contain *all* the formatting
//     information that is required for the site layout.  It should mean that if a change is
//     required to site layout, it should be possible to achive this for the entire site by
//     changing *only* normal.css.
//   - If including a gallery, it will also be necessary to bring in "gallery.inc".
//   See "readme.txt" (in the "includes" directory) for more information.
//---------------------------------------------------------------------------------------------
    /* Bring in the template file from the includes directory */
    require("../includes/template.inc");
    /* Uncomment the following line if you want to include a gallery of photos */
    // require("../includes/gallery.inc");
    /* NOTE: Any pre-display php code needs to go here (e.g. setting up session variables) */
    // setvars();
    /* Now set up the heading html. This inlcudes the page title for the top of the browser bar */
    htmlHeader("Winchester RSCDS: this page name"); //Don't forget to personalise this page title
    /* NOTE: Do not put ANY html code before this point - including comments! */
    /* Now set up the menu bar. The background is specified in the parameter
        and should be placed in the main graphics directory */
    htmlMenusFloat("tarblank.gif"); /* Change the tartan graphic if you wish.  It is expecting
                                        to find it in the main graphics directory */
?>

<!-- Page content starts here -->

  <!-- he following line should be omitted if you create a "site-title.txt" file -->
  <h1>Replace this with the name of the club</h1>

  <!-- The following line puts the two dancers graphic at the top, just under the title -->
  <?php insertGraphic("dancers"); ?>

  <!-- The following line will display a gallery (of photos) if you uncomment it.
           But read the readme file first! -->
  <?php /* displayGallery(); */ ?>

  <!-- The following line will display an automatically updated CSV of events if you uncomment it.
           Read the readme first... although I've not written it yet... :-(  -->
  <?php /* displayCSV("programme.csv"); */ ?>

  <!-- The following line will list the contents of a directory if uncommented.  
           In this case, it will:
           - list the contents of directory "newsletters";
           - not display any ".doc" extensions; and
           - list them in reverse order.  
           See comments in template.inc for more details. -->
  <?php /* dir_list("newsletters", ".doc", 1); */ ?>

	<!-- If not using any of the above special features, and if this is a normal content
           page, insert the first paragraph or two of your page content in this space -->

  <!-- Insert the next line after a couple of paragraphs to get the thistle graphic -->
  <?php insertGraphic("thistle"); ?>

	<!-- Insert the rest of your page content in this space -->

  <!-- The following line will insert a list of common links if you uncomment it.
           You don't need to look at the readme to understand this... -->
  <?php /* common_scd_links(); */ ?>

<!-- Call the end of page tidying up function -->
<!-- The first parameter is the update message for the page.  If instead you use the keyword
       "file", it will:
       - use the first line of the contents of "updates.txt" as the update message *if* this page
         is "index.php"
       - otherwise, it will not display anything at all. -->
<!-- The second parameter is a boolean which switches on a "Return to Top" button if TRUE -->
<?php	htmlFooter("file", FALSE); ?>
