*********************************************************************************
* Filename:     readme.txt                                                      *
* Version:      15.02.2014, 23:58hr                                             *
* Author:       David Argles, daargles@gmail.com                                *
* Description:  Read Me file for websites using "Wessex SCD page generator 2"   *
*               (i.e. any new pages on this site).  It explains how these sites * 
*               work and how to set a new one up.                               *
*********************************************************************************

Philosophy
==========

The idea behind the way this whole site is set up is that it's good to "KISS your 
DRY SOCs"!  That is:

  KISS: Keep It Stupidly Simple (not as easy in practice as one would like).
  DRY:  Don't Repeat Yourself.  So if it's necessary to make the same change in two 
         differeent places, we've failed.
  SOCs: There should be a Separation Of Concerns.
  
The last point means that there should be a clear division of content.  It's 
currently a bit of a work in progress (and might always be!) but the idea is 
that:

1) Page content should be contained in <pagename>.php files in the root of the 
    <site> directory, one <pagename>.php file for each physical page displayed 
    on the website.  These should contain *only* sufficient text and html to 
    display the main content that varies from page to page, and there should be 
    no style definitions in these pages.  

2) These pages instantiate a "webpage" class defined in a single <webpage.php> 
    file contained in the <library> directory.  This means that any changes to 
    the look and feel of the website are made *once* in webpage.php, not again 
    and again throughout the website!  There is therefore a small amount of 
    "pro forma" code at the beginning and end of each <pagename>.php to call
    the webpage class and instantiate it.
    
3) Basic boilerplate text and menus change from club to club, so configuration 
    information is extracted into a "webpage.ini" file, again in the root of 
    the <site> directory.  Again, this should contain only configuration 
    information; formatting should be handled elsewhere.  This means that there 
    is only one file that handles the menu for all pages for an individual 
    club's website, but that there is a separate one for each club, so it can 
    change from club to club.
    
4) *All* style definitions -should- be contained in the css file (actually, 
    this is hard to achieve in practice for various pragmatic reasons).  
    In this implementation, it has been possible to reduce the number of CSS 
    files to one (there were previously three; this seriously slowed the page 
    download times); it is called "webpage.css" and again is held in the 
    <library> directory.

Layout Rationale
================

5) Each <site> directory should consist mainly of <pagename>.php files.  Other 
    files, like newsletters etc., are removed into sub-directories.  So for 
    winchester, there is a "newsletters" subdirectory, since there are so many 
    of them.  The "resources" sub-directory for that site is for anything else, 
    like application forms or whatever.
    
6) There's also the "webpage.ini" lying amongst the <pagename>.php files; this 
    *must* be present.
    
7) There's also a couple of other files that may be pesent:
   - "updates.txt" maintains a list of updates made to the site.  This can be 
     used to display a brief summary of the latest update(s) on the home page 
     of the site.
   - "index.html" should also be present.  This doesn't change from site to 
     site but simply redirects for backwards compatibility reasons (in case 
     there are old links out on the web pointing to ***/index.html).
     
9) Anything that needs to be available for all sites is in the main public_html 
    directory (the includes and the graphics).

Documentation
=============

The documentation is held in the <documentation> subdirectory.  Inside there, 
the <planning> section contains documents created while building the site, 
whilst <releaseDocs> holds the following documents to help the reader 
understand how to maintain the site.

10) The idea of the "readme.txt" file (this one!) is to explain the rationale 
     behind the site design and how the site works.
     
11) "quickstart.txt" is designed to help someone implement a new club website.

12) "howto.txt" looks at the various site capabilities in more detail.

Practicalities
==============

The basic idea is that it should be really easy to create a completely new 
club site if required, and not too hard to update an old one to the current 
standard.

The basic process for either updating an old site or for creating a new one 
from scratch is now covered in a separate file, "quickstart.txt".  That file 
only gives the outline for getting the simplest of working sites up and running.

--- End of file ---
