*********************************************************************************
* Filename:     z_readme-gallery.txt                                            *
* Version:      18.05.2013, 14:26hr                                             *
* Author:       David Argles, daargles@gmail.com                                *
* Description:  ReadMe file for websites wanting to use the "gallery" facility. *
*               It explains how it works and how to set one up.                 * 
*********************************************************************************

Philosophy
==========
The basic idea is that it should be possible to have a painless display of 
photos without having to individually format every single item.  There is a 
gallery page which displays thumbnails (gallery.php) and a viewer which allows 
one to look closer at individual photos (viewer.php).  These two files should 
be included in the site directory, but should not be altered (except in one or 
two clearly marked places). 
Along with these two files, it is also necessary to create a "gallery" 
subdirectory.  New photos should then be placed in a new (sub)directory within 
"gallery", the code will do all the rest.

HowTo
=====
1)  The idea is that gallery.php and viewer.php shouldn't be touched, just copy 
     them into your web directory.  Except you will need to change just one or 
     two places which are hopefully now clearly marked; it's things like the page 
     name that will be specific to your site.
2)  Create a "gallery" subdirectory within your web directory.
3)  Take a directory of pictures which you want to display and copy the whole 
     thing (directory included) into "gallery".
4)  "gallery.php" will immediately display a set of default thumbnails (a rather 
     ugly graphic at the moment, but it was quick to throw together for testing).  
5)  Clicking on one of these thumbnails will take you to viewer.php which will 
     display the chosen picture.
6)  It's then possible to navigate through the set using the "prev" and "next" 
     links next to the title.
7)  Meaningful thumbnails can then be created alongside the pictures themselves.  
     For a picture named "picture.jpg", the thumbnail *must* be called 
     "picture_t.jpg" for "gallery.php" to recognise it.
8)  Pictures *must* be named "xxx.jpg" (i.e. any name you like, but with exactly 
     ".jpg" as the extension) for the gallery page to recognise them.  This means 
     that anything with a ".JPG" or a ".jpeg" extension must be renamed in order 
     to show.  OK, I know that's annoying, but the really clever code needs 
     writing to make it work differently.  I *suspect* that gifs would display - 
     so long as they are renamed "xxx.jpg"!  Hmm...
9)  The default title for an individual picture will be the filename of that 
     picture.  You can give it a meaningful description if you wish by creating 
     an "xxx.txt" file, i.e. "picture.txt" will display as the description for 
     "picture.jpg".
10) The default title for the complete set of pictures will be the name that you 
     gave the containing subdirectory.  Instead of this, a decent title can be set 
     by creating a "title.txt" file inside the subdirectory alongside the picture 
     files.
11) A meaningful description for the set can be added by creating a 
     "description.txt" file, again within the containing subdirectory.
12) Alternatively, you can embed a video by creating a (sub)directory with a 
     "content.ins" (can contain html) file in it.  A "title.txt" makes it look 
     nice, too; and a "description.txt" could be added also, just as with the 
     photos.
13) Actually, you can create just about anything you like using this approach... 
     (I'm not sure about the wisdom of that in the long term, I've not protected 
     the page from scary stuff...)  But for now, it could be fun to experiment 
     with.

Summary
=======
The main idea of this is that it is mind-numbingly simple (and quick) to add 
collections of photos to a page.  They are immediately displayed; and things 
like thumbnails can then be added later (although it's much nicer if they're done straightaway).  But you don't have to spend ages placing every photo individually 
and formatting it, etc, etc.

--- end of file ---
