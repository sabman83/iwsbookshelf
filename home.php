<?
session_start();

if (!isset($_SESSION['uemail'])) {
    header('Location: index.php');
}

include_once 'inc/db.class.php';

$dbObject = new dbBookshelf();

$check_dbConnect = $dbObject->connect();

if($check_dbConnect){
$name = $dbObject->get_uname($_SESSION['uemail']);
$uid = $dbObject->get_uid($_SESSION['uemail']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Book Store</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
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
<li><a href="#" id="current">Home</a></li>
<li><a href="search.php">Add Books</a></li>
<li><a href="shelf.php">Your Shelf</a></li>
<li><a href="feeds.php">News Feeds</a></li>
<li><a href="ajax/logout.php">Logout</a></li>
</ul>
</div>

</div>

<div class="left_column_boxes">

<h4>About this Project</h4>
<dl>
<dt class="news">Whats is it about?</dt>
<dd>The idea behind this project  is to develop a virtual online bookshelf. Any user should be able to search for the book he is looking for and be able to add it to his virtual shelf. He can rate them, tag them, write reviews about them and keep a timeline record of the books he has been reading.</dd>

<dt class="news">What technologies does it use?</dt>
<dd>The project uses PHP for the server interaction and Mootools JavaScript Library for the client interaction. It makes use of the Amazon Web Services to search for the books. The website uses a lot of AJAX calls for better user experience.</dd>
</dl>
</div>

<!--<div class="left_column_boxes">

<h4>Contact us</h4>
<form id="form1" method="post" class="contact_us" action="">
    <p>
      <label>Name
      <input type="text" class="fields_contact_us" name="textfield" />

    </label>

    <label>E-mail
    <input type="text" class="fields_contact_us" name="textfield1" />
	</label>
	<label>
    Your question:
    <textarea name="textarea" cols="" rows=""></textarea>
	</label>
    <label>

    <input type="submit" class="submit_button_contact" name="Submit1" value="Submit" />
    </label></p>
  </form>
  
</div>
  -->
<p class="center">Developed by Sebastin Kolman Template Design from <a href="http://www.csstemplateheaven.com">www.csstemplateheaven.com</a></p>

</div>

<div id="content">


    <h3>Your entire Book Shelf....right here!!</h3>
    <p><span style="float:left;font-size:50px;line-height:30px;padding-top:2px;font-family: Georgia;">W</span>elcome <b><?echo $name[0]." ".$name[1];?> </b>to your <b>Bookshelf Portal</b>.Your User id is<? echo $uid[0]; ?> .<br/><br/> <br/><br/><span style="float:left;font-size:50px;line-height:30px;padding-top:2px;font-family: Georgia;">Y</span>ou can start creating your bookshelf by clicking on the <b><i>"Add Books"</i></b> linkin the left menu. If you have already added your books then you can have a look at your shelf by clicking the <b><i>"Your Shelf"</i></b> link. The portal is also powered with <b><i>"News Feeds"</i></b> where you can browse through books related news items from Yahoo!, Google, CNN etc. Incase you follow literary blogs or websites, you can bookmark then and store them right here! Tag them and use the <b><i>"Bookmark"</i></b>  link on the left menu to view them </p>
</div>

<div id="footer"></div>

</div>

</body>
</html>
