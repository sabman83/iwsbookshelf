<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>The Book Store | By Dieter Schneider 2007 | www.csstemplateheaven.com</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/formcheck.css" />
<script type="text/javascript" src="lib/mootools.js"></script>
<script type="text/javascript" src="lib/formcheck.js"></script>
<script type="text/javascript">
			window.addEvent('domready', function(){check = new FormCheck('register', {
				display : {
					fadeDuration : 500,
					errorsLocation : 1,
					indicateErrors : 1,
					showErrors : 1
					
				}
			})});
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
    <p><span style="float:left;font-size:50px;line-height:30px;padding-top:2px;font-family: Georgia;">R</span>egister below ... All fields are required</p>
	<br/>
	<div class="form_box">
	<form id="register" method="post" class="add_book" action="">
	    <p>
		  <label>Email Address:
		  <input type="text"  class="validate['required','email']" name="email" />
		  </label>
		<br/>
	    <label>Password:
	    <input type="password" class="validate['required','length[6,-1]']" name="password" />
		(should be of 6 characters or more)
		</label>
		<br/><br/>
		<label>Re-Type Password:
	    <input type="password" class="validate['required','confirm[password]']" name="repassword" />
		</label>
		<br/>
		<label>First Name:
	    <input type="text" class="validate['required','length[1,-1]','nodigit']" name="fname" />
		</label>
		<br/>
		<label>Last Name:
	    <input type="text" class="validate['required','length[1,-1]','nodigit']" name="lname" />
		</label>
		
		
	    <input type="submit" class="login_button" name="login" value="Submit" />
	    </label>
		</p>
	</form>
	</div>
</div>

<div id="footer"></div>

</div>

</body>
</html>
