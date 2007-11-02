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
			$('search_form').addEvent('submit', function(e) {
				/**
				 * Prevent the submit event
				 */
				new Event(e).stop();
			
				/**
				 * This empties the log and shows the spinning indicator
				 */
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

    <h3>Search and Add Books</h3>
	<div class="form_box">
	    <p>Type the title/ author name of the book you want to search below:</p>
		<form id="search_form" method="get" class="contact_us" action="ajax/fetch.php">
		    <p>
		      <label>
		      <input type="text" class="fields_contact_us" name="keyword" id="keyword" />

		    </label>

		    <input type="submit" class="login_button" name="search" value="Search" id="search"/>
		    </label>
			</p>
		</form>
	</div>
	<br/><br/>
	<div class="form_box">
		<p>Your Search Results...</p>
		<div id="display_results"></div>
	</div>
</div>

<div id="footer"></div>
</div>
</body>
</html>