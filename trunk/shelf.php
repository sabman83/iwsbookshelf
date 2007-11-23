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
		window.onload = function() {
			var myAccordianEffect = new Accordion('h3.tagTitle', 'div.tagBooks', {display:-1,alwaysHide: true});
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
<li id="active"><a href="#" id="current">Home</a></li>
<li><a href="search.php">Add Books</a></li>
<li><a href="#">Your Shelf</a></li>
<li><a href="#">News</a></li>
<li><a href="#">BookMarks</a></li>
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

<div id="footer"></div>

</div>

</body>
</html>
