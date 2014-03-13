<?php
/**
 * modify.php allows us to modify entries in our Wessex SCD database.
 *
 * It calls our class, webpage, sets the title for our page, sets the page content,
 * & streams the completed boilerplate code.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 13-03-2014, 00:05h
 * @copyright 2014 Wessex SCD
 */

  /* The following line makes the server display error messages.
   * You may uncomment it during development, but don't forget to comment it 
   * out again when the page goes live! */
  ini_set("display_errors", 1);

  /* The next two lines bring in the webpage class and create a new instance.
   * Don't change these lines! */
  require("../library/webpage.php");
  $page = new webpage();
  
  /* If you need access to the database, you'll need to uncomment the next two lines 
   * to bring in the database class and create a new instance.  It must be done 
   * -before- we start streaming the HTML.
   * Don't change these lines! */
  require("../library/database.php");
  $database = new database($page->rootpath);
  
  /* The next line streams the initial html.  Don't change this. */
  $page->HTMLstreamTop();
  
  /* The HTML section that follows is the space for you to put all your main page content.
   * Aim to use just <p> for paragrpahs, and just <h3> for sub-headings.  Let the CSS do 
   * all the work! */
?>
       <!-- The main page content starts here -->
       
        <!-- The next line inserts the Two Dancers graphic on the page.  Comment it out if 
            you don't want it displayed -->
       <?php //$page->insertGraphic("dancers"); ?>
       
       <h3>Modify Database</h3>
       <p>This page allows us to modify table entries in the Wessex SCD database.</p>
       
       <!-- First, we need to ask which table should be modified -->
       <form action="modify.php" method="get">
       	Select table to modify: <input  type="text" name="tableChoice" list="tables">
          <?php 
          	  $database->query("SHOW TABLES");
	    	  /* We'd better know if there was a problem */
	    	  if($database->error) echo($database->error);
              echo("<datalist id=\"tables\">\n");
			  while ($row = $database->result->fetch_object())
				foreach($row as $pointer=>$table) echo("            <option value='$table'>\n");
			  echo("          </datalist>\n");
          	?>
        <input name="Table choice" value="Select Table" type="submit">
        <?php
          if(isset($_GET[tableChoice]))$table = $_GET[tableChoice];
          /* Let's make the default table choice "bands" for now */
          else $table = "bands";
        ?>
        
       </form>

      <?php $rownum=2; ?>
       <p>Current table: <?php echo $table; ?> &nbsp; Current entry: <?php echo $rownum; ?></p>

      	 <?php
            /* Before we can display the table data, we need to find 
       	    out what the field names are for the chosen table */
            $database->query("SHOW COLUMNS FROM $table");
	       /* We'd better know if there was a problem */
	       if($database->error) echo($database->error);
		  /*echo"<pre>";
		  print_r($database->result);
		  echo"</pre>"; */ 
		   $firstField = "";
		   while ($row = $database->result->fetch_object())
		   foreach($row as $pointer=>$field) if($pointer=="Field") if($firstField == "") $firstField = $field;
		 ?>

       <!-- Now we can display the chosen record -->       
       <?php   
           $database->query("SELECT * FROM $table WHERE ($firstField = '$rownum')");
		   //echo("SELECT * FROM $table WHERE ($firstField = '$rownum')");
	       /* We'd better know if there was a problem */
	       if($database->error) echo($database->error);
           echo("<form action=modify.php method=\"get\">\n");
		   echo("<table>");
		   while ($row = $database->result->fetch_object())
		   foreach($row as $pointer=>$field)
		   {
		   	 echo("\n            <tr><td>$pointer:</td><td><input value=\"$field\" type=\"text\"></td></tr>\n");
		   
		  /*echo"<pre>";
		  print_r($row);
		  echo"</pre>";*/
		   }
           echo("        <tr><td></td><td><input name=\"Update record\" value=\"Update Record\" type=\"submit\"></td></tr>\n");
		   echo("</table>");
           echo("</form>");
	   ?>


       <?php 
         //$database->rebuild();
       ?>

       <!-- The next line inserts the Thistle graphic on the page.  Uncomment it if 
            you want it displayed -->
       <?php //$page->insertGraphic("thistle"); ?>
       
<?php
  /* The next line displays a "Return to Top" button at the foot of the page
   * Uncomment it if you want it to display */
  // echo("        <a class=\"doubleBottom\" href=\"".$_SERVER['PHP_SELF']."\">Return to top</a>\n");  

  /* The final line streams the final html.  Don't change this. */
  $page->HTMLstreamBottom();
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
