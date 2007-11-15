<?php
class dbBookshelf {

	var $host;
	var $schema;
	var $user;
	var $password;
	var $port;

	function dbBookshelf(){

	$this->host = "localhost";

	$this->schema = "bookshelf";

	$this->user = "root";

	$this->password = "";

	$this->port = "3306";
	}
	
	
	public function store_user($uemail,$upassword,$fname,$lname){
	$uid = "NULL";
	$query = "INSERT INTO bookshelf.user VALUES (".$uid.",'".$uemail."','".$upassword."','".$fname."','".$lname."')";
	$result = mysql_query($query);
	return $result;
	}
	
	public function store_book($uid,$asin_id,$comments,$rating,$date){
	$query = "INSERT INTO bookshelf.books VALUES ('".$uid."','".$asin_id."','".$rating."','".$comments."','".$date."')";
	$result = mysql_query($query);
	return $result;
	}

	public function store_tags($uid,$asin_id,$tag_array){
	foreach($tag_array as $tag)
	{
	$query = "INSERT INTO bookshelf.tags VALUES ('".$uid."','".$asin_id."','".$tag."')";
	$result = mysql_query($query);
	return $result;
	}
	}

	public function store_bookmark($uid,$url,$tag_array){
	foreach($tag_array as $tag)
	{
	$query = "INSERT INTO bookshelf.bookmark VALUES ('".$uid.",'".$url."','".$tag."')";
	$result = mysql_query($query);
	return $result;
	}
	}
	
	public function get_uname($uemail){
	$query = "SELECT ufirstname, ulastname FROM bookshelf.user WHERE uemail = '".$uemail."'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	return $row;
	}

	public function get_uid($uemail){
	$query = "SELECT uid FROM bookshelf.user WHERE uemail = '".$uemail."'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	return $row;
	}	
	
	public function connect(){
		//connection to the database
		$dbhandle = mysql_connect($this->host, $this->user, $this->password)
		  or die("Unable to connect to MySQL");
		//select a database to work with
		$dbselect = mysql_select_db($this->schema,$dbhandle)
		  or die("Could not select examples");
		return true;  
	}
	
	public function validate_user($uemail,$upassword){
	$query = "SELECT uid FROM bookshelf.user WHERE uemail = '".$uemail."' and upassword = '".$upassword."'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	return $row;
	}

}
?>