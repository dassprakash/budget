<?php
session_start();
include_once('../dbconfig.php');
$postdata = file_get_contents("php://input");
$data_j = json_decode($postdata, true);
$dbh = new PDO('mysql:host=localhost; dbname=daspra_budjet;', 'daspra_budjet', 'dassbudjet');
if($data_j['action']=='transaction')
{
	$sth = $dbh->prepare("SELECT * FROM category where level='1'");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['excatlist'] = $result;
	$sth = $dbh->prepare("SELECT * FROM category where level='2'");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['incomecatlist'] = $result;
	$sth = $dbh->prepare("SELECT * FROM account");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['account'] = $result;
}
if($data_j['action']=='addexpence')
{
	$sql="INSERT INTO `bills`(`UserId`, `Title`, `Dates`, `CategoryId`, `AccountId`, `Amount`, `Description`) VALUES ('".$_SESSION['userid']."','".$data_j['name']."','".$data_j['date']."','".$data_j['excat']."','".$data_j['account']."','".$data_j['amount']."','".$data_j['description']."')";
	if(mysql_query($sql))
	{
		 $data['sucess']='sucessfully register';
	}else{
		 $data['error']='Not added your expense ';
	}
}
if($data_j['action']=='addIncome')
{
	 $sql="INSERT INTO `assets`(`UserId`, `Title`, `Date`, `CategoryId`, `AccountId`, `Amount`, `Description`) VALUES ('".$_SESSION['userid']."','".$data_j['name']."','".$data_j['date']."','".$data_j['excat']."','".$data_j['account']."','".$data_j['amount']."','".$data_j['description']."')";
	if(mysql_query($sql))
	{
		 $data['sucess']='sucessfully register';
	}else{
		 $data['error']='Not added your income';
	}
}

header("Content-Type: application/json");
echo json_encode($data);
?>