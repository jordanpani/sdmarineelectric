<?php
// -------------------------------------------------------------------
// outputRSS_XML()- Outputs the "title", "link", "description", and "pubDate" elements of an RSS feed in return type
// -------------------------------------------------------------------
function outputRSS_XML($rssid, $cacheseconds, $loc, $cache_file) {
    global $rss;

	include_once('inidata1.php');

	$rssurl1=isset($rsslist[$rssid][0])? $rsslist[$rssid][0] : "";
	$rssurl2=isset($rsslist[$rssid][1])? $rsslist[$rssid][1] : "";
	$rssloc1=isset($rsslist[$rssid][2])? $rsslist[$rssid][2] : "";
	$rssloc2=isset($rsslist[$rssid][3])? $rsslist[$rssid][3] : "";

    $rss->cache_time = $cacheseconds;

	if(file_exists($cache_file)){
		if(time()-filemtime($cache_file)>$cacheseconds)
			$bWrite=true;
		else
			$bWrite=false;
	} else {
		$bWrite=true;
	}

	if($bWrite && $loc==0){
	    if ($rs = $rss->get($rssurl1)) {
			$txt = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n<rss version=\"2.0\">\n<channel>\n";
		    echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n<rss version=\"2.0\">\n<channel>\n";
        	    foreach ($rs['items'] as $item) {
				  $forecast1 = str_replace(' day="','&lt;b&gt;',$item[forecast1]);
				  $forecast1 = str_replace('" date="','&lt;/b&gt; ',$forecast1);
				  $forecast1 = str_replace('" low="','&lt;br&gt;Low:',$forecast1);
				  $forecast1 = str_replace('" high="','&amp;deg; High:',$forecast1);
				  $forecast1 = str_replace('" text="','&amp;deg;&lt;br&gt;',$forecast1);
				  $forecast1 = str_replace('"','',$forecast1);

				  $forecast2 = str_replace(' day="','&lt;b&gt;',$item[forecast2]);
				  $forecast2 = str_replace('" date="','&lt;/b&gt; ',$forecast2);
				  $forecast2 = str_replace('" low="','&lt;br&gt;Low:',$forecast2);
				  $forecast2 = str_replace('" high="','&amp;deg; High:',$forecast2);
				  $forecast2 = str_replace('" text="','&amp;deg;&lt;br&gt;',$forecast2);
				  $forecast2 = str_replace('"','',$forecast2);

                  echo "<item>\n<title>$item[title]</title>\n<location>".$rssloc1."</location>\n<description>$item[description]</description>\n<pubDate>".str_replace('2006 ','2006 &lt;br&gt;     at ',$item[pubDate])."</pubDate>\n<link>$item[link]</link>\n<forecast1>$forecast1</forecast1>\n<forecast2>$forecast2</forecast2>\n</item>\n\n";
				  $txt .= "<item>\n<title>$item[title]</title>\n<location>".$rssloc1."</location>\n<description>$item[description]</description>\n<pubDate>".str_replace('2006 ','2006 &lt;br&gt;    at ',$item[pubDate])."</pubDate>\n<link>$item[link]</link>\n<forecast1>$item[forecast1]</forecast1>\n<forecast2>$item[forecast2]</forecast2>\n</item>\n\n";
            	}
		    if ($rs = $rss->get($rssurl2)) {
    	        foreach ($rs['items'] as $item) {
				  $forecast1 = str_replace(' day="','&lt;b&gt;',$item[forecast1]);
				  $forecast1 = str_replace('" date="','&lt;/b&gt; ',$forecast1);
				  $forecast1 = str_replace('" low="','&lt;br&gt;Low:',$forecast1);
				  $forecast1 = str_replace('" high="','&amp;deg; High:',$forecast1);
				  $forecast1 = str_replace('" text="','&amp;deg;&lt;br&gt;',$forecast1);
				  $forecast1 = str_replace('"','',$forecast1);

				  $forecast2 = str_replace(' day="','&lt;b&gt;',$item[forecast2]);
				  $forecast2 = str_replace('" date="','&lt;/b&gt; ',$forecast2);
				  $forecast2 = str_replace('" low="','&lt;br&gt;Low:',$forecast2);
				  $forecast2 = str_replace('" high="','&amp;deg; High:',$forecast2);
				  $forecast2 = str_replace('" text="','&amp;deg;&lt;br&gt;',$forecast2);
				  $forecast2 = str_replace('"','',$forecast2);
				  
                  echo "<item>\n<title>$item[title]</title>\n<location>".$rssloc2."</location>\n<description>$item[description]</description>\n<pubDate>".str_replace('2006 ','2006 &lt;br&gt;      at ',$item[pubDate])."</pubDate>\n<link>$item[link]</link>\n<forecast1>$forecast1</forecast1>\n<forecast2>$forecast2</forecast2>\n</item>\n\n";
				  $txt .= "<item>\n<title>$item[title]</title>\n<location>".$rssloc2."</location>\n<description>$item[description]</description>\n<pubDate>".str_replace('2006 ','2006 &lt;br&gt;       at ',$item[pubDate])."</pubDate>\n<link>$item[link]</link>\n<forecast1>$item[forecast1]</forecast1>\n<forecast2>$item[forecast2]</forecast2>\n</item>\n\n";
            	}
			}

			echo "</channel></rss>";
			$txt .= "</channel></rss>";
			if ($rs['items_count'] > 0){
				if ($f = @fopen($cache_file, 'w')) {
					fwrite ($f, $txt, strlen($txt));
					fclose($f);
				}
			   $bBckRSS = false;

			} else {

		       echo "<li>Sorry, no items found in the RSS file :-(</li>";
			   $bBckRSS = true;
		   }

	    } else {
			$bBckRSS = true;
		}

	} else {
		$bBckRSS = true;
	}

	if($bBckRSS || 	$loc>0){
		$rss->cache_dir = '';
	    if ($rs = $rss->get($cache_file)) {
			$nNr=1;
			$txt = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n<rss version=\"2.0\">\n<channel>\n";

        	foreach ($rs['items'] as $item) {

				$forecast1 = str_replace('day=','&lt;b&gt;',$item[forecast1]);
				$forecast1 = str_replace('" date="','&lt;/b&gt; ',$forecast1);
				$forecast1 = str_replace('" low="','&lt;br&gt;Low:',$forecast1);
				$forecast1 = str_replace('" high="','&amp;deg; High:',$forecast1);
				$forecast1 = str_replace('" text="','&amp;deg;&lt;br&gt;',$forecast1);
				$forecast1 = str_replace('"','',$forecast1);

				$forecast2 = str_replace('day=','&lt;b&gt;',$item[forecast2]);
				$forecast2 = str_replace('" date="','&lt;/b&gt; ',$forecast2);
				$forecast2 = str_replace('" low="','&lt;br&gt;Low:',$forecast2);
				$forecast2 = str_replace('" high="','&amp;deg; High:',$forecast2);
				$forecast2 = str_replace('" text="','&amp;deg;&lt;br&gt;',$forecast2);
				$forecast2 = str_replace('"','',$forecast2);


				if($nNr==1){	
					$txt .= "<item>\n<title>$item[title]</title>\n<location>".$rssloc1."</location>\n<description>$item[description]</description>\n<pubDate>$item[pubDate]</pubDate>\n<link>$item[link]</link>\n<forecast1>$forecast1</forecast1>\n<forecast2>$forecast2</forecast2>\n</item>\n\n";
				}
				if($nNr==2){	
					$txt .= "<item>\n<title>$item[title]</title>\n<location>".$rssloc2."</location>\n<description>$item[description]</description>\n<pubDate>$item[pubDate]</pubDate>\n<link>$item[link]</link>\n<forecast1>$forecast1</forecast1>\n<forecast2>$forecast2</forecast2>\n</item>\n\n";
				}

				if($nNr==$loc){					
					$aRSS = array(
						"title" => $item['title'],
						"location" => $item['location'],
						"description" => $item['description'],
						"pubDate" => $item['pubDate'],
						"link" => $item['link'],
						"forecast1" => $forecast1, 
						"forecast2" => $forecast2
					);

				}
				$nNr += 1;
            }
			$txt .= "</channel></rss>";

			if($loc>0)
				return $aRSS;
			else
				echo $txt;
    	}
	}
}

// ===============================================================================
?>