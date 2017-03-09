<?php

session_start();
//Include Database

include('../dbconfig.php');


// Get User Info
	
// fetch data to calender
$query 				   = "select * from bills where UserId = ".$_SESSION['userid'] ;
$assetstocalender      = mysql_query($query);
$events = array();
$sum = 0;
while ($row = mysql_fetch_assoc($assetstocalender)) {
    $start = $row['Dates'];
    $end   = $row['Dates'];
    $amount = 'Rs  '.$row['Amount'];
    $title = $row['Title'];
    $sum+= $row['Amount'];
    
    $eventsArray['title'] = $title;
    $eventsArray['start'] = $start;
    $eventsArray['end'] = $end;
    $eventsArray['names'] = $amount;
    $events[] = $eventsArray;
}
$eventsArray['sum'] = $sum;
echo json_encode($events);	
//echo $sum;	
	
?>
