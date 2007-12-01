<?
session_start();

if (!isset($_SESSION['uemail'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Book Store | By Dieter Schneider 2007 | www.csstemplateheaven.com</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<script type="text/javascript" src="lib/mootools.js"></script>
<script type="text/javascript">
		function navigate(limit){
			
				var log = $('newsFeeds').empty();
				
				var url = "ajax/feeds.php?limit="+limit;
			
					new Ajax(url, {
					method: 'get',
					update: $('newsFeeds')
				}).request();
		}
</script>
</head>

<body>

<div id="container">

<div id="header">
<h1>THE BOOK SHELF</h1>
</div>


<div id="sideheader"></div>

<div id="left_column">


<div class="left_column_boxes">

<h4>Navigation</h4>
<div id="navcontainer">
<ul id="navlist">
<li><a href="home.php" id="current">Home</a></li>
<li><a href="search.php">Add Books</a></li>
<li><a href="shelf.php">Your Shelf</a></li>
<li><a href="#">News Feeds</a></li>
<li><a href="bookmark.php">Your BookMarks</a></li>
<li><a href="ajax/logout.php">Logout</a></li>
</ul>
</div>

</div>

<div class="left_column_boxes">

<h4>News</h4>
<dl>
<dt class="news">This is a definiton list</dt>
<dd>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed quam.  Nullam gravida aliquet odio. Phasellus ullamcorper tincidunt orci.  Praesent vel purus. Sed porttitor. Proin porttitor suscipit urna. Morbi  rhoncus posuere orci.</dd>

<dt class="news">Lists are cool</dt>
<dd>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed quam.  Nullam gravida aliquet odio. Phasellus ullamcorper tincidunt orci.  Praesent vel purus. Sed porttitor. Proin porttitor suscipit urna. Morbi  rhoncus posuere orci.</dd>
</dl>

</div>

  <p class="center">Created by Dieter Schneider 2007 <a href="http://www.csstemplateheaven.com">www.csstemplateheaven.com</a></p>


</div>

<div id="content">

	<p>Here are the latest news feeds from <i>Yahoo!</i>, <i>CNN</i> and <i>Comic Book Resources</i>.</p>
	<div id="newsFeeds">
	<?
	// include lastRSS library
	  include 'inc/lastRSS.php';
	  
	  // create lastRSS object
	  $rss = new lastRSS; 
	  
	  // setup transparent cache
	  $rss->cache_dir = 'tmp/'; 
	  $rss->cache_time = 3600; // one hour
	  $rss->stripHTML = True; // remove HTML tags
	  ?>
	  <?
	  // load some RSS file
	  if ($rs = $rss->get('http://pipes.yahoo.com/pipes/pipe.run?_id=wlastpKf3BGtgy7TX0sBXw&_render=rss')) {
	  	$limit = 0;
		for($i=$limit;$i<=$limit+15;$i++){
		print "<p><a href='".$rs['items'][$i]['link']."'>";
		print $rs['items'][$i]['title']."</a><br/>";
		print $rs['items'][$i]['description']."<br/>";
		print "</p>";
		}
		print"<a align='right' onclick='navigate(15)' id='next' href='#'>Next</a>";
	  }
	  else {
	  	die ('Error: RSS file not found...');
	  }
	?>
	</div>
</div>

<div id="footer"></div>

</div>

</body>
</html>
