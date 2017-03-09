<?php
session_start();
include_once('../dbconfig.php');
$postdata = file_get_contents("php://input");
$data_j = json_decode($postdata, true);
$dbh = new PDO('mysql:host=localhost; dbname=daspra_budjet;', 'daspra_budjet', 'dassbudjet');

if($data_j['action']=='register')
{
	$sql="INSERT INTO `user_details`(`first_name`, `last_name`, `username`, `password`, `email`) VALUES ('".$data_j['fname']."','".$data_j['lname']."','".$data_j['username']."','".md5($data_j['password'])."','".$data_j['email']."')";
	if(mysql_query($sql))
	{
		 $data['sucess']='sucessfully register';
	}else{
		 $data['error']='sucessfully register';
	}
	
}
if($data_j['action']=='login')
{
	$where = "username='".$data_j['uname']."' AND password='".md5($data_j['password'])."'";
	$fetch_query = "SELECT id FROM user_details WHERE ".$where;
	$fect = mysql_query($fetch_query);
	if(mysql_num_rows($fect))
	{
	$fect = mysql_fetch_array($fect);
		$_SESSION['username'] = $data_j['uname'];
		$_SESSION['userid'] = $fect['id'];
		$data['sucess']='sucessfully login';
	}else
	{
		$data['error']="Please Enter correct Information";
	}
}
if($data_j['action']=='profile')
{
	$where = "id='".$_SESSION['userid']."'";
	$fetch_query = "SELECT * FROM user_details WHERE ".$where;
	$sth = $dbh->prepare($fetch_query);
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['profile'] = $result[0];
}
if($data_j['action']=='updateprofile')
{
	$where = "id='".$_SESSION['userid']."' AND password='".md5($data_j['oldpassword'])."'";
	$fetch_query = "SELECT id FROM user_details WHERE ".$where;
	$fect = mysql_query($fetch_query);
	if(mysql_num_rows($fect))
	{
		if(isset($data_j['password']))
		{
			$pass = ",`password`='".md5($data_j['password'])."'";
		}else{
			$pass = '';
		}
		$sql="UPDATE `user_details` SET `first_name`='".$data_j['fname']."',`last_name`='".$data_j['lname']."',`username`='".$data_j['username']."',`email`='".$data_j['email']."'".$pass." WHERE id='".$_SESSION['userid']."'";
		if(mysql_query($sql))
		{
			$_SESSION['username'] = $data_j['username'];
			$data['sucess']='sucessfully update';
		}else{
			$data['error']='Not update your profile';
		}
	}else{
		$data['error']='Please enter your correct password';
	}
}
header("Content-Type: application/json");
echo json_encode($data);
?>