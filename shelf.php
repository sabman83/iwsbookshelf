<?
session_start();

if (!isset($_SESSION['uemail'])) {
    header('Location: index.php');
}

include_once 'inc/db.class.php';
include_once 'inc/aws.class.php';

$dbObject = new dbBookshelf();
$awsObject = new AmazonWebService();

$check_dbConnect = $dbObject->connect();

if($check_dbConnect){
$name = $dbObject->get_uname($_SESSION['uemail']);
$uid = $dbObject->get_uid($_SESSION['uemail']);
$tags = $dbObject->get_tags($uid[0]);
$dates = $dbObject->get_book_dates($uid);
}

// format MySQL DateTime (YYYY-MM-DD hh:mm:ss) using date()
function datetime($datetime) {
    $year = substr($datetime,0,4);
    $month = substr($datetime,5,2);
    $day = substr($datetime,8,2);
    
    return date("M j Y",mktime(0,0,0,$month,$day,$year));
}

$doc = new DOMDocument('1.0', 'iso-8859-1');

$root = $doc->createElement('data');
$doc->appendChild($root);
$count =  count($dates);

for($i=0;$i<$count;$i++){
		//creating parent element EVENT for Termination Date
		$parent = $doc->createElement('event');
		$parent = $root->appendChild($parent);
		//adding attributes to parent element EVENT
		$parent->setAttribute('start', datetime($dates[$i]['date'])." 00:00:00 GMT");
		$parent->setAttribute('title', $awsObject->get_title($dates[$i]['asin']));
		$parent->setAttribute('isDuration', 'false');
		$parent->setAttribute('image', '../images/dark-red-circle.png');
		$parent->setAttribute('icon', '../images/dark-red-circle.png');
		$parent_text = $doc->createTextNode("Book Read on ");
		$parent_text = $parent->appendChild($parent_text);		
			
}

//echo $doc->saveXML();
$doc->save('tmp/test.xml');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Book Store | By Dieter Schneider 2007 | www.csstemplateheaven.com</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<script type="text/javascript" src="lib/mootools.js"></script>
<script src="lib/timeline-api.js" type="text/javascript"></script>
<script type="text/javascript">
		window.onload = function() {
			var myAccordianEffect = new Accordion('h3.tagTitle', 'div.tagBooks', {display:-1,alwaysHide: true});
			var tl;
			var theme = Timeline.ClassicTheme.create();
			  theme.event.label.width = 150; 
			  theme.event.bubble.width = 200;
			  theme.event.bubble.height = 50;
			  //theme.ether.backgroundColors.unshift("blue");
			  
			  //defines an event to be painted on the band
			  var eventSource = new Timeline.DefaultEventSource();
			var bandInfos = [
				Timeline.createBandInfo({
					eventSource:    eventSource,
					date:           "<?echo datetime($date[0]['date'])." 00:00:00 GMT";?>",//timeline will load with this date highlighted by default
					//timeZone: -5,// -5 indicates Eastern Timezone
					width:          "0%", 
					intervalUnit:   Timeline.DateTime.MONTH, 
					intervalPixels: 100
				}),
				Timeline.createBandInfo({
					showEventText:  true,
					trackHeight:    1.5,//height of each event
					trackGap:       0.2, // vertical gap between events
					eventSource:    eventSource,
					width:          "100%", 
					date:           "<?echo datetime($date[0]['date'])." 00:00:00 GMT";?>",//timeline will load with this date highlighted by default
					intervalUnit:   Timeline.DateTime.YEAR, 
					intervalPixels: 100
				})
			  ];
			bandInfos[1].syncWith = 0;
			//bandInfos[1].highlight = true;

			tl = Timeline.create(document.getElementById("footer"), bandInfos);
			Timeline.loadXML("tmp/test.xml", function(xml, url) { eventSource.loadXML(xml, url); });//xml data source fed to the timeline

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
<li><a href="#">Your Shelf</a></li>
<li><a href="feeds.php">News Feeds</a></li>
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

	<p>Click on the Shelf Title to display the books. Clicking on book image will take you to the Book Details page:
	
	<?
	print $uid[0];
	$row = $dbObject->get_tags($uid[0]);
	//print_r($row);
	$i = 0;
	while($row[$i]){
	print "<h3 class='tagTitle'>".$row[$i]."</h3>";
	print"<div class='tagBooks'>";
	$taggedBook = $dbObject->get_books_by_tags($row[$i],$uid[0]); 
	$numOfBooks = count($taggedBook);
	//print_r($taggedBook);
	$j =0;
	print "<table>";
	while($j < $numOfBooks)
		{
		print "<tr>";
		for($k=0;$k<3;$k++){
			while($awsObject->get_medium_image($taggedBook[($j+$k)])){
			print "<td>";
			print "<a href=\"details.php?id=".$taggedBook[$j]."\"><img src=\"".$awsObject->get_medium_image($taggedBook[$j])."\"></img></a>";
			$j++;
			print "</td>";
			}
		}
		print "</tr>";
		}
	print "</table>";
	print"</div>";
	$i++;
	}
	?>
	</p>
</div>

<div id="footer" style="margin-left:50px;width: 670px;height: 150px; border: 1px solid #aaa"></div>
<br/><br/><br/><br/>
</div>

</body>
</html>
