<?php
include 'iotdb.php';
require(__DIR__ . '/spMQTT.class.php');
spMQTTDebug::Enable();
$grp=$_GET["grp"]; //grp is the group id received
$bat=$_GET["bat"]; //bat  is group id received fro battery status
if($grp!=NULL)
{
	display($grp);
}
if($bat!=NULL)
{
	//
	mysql_select_db($dbname) or die(mysql_error());
	$query="SELECT * FROM devices WHERE devices.group='$bat'";

	$results=mysql_query($query);
	if (mysql_num_rows($results) > 0) 
	{
	
		while($row = mysql_fetch_assoc($results))
		{
			$macid=$row['macid'];
				
				command($macid,2);	//publish for getting bat status
							
				$query = "UPDATE devices SET battery ='3', status='1' WHERE macid='$macid'"; //updating battery status in device table and also changing new device status,, initially keeping status as offline and bat unavailable
				//echo "</br>".$query;
				if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
					echo "UPDATE failed: $query<br/>".mysql_error()."<br/><br/>";
				sleep(1);
				$query = "UPDATE devices SET battery ='2', status='0' WHERE macid='$macid'"; //updating battery status in device table and also changing new device status,, initially keeping status as offline and bat unavailable
				//echo "</br>".$query;
				if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
					echo "UPDATE failed: $query<br/>".mysql_error()."<br/><br/>";
				
			
			
           	    	
		}
	}
	

	display($bat);
}
function command($macid,$action) //for sending mqtt commands
	{
		//$mqtt->setAuth('sskaje', '123123');
		$mqtt = new spMQTT('tcp://localhost:1883/');
		$connected = $mqtt->connect();
		if (!$connected) 
			{
			    die(" <span class='error'>Mosca MQTT Server is Offline\n</span>");
			}

		$mqtt->ping();

		$msg = str_repeat($action, 1);

		//echo "</br>esp/valve/".$macid;
		$mqtt->publish('esp/valve/'.$macid, $msg, 0, 1, 0, 1);
		//echo "</br>Success";
	}

function display($grp)
{
	$dbname='iot';
	mysql_select_db($dbname) or die(mysql_error());
	echo "<button id='bat' type='button' onclick='checkbat(this.value)' value='$grp'>Check Battery status</button></br></br>";
	$query="SELECT * FROM devices WHERE devices.group=$grp";
	$results=mysql_query($query);
	if (mysql_num_rows($results) > 0) 
	{	$i=1;
		
		while($row=mysql_fetch_assoc($results)) 
		{	
			$macid=$row['macid'];
			$action=$row['action'];
			$battery=$row['battery'];
			$status=$row['status']; //online offline or new, 1, 0, 2
			$seen=$row['seen'];
			$grp=$row['group'];//group in which it belongs
			$query="SELECT name FROM groups WHERE id='$grp'";
			$grps=mysql_query($query);
			$rows=mysql_fetch_assoc($grps);
			$name=$rows['name'];
			if($battery==1) //changing into user readable form
				$battery="<span style='color: #00CC00;'><b>Healthy</b></span>";
			elseif($battery==2)
				$battery="<span style='color: #FF0000;'><b>Status unavailable</b></span>";
			elseif($battery==3)
				$battery="<span style='color: #0000FF;'><b>Checking status...</b></span>";
			else
				$battery="<span style='color: #FF0000;'><b>Replace battery</b></span>";
			
			if($action==1) //changing into user readable form
				$action="<b><span style='color: #FFAA00;'>Valve is Open</b></span>";
			else
				$action="<b><span style='color: #AA6600;'>Valve is Closed</span></b>";
		
			if($status==0) //offline
				$status="<b><span style='color: #FF0000;'>Device offline, please check..</span></b>";
			elseif($status==1) //online
				$status="<b><span style='color: #00CC00;'>ONLINE</span></b>";
			elseif($status==2) //new device
				$status="<span style='color: #0088FF;'><b>New Device Found</b></span>";

			echo "<h4 style='color:#3B5998;font-weight:normal;'><b>Valve ".$i."</b> ".$status."</h4><b style='color:#3B5998;font-weight:normal;'>Group: $name</b></br><b style='color:#3B5998;font-weight:normal;'>Device MAC ID</b> :<span style='color:#3B5998;font-weight:normal;'> ".$macid. "</span></br>".$action."</br> <b style='color:#3B5998;font-weight:normal;'>Battery status : </b> ".$battery." </br><b style='color:#3B5998;font-weight:normal;'>Last updated : </b>$seen <hr></span>";
			$i++;
		
		
		}
	}
	else
		{
			echo "<h3>No Devices added yet</h3>";
		}
	
}
?>

