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
	
	public function delete_book($uid,$asin){
	$delete_query = "DELETE FROM bookshelf.books WHERE uid ='".$uid[0]."' and asin ='".$asin."'";
	$delete_result = mysql_query($delete_query);
	if($delete_result){
	$delete_tag_query = "DELETE FROM bookshelf.tags WHERE uid ='".$uid[0]."' and asin ='".$asin."'";
	$delete_tag_result = mysql_query($delete_tag_query);
	return true;
	}else{
	return false;
	}
	}
	
	public function update_book($uid,$asin,$comments,$rating,$date){
	$query = "UPDATE bookshelf.books SET rating = '".$rating."', comments = '".$comments."', date = '".$date."' WHERE uid = '".$uid."' and asin = '".$asin."'";
	$result = mysql_query($query);
	return $result;
	}
	
	public function store_tags($uid,$asin_id,$tag_array){
	foreach($tag_array as $tag)
	{
	$query = "INSERT INTO bookshelf.tags VALUES ('".$uid."','".$asin_id."','".$tag."')";
	$result = mysql_query($query);
	}
	return $result;
	}
	
	public function update_tags($uid,$asin,$tag_array){
	$delete_query = "DELETE FROM bookshelf.tags WHERE uid ='".$uid."' and asin ='".$asin."'";
	$delete_result = mysql_query($delete_query);
	foreach($tag_array as $tag)
	{
	$query = "INSERT INTO bookshelf.tags VALUES ('".$uid."','".$asin."','".$tag."')";
	$result = mysql_query($query);
	}
	return $query;
	}
	
	public function store_bookmark($uid,$url,$tag_array){
	foreach($tag_array as $tag)
	{
	$query = "INSERT INTO bookshelf.bookmark VALUES ('".$uid.",'".$url."','".trim($tag)."')";
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
	
	public function get_tags($uid){
	$query = "SELECT DISTINCT tag_names FROM bookshelf.tags WHERE uid = '".$uid[0]."' GROUP BY tag_names";
	$result = mysql_query($query);
	$row = array();
	$i = 0;
	while($tmp = mysql_fetch_row($result)){
		$row[$i]  = $tmp[0]; 
	$i++;
	}
	return $row;
	}
	
	public function get_books_by_tags($tag,$uid){
	$query = "SELECT asin FROM bookshelf.tags WHERE uid = '".$uid[0]."' AND tag_names ='".$tag."'";
	$result = mysql_query($query);
	$row = array();
	$i = 0;
	while($tmp = mysql_fetch_row($result)){
		$row[$i]  = $tmp[0]; 
	$i++;
	}
	return $row;
	}
	
	public function get_book_details($uid,$asin){
	$query = "SELECT * FROM bookshelf.books WHERE uid = '".$uid[0]."' AND asin ='".$asin."'";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	return $row;
	}
	
	public function get_book_dates($uid){
	$query = "SELECT asin, date FROM bookshelf.books WHERE uid = '".$uid[0]."'";
	$result = mysql_query($query);
	$row = array();
	$i = 0;
	while($tmp = mysql_fetch_assoc($result)){
		$row[$i]['asin']  = $tmp['asin']; 
		$row[$i]['date']  = $tmp['date'];
	$i++;
	}
	return $row;
	}
	
	
	public function get_book_tags($uid,$asin){
	$query = "SELECT tag_names FROM bookshelf.tags WHERE uid = '".$uid[0]."' AND asin ='".$asin."'";
	$result = mysql_query($query);
	$row = array();
	$i = 0;
	while($tmp = mysql_fetch_row($result)){
		$row[$i]  = $tmp[0]; 
	$i++;
	}
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