<?php
include 'iotdb.php';
require(__DIR__ . '/spMQTT.class.php');
date_default_timezone_set('Asia/Kolkata');//setting IST
spMQTTDebug::Enable();



mysql_select_db($dbname) or die(mysql_error());
	
$query="SELECT * FROM tasks";
//echo $query;

$results=mysql_query($query);

if (mysql_num_rows($results) > 0) 
{
	   echo "</br>Executing tasks</br>";

	   while($row = mysql_fetch_assoc($results)) 
		{	
			$id=$row['id'];
			$macid=$row['macid'];
			$start=$row['start'];
			$stop=$row['stop'];
			$action=$row['action'];
           	    	$currenttime=date('Hi');
			
			if($start!=NULL)
			{
				
				if($currenttime>=$start and $currenttime<$stop and $action==1)
				{
					
					command($macid,$action);
					$query = "UPDATE tasks SET action ='0' WHERE id='$id'";
					$action=0;//doing this because dont want to again fetch from table
					//setting start NUll so that it wont check
					echo "</br>".$query;
					if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
						echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
					else
						echo "</br>Task upadated to stop</br>";
					$query = "UPDATE devices SET action ='1' WHERE macid='$macid'"; //updating action status in device table also
					echo "</br>".$query;
					if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
						echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
					
					
				}
				
			}
			if($stop!=NULL)
			{
				if($currenttime==0000)
						$currenttime=2400; //2400 is same as 1200am or 0000
						
				
				if($currenttime>=$stop and $action==0)
				{
					command($macid,$action);
					//$query = "DELETE FROM tasks WHERE macid='$macid' and action='0'"; //deleting the final entry
					$query = "UPDATE tasks SET action ='1' WHERE id='$id'"; //resetting to 1 for next day execution
					echo $query;
					if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
						echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
					else
						echo "</br>Task upadated for next day</br>";
					$query = "UPDATE devices SET action ='0' WHERE macid='$macid'"; //updating action status in device table also
					echo "</br>".$query;
					if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
						echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
				}
				
			}
    		}
echo "Done executing";
}
else
{
echo "No scheduled tasks exist";
}

function command($macid,$action) //for sending mqtt commands
{
//$mqtt->setAuth('sskaje', '123123');
$mqtt = new spMQTT('tcp://localhost:1883/');
$connected = $mqtt->connect();
if (!$connected) {
    die(" Mosca MQTT Server is Offline\n");
}

$mqtt->ping();

$msg = str_repeat($action, 1);

//echo "</br>esp/valve/".$macid;
$mqtt->publish('esp/valve/'.$macid, $msg, 0, 1, 0, 1);
echo "</br>Success";
}




