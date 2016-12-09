<?php
//	This file contains the PHP coding to connect to my class database called gullydsm_dmacc.
//
//	Include this file in any page that needs to access the database.
//  Use the following settings to connect to the dmacc database
//

$hostname = "localhost";			
$username = "hollyjoelle_wdv341";		//database/username from control panel
$password = "Yellow04";		//database password	from control panel for the 
$database = "hollyjoelle_wdv341";		//name of database/username from control panel

//Create connection object to the MySQL database server

$conn = new mysqli($hostname, $username, $password, $database);


//Check connection with DEVELOPMENT exception handling

if($conn->connect_error)
{
	die("Connection Failed: " . $conn->connect_error);	
}
else
{
	echo "Connected Successfully";
}

?>