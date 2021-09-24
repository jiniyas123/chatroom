<?php
//get parameters
$roomname=$_GET['roomname'];

//creating alert
 function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
//connecting to the database
include 'db_connect.php';

//execute sql to check whether the room is exists
$sql="SELECT * FROM `rooms` WHERE roomname='$roomname'";

$result=mysqli_query($conn,$sql);

if($result){
     if(mysqli_num_rows($result)==0){
         phpAlert("This room does not exists.Try to create a new one");
     }

}
else{

   echo "Error : ".mysql_error($conn);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Jiniyas">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Chatroom</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyClass{
  height: 350px;
  overflow-y: scroll;
}
</style>
</head>
<body>

<h2>Chat Messages - <?php echo $roomname; ?></h2>

<div class="container">
  <div class="anyClass">
  
</div>
</div>



<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add message"><br>
<button class="btn-btn-default" name="submitmsg" id="submitmsg">Send</button>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">
  

setInterval(runFunction,1000);
function runFunction(){
  $.post("htcont.php",{room:'<?php echo $roomname ?>'},
    function(data,status)
    {
       document.getElementsByClassName('anyClass')[0].innerHTML=data;
    }

    )
}

 // using enter key to submit
var input = document.getElementById("usermsg");

input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("submitmsg").click();
  }
});


 //if user submit this form 
  $("#submitmsg").click(function(){
    var clientmsg=$("#usermsg").val();
  $.post("postmsg.php", {text:clientmsg, room:'<?php echo $roomname ?>', ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
  function(data,status){
    document.getElementsByClassName('anyClass')[0].innerHTML=data;});
  $("#usermsg").val("");
  return false;
  });
</script>
</body>
</html>
