<?php
session_start();
include_once('../dbconfig.php');
$postdata = file_get_contents("php://input");
$data_j = json_decode($postdata, true);
$dbh = new PDO('mysql:host=localhost; dbname=daspra_budjet;', 'daspra_budjet', 'dassbudjet');
if($data_j['action']=='listcategory')
{
	$sth = $dbh->prepare("SELECT * FROM category where Level='2'");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['list'] = $result;
}
if($data_j['action']=='addcategory')
{
	$level='2';
	$sql="INSERT INTO `category`(`CategoryName`, `Level`) VALUES ('".$data_j['cname']."','".$level."')";
	if(mysql_query($sql))
	{
		 $data['sucess']='sucessfully register';
		 $sth = $dbh->prepare("SELECT * FROM category where Level='2'");
$sth->execute();

/* Fetch all of the remaining rows in the result set */
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
$data['list'] = $result;
	}else{
		 $data['error']='sucessfully register';
	}
	
}
if($data_j['action']=='deletecat')
{
	$level='1';
	$sql="DELETE FROM `category` WHERE `CategoryId`='".$data_j['catid']."'";
	if(mysql_query($sql))
	{
	 $data['sucess']='sucessfully Deleted';
	 $sth = $dbh->prepare("SELECT * FROM category where Level='2'");
		$sth->execute();

		/* Fetch all of the remaining rows in the result set */
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		$data['list'] = $result;
	}else{
		 $data['error']='sucessfully register';
	}
	
}
if($data_j['action']=='Editcat')
{
	$level='1';
	$sql="UPDATE `category` SET `CategoryName`='".$data_j['catname']."' WHERE `CategoryId`='".$data_j['catid']."'";
	if(mysql_query($sql))
	{
	 $data['sucess']='sucessfully Updated';
	 $sth = $dbh->prepare("SELECT * FROM category where Level='2'");
		$sth->execute();

		/* Fetch all of the remaining rows in the result set */
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		$data['list'] = $result;
	}else{
		 $data['error']='sucessfully register';
	}
	
}

header("Content-Type: application/json");
echo json_encode($data);
?>