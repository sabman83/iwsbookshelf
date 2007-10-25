<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Book Store | By Dieter Schneider 2007 | www.csstemplateheaven.com</title>

</head>

<body>
<?php

//**Amazon Web Service Details**
//Access IDs
define("Access_Key_ID", "0H07E57B8B2GHH4549R2");

function printSearchResults($parsed_xml, $SearchIndex){
    $current = $parsed_xml->Items->Item;
	if (isset($current->MediumImage->URL)) {
    print("<img align=\"left\" src=\"".$current->LargeImage->URL."\"></img>");
	print("<h3>".$current->ItemAttributes->Title."");
	print("<br/> By ".$current->ItemAttributes->Author."</h3>");
	print("<p><br/><span style=\"color: #666600;\">ISBN No: </span>".$current->ItemAttributes->ISBN);
	print("<br/><br/><span style=\"color: #666600;\">Publication Date:</span> ".$current->ItemAttributes->PublicationDate);
	print("<br/><br/><span style=\"color: #666600;\">Publisher: </span>".$current->ItemAttributes->Publisher."</p>");
	
	if ((strlen($current->EditorialReviews->EditorialReview[1]->Content) <= strlen($current->EditorialReviews->EditorialReview[0]->Content)) && (strlen($current->EditorialReviews->EditorialReview[0]->Content)!= 0)) 		
	{
	print("<p><span style=\"color: #666600;\">Review: </span><br/>".$current->EditorialReviews->EditorialReview[0]->Content."</p>");
	 }else 
	 {
		print("<p> Review: <br/>".$current->EditorialReviews->EditorialReview[1]->Content."</p>");	
	}
 }
 else{
  print("<center>No matches found.</center>");
   }


}

//Set up the operation in the request
function ItemLookup	($id){

//Set the values for some of the parameters.
$Operation = "ItemLookup";
$Version = "2007-07-16";
$ResponseGroup = "Medium";
$IdType = "ASIN";

//User interface provides values 
//for $SearchIndex and $Keywords

//Define the request
$request=
     "http://ecs.amazonaws.com/onca/xml"
   . "?Service=AWSECommerceService"
   . "&AWSAccessKeyId=" . Access_Key_ID
   . "&Operation=" . $Operation
   . "&ItemId=" . $id
   . "&IdType=" . $IdType
   . "&ResponseGroup=" . $ResponseGroup;

//Catch the response in the $response object
$response = file_get_contents($request);
$parsed_xml = simplexml_load_string($response);

printSearchResults($parsed_xml, $SearchIndex);

}
?>
<div id="description">

    <h2>Book Details</h2>
	<p>
	<?
	ItemLookup($_GET['id']);
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