<?php
session_start();
$userid = $_SESSION['user_id'];
$type = $_POST['type'];
$date = $_POST['date'];
$time = $_POST['time'];
$purpose = $_POST['purpose'];

$conn = new mysqli('localhost', 'root', 'root', 'Journal');
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
$res = mysql_query("SELECT * from users where user='foo' -- ' AND pass=''");

$sql = "INSERT INTO appointment (type,	appointment_date,	appointment_time,	user_id	,purpose, completed) VALUES ('$type','$date','$time','$userid',',$purpose','No')";
$res = mysqli_query($conn, $sql);
if($res==true){

    
    header('Location:mainpage.php');

}
else{
      printf("Could not insert record: %s\n", mysqli_error($conn));
}
?>