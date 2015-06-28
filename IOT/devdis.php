<?php 
include_once 'iotdb.php';
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1); //for suppressing errors and notices
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Device Discovery</title>
<?php include 'favicon.php';?>
<script type='text/javascript'>
function showUser(str)
{

if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
  }
xmlhttp.onreadystatechange=function()
  {
	if (xmlhttp.readyState==3 && xmlhttp.status==200)
	  {
	  document.getElementById(str).innerHTML="Finding new devices ....";
	  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(str).innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open('GET','dd.php?q='+str,true);
xmlhttp.send();
}
</script>
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



<div  id='container' class='wrapper container'>
<div class=" span-12 append-4"><a STYLE='text-decoration:none'href='index.php'>
      <h1 style='color:#3B5998;font-weight:normal;'>IOT Based Valve control</h1></a>
    </div>
    <div class=" span-12 append-4">
<h2 style='color:#3B5998;font-weight:normal;'>Devices Added</h2>
<form action="">
<?php

mysql_select_db($dbname) or die(mysql_error());
	
$query="SELECT * FROM devices";
$results=mysql_query($query);
if (mysql_num_rows($results) > 0) 
{	$i=1;
	while($row=mysql_fetch_assoc($results)) 
	{	
		$macid=$row['macid'];
		$action=$row['action'];
		$battery=$row['battery'];
		$status=$row['status']; //online offline or new, 1, 0, 2
		if($battery==1) //changing into user readable form
			$battery="<span style='color: #00CC00;'><b>Healthy</b></span>";
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

		echo "<h3 style='color:#3B5998;font-weight:normal;'><b>Valve ".$i."</b> ".$status."</h3><b style='color:#3B5998;font-weight:normal;
    '>Device MAC ID</b> :<span style='color:#3B5998;font-weight:normal;
    '> ".$macid. "</span></br>".$action."</br> <b style='color:#3B5998;font-weight:normal;
    '>Battery status : </b> ".$battery." </br> <hr></span>";
		$i++;
		
		
	}
}
else
{
echo "<h3>No Devices added yet</h3>";
}
?>

</form> 


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
