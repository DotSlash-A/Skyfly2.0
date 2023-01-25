<?php
$servername="localhost:3306";
$username="root";
$password="";
$dbname="student";

$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
die("Connection failed: ".$conn->connect_error);
}
$sql="INSERT INTO student(stuid,stuname,fees,email)
VALUES(1,'Anjali',2000,'anjali@adc.com'),
(2,'Bhanu',3000,'bhanu@adc.com'),
(3,'Cherry',4000,'cherry@adc.com')";
if($conn->query($sql)===TRUE){
echo("Inserted into student successfully");
}else{
echo("Error in inserting".$conn->error);
}
$conn->close();
?>