<?php
// include lastRSS library
  include '../inc/lastRSS.php';
  
  // create lastRSS object
  $rss = new lastRSS; 
  
  // setup transparent cache
  $rss->cache_dir = 'tmp/'; 
  $rss->cache_time = 3600; // one hour
  $rss->stripHTML = True; // remove HTML tags
  
  // load some RSS file
  if ($rs = $rss->get('http://pipes.yahoo.com/pipes/pipe.run?_id=wlastpKf3BGtgy7TX0sBXw&_render=rss')) {
  	$limit = $_GET['limit'];
	for($i=$limit;$i<=$limit+15;$i++){
	print "<p><a href='".$rs['items'][$i]['link']."'>";
	print $rs['items'][$i]['title']."</a><br/>";
	print $rs['items'][$i]['description']."<br/>";
	print "</p>";
	}
	print"<a align='left'  onclick='navigate(".$limit.")' id='previous' href'#'>Previous</a>           <a align='right'  onclick='navigate(".($limit+15).")' id='next' href='#'>Next</a>";
  }
  else {
  	die ('Error: RSS file not found...');
  }
?>