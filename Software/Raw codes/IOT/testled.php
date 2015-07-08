<?php 
require(__DIR__ . '/spMQTT.class.php');
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1); //for suppressing errors and notices
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Led Test</title>
<?php include 'favicon.php';?>
</head>

<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" charset="utf-8" />
 <link rel="stylesheet" href="css/navigation.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print"> 
<link rel="stylesheet" href="css/zebra_datepicker.css" type="text/css">
<!--[if lt IE 8]>
  <link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection">
<![endif]-->
<script type='text/javascript' src='script/jquery-1.9.1.min.js'></script>
<script type='text/javascript' src='script/jquery-ui-1.7.2.custom.min.js'></script>
<script type='text/javascript' src='script/jquery.easing.1.3.js'></script>


<noscript>
Your browser doesnt support javascript</noscript>
<body >

<h2><?php echo " Simple Web based IOT"; ?></h2>

<div  id='container' class='wrapper container'>

    <div class=" span-12 append-4">
<?php 
echo"
<form action='#' method='post'>
<h2>Valve 1</h2>
<select name='item'>
<option value='ON'>ON</option>
<option value='OFF'>OFF</option>
</select>
<input type='submit' name='submit' value='Submit' />
</form>";
if(isset($_POST['submit'])){
$com = $_POST['item'];
$mqtt = new spMQTT('tcp://localhost:1883/');
spMQTTDebug::Enable();

$connected = $mqtt->connect();
if (!$connected) {
    die("Not connected\n");
}

$mqtt->ping();

$msg = str_repeat($com, 1);
$mqtt->publish('esp/valve', $msg, 0, 1, 0, 1);
echo 'Valve is '.$com;  // Displaying Selected Value
//$mqtt->close();
}

 ?>  

    </div>
   
    <div class="span-5">
         <?php include_once "navigation.php";?>
    </div>
		</div> <!-- end of container div -->
   
<div class="push"></div>

<div class='container footer'>
<?php //include_once "footer.php";?><?php
include_once "app.php";?></div>

</body>
</html>
