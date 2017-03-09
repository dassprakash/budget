<?php
session_start();
include_once('../dbconfig.php');
$postdata = file_get_contents("php://input");
$data_j = json_decode($postdata, true);
$dbh = new PDO('mysql:host=localhost; dbname=daspra_budjet;', 'daspra_budjet', 'dassbudjet');
if($data_j['action']=='accountlist')
{
	$sth = $dbh->prepare("SELECT * FROM account where UserId=".$_SESSION['userid']);
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['list'] = $result;
}
if($data_j['action']=='addaccount')
{
	$sql="INSERT INTO `account`(`AccountName`, `UserId`) VALUES ('".$data_j['cname']."','".$_SESSION['userid']."')";
	if(mysql_query($sql))
	{
		 $data['sucess']='sucessfully register';
		 $sth = $dbh->prepare("SELECT * FROM account where UserId=".$_SESSION['userid']);
$sth->execute();

/* Fetch all of the remaining rows in the result set */
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
$data['list'] = $result;
	}else{
		 $data['error']='Sorry Not register your account';
	}
	
}
if($data_j['action']=='deletecat')
{
	$level='1';
	$sql="DELETE FROM `account` WHERE `AccountId`='".$data_j['catid']."'";
	if(mysql_query($sql))
	{
	 $data['sucess']='sucessfully Deleted';
	 $sth = $dbh->prepare("SELECT * FROM account where UserId=".$_SESSION['userid']);
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
	$sql="UPDATE `account` SET `AccountName`='".$data_j['catname']."' WHERE `AccountId`='".$data_j['catid']."'";
	if(mysql_query($sql))
	{
	 $data['sucess']='sucessfully Updated';
	 $sth = $dbh->prepare("SELECT * FROM account where UserId=".$_SESSION['userid']);
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