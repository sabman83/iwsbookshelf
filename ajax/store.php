<?
session_start();
if (!isset($_SESSION['uemail'])) {
    header('Location: index.php');
}

include_once('../inc/db.class.php');

$dbObject = new dbBookshelf();


$asin = $_POST['asin'];
$review = $_POST['review'];
$rating = $_POST['rating'];
$tags = $_POST['Shelf'];
$tags = explode(",", $tags);

$date_read = $_POST['date_read'];
$date_read = explode("/", $date_read);
$date_read = array_reverse($date_read);
$date_read = implode("-",$date_read);

$check_dbConnect = $dbObject->connect();
if($check_dbConnect){
$uid = $dbObject->get_uid($_SESSION['uemail']);
$check_store = $dbObject->store_book($uid[0],$asin,$review,$rating,$date_read);
if($check_store){
$store_tags = $dbObject->store_tags($uid[0],$asin,$tags);

print "<br/><br/><p>Your Book has been Added to your shelf.<br/><br/><a href='search.php'>Add More Books</a>||<a href='#'>Browse your Shelf</a></p>";}
else{
print "<p>This Book is already in your shelf.<br/><br/><a href='search.php'>Search Again</a>||<a href='#'>Browse your Shelf</a></p>";}
}


?>	