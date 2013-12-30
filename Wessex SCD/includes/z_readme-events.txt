*********************************************************************************
* Filename:     z_readme-events.txt                                             *
* Version:      18.05.2013, 14:31hr                                             *
* Author:       David Argles, daargles@gmail.com                                *
* Description:  ReadMe file for websites wanting to use the "events" facility.  *
*               It explains how it works and how to set one up.                 * 
*********************************************************************************

Philosophy
==========
Certain clubs (currently Winchester, I believe) like to display a diary of 
forthcoming events.  This leads to a small but additional management load, since 
the events list needs updating periodically, simply to remove events that are now 
in the past.  The idea of this facility is to provide a way of displaying a list 
of events that will automatically ignore any dates that are now in the past.  It 
is driven by a CSV file, so it also has the advantage that it is very quick and 
easy to create and to add new events to the list.

Usage
=====
To create a list in the first place, create a CSV with two columns.  The first 
column *must* be a date, and the second is expected to be a description of the 
corresponding event.

NOTE: dates can be in any format, but php seems to like US-style dates, so 
"3/4/13" will display as "4th Mar 2013".  (Actually, it won't display at all as 
it's now in the past ;-) but it would have done before that).

The list of events is called up simply by calling 'displayProgramme("filename.csv")' 
within the relevant php page, where <filename.csv> is the name of your csv file.  
It doesn't matter what format you've used for the event date, it will always 
display in the format "Tuesday 4th Mar 2014".  The idea behind this is that you 
can put a simple date in the CSV and let the code sort out the fancy stuff for 
display.

The pro-forma-file is called <programme.csv>, but it can be called anything you 
like.  This means that it is possible to have multiple events lists within a 
club site, so you could have one list for 2013 say, then a heading and maybe some 
text, then another list for 2014, all on the same page.

Possible Development
====================
The facility doesn't deal with the display as seen in the current Winchester site.  
At one point in their listing, they give very full details of the event which 
extends over many lines of display.  This could be dealt with by providing two 
events lists, one either side of the extensive single event listing.  But it 
wouldn't update correctly when the event ceased to be in the future.

So another possibility would be to update 'displayProgramme()' so that it allows 
miltiple columns in the CSV; if it finds additional columns after the primary event 
description, it would then display these as further lines in the decription 
column.  I don't think this would be hard to do, and could be useful.

Another possibility would be to gently suggest to the club that this is perhaps 
not the best way to present an events calendar ;-)  Rather, one shoud perhaps 
give a link to another page, or more likely a printable PDF that gives the details 
required.

--- end of file ---
