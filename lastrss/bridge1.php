<?php

/*
======================================================================
LastRSS bridge script- By Dynamic Drive (http://www.dynamicdrive.com)
Communicates between LastRSS.php to Advanced Ajax ticker script using Ajax. Returns RSS feed in XML format
Created: Feb 9th, 2006. Updated: Feb 9th, 2006
======================================================================
*/

header('Content-type: text/xml');

// include lastRSS
include "lastRSS1.php"; //path to lastRSS.php on your server from this script ("bridge.php")

// Create lastRSS object
$rss = new lastRSS;
$rss->cache_dir = 'cache'; //path to cache directory on your server from this script. Chmod 777!
$rss->date_format = 'M d, Y g:i:s A'; //date format of RSS item. See PHP date() function for possible input.

$rssid=$_GET['id'];
$cacheseconds=(int) $_GET["cachetime"]; //typecast "cachetime" parameter as integer (0 or greater)
$loc=isset($_GET['loc']) ? $_GET['loc'] : 0;  //return type: 0 -> return XML format; 1 -> return array;
$cache_file = 'static/rsscache'.$rssid.'.xml';

include_once('rssxml1.php');

outputRSS_XML($rssid, $cacheseconds, $loc, $cache_file);
?>