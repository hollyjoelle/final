<?php

class products{

	public $productId = "";
	public $productTitle = "";
	public $productDescription = "";
	public $productImage = "";
	public $productPrice = "";
	public $userUploaded = "";
	public $date = "";
	public $time ="";
	public $sql = "";
	public $displaymsg ="";
	public $displayTable="";
	

	
//...................................Begin Sets.......................................................//	
	function setProductId($inProductId)
	{
		$this->productId = $inProductId;
	}

	function setProductTitle($inProductTitle)
	{
		$this->productTitle = $inProductTitle;
	}
		
	function setProductDescription($inProductDescription)
	{
		$this->productDescription = $inProductDescription;
	}
	function setImage($inImage)
	{
		$this->productImage = $inImage;
	}
	function setProductPrice($inProductPrice)
	{
		$this->productPrice = $inProductPrice;
	}
	function setUserUploaded($inUserUploaded)
	{
	$this->userUploaded = $inUserUploaded;
	}
	function setdate()
	{
		$this->date = date("Y-m-d");
	}	
	function settime()
	{
		date_default_timezone_set('America/Chicago');
		$this->time = date("G:i:s");
	}	

//...............................END GETS ..............................// BEGIN SETS//.................................//
	function getProductId()
	{
		return $this->productId;
	}
	
	function getProductTitle()
	{
		return $this->productTitle;
	}
	function getProductDescription()
	{
		return $this->productDescription;
	}
	function getProductImage()
	{
		return $this->productImage;
	}
	function getProductPrice()
	{
		return $this->productPrice;
	}
	function getUserUploaded()
	{
		return $this->userUploaded;
	}
	function getdate()
	{
		return date("m/d/Y");
	}

	function gettime()
	{
		return date("g:i A");
	}
//.........................................  //END GETS//.....................................................//
	

	function selectProducts()
		{
		$sql = "SELECT $productTitle, $productDescription, $productImage FROM products WHERE event_user_name = ? AND event_user_password = ?";				
			$query = $conn->prepare($sql) or die("<p>SQL String: $sql</p>");	//prepare the query
			
			$query->bind_param("ss",$inUsername,$inPassword);	//bind parameters to prepared statement
			
			$query->execute() or die("<p>Execution </p>" );
			
			$query->bind_result($userName,$passWord);
			
			$query->store_result();
			
			$query->fetch();
		}
			
	function buildAdminProductTable() //..................................BUILD ADMINISTRATOR PRODUCT TABLE ................//
		{	
		include "heartlandConnect.php";		
		$sql = "SELECT product_id, product_title, product_description, product_image, product_price, user_uploaded, date, time FROM products";
		$res = mysqli_query($conn, $sql);	//run the query
		if($res)
		{
		//process the result
			if ($res->num_rows > 0) 
			{		
						// output data of each row
			
				$displayTable = "<table class='tableFormat'>";
				$displayTable .= "<th>Product</th>";
				$displayTable .= "<th>Description</th>";
				$displayTable .= "<th>Image</th>";
				$displayTable .= "<th>Price</th>";
				$displayTable .= "<th>Time/Date</th>";
				$displayTable .= "<th>Update/Delete</th>";
				$displayTable .= "<th>User</th>";
				
				while($row = $res->fetch_assoc()) 
				{
				
				$productPrice = '$ '.sprintf('%0.2f', $row['product_price']);
					//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
					$displayTable .= "<tr><td>";
					$displayTable .= $row['product_title'];
					$displayTable .= "</td><td class='desc'>";
					$displayTable .= $row['product_description'];
					$displayTable .= "</td><td>";
					$displayTable .= "<img height='100px' width='100px' src='img/";
					$displayTable .= $row['product_image'];
					$displayTable .= "'>";
					$displayTable .= "</td><td>";
					$displayTable .= $row['product_price'];
					$displayTable .= "</td><td class='desc'>";
					$displayTable .= "Entered on: ". $row['date']. "</br></br> At:";
					$timestamp = $row['time'];
					$hour = substr($timestamp, 0, 2 );
					$minute = substr($timestamp, 3, 2);
					$displayTable .= date('h:i A', mktime($hour, $minute));								
					$displayTable .= "</td><td class='upd'>";
					$displayTable .= "ID#". $row['product_id']. " ". " ";
					$displayTable .= "<a href='deleteProducts.php?delete_id="; //delete event link
					$displayTable .= $row['product_id'];
					$displayTable .= "'>Delete</a>/";
					$displayTable .= "<a href='updateProducts.php?update_id="; //update event link
					$displayTable .= $row['product_id'];
					$displayTable .= "%20";
					$displayTable .= $row['user_uploaded'];
					$displayTable .= "'>Update</a>";
					$displayTable .= "</td><td>";
					$displayTable .= $row['user_uploaded'];
					$displayTable .= "</td></tr>";
			}
			//$displayMsg = "Number of rows is " . $res->num_rows;
			$displayTable .= "</table>";
			return $displayTable;
		} 
		else 
		{
				$displayTable = "0 results";
				return $displayTable . $sql;
		}
		}else{ 
				$displayTable = "there was an error";
				return $displayTable. $sql;
				}
		}  
			
	function buildProductTable() //.................................BUILDS INITIAL PRODUCT TABLE .................//
		{	
		include "heartlandConnect.php";		
		$sql = "SELECT product_id, product_title, product_description, product_image, product_price FROM products";
		$res = mysqli_query($conn, $sql);	//run the query
		if($res)
		{
		//process the result
			if ($res->num_rows > 0) 
			{		
						// output data of each row
			
				$displayTable = "<table class='tableFormat'>";
				$displayTable .= "<th>Product</th>";
				$displayTable .= "<th>Description</th>";
				$displayTable .= "<th>Image</th>";
				$displayTable .= "<th>Price</th>";
				
				while($row = $res->fetch_assoc()) 
				{
				
				$productPrice = '$ '.sprintf('%0.2f', $row['product_price']);
					//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
					$displayTable .= "<tr><td>";
					$displayTable .= $row['product_title'];
					$displayTable .= "</td><td class='desc'>";
					$displayTable .= $row['product_description'];
					$displayTable .= "</td><td>";
					$displayTable .= "<img height='100px' width='100px' src='img/";
					$displayTable .= $row['product_image'];
					$displayTable .= "'>";
					$displayTable .= "</td><td>";
					$displayTable .= $productPrice;
					$displayTable .= "</td></tr>";
			}
			//$displayMsg = "Number of rows is " . $res->num_rows;
			$displayTable .= "</table>";
			return $displayTable;
		} 
		else 
		{
				$displayTable = "0 results";
				return $displayTable . $sql;
		}
		}else{ 
				$displayTable = "there was an error";
				return $displayTable. $sql;
				}
		}
		// ............................END buildProductTable()........................//
		
	function getUpdate() //..............................Get Update Function...............//
		{
		include "heartlandConnect.php";
//    $sql = "INSERT INTO wdv341_events (event_name, event_description)
//    VALUES ('John', 'Doe')";

		$sql = "SELECT ";
		$sql .= "product_title, ";
		$sql .= "product_description, ";
		$sql .= "product_image, ";
		$sql .= "product_price ";
		$sql .= " FROM products";
		$sql .= " WHERE product_id = ?";
		
		$query = $conn->prepare($sql) or die("<p>SQL String: $sql</p>");	//prepare the query
			
		$query->bind_param("s", $this->productId);	//bind parameters to prepared statement
			
		$query->execute() or die("<p>Execution </p>" );
			
		$query->bind_result($this->productTitle,$this->productDescription,$this->productImage,$this->productPrice);
			
		$query->store_result();
			
		$query->fetch();
	 $conn->close();
	}

	function runUpdate() //.....................................................RUNS THE INSERT FOR THE UPDATE ..............//
	{
		include "heartlandConnect.php";
		
		$sql = "UPDATE products SET ";
		$sql .= "product_title= ?, ";
		$sql .= "product_description=?, ";
		$sql .= "product_image=?, ";
		$sql .= "product_price=?";
		$sql .= " WHERE product_id= ?";
	 
		$query = $conn->prepare($sql) or die("<p>SQL String: $sql</p>");	//prepare the query
		$query->bind_param("sssss", $this->productTitle, $this->productDescription, $this->productImage, $this->productPrice, $this->productId);	//bind parameters to prepared statement
			
		$query->execute() or die("<p>Execution </p>" );

	 $conn->close();
	}
	function runInsert()  //.........................Start RUN INSERT...........................///
	{
		include "heartlandConnect.php";
	$sql = "INSERT INTO products (";
	$sql .= "product_title, ";
	$sql .= "product_description, ";
	$sql .= "product_image, ";
	$sql .= "product_price, ";
	$sql .= "user_uploaded, ";
	$sql .= "date, ";
	$sql .= "time ";	//Last column does NOT have a comma after it.
	
	$sql .= ") VALUES (";
	$sql .= "?, ";
	$sql .= "?, ";
	$sql .= "?, ";
	$sql .= "?, ";
	$sql .= "?, ";
	$sql .= "?, ";
	$sql .= "?";
	$sql .= ")";
	
	$query = $conn->prepare($sql) or die("<p>SQL String: $sql</p>");	//prepare the query
	$query->bind_param("sssssss", $this->productTitle, $this->productDescription, $this->productImage, $this->productPrice, $this->userUploaded, $this->date, $this->time);	//bind parameters to prepared statement
			
	$query->execute() or die("<p>Execution </p>" );

	 $conn->close();
	}
	
	
	

	
}
?>