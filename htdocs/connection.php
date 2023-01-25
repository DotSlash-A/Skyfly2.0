<?php
	$name=$_POST['name'];
	$username=$_POST['username'];
	$gender=$_POST['gender'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$number=$_POST['number']; 
	$conn=new mysqli('localhost','root','','login');
	if($conn->connect_error){
		die('Connection failed : '.$conn->connect_error);
	}else{
		$stmt=$conn->prepare("insert into info2(name,username,gender,email,password,number)
		values(?,?,?,?,?,?)");
		$stmt->bind_param("sssssi",$name,$username,$gender,$email,$password,$number);
		$stmt->execute();
		echo "registration successful";
		$stmt->close();
		$conn->close();
}
?>