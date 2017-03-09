<?php
session_start();
include_once('../dbconfig.php');
$postdata = file_get_contents("php://input");
$data_j = json_decode($postdata, true);
$dbh = new PDO('mysql:host=localhost; dbname=daspra_budjet;', 'daspra_budjet', 'dassbudjet');
if($data_j['action']=='listincome')
{
	$sth = $dbh->prepare("SELECT * from bills left join category on bills.CategoryId = category.CategoryId left join account on bills.AccountId = account.AccountId where bills.UserId = ".$_SESSION['userid']." ORDER BY bills.Dates ");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['list'] = $result;
	
	$sth = $dbh->prepare("SELECT * FROM category where level='1'");
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
if($data_j['action']=='deleteincome')
{
	$sql="DELETE FROM `bills` WHERE `BillsId`='".$data_j['incomeid']."'";
	if(mysql_query($sql))
	{
	 $data['sucess']='sucessfully Deleted';
	 $sth = $dbh->prepare("SELECT * from bills left join category on bills.CategoryId = category.CategoryId left join account on bills.AccountId = account.AccountId where bills.UserId = ".$_SESSION['userid']." ORDER BY bills.Dates ");
		$sth->execute();

		/* Fetch all of the remaining rows in the result set */
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		$data['list'] = $result;
	}else{
		 $data['error']='sucessfully register';
	}
	
}
if($data_j['action']=='updateIncome')
{
	$sql="UPDATE bills SET Title = '".$data_j['name']."', Dates = '".$data_j['date']."', CategoryId = '".$data_j['excat']."', AccountId = '".$data_j['account']."', Amount = '".$data_j['amount']."', Description = '".$data_j['description']."' WHERE BillsId = '".$data_j['AssetsId']."'";
	if(mysql_query($sql))
	{
	 $data['sucess']='sucessfully Deleted';
	 $sth = $dbh->prepare("SELECT * from bills left join category on bills.CategoryId = category.CategoryId left join account on bills.AccountId = account.AccountId where bills.UserId = ".$_SESSION['userid']." ORDER BY bills.Dates ");
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