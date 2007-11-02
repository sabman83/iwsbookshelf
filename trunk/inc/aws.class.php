<?php
class AmazonWebService {

var $access_key_id;
var $Operation;
var $Version;
var $ResponseGroup;
var $SearchIndex;
var $IdType;
var $request;

function AmazonWebService(){

$this->access_key_id = "0H07E57B8B2GHH4549R2";

$this->Version = "2007-07-16";

$this->ResponseGroup = "Medium";
}

public function ItemSearch($SearchIndex, $Keywords){

$this->Operation = "ItemSearch";
$this->SearchIndex = $SearchIndex;
$this->request = "http://ecs.amazonaws.com/onca/xml"
   . "?Service=AWSECommerceService"
   . "&AWSAccessKeyId=" . $this->access_key_id
   . "&Operation=" . $this->Operation
   . "&Version=" . $this->Version
   . "&SearchIndex=" . $this->SearchIndex
   . "&Keywords=" . $Keywords
   . "&ResponseGroup=" . $this->ResponseGroup ;

$response = file_get_contents($this->request);
$parsed_xml = simplexml_load_string($response);

return $parsed_xml;
} 

public function ItemLookup($Itemid){
$this->Operation = "ItemLookup";
$this->SearchIndex = $SearchIndex;
$this->IdType = "ASIN";
$this->request = "http://ecs.amazonaws.com/onca/xml"
   . "?Service=AWSECommerceService"
   . "&AWSAccessKeyId=" . $this->access_key_id
   . "&Operation=" . $this->Operation
   . "&ItemId=" . $Itemid
   . "&IdType=" . $this->IdType
   . "&ResponseGroup=" . $this->ResponseGroup;

$response = file_get_contents($this->request);
$parsed_xml = simplexml_load_string($response);

return $parsed_xml;
}

public function printSearchResults($parsed_xml){
  print("<table>");
  $numOfItems = $parsed_xml->Items->TotalResults;
  $i =0;
  
  if($numOfItems>0){
  while ($i < 9)
  {
    print "<tr>";
	for ($j=$i; $j<$i+3; $j++){
	$current = $parsed_xml->Items->Item[$j];
	if (isset($current->MediumImage->URL)) {
    print("<td><a href=\"ajax/add.php?id=" .$current->ASIN. "\" onclick=\"return MOOdalBox.open(this, '', '800 600')\"><img src=\"".$current->MediumImage->URL."\" /></a>");
	print("<br>".$current->ItemAttributes->Title);
	print("<br/> By ".$current->ItemAttributes->Author."</td>");
	} 
	}
	print "</tr>";
	
  $i = $i + 3;
  }
 }
 else{
  print("</tr><td><center>No matches found.</center></tr></td>");
   }
 print "</table>"; 

}

public function printItemResult($parsed_xml){
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

public function get_medium_image($parsed_xml){
	$current = $parsed_xml->Items->Item;
	if (isset($current->MediumImage->URL)) {
		return $current->MediumImage->URL;
		}
	else{
		return("No matches found.");
   }
}

public function get_title($parsed_xml){
	$current = $parsed_xml->Items->Item;
	if (isset($current->ItemAttributes->Title)) {
		return $current->ItemAttributes->Title;
		}
	else{
		print("No matches found.");
   }
}

public function get_author($parsed_xml){
	$current = $parsed_xml->Items->Item;
	if (isset($current->ItemAttributes->Author)) {
		return $current->ItemAttributes->Author;
		}
	else{
		print("No matches found.");
   }
}

}
?>