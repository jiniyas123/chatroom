<?php 

//Getting the value of post parameter 
 $room=$_POST['room'];

 //creating alert
 function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

//Checking for string size 
 if(strlen($room)>20 or strlen($room)<2){
    phpAlert("please! choose a name between 2 and 20 charcters"); 
    //echo '<script>window.location.href="index.php";</script>';
    exit();
 }

//Cheching whether room name is alpha numeric
 else if(!ctype_alnum($room)){
    phpAlert("please! choose a alpha-numeric room name");
    //echo '<script>window.location.href="index.php";</script>';
    exit();
 }
 else{
 	//Connecting to database
 	include 'db_connect.php';
 }
$sql="SELECT * FROM `rooms` WHERE roomname='$room'";
$result=mysqli_query($conn,$sql);
if($result){
	if(mysqli_num_rows($result)>0){
		phpAlert("please! choose a different room as this room is already claimed");
	}
	else{
		$sql="INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', current_timestamp());";
		if(mysqli_query($conn,$sql)){
			phpAlert("Your room is ready and you can chat now!");
			echo '<script>window.location="http://localhost/chatroom/rooms.php?roomname='.$room.'";</script>';
		}
	}
} 
else{
	echo "Error: ".mysqli_error($conn);
}

?>