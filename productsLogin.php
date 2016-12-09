<?php 
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();
include "productsClass.php";
$Products1 = new products;
	if (isset ($_SESSION['validUser']) && ($_SESSION['validUser'] == "yes"))			//is this already a valid user?
	{
		//User is already signed on.  Skip the rest.
		$Products1->setUserUploaded($_POST['product_username']);
		$message = "Welcome Back!".  $Products1->getUserUploaded();	//Create greeting for VIEW area		
	}
	else
	{
		if (isset($_POST['submitLogin']) )			//Was this page called from a submitted form?
		{
			$inUsername = $_POST['product_username'];	//pull the username from the form
			$inPassword = $_POST['product_password'];	//pull the password from the form
			
			include 'heartlandConnect.php';				//Connect to the database

			$sql = "SELECT product_username, product_password FROM product_user WHERE product_username = ? AND product_password = ?";				
			
			$query = $conn->prepare($sql) or die("There has been a problem :-(");	//prepare the query
			
			$query->bind_param("ss",$inUsername,$inPassword);	//bind parameters to prepared statement
			
			$query->execute() or die("<p>Execution </p>" );
			
			$query->bind_result($userName,$passWord);
			
			$query->store_result();
			
			$query->fetch();	
			
			//echo "<h2>userName: $userName</h2>";
			//echo "<h2>password: $passWord</h2>";
		
			//echo "<h2>Number of rows affected " . $connection->affected_rows . "</h2>";	//best for Update,Insert,Delete			
			//echo "<h2>Number of rows found " . $query->num_rows . "</h2>";				//best for SELECT
			
			if ($query->num_rows == 1 )		//If this is a valid user there should be ONE row only
			{
				$_SESSION['validUser'] = "yes";				//this is a valid user so set your SESSION variable
				$message = "Welcome Back! $userName";
				//Valid User can do the following things:
			}
			else
			{
				//error in processing login.  Logon Not Found...
				$_SESSION['validUser'] = "no";					
				$message = "Sorry, there was a problem with your username or password. Please try again.";
			}			
			
			$query->close();
			$conn->close();
			
		}//end if submitted
		else
		{
			$message = "You have logged out successfully";
		}//end else submitted
		
	}//end else valid user
	
//turn off PHP and turn on HTML
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Login and Control Page</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link rel="stylesheet" type="text/css" href="form_style.css">
</head>
<body id="body" onScroll="headerAnimate()"> <!-----Begin Body--->
<div id = "header"> <!-- Header -->
<div id="barMenu">
</div>
</div>
<div id= "header1"> <!--Header1 -->
<?php
	if (isset ($_SESSION['validUser']) && ($_SESSION['validUser'] == "yes"))		//This is a valid user.  Show them the Administrator Page
	{
		
//turn off PHP and turn on HTML
?>
		<div id="menu">
        <ul>
			<li><a href="productsAdmin.php?user_uploaded= <?php echo $_POST['product_username'];?>">View/Update/Delete Products</a></li>
			<li><a href="productsInsert.php?user_uploaded= <?php echo $_POST['product_username'];?>">Input A New Product</a></li>
			<li><a href="productsLogout.php?user_uploaded= <?php echo $Products1->getUserUploaded();?>">Logout</a></li>	
       <li><a href="contactForm.php">Contact Us</a></li>      
            
		</ul>
		</div>
</div>
<div id="main">
<h3><?php echo $message?></h3>
<h3>Welcome To the Products Admin system</h3>




<?php
	}
	else									//The user needs to log in.  Display the Login Form
	{
?>			
			<h2>Please login to the Administrator System</h2>
			
                <form method="post" name="loginForm" class="dark-matter" action="productsLogin.php" >
                  <p>Username: <input name="product_username" type="text" required/></p>
                  <p>Password: <input name="product_password" type="password" required/></p>
                  <p><input name="submitLogin" value="Login" type="submit" /> <input name="" type="reset" />&nbsp;</p>
                </form>
       
<?php //turn off HTML and turn on PHP
	}
//turn off PHP and begin HTML			
?>
</div>
</body>
</html>