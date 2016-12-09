<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

	if (isset ($_SESSION['validUser']) && ($_SESSION['validUser'] == "yes"))			//is this already a valid user?
{
include "heartlandConnect.php";	
$delete_id = $_GET['delete_id'];
//$delete_id = $delete_id/1;
$sql = "DELETE FROM products WHERE product_id=$delete_id";


	$res = $conn->query($sql);
	if($res)
	{

?>
<!DOCTYPE HTML>
<html>

<head>
	<div id="menu">
		<ul>	
		<li><a href="productsAdmin.php">Product Admin Home</a></li>
			<li><a href="productsInsert.php">Insert New Product</a></li>
	        <li><a href="productsLogout.php">Logout</a></li>
		</ul>
		
	</div>	
</head>
<body>
<br><br>
<h3>
<?php
		echo "Record ". $delete_id ." Was Deleted Successfully";
	}
	else{
		echo "Something Went Wrong". "Record ". $delete_id." Was not deleted.";
		}
	$conn->close();
	{
header('Location: productsAdmin.php');
}
?>
</h3>
<h4>Go back to record selection page<a href="productsAdmin.php">Click Here</a></h4>

<?php
}else{
header('Location: productsLogin.php');
}
?>
</body>
</html>