<?php include_once 'iotdb.php';?>
<h2><?php echo " Checking for mac duplicates"; ?></h2>

<div  id='container' class='wrapper container'>

    <div class=" span-12 append-4">
<?php 
echo"
<form action='#' method='post'>
<h2>Valve 1</h2>
<input type='text' id='macid' name='macid'/>

<input type='submit' name='submit' value='Submit' />
</form>";
if(isset($_POST['submit'])){
$com = $_POST['macid'];
/*$mqtt = new spMQTT('tcp://192.168.43.177:1883/');
spMQTTDebug::Enable();

$connected = $mqtt->connect();
if (!$connected) {
    die("Not connected\n");
}*/

//$mqtt->ping();

///$msg = str_repeat($com, 1);
//$mqtt->publish('esp/valve', $msg, 0, 1, 0, 1);
echo 'item\'s mac id is '.$com;  // Displaying Selected Value
//checking for duplicates macid i.e., already discovered devices, before entering
$query="SELECT * FROM devices where"."(macid='$com')";
mysql_select_db($dbname) or die(mysql_error());
$results=mysql_query($query);
if (mysql_num_rows($results) > 0) 
{
  	echo "</br>Match found</br>";
	$query = "UPDATE devices SET status ='1' WHERE macid='$com'";
	echo $query;
if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
	echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
else
	echo "</br>Device status updated";//marked online
//mark the device online
}
else 
{
	echo "</br>Match not found</br>";
//inserting the new found device into the device folder
	$query="INSERT INTO devices VALUES". "('$com',2,NULL, DEFAULT)";
if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
	echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
else
	echo "New device added";
}
mysql_close();
//$mqtt->close();
}

 ?>  

    </div>
