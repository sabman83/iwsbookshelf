<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Book Store | By Dieter Schneider 2007 | www.csstemplateheaven.com</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/moodalbox.css" />

<script	type="text/javascript" src="lib/mootools.js"> </script>
<script	type="text/javascript" src="lib/moodalbox.js"> </script>
<script type="text/javascript" src="lib/pbbdatepicker.v1.1.js"></script>
<script type="text/javascript">
		
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
<li><a href="#">Add Books</a></li>
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

  <p class="center">Developed by Sebastin Kolman Template Design from <a href="http://www.csstemplateheaven.com">www.csstemplateheaven.com</a></p>


</div>

<div id="content">

    <h3>Add Books</h3>
	<div class="form_box">
	    <div class="add_box">
	    <p>Fill in the details below and click on Add</p>
		<form id="add_form" method="get" class="add_book" action="ajax/fetch.php">
		    <p>
		      <label>1) Rate the book:<br/></label>
			  <label>2) Enter the name of the shelves where you want this book to be placed. Separate each shelf name with a comma:</label>
		      <input type="text" class="fields_contact_us" name="Shelf" id="shelf" />
			  <br/>
			  <label>3) Write comments or your views about this book here:
		       <textarea name="review" id="review" cols="80" rows="5"></textarea>
			  </label>
			  <br/>
			  <label>4) Date Read:
			  <input type="text" class="fields_contact_us"/>
			  </label>
			  
		    <input type="submit" class="login_button" name="search" value="Add" id="add"/>
		    </label>
			</p>
		</form>
	</div>

</div>

<div id="footer"></div>
</div>
</body>
</html>
