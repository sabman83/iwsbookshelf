<?php

//**Amazon Web Service Details**
//Access IDs
define("Access_Key_ID", "0H07E57B8B2GHH4549R2");

function printSearchResults($parsed_xml, $SearchIndex){
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

//Set up the operation in the request
function ItemSearch($Keywords){

//Set the values for some of the parameters.
$Operation = "ItemSearch";
$Version = "2007-07-16";
$ResponseGroup = "Medium";
$SearchIndex = "Books";

//User interface provides values 
//for $SearchIndex and $Keywords

//Define the request
$request=
     "http://ecs.amazonaws.com/onca/xml"
   . "?Service=AWSECommerceService"
   . "&AWSAccessKeyId=" . Access_Key_ID
   . "&Operation=" . $Operation
   . "&Version=" . $Version
   . "&SearchIndex=" . $SearchIndex
   . "&Keywords=" . $Keywords
   . "&ResponseGroup=" . $ResponseGroup;

//Catch the response in the $response object
$response = file_get_contents($request);
$parsed_xml = simplexml_load_string($response);

printSearchResults($parsed_xml, $SearchIndex);
//print_r( $parsed_xml->Items->Item[2]);

}

$search_keyword = urlencode($_POST['keyword']);
ItemSearch($search_keyword);

?>