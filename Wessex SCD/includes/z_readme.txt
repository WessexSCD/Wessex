*********************************************************************************
* Filename:     z_readme.txt                                                    *
* Version:      27.05.2013, 22:12hr                                             *
* Author:       David Argles, daargles@gmail.com                                *
* Description:  Read Me file for websites using the files in this directory. It * 
*               explains how these sites work and how to set a new one up.      *
*********************************************************************************

Philosophy
==========
The idea behind the way these websites are set up is that there should be a clear division of content.  It's currently a bit of a work in progress (and might always be!) but the idea is that:
1) Page content should be contained in <pagename>.php files in the root of the <site>-new directory, one <pagename>.php file for each physical page displayed on the website.  These should contain *only* sufficient text and html to display the main content that varies from page to page, and there should be no style definitions in these pages.  There has to be some "pro forma" code at the beginning and end of each <pagename>.php to bring in the boilerplate code that needs to surround it.
2) The individual site menus can change from club to club, so the menu information is extracted into a "menu.ins" file, again in the root of the <site>-new directory.  Again, this should contain only menu information; formatting should be handled elsewhere.  This means that there is only one file that handles the menu for all pages for an individual club's website, but that there is a separate one for each club, so it can change from club to club.
3) Any common code required for each page is handled in a template file called "template.inc" and which is located outside of the <site>-new directory in this folder (which is expected to be named "includes" and located in public_html itself).  This means that the boilerplate code can be called from any other club website's sub-directory.  Typically, the boilerplate code includes all the page header stuff and footer stuff.  It also defines the layout of the whole page, but this has to be considered in conjunction with the .css file.
4) *All* style definitions -should- be contained in css files (actually, this is hard to achieve in practice for various pragmatic reasons).  There are currently three .css files which are again located in the "includes" directory in public_html; the main one is "normal.css", which should handle all the look and feel of the website.  In practice, the final layout is likely to be a bit of an interchange between "normal.css" and "template.inc", but apart from the other two .css files, there shouldn't be anything anywhere else that affects it.  Before normal.css is called, "reset.css" is called to make sure the browser's default settings are as they should be; this helps to ensure cross-browser compatibility.  After that, but still before normal.css, "gallery.css" is called.  This enables all gallery-specific formatting to be handled in a single css file.  The gallery facility has its own readme file ("z_readme-gallery.txt").

Layout Rationale
================
5) I've aimed to make the <site>-new directory consist mainly of <pagename>.php files.  Other files, like newsletters etc., are removed into sub-directories.  So for Winchester-new, there is a "newsletters" subdirectory, since there are so many of them.  The "resources" sub-directory for that site is for anything else, like application forms or whatever.
6) There's also the "menu.ins" lying amongst the <pagename>.php files; this *must* be present.
7) There's also a number of optional files that will normally be pesent:
   - "site-title.txt" gives (probably) the club name which will be repeated as a heading on every page.
   - "site-location.txt" gives the geographical location of the club which will be repeated as a sub-heading on every page.
   - "updates.txt" maintains a list of updates made to the site.  This can be used to display a brief summary of the latest update(s) on the home page of the site.
   - "index.html" should also be present.  This doesn't change from site to site but simply redirects for backwards compatibility reasons (in case there are old links out on the web pointing to ***/index.html).
8) It's also possible to include one or more <filename>.csv files.  This (or these) can be called up within a page to display a self-updating list of events.  The events facility has its own readme file ("z_readme-events.txt").
9) Anything that needs to be available for all sites is in the main public_html directory (the includes and the graphics).

Management Files
================
10) The idea of the "z_readme.txt" file (this one!) is to explain the rationale behind the site design and how the site works.
11) "z_updates-log.txt" was originally conceived as being a place where one would make notes during updates as a reminder of what had been done so far and what still needed to be done.  However, it is now also used as a "token" to prevent problems if two people try and update at the same time.  The idea is to make a note that we've started editing when we log on, and then note what we've done as we log off.
12) "z_comments.txt" is designed as a place where one can record ideas for the future, together with comments on why certain decisions have been made.
13) There's also a couple of specific readme files, "z_readme-gallery.txt" and "z_readme-events.txt" which explain those two specific features.

Practicalities
==============
The basic idea is that it should be really easy to create a completely new club site if required, and not too hard to update an old one to the current standard.

The basic process for either updating an old site or for creating a new one from scratch is now covered in a separate file, "z_quickstart.txt".  That file only gives the outline for getting the simplest of working sites up and running.

There is *probably* just about enough detail in page-template.php to show how to use the various more advanced features available, but I'll probably have a go at writing a general "howto" to document all the various features available in the common template.

--- End of file ---
