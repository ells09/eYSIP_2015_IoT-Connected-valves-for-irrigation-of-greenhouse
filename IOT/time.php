<?php 
include_once 'iotdb.php';?>
<?php
date_default_timezone_set('Asia/Kolkata');//setting IST
echo "Time is ".date('Hi');?>
<h2><?php echo " Entering schedules"; ?></h2>

<div  id='container' class='wrapper container'>

    <div class=" span-12 append-4">
<?php 
echo"
<form action='#' method='post'>
<h2>Valve 1</h2>
Start time:
<input type='text' id='start' name='start'/>
Stop time:
<input type='text' id='stop' name='stop'/>
<input type='submit' name='submit' value='Submit' />
</form>";
if(isset($_POST['submit']))
{

$start = $_POST['start'];
$stop = $_POST['stop'];
$com=125;
echo 'item\'s mac id is '.$com;  // Displaying Selected Value
//checking for duplicates macid i.e., already discovered devices, before entering
mysql_select_db($dbname) or die(mysql_error());

	$query="INSERT INTO tasks VALUES". "(DEFAULT,'$com','$start','$stop', '1')";
//if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
//	echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
	echo $query;
if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
	echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
else
	echo "</br>Device time schedule updated";//marked online
//mark the device online
mysql_close();
//$mqtt->close();

}

 ?>  

    </div>
