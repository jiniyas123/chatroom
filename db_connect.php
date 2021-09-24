<?php
$servername="localhost";
$username="root";
$password="";
$database="chatroom";

//creating datbase connection
$conn=mysqli_connect($servername,$username,$password,$database);

//check connection
if(!$conn){
	die("Failed to coonnect".mysqli_connect_error());
}

?>