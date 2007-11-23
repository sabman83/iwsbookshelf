<?
session_start();
include_once('../inc/db.class.php');

if (!isset($_SESSION['uemail'])) {
    header('Location: index.php');
}
$dbObject = new dbBookshelf();
$check_dbConnect = $dbObject->connect();
if($check_dbConnect){
$uid = $dbObject->get_uid($_SESSION['uemail']);
$asin = $_GET['id'];
$delete_book = $dbObject->delete_book($uid,$asin);
if($delete_book){
//print $update_book;
print "<br/><br/><p>Your Book has been Deleted.<br/><br/><a href='search'>Search Books</a>||<a href='shelf.php'>Browse your Shelf</a></p>";}
else{
print "<p>This Book is already been deleted.<br/><br/><a href='search.php'>Search For Books</a>||<a href='shelf.php'>Browse your Shelf</a></p>";}
}


?>

