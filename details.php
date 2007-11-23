<?
session_start();
if (!isset($_SESSION['uemail'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Book Store | By Dieter Schneider 2007 | www.csstemplateheaven.com</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/moodalbox.css" />

<script	type="text/javascript" src="lib/mootools.js"> </script>
<script	type="text/javascript" src="lib/moodalbox.js"> </script>
<script type="text/javascript" src="lib/pbbdatepicker.v1.1.js"></script>
<script type="text/javascript">
window.addEvent('domready', function(){
	var rating = $('current_rating');

	$('one_rating').addEvent('click', function(){
					
			var storeRating = new Fx.Style($('current_rating'),'width');
			storeRating.set(16);
			$('current_rating').setProperty('title','1');
			$('rating').setProperty('value','1');
			});
	
	$('two_rating').addEvent('click', function(){
					
			var storeRating = new Fx.Style($('current_rating'),'width');
			storeRating.set(32);
			$('current_rating').setProperty('title','2');
			$('rating').setProperty('value','2');
			});
	$('three_rating').addEvent('click', function(){
					
			var storeRating = new Fx.Style($('current_rating'),'width');
			storeRating.set(48);
			$('current_rating').setProperty('title','3');
			$('rating').setProperty('value','3');
			});
	
	$('four_rating').addEvent('click', function(){
					
			var storeRating = new Fx.Style($('current_rating'),'width');
			storeRating.set(64);
			$('current_rating').setProperty('title','4');
			$('rating').setProperty('value','4');
			});
	$('five_rating').addEvent('click', function(){
					
			var storeRating = new Fx.Style($('current_rating'),'width');
			storeRating.set(80);
			$('current_rating').setProperty('title','5');
			$('rating').setProperty('value','5');
			});
});
</script>	
<script type="text/javascript">
	window.onload = function() {

                MyDatePicker = new PBBDatePicker($('date_read'), {
                        rangeYear: {'min': new Date().getFullYear() - 20, 'max': new Date().getFullYear() + 20},
                        iconImg : 'images/date.png',
                        onShow: function(picker){
                                picker.effects({duration: 500, transition: Fx.Transitions.quadInOut}).custom({'opacity': [0, 0.8]});
                        } 
                });
		}
</script>
<script type="text/javascript">
		window.addEvent('domready', function(){
			$('add_form').addEvent('submit', function(e) {
				/**
				 * Prevent the submit event
				 */
				new Event(e).stop();
			
				/**
				 * This empties the log and shows the spinning indicator
				 */
				var emptyForm = $('form_box').setStyle('display','none'); 
			
				var log = $('display_results').empty().addClass('ajax-loading');
				
				/**
				 * send takes care of encoding and returns the Ajax instance.
				 * onComplete removes the spinner from the log.
				 */
				this.send({
					update: log,
					onComplete: function() {
						log.removeClass('ajax-loading');
					}
				});
			});
		}); 
</script>	
<script type="text/javascript">
		window.addEvent('domready', function(){
			$('delete_form').addEvent('submit', function(e) {
				/**
				 * Prevent the submit event
				 */
				new Event(e).stop();
			
				/**
				 * This empties the log and shows the spinning indicator
				 */
				var emptyForm = $('form_box').setStyle('display','none'); 
			
				var log = $('display_results').empty().addClass('ajax-loading');
				
				/**
				 * send takes care of encoding and returns the Ajax instance.
				 * onComplete removes the spinner from the log.
				 */
				this.send({
					update: log,
					onComplete: function() {
						log.removeClass('ajax-loading');
					}
				});
			});
		}); 
</script>
</head>
<?php
include_once('inc/aws.class.php');
include_once('inc/db.class.php');

$aws_object = new AmazonWebService();
$dbObject = new dbBookshelf();
$asin = $_GET['id'];
//$book_details = $aws_object->ItemLookup($_GET['id']);
$check_dbConnect = $dbObject->connect();

if($check_dbConnect){
$name = $dbObject->get_uname($_SESSION['uemail']);
$uid = $dbObject->get_uid($_SESSION['uemail']);
$bookDetails = $dbObject->get_book_details($uid,$asin);
$bookTags = $dbObject->get_book_tags($uid,$asin);
}


?>
<body>

<div id="container">

<div id="header">
<h1>THE BOOK SHELF</h1>
</div>


<div id="sideheader"></div>

<div id="left_column">


<div class="left_column_boxes">

<h4>Navigation</h4>
<div id="navcontainer">
<ul id="navlist">
<li id="active"><a href="#" id="current">Home</a></li>
<li><a href="#">Add Books</a></li>
<li><a href="#">The Shelves</a></li>
<li><a href="#">News</a></li>
<li><a href="#">Timeline</a></li>
<li><a href="ajax/logout.php">Logout</a></li>
</ul>
</div>

</div>

<div class="left_column_boxes">

<h4>News</h4>
<dl>
<dt class="news">This is a definiton list</dt>
<dd>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed quam.  Nullam gravida aliquet odio. Phasellus ullamcorper tincidunt orci.  Praesent vel purus. Sed porttitor. Proin porttitor suscipit urna. Morbi  rhoncus posuere orci.</dd>

<dt class="news">Lists are cool</dt>
<dd>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed quam.  Nullam gravida aliquet odio. Phasellus ullamcorper tincidunt orci.  Praesent vel purus. Sed porttitor. Proin porttitor suscipit urna. Morbi  rhoncus posuere orci.</dd>
</dl>

</div>

  <p class="center">Developed by Sebastin Kolman Template Design from <a href="http://www.csstemplateheaven.com">www.csstemplateheaven.com</a></p>


</div>

<div id="content">

    <h3>Book Detail</h3>
	<div id="form_box" class="form_box">
	    <div id="add_box" style="display:block;">
		    <p>Click on <i>"Save Edit"</i> to save any changes or click on <i>"Delete"</i> to remove the book from your shelf:</p>
			<p><?
				print $uid[0];
				print("<img align=\"left\" src=\"".$aws_object->get_medium_image($asin)."\"></img>");
				print("<br/>".$aws_object->get_title($asin));
				print("<br/> By ".$aws_object->get_author($asin));
				//print_r($bookDetails);
				//print_r($bookTags);
				$bookTags = implode(",",$bookTags);
				//print_r($bookTags);
				$rating = $bookDetails["rating"] * 16;
				$date = $bookDetails["date"];
				$date = explode("-", $date);
				$date = array_reverse($date);
				$date = implode("/",$date);
				?>
			</p>
			<br/><br/><br/><br/><br/>
			<form id="add_form" method="post" action="ajax/update.php?id=<?echo $asin;?>">
			    <p>
			      <label>Your Rating:</label>
					
					<ul class="star-rating">
						<li>
						      <a href="javascript: void(0)" title="" class="current-rating" id="current_rating" style="width: <?echo $rating?>px;">
						      Current Rating
						      </a>
						</li>
						<li>
						      <a href="javascript: void(0)" title="1" id="one_rating" class="one-star">
						      1 star
						      </a>
						      </li>
						<li>
						      <a href="javascript: void(0)" title="2" id="two_rating" class="two-stars">
						      2 stars
						      </a>
						      </li>
						<li>
						      <a href="javascript: void(0)" title="3" id="three_rating" class="three-stars">
						      3 stars
						      </a>
						      </li>
						<li>
						      <a href="javascript: void(0)" title="4" id="four_rating" class="four-stars">
						      4 stars
						      </a>
						      </li>
						<li>
							  <a href="javascript: void(0)" title="5" id="five_rating" class="five-stars">
							  5 stars
							  </a>
					    </li>
					</ul>
					<br/>
				<p>
				  <label>Tags Assigned:</label>
			      <input type="text" class="fields_contact_us" name="Shelf" id="shelf" value="<?echo $bookTags;?>" />
				  <br/>
				  <label>Comment/Review:
			       <textarea name="review" id="review" cols="80" rows="5"><?echo $bookDetails["comments"]?></textarea>
				  </label>
				  <br/>
				  <label>Date Read:
				  <input type="text" name="date_read" id="date_read" class="fields_contact_us" value="<?echo $date;?>"/>
				  </label>
				  <br/><br/><br/><br/>
				  <input type="hidden" name="rating" id="rating" value="<?echo $bookDetails["rating"];?>" />
				  <input type="submit" class="edit_button" name="edit" value="Save Edits" id="Edit"/></form>  or  
				  <form id="delete_form" method="post" action="ajax/delete.php?id=<?echo $asin;?>">
				  <input type="submit" class="delete_button" name="delete" value="Delete" id="delete"/>
				  </form>
			    </label>
				</p>
			</form>
		</div>	
	</div>
	<div id="display_results"></div>
</div>

<div id="footer"></div>
</div>
</body>
</html>
