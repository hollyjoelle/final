<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

if (isset ($_SESSION['validUser']) && ($_SESSION['validUser'] == "yes"))			//is this already a valid user?
{

include "heartlandConnect.php";
include "productsClass.php";
$Products1 = new products;
$userUploaded= $_GET['user_uploaded'];

	if(isset($_POST['submit']) )
	{

	$Products1->setProductTitle($_POST['product_title']);
	$Products1->setProductDescription($_POST['product_description']);
	$Products1->setImage($_POST['product_image']);
	$Products1->setProductPrice($_POST['product_price']);
	$Products1->setDate();
	$Products1->setTime();
	$Products1->setUserUploaded($_POST['user_uploaded']);
	
	$Products1->runInsert();
	
	
}






?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link rel="stylesheet" type="text/css" href="form_style.css">
</head>
<body id="body"> <!-----Begin Body--->
<div id = "header"> <!-- Header -->
<div id="barMenu">
</div>
</div>
<div id= "header1"> <!--Header1 -->
	<div id="menu">
		<ul>	
		<li><a href="productsAdmin.php?user_uploaded=<?php echo $userUploaded;?>">Product Admin Home</a></li>
			<li><a href="productsInsert.php?user_uploaded= <?php echo $_GET['product_username'];?>">Insert New Product</a></li>
	        <li><a href="productsLogout.php">Logout</a></li>
		</ul>
		
	</div>	
</div>
<div id="main">
<?php
	if(isset($_POST['submit']))
	{
	?>
	<table>
		<th>Product Title</th>
		<th>Product Description</th>
		<th>Product Image</th>
		<th>Product Price</th>
		<th>Date Entered</th>
		<th>Time Entered</th>
		<th>User</th>
		<tr>
			<td><?php echo $Products1->getProductTitle();?> </td>
			<td class="desc"><?php echo $Products1->getProductDescription();?> </td>	
			<td><img src="img/<?php echo $Products1->getProductImage();?>"height="100px width="100px"> </td>	
			<td><?php echo $Products1->getProductPrice(); ?></td>	
			<td><?php echo $Products1->getDate();?></td>	
			<td><?php echo $Products1->getTime();?></td>
			<td><?php echo $Products1->getUserUploaded();?></td>
		</tr>
			
	</table>
	<?php
	}
	?>
<form action="productsInsert.php" method="post" action="productsInsert.php" class="dark-matter">
<?php
	if(isset($_POST['submit']))
	{
	?>
	  <h1>
		Product Entered Successfully
		<span>Please Enter Another Product or click a link at the bottom of the page</span>
        <span>Please fill all text fields completely and accurately</span>
				<span>Thank You</span>
    </h1>
	<?php
	}else{
	?>
  <h1>
  Insert a New Product Into the Database
        <span>Please fill all text fields completely and accurately</span>
				<span>Thank You</span>
    </h1>
	    <?php
		}
	?>
    <label>
        <span>Product Title:</span>
        <input id="product_title" type="text" name="product_title" required/>
    </label>
    <label>
        <span>Product Description:</span>
        <textarea  id="product_description"  name="product_description"required> </textarea>
    </label>
    
    <label>
        <span> Photo :</span>
            <input type="hidden" name="size" value="350000">
            <input type="file" id="product_image" name="product_image"required> 
    </label> 
     <label>
        <span>Price :</span>
		<input type="text"id="product_price" name="product_price"required>
    </label>    
     <label>
	 <?php
	 if(!isset($_POST['submit']))
	 {
	 ?>
	 <input type="hidden" id="user_uploaded" name = "user_uploaded" value = "<?php echo $_GET['user_uploaded'];?>">
	 	<?php }else{  ?>
			 <input type="hidden" id="user_uploaded" name = "user_uploaded" value = "<?php echo $_POST['user_uploaded'];?>">
		<?php 
		}
		?>
        <span>&nbsp;</span> 
        <input  type="submit" name="submit" id="button" value="submit"class="button" /> 

    </label>    
</form>
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