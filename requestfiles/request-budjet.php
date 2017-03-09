<?php
session_start();
include_once('../dbconfig.php');
$postdata = file_get_contents("php://input");
$data_j = json_decode($postdata, true);
$dbh = new PDO('mysql:host=localhost; dbname=daspra_budjet;', 'daspra_budjet', 'dassbudjet');
function selectbudject()
{
	$dbh = new PDO('mysql:host=localhost; dbname=daspra_budjet;', 'daspra_budjet', 'dassbudjet');
	$sth = $dbh->prepare("SELECT * from monthlybudjet left join category on monthlybudjet.CategoryId = category.CategoryId left join account on monthlybudjet.AccountId = account.AccountId where monthlybudjet.UserId = ".$_SESSION['userid']." ORDER BY monthlybudjet.Dates ");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	return $sth->fetchAll(PDO::FETCH_ASSOC);
}
if($data_j['action']=='listbudjet')
{
	$result = selectbudject();
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
	$sql="DELETE FROM `monthlybudjet` WHERE `BudjetId`='".$data_j['incomeid']."'";
	if(mysql_query($sql))
	{
	 $data['sucess']='sucessfully Deleted';
	 $result = selectbudject();
	$data['list'] = $result;
	}else{
		 $data['error']='sucessfully register';
	}
	
}
if($data_j['action']=='updateIncome')
{
	$sql="UPDATE monthlybudjet SET Title = '".$data_j['name']."', Dates = '".$data_j['date']."', CategoryId = '".$data_j['excat']."', AccountId = '".$data_j['account']."', Amount = '".$data_j['amount']."', Description = '".$data_j['description']."' WHERE BudjetId = '".$data_j['AssetsId']."'";
	if(mysql_query($sql))
	{
	 $data['sucess']='sucessfully Deleted';
	 $result = selectbudject();
		$data['list'] = $result;
	}else{
		 $data['error']='sucessfully register';
	}
	
}
if($data_j['action']=='change_status')
{
	$sql="UPDATE monthlybudjet SET status = 'Y' WHERE BudjetId = '".$data_j['incomeid']."'";
	if(mysql_query($sql))
	{
	 $data['sucess']='sucessfully Update the status';
	 $result = selectbudject();
		$data['list'] = $result;
	}else{
		 $data['error']='sucessfully register';
	}
	
}
if($data_j['action']=='addbudject')
{
	$sql="INSERT INTO `monthlybudjet`(`UserId`, `Title`, `Dates`, `CategoryId`, `AccountId`, `Amount`, `Description`) VALUES ('".$_SESSION['userid']."','".$data_j['name']."','".$data_j['date']."','".$data_j['excat']."','".$data_j['account']."','".$data_j['amount']."','".$data_j['description']."')";
	if(mysql_query($sql))
	{
		$result = selectbudject();
		$data['list'] = $result;
	}else{
		 $data['error']='Not register your budject';
	}
}
header("Content-Type: application/json");
echo json_encode($data);
?>