<?
include_once('../inc/db.class.php');

$dbObject = new dbBookshelf();
print_r($_POST);
print"<br/>";

$asin = $_POST['asin'];
$review = $_POST['review'];
$rating = $_POST['rating'];
$date_read = $_POST['date_read'];

$date_read = explode("/", $date_read);
$date_read = array_reverse($date_read);
$date_read = implode("-",$date_read);

$check_dbConnect = $dbObject->connect();
if($check_dbConnect){
print_r($_POST);
print"<br/>";
print $date_read;
print"<br/>";
$check_store = $dbObject->store_book($asin,$review,$rating,$date_read);
if($check_store){
print "stored successfully";}else{
print "store nahi hua";}
}


?>	