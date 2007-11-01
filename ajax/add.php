<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Book Store | By Dieter Schneider 2007 | www.csstemplateheaven.com</title>

</head>

<body>
<?php
include_once('../inc/aws.class.php');

$aws_object = new AmazonWebService();
?>
<div id="description">

    <h2>Book Details</h2>
	<p>
	<?
	$aws_object->printItemResult($aws_object->ItemLookup($_GET['id']));
	?>
	</p>
	<center class="submit_button_contact"><a href="add.php?id=<?print $_GET['id'];?>">Add this Book to my shelf</a></center>
</div>

<!--<div class="add_box">
	    <p>Fill in the details below and click on Add</p>
		<form id="add_form" method="get" class="add_book" action="ajax/fetch.php">
		    <p>
		      <label>2) Enter the name of the shelves where you want this book to be placed. Separate each shelf name with a comma:</label>
		      <input type="text" class="fields_add_book" name="Shelf" id="shelf" />
			  <br/>
			  <label>3) Write comments or your views about this book here:
		       <textarea name="review" id="review" cols="80" rows="5"></textarea>
			  </label>
			  <br/>
			  <label>4) Date Read:
			  <input type="text" class="fields_add_book" id="MyDateB" value="" onFocus="new PBBDatePicker(this,{
        onShow: function(picker){
                picker.effects({duration: 500, transition: Fx.Transitions.quadInOut}).custom({'opacity': [0, 0.8]});
        } 
});"/>
			  </label>
			  
		    <input type="submit" class="login_button" name="search" value="Add" id="add"/>
		    </label>
			</p>
		</form>
	</div>-->

<div id="footer"></div>


</body>

</html>