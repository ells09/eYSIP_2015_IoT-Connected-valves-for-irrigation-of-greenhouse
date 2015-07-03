<?php
//include 'iotdb.php';
require(__DIR__ . '/spMQTT.class.php');


$start_time = time(); //defining starting time
//ini_set('display_errors', 'Off'); //for suppressing errors and notices
//$start_time = time();
//echo $start_time;

$mqtt = new spMQTT('tcp://localhost:1883/');

spMQTTDebug::Enable();

//$mqtt->setAuth('sskaje', '123123');
$mqtt->setKeepalive(3600);
$connected = $mqtt->connect();
if (!$connected) {
    die("Not connected\n");
}


$topics['esp/valve'] = 1;

$mqtt->subscribe($topics);

#$mqtt->unsubscribe(array_keys($topics));

$mqtt->loop('default_subscribe_callback');



/**
 * @param spMQTT $mqtt
 * @param string $topic
 * @param string $message
 */
function default_subscribe_callback($mqtt, $topic, $message) {
    printf("Message received: Topic=%s, Message=%s\n</br>", $topic, $message);
	//entering msg into database
	$dbhost  = 'localhost';    
	$dbname  = 'iot'; 
	$dbuser  = 'root';    
	$dbpass  = 'jayant123';    

	mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
	mysql_select_db($dbname) or die(mysql_error());
	$query="INSERT INTO devices VALUES". "('$message',NULL,NULL)";
	if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
	echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
	//$mqtt->close(); //same with this line
	$mqtt->unsubscribe($topics); //adding this line helped in removing the infinite wait
	
}

function get_post($var)
	{
		return mysql_real_escape_string($_POST[$var]);
		}
