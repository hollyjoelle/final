<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

	if (isset ($_SESSION['validUser']) && ($_SESSION['validUser'] == "yes"))			//is this already a valid user?
{
include "heartlandConnect.php";
include "productsClass.php";
$Products1 = new products;
$userUploaded= $_GET['user_uploaded'];

if(isset($_GET['update_id']))
{
	$Products1->setProductId($_GET['update_id']);
}
if(isset($_POST['update_id']))
{
	$Products1->setProductId($_POST['update_id']);
}

if (isset($_POST['submit']))
{
$Products1->setProductTitle($_POST['product_title']);
$Products1->setProductDescription($_POST['product_description']);
$Products1->setImage($_POST['product_image']);
$Products1->setProductPrice($_POST['product_price']);
$Products1->setProductId($_POST['update_id']);
echo $Products1->runUpdate();
	

/*mysqli_real_escape_string($conn,$sql); //data sanitization...or so i thought

$res = mysqli_query($conn,$sql);  

if($res){
$displaymsg = "Record Entered Successfully";
$conn->close();
}else{
	$displaymsg = "There was an error entering your record";
}*/
}else if(isset ($_GET['update_id']))
{

$Products1->setProductId($_GET['update_id']);
$Products1->getUpdate();
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
<link rel="stylesheet" type="text/css" href="css/form_style.css">
</head>
<body id="body" onScroll="headerAnimate()"> <!-----Begin Body--->
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
		</ul>
		
	</div>	
</div>
<div id="main">
<?php
if (!isset($_POST['submit']))
{
?>
<!--<h3>If you would like to view the data in the database, <a href="heartlandSelectPage.php">Click here</a></h3>-->

<form id="form1" name="form1" method="post" class="dark-matter" action="updateProducts.php">
    <h1>Administrator: Update Product Information
        <span>Please fill all text fields completely and accurately</span>
    </h1>
  <p>Product Title </br>
    <input type="text" value = "<?php echo $Products1->getProductTitle();?>" name="product_title" 
	id="product_title" required/>
</p>
  <p>Product Description </br>
    <textarea rows="10" cols="50" name="product_description" id="product_description" required><?php echo $Products1->getProductDescription();?></textarea>
  </p>
  <p> <?php echo $Products1->getProductDescription();?>
  <p>
  Product Image URL <br/>
  	<input type="text" value = "<?php echo $Products1->getProductImage();?>" name="product_image" id="product_image" required/>
  </p>
  <p>Product Image<p>
  <img src = "img/<?php echo $Products1->getProductImage();?>" height="100px" width="100px">
  
  <p>Product Price </br>
    <input type="text" value = "<?php echo $Products1->getProductPrice();?>" name = "product_price" id="product_price" required />
 
	<input type="hidden" name ="update_id" id="update_id" value="<?php echo $_GET['update_id'];?>"/>
		 <input type="hidden" id="user_uploaded" name = "user_uploaded" value = "<?php echo $_GET['user_uploaded'];?>">
   <p> <input type="submit" name="submit" class="button" id="button" value="Submit" /></p>
   <p> <input type="reset" name="button2" class="button"id="button2" value="Reset" /></p>

</form>

<?php
}else 
{ header('Location: productsAdmin.php')
?>
<?php }}else{
header('Location: products.php');
}?>
<div> 
</body>

</html>
