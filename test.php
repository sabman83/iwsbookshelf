<?php
include_once('inc/aws.class.php');

$aws_object = new AmazonWebService();

$search_results = $aws_object->ItemLookup("0345478983");

$aws_object->printItemResult($search_results);

?>