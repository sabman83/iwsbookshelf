<?
include_once('../inc/db.class.php');

$dbObject = new dbBookshelf();

if($dbObject->connect()){
print_r($_POST);
};


?>	