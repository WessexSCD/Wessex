<?php
############################################################
# GALLERY CODE
# Author:       David Argles (daargles@gmail.com)
$galleryVersion = "16Aug2013, 07:05h";
# Purpose:
#  Basically, this include just has one function - displayMedia - 
#  which displays a gallery of picture thumbnails when called.
#  displayGallery is also defined, which assumes a gallery of 
#  pictures in a directory named "gallery".
#
# A full "HowTo" is included in "z_readme-gallery.txt"
############################################################
# This function displays a gallery when called
#-----------------------------------------------------------
function displayMedia($dirname) { 
?>

<?php
    /* We're going to need to know which page we are, so get it now */
    $retPage=substr(strrchr($_SERVER['PHP_SELF'], "/"),1);
    /* We now need the contents of the media directory in alphabetical order; 
       put into an array, $result; flag error if path is wrong */
    @$result=scandir($dirname, 0);
    if (!$result) echo("<p class=\"indent\"><b>Picture Error:</b> <i>picture directory (".$dirname.") not found!</i>\n</p>");
    /* If that worked OK... */
    else{
      /* Get the next entry in the directory listing - it should be a sub-directory */
      for ($i=0; $i<count($result); $i++)
      {
        $picDir=$result[$i];
      /* Ignore the .. and . directory entries */
      if($picDir != ".." & $picDir != ".") 
      {
        /* Set up $title to be the section title; default is directory name */
        $title = $picDir;
        /* See if there's a title.txt inside this subdirectory */
        $filename = $dirname."/".$picDir."/title.txt";
        /* (The leading @ suppresses error reporting if the file's not there) */
        @$file_handle = fopen($filename, "r");
        /* If so, we need only the first line of the file (it's a title...) */
        if($file_handle)
        {
          $title = fgets($file_handle);
          fclose($file_handle);
        }
        /* List the collection name as a centred heading */
        echo("  <h5>".$title."</h5>\n");

        /* Now get the directory description if there is one */
        $filename = $dirname."/".$picDir."/description.txt";
        /* (The leading @ suppresses error reporting if the file's not there) */
        @$file_handle = fopen($filename, "r");
        /* If so, we need only the first line of the file (it's a one liner...) */
        if($file_handle)
        {
          /* Now display it on the page */
          echo("  <p class=\"centre\">".fgets($file_handle)."</p>\n");
          fclose($file_handle);
        }

        /* Now see if there's a content.ins file */
        $contentfile = FALSE;
        $filename = $dirname."/".$picDir."/content.ins";
        /* (The leading @ suppresses error reporting if the file's not there) */
        @$file_handle = fopen($filename, "r");
        /* If so, we need all the content of the file */
        if($file_handle)
        {
          $contentfile = TRUE;
          while(!feof($file_handle))
          {
            /* Display it on the page */
            echo(fgets($file_handle));
          }
          fclose($file_handle);
        }

         /* Now get the pictures in the directory and display their thumbnails */
        @$handlePicDir=opendir($dirname."/".$picDir);
        if (!$handlePicDir) $handlePicDir=opendir($dirname);
       /* Start a containing div for the pics */
        echo ("  <div class=\"galleryPadLeft\">");
        echo ("&nbsp;");
        echo ("</div>\n");
        echo ("  <div class=\"galleryIndent\">\n");
        /* Get the next entry in the picture sub-directory */
        $picCounter = 0; /* We'll use this to count the no of pictures in this dir */
        while($picitem=readdir($handlePicDir)) 
        {
          /* Is this a full-sized picture? */
          if(strstr($picitem, ".jpg", FALSE) && !strpos($picitem, "_t."))
          {
            /* If so, we need to remember the filename */
            $piclist[$picCounter] = $picitem;
            $picCounter++;
            /* Is there a corresponding thumbnail? */
            $thumbPic = "../graphics/default-t.jpg";
            $thumbName = strstr($picitem, ".jpg", TRUE)."_t.jpg";
            /* Try opening the file */
            $fullname = $dirname."/".$picDir."/".$thumbName;
            @$thumb_handle = fopen($fullname, "r");
            /* If it's there, we need to update $thumbPic and close the file */
            if($thumb_handle)
            {
              $thumbPic = $dirname."/".$picDir."/".$thumbName;
              fclose($thumb_handle);
            }
            /* Is there a corresponding picture description? */
            $picDescription = $picitem;
            $picDescFile = strstr($picitem, ".jpg", TRUE).".txt";
            /* Try opening the file */
            $fullname = $dirname."/".$picDir."/".$picDescFile;
            @$desc_handle = fopen($fullname, "r");
            /* If it's there, we need to update $picDescription and close the file */
            if($desc_handle)
            {
              $picDescription = "";
              while(!feof($desc_handle))
              {
                /* Spool it into $picDescription */
                $picDescription .= fgets($desc_handle);
              }
             fclose($desc_handle);
            }
            /* Now display the thumbnail */
            echo("    <div class=\"img\">\n");
            echo("      <a href=\"viewer.php?picdir=".$dirname."/".$picDir."&amp;picname=".$picitem."&amp;retpage=".$retPage."\">");
            echo("<img src=\"".$thumbPic."\" alt=\"thumbnail of ".$picitem."\" width=\"110\" height=\"90\" /></a>\n");
            echo("      <div class=\"desc\">".$picDescription."</div>
");
            echo("    </div>\n");
          }

          /* Ignore anything that's not a thumbnail 
          if(strpos($picitem, "_t.")) 
          {
            /* Work out the name of the related big pic 
            $bigpic = strstr($picitem, "_t.", TRUE).strstr($picitem, ".", FALSE);
            /* Set up the session variable for viewer.php 
            $_SESSION['path']=$dirname."/".$picDir;
            $_SESSION['picname']=$bigpic;
          }*/
        }
        /* Close the containing div */
        if($picCounter>0) echo("    <p class=\"clear\"></p>\n    <p class=\"icentre\">--- Click on pictures to enlarge ---</p>\n");
        echo ("  </div>\n");
        /* We need to clear the "float left" */
        echo ("  <p class=\"clear\"></p>\n");
        /* If we didn't find any content, we ought to say so */
        if($picCounter==0 && !$contentfile) echo("  <p class=\"centre\">(No pictures found)</p>\n");

        /* echo("<div>(".$picCounter." pictures in this folder)</div>"); */
      }
      }
    }
}
############################################################
# This function displays a gallery when called
#-----------------------------------------------------------
function displayGallery() {
?>
<p></p>
<?php 
  displayMedia("gallery");
}
############################################################
# 	--- END OF GALLERY.INC ---
############################################################
