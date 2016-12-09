<?php
if(!isset($_POST['submit']) )	
{}
?>




<title>Contact Page</title>

<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link rel="stylesheet" type="text/css" href="form_style.css" />

</head>

<body>
<h1>Contact US</h1>

<body id="body"> <!-----Begin Body--->
<div id = "header"> <!-- Header -->
<div id="barMenu">
</div>
</div>
<div id= "header1"> <!--Header1 -->
	<div id="menu">
		<ul>	
		<li><a href="productsAdmin.php">Product Admin Home</a></li>
		<li><a href="productsInsert.php">Insert New Product</a></li>
	     <li><a href="productsLogout.php">Logout</a></li>
          <li><a href="contactForm.php">Contact Us</a></li>
		</ul>
		
	</div>	
</div>

<!--form begins-->
<form id="form1" name="form1" class="dark-matter" method="post" action="processEmail.php">
  <p>Send From: </br>
    <input type="email" value = "hjjohnson1@dmacc.com" name="sendFrom" id="sendFrom" />
</p>
  <p>To: </br>
    <input type="email" name="sendTo" id="sendTo" />
  </p>
  <p>
  Subject: <br/>
  	<input type="text" name="subject" id="subject"/>
  </p>
    <p>Message: </br>
    <textarea rows="10" cols="50" name="message" id="message"> </textarea>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
    <input type="reset" name="button2" id="button2" value="Reset" />
  </p>
</form>


</body>
</html>