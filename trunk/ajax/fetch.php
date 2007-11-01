<?php
include_once('../inc/aws.class.php');

$aws_object = new AmazonWebService();

$search_keyword = urlencode($_POST['keyword']);

$aws_object->printSearchResults($aws_object->ItemSearch("Books",$search_keyword));

?>