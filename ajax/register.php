<?
session_start();

include_once('../inc/db.class.php');

$dbObject = new dbBookshelf();
print_r($_POST);
print"<br/>";

$email = $_POST['email'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];


$check_dbConnect = $dbObject->connect();
if($check_dbConnect){
print_r($_POST);
print"<br/>";
$check_store = $dbObject->store_user($email,$password,$fname,$lname);
if($check_store){
print "stored successfully";
$_SESSION['uemail'] = $email;
header('Location: ../home.php');
}else{
print "store nahi hua";}
}


?>	