<?
session_start();
header('Content-type: text/plain');

include_once('../inc/db.class.php');

$dbObject = new dbBookshelf();

$email = $_POST['username'];
$password = $_POST['password'];

$check_dbConnect = $dbObject->connect();
if($check_dbConnect){
$check_user = $dbObject->validate_user($email,$password);
if (is_null($check_user[0])){
print "false";
}else{
$_SESSION['uemail'] = $email;
print "true";
}
}


?>	