<?
session_start();
if (!isset($_SESSION['uemail'])) {
    header('Location: index.php');
}
include_once('../inc/db.class.php');
$dbObject = new dbBookshelf();
$check_dbConnect = $dbObject->connect();

print $_SESSION['uemail'];
$uid = $dbObject->get_uid($_SESSION['uemail']);
print $uid[0];
print "<br/>";
//print $_POST['edit'];
$asin = $_GET['id'];
$review = $_POST['review'];
$rating = $_POST['rating'];
$tags = $_POST['Shelf'];
$tags = explode(",", $tags);

$date_read = $_POST['date_read'];
$date_read = explode("/", $date_read);
$date_read = array_reverse($date_read);
$date_read = implode("-",$date_read);

if($check_dbConnect){
$update_book = $dbObject->update_book($uid[0],$asin,$review,$rating,$date_read);
if($update_book){
//print $update_book;
$update_tags = $dbObject->update_tags($uid[0],$asin,$tags);
if($update_tags){
print $update_tags;
print "<br/><br/><p>Your Book has been Updated.<br/><br/><a href='JavaScript:location.reload(true);'>View Changes</a>||<a href='shelf.php'>Browse your Shelf</a></p>";}
else{
print "<p>This Book is already been deleted.<br/><br/><a href='search.php'>Search For Books</a>||<a href='shelf.php'>Browse your Shelf</a></p>";}
}
}

?>	