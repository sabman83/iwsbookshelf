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
<title>The Book Store</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/moodalbox.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/formcheck.css" />

<script	type="text/javascript" src="lib/mootools.js"> </script>
<script	type="text/javascript" src="lib/moodalbox.js"> </script>
<script type="text/javascript" src="lib/pbbdatepicker.v1.1.js"></script>
<script type="text/javascript" src="lib/formcheck.js"></script>
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
			window.addEvent('domready', function(){check = new FormCheck('add_form', {
				display : {
					fadeDuration : 500,
					errorsLocation : 1,
					indicateErrors : 1,
					showErrors : 1
					
				}
			})});
</script>
</head>
<?php
include_once('inc/aws.class.php');

$aws_object = new AmazonWebService();
$asin = $_GET['id'];
$book_details = $aws_object->ItemLookup($_GET['id']);

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
<li><a href="home.php" id="current">Home</a></li>
<li><a href="search.php">Add Books</a></li>
<li><a href="shelf.php">Your Shelf</a></li>
<li><a href="feeds.php">News Feeds</a></li>
<li><a href="ajax/logout.php">Logout</a></li>
</ul>
</div>

</div>

<div class="left_column_boxes">

<h4>About this Project</h4>
<dl>
<dt class="news">Whats is it about?</dt>
<dd>The idea behind this project  is to develop a virtual online bookshelf. Any user should be able to search for the book he is looking for and be able to add it to his virtual shelf. He can rate them, tag them, write reviews about them and keep a timeline record of the books he has been reading.</dd>

<dt class="news">What technologies does it use?</dt>
<dd>The project uses PHP for the server interaction and Mootools JavaScript Library for the client interaction. It makes use of the Amazon Web Services to search for the books. The website uses a lot of AJAX calls for better user experience.</dd>
</dl>

</div>

<p class="center">Developed by Sebastin Kolman Template Design from <a href="http://www.csstemplateheaven.com">www.csstemplateheaven.com</a></p>

</div>

<div id="content">

    <h3>Add Books</h3>
	<div id="form_box" class="form_box">
	    <div id="add_box" style="display:block;">
		    <p>Fill in the details below and click on Add</p>
			<p><?
				print("<img align=\"left\" src=\"".$aws_object->get_medium_image($asin)."\"></img>");
				print("<br/>".$aws_object->get_title($asin));
				print("<br/> By ".$aws_object->get_author($asin));?>
			</p>
			<br/><br/><br/><br/><br/>
			<form id="add_form" method="post" action="ajax/store.php">
			    <p>
			      <label>1) Rate the book:</label>
					
					<ul class="star-rating">
						<li>
						      <a href="javascript: void(0)" title="" class="current-rating" id="current_rating" style="width: 0px;">
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
				  <label>2) Enter the name of the shelves(tags) where you want this book to be placed. Separate each shelf name with a comma:</label>
			      <input type="text" class="validate['required']"  name="Shelf" id="shelf" />
				  <br/>
				  <label>3) Write comments or your views about this book here:
			       <textarea name="review" id="review" cols="80" rows="5"></textarea>
				  </label>
				  <br/>
				  <label>4) Date Read:
				  <input type="text" name="date_read" id="date_read" class="fields_contact_us"/>
				  </label>
				  <input type="hidden" name="asin" id="asin" value="<? print $_GET['id']?>" />
				  <input type="hidden" name="rating" id="rating" value="0" />
			    <input type="submit" class="login_button" name="search" value="Add" id="add"/>
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
