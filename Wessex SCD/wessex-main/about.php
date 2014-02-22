<?php
/**
 * about.php presents the excitement of Scottish Country Dancing to newcomers.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 22-02-2014, 23:17h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
     Uncomment it during development. */
  //ini_set("display_errors", 1);

  /* The next two lines bring in the webpage class and create a new instance.
     Don't change these lines! */
  require("library/webpage.php");
  $page = new webpage();
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
  /* The next line inserts the Two Dancers graphic on the page.  Comment it out if 
   * you don't want it displayed */
  $page->insertGraphic("dancers");
?>
      <h3>About Scottish Country Dancing</h3>

      <p>Scottish Country Dancing is the traditional ballroom dancing of Scotland. 
      The Royal Scottish Country Dance Society, based in Edinburgh, was founded in 
      1923 to preserve this joyful social dance tradition. Since then Scottish 
      Country Dancing has spread all over the world.</p> 

      <p>Scottish Country dances are danced with partners in sets of two or more 
      couples doing an exciting variety of formations. The dances vary in tempo, 
      including lively jigs, hornpipes and reels, and the slower, elegant 
      strathspeys.</p> 

      <p>If you want to join in an activity that is both friendly and fun, why not 
      try Scottish Country Dancing? Anyone of any age can have a go and it gives 
      you the opportunity to enjoy a hobby that's a guaranteed way of forgetting 
      your worries, meeting friends and having fun as well as an energetic way of 
      keeping fit.</p>	  	
<?php
  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
