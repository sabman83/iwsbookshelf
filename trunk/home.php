<?
session_start();
if (isset($_SESSION['uid'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Book Store | By Dieter Schneider 2007 | www.csstemplateheaven.com</title>
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
<li id="active"><a href="#" id="current">Home</a></li>
<li><a href="search.php">Add Books</a></li>
<li><a href="#">The Shelves</a></li>
<li><a href="#">News</a></li>
<li><a href="#">Timeline</a></li>
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
  <p class="center">Created by Dieter Schneider 2007 <a href="http://www.csstemplateheaven.com">www.csstemplateheaven.com</a></p>


</div>

<div id="content">


    <h3>Your entire Book Shelf....right here!!</h3>
    <p><span style="float:left;font-size:50px;line-height:30px;padding-top:2px;font-family: Georgia;">W</span>elcome to your <b>Bookshelf Portal</b>.</p><p> <span style="float:left;font-size:50px;line-height:30px;padding-top:2px;font-family: Georgia;">Y</span>ou can start creating your bookshelf by clicking on the <i>"Add Books"</i> linkin the left menu. If you have already added your books then you can have a look at your shelf by clicking the <i>"You Shelf"</i> link. The portal is also powered with <i>news feeds</i> where you can browse through books related news items from Yahoo!, Google, CNN etc. Incase you follow literary blogs or websites, you can bookmark then and store them right here! Tag them and use the <i>"Bookmark"</i> link on the left menu to view them </p>
</div>

<div id="footer"></div>

</div>

</body>
</html>
