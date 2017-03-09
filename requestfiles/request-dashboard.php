<?php
session_start();
include_once('../dbconfig.php');
$postdata = file_get_contents("php://input");
$data_j = json_decode($postdata, true);
$dbh = new PDO('mysql:host=localhost; dbname=daspra_budjet;', 'daspra_budjet', 'dassbudjet');
if($data_j['action']=='dashboard')
{
	$sth = $dbh->prepare("SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = ".$_SESSION['userid']." AND MONTH(Dates) = MONTH (CURRENT_DATE())");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['expence'] = (int)$result[0]['Amount'];

	$sth = $dbh->prepare("SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = ".$_SESSION['userid']." AND MONTH(Date) = MONTH (CURRENT_DATE())");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['income'] = (int)$result[0]['Amount'];

	$sth = $dbh->prepare("SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = ".$_SESSION['userid']);
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$allincome = $result[0]['Amount'];

	$sth = $dbh->prepare("SELECT SUM(Amount) AS Amount FROM bills WHERE UserId =".$_SESSION['userid']);
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['allexpence'] = (int)$result[0]['Amount'];

	$data['allIncome'] = $allincome - $data['allexpence'];

	$sth = $dbh->prepare("SELECT Title,Amount,Date,AccountName from assets left join category on assets.CategoryId = category.CategoryId left join account on assets.AccountId = account.AccountId where assets.UserId = ".$_SESSION['userid']." ORDER BY assets.Date desc LIMIT 0 , 10");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['income_list'] = $result;

	$sth = $dbh->prepare("SELECT Title,Amount,Dates,AccountName from bills left join category on bills.CategoryId = category.CategoryId left join account on bills.AccountId = account.AccountId where bills.UserId = ".$_SESSION['userid']." ORDER BY bills.Dates desc LIMIT 0 , 10");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['expence_list'] = $result;
	
	$sth = $dbh->prepare("SELECT Title,Amount from monthlybudjet left join category on monthlybudjet.CategoryId = category.CategoryId left join account on monthlybudjet.AccountId = account.AccountId where monthlybudjet.UserId = ".$_SESSION['userid']." AND MONTH(monthlybudjet.Dates) = MONTH (CURRENT_DATE()) ORDER BY monthlybudjet.Dates ");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['budjet_list'] = $result;
	
	$sth = $dbh->prepare("SELECT sum(monthlybudjet.Amount) from monthlybudjet left join category on monthlybudjet.CategoryId = category.CategoryId left join account on monthlybudjet.AccountId = account.AccountId where monthlybudjet.UserId = ".$_SESSION['userid']." AND MONTH(monthlybudjet.Dates) = MONTH (CURRENT_DATE()) ORDER BY monthlybudjet.Dates ");
	$sth->execute();

	/* Fetch all of the remaining rows in the result set */
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$data['budjet_total'] = $result[0]['sum(monthlybudjet.Amount)'];
}


header("Content-Type: application/json");
echo json_encode($data);
?>