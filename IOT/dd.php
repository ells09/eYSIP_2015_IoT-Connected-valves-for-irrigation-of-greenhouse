<?php
include 'iotdb.php';
require(__DIR__ . '/spMQTT.class.php');
spMQTTDebug::Enable();
$q=$_GET["q"]; //q is the macid received
if($q!=NULL)
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
				$query = "UPDATE devices SET action ='1' WHERE macid='$macid'"; //updating action status in device table 
				//echo "</br>".$query;
				if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
					echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
			}
			else
			{
				command($macid,0);	//Switch off
				echo "Switch ON";
				$query = "UPDATE devices SET action ='0' WHERE macid='$macid'"; //updating action status in device table 
				//echo "</br>".$query;
				if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
					echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
			}
           	    	
		}
	}
	

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
//echo "</br>Success";
}
?>

