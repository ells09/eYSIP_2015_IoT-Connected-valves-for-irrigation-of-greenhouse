<?php
include 'iotdb.php';
require(__DIR__ . '/spMQTT.class.php');
spMQTTDebug::Enable();
$q=$_GET["q"]; //q is the macid received
if($q!=0 and $q!=1 )
{
//echo "Hello World".$q;
mysql_select_db($dbname) or die(mysql_error());
$query="SELECT * FROM devices where"."(macid='$q')";
$results=mysql_query($query);
	if (mysql_num_rows($results) > 0) 
	{
		while($row = mysql_fetch_assoc($results))
		{
			$macid=$row['macid'];
			$action=$row['action'];
			if($action==0)//checking valve is off or not
			{
				command($macid,1);	//switch ON			
				echo "Switch OFF"; //update button status
				$query = "UPDATE devices SET action ='1', status='1' WHERE macid='$macid'"; //updating action status in device table and also chanign new device status
				//echo "</br>".$query;
				if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
					echo "UPDATE failed: $query<br/>".mysql_error()."<br/><br/>";
			}
			else
			{
				command($macid,0);	//Switch off
				echo "Switch ON";
				$query = "UPDATE devices SET action ='0' WHERE macid='$macid'"; //updating action status in device table 
				//echo "</br>".$query;
				if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
					echo "UPDATE failed: $query<br/>".mysql_error()."<br/><br/>";
			}
           	    	
		}
	}
	

}
else 
{
mysql_select_db($dbname) or die(mysql_error());

$query="SELECT * FROM devices";
$results=mysql_query($query);
	if (mysql_num_rows($results) > 0) 
	{
		while($row = mysql_fetch_assoc($results))
		{
				$macid=$row['macid'];
				
				command($macid,$q);	//switch 
							
				//echo "Switch OFF"; //update button status
				
			
           	    	
		}
	if($q==1)
		echo "Switch OFF";
	else 
		echo "Switch ON";
	$update="UPDATE devices SET action='$q'"; //this is for updating running status off devices

	//echo "</br>".$query;
	if(!mysql_query($update,mysql_connect($dbhost, $dbuser, $dbpass)))
	echo "UPDATE failed: $query<br/>".mysql_error()."<br/><br/>";
	}

}

function command($macid,$action) //for sending mqtt commands
{

$mqtt = new spMQTT('tcp://localhost:1883/');
$connected = $mqtt->connect();
if (!$connected) {
    die("<span class='error'> Mosca MQTT Server is Offline\n</span>");
}

$mqtt->ping();

$msg = str_repeat($action, 1);

//echo "</br>esp/valve/".$macid;
$mqtt->publish('esp/valve/'.$macid, $msg, 0, 1, 0, 1);
//echo "</br>Success";
}
?>

