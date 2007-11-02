<?
class dbBookshelf {

var $db_host;
var $db_schema;
var $db_user;
var $db_password;
var $db_port;

function dbBookshelf(){
this->db_host = "localhost";
this->db_schema = "bookshelf";
this->db_user = "root";
this->db_password = "";
this->db_port = "3306";
}

public function connect(){
	if (!($db = mysql_pconnect($this->host, $this->user, $this->password))){
	die("Can't connect to database server.");
    return false;
	}else{
		// select a database
		if (!(mysql_select_db(this->schema,$db))){
		die("Can't connect to database.");
		return false;
    }else{
		return true;
		}
}
}

public function store_book($asin_id,$comments,$rating,$date){
$query = "INSERT INTO bookshelf.books VALUES (".$asin_id.",".$rating.",".$comments.",".$date.")";
$result = mysql_query($query);
if (!result){
print "Error in Storing Data";
}
}

public function store_tags($asin_id,$tag_array){

foreach($tag_array as $tag)
{
$query = "INSERT INTO bookshelf.tags VALUES (".$asin_id.",".$tag.")";
$result = mysql_query($query);
if (!result){
print "Error in Storing Data";
}
}
}



}
?>