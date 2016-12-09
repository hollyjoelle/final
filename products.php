<?php
include "heartlandConnect.php";
include "productsClass.php";
$Products1 = new products;


if(isset($_POST['submit']) )
	{
	//$image = $_POST['image'];
	$test = $_POST['test'];
	$image = $_POST['image'];
		}
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
			<ul class="menu">
		<li><a class = "adminlink" href="productsAdmin.php">Administrator Access</a></li>
		</ul>
	</div>	
</div>
<div id="main">
<?php echo $Products1->buildProductTable();
?>


<footer>
</footer>
</body>
</html>