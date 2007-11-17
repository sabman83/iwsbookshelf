<?
session_start();
if (isset($_SESSION['uemail'])) {
    header('Location: home.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Book Store | By Dieter Schneider 2007 | www.csstemplateheaven.com</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<script type="text/javascript" src="lib/mootools.js"></script>
<script type="text/javascript">
		window.addEvent('domready', function(){
			$('login_form').addEvent('submit', function(e) {
				/**
				 * Prevent the submit event
				 */
				new Event(e).stop();
			
				/**
				 * This empties the log and shows the spinning indicator
				 */
				/*var log = $('login_form').empty().addClass('ajax-loading');*/
				
				/**
				 * send takes care of encoding and returns the Ajax instance.
				 * onComplete removes the spinner from the log.
				 */
				this.send({
					evalResponse:true,
					onComplete: function(response) {
						/*log.removeClass('ajax-loading');*/
						var feedback = String(response);
						if (feedback.charAt('0') == 't'){
							$('login_message').setText('logged in successfully...Proceeding');
							<? ?>
							window.location = "home.php";
							}
						else
							$('login_message').setText('Error....try again or Register if you havn\'t');
						
						
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
<li><a href="search.php">Add Books</a></li>
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

<!--<div class="left_column_boxes">

<h4>Contact us</h4>
<form id="form1" method="post" class="contact_us" action="">
    <p>
      <label>Name
      <input type="text" class="fields_contact_us" name="textfield" />

    </label>

    <label>E-mail
    <input type="text" class="fields_contact_us" name="textfield1" />
	</label>
	<label>
    Your question:
    <textarea name="textarea" cols="" rows=""></textarea>
	</label>
    <label>

    <input type="submit" class="submit_button_contact" name="Submit1" value="Submit" />
    </label></p>
  </form>
  
</div>
  -->
  <p class="center">Created by Dieter Schneider 2007 <a href="http://www.csstemplateheaven.com">www.csstemplateheaven.com</a></p>


</div>

<div id="content">


    <h3>Your entire Book Shelf....right here!!</h3>
    <p><span style="float:left;font-size:50px;line-height:30px;padding-top:2px;font-family: Georgia;">W</span>elcome to the <b>Bookshelf Portal</b>. This application works as your virtual online bookshelf. You can add books, create new shelves for different books, rate books and also be connected to the Amazon Book Shop to buy books. Besides this you can also create news feeds for the latest in news about authors you like or books you are looking forward to read. To start using this application simply login below and start adding your favorite books now...!!.  </p>
	<form id="login_form" method="post" class="contact_us" action="ajax/login.php">
	    <p>
		
	      <label>Username
	      <input type="text" class="fields_contact_us" name="username" />

	    </label>

	    <label>Password
	    <input type="password" class="fields_contact_us" name="password" />
		</label>
		
	    <input type="submit" class="login_button" name="login" value="Login" />
	    </label>
		<div id="login_message" style="color: red;"></div>
		</p>
  </form>
  
  <p>If you are not registered click <a href="register.php">HERE</a></p>
</div>

<div id="footer"></div>

</div>

</body>
</html>
