<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

if (isset ($_SESSION['validUser']) && ($_SESSION['validUser'] == "yes"))			//is this already a valid user?
{

include "heartlandConnect.php";
include "productsClass.php";
$Products1 = new products;
$userUploaded= $_GET['user_uploaded'];
?>
<html>
<head>
<script>
var screenWidth = window.innerWidth;


var headerAnimate = function headerAnimate()
{
	document.getElementById("header").style.height = "150px";
}


</script>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body id="body"> <!-----Begin Body--->
<div id = "header"> <!-- Header -->
<div id="barMenu">
</div>
</div>
<div id= "header1"> <!--Header1 -->
	<div id="menu">
		<ul>	
		<li><a href="productsAdmin.php">Product Admin Home</a></li>
			<li><a href="productsInsert.php?user_uploaded=<?php echo $userUploaded?>">Insert New Product</a></li>
	        <li><a href="productsLogout.php">Logout</a></li>
            <li><a href="contactForm.php">Contact Us</a></li>
		</ul>
		
	</div>	
</div>
<div id="main">
<?php echo $Products1->buildAdminProductTable();
?>

</div>
<footer>	
</footer>
<?php
	}else{
header('Location: productsLogin.php');
}
?>

</body>
</html>