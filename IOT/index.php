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
<title>Led Test</title>
<?php include 'favicon.php';?>
<script type='text/javascript'>
function update(str)
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
	  document.getElementById(str).innerHTML="Switching ....";
	  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(str).innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open('GET','com.php?q='+str,true);
xmlhttp.send();
}
</script>
<script type='text/javascript'>
function updateall(str)
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
	  var items = document.getElementsByClassName('item');
	  for (var i = 0; i < items.length; ++i) 
		{
    			var item = items[i];  
    			item.innerHTML = "Switching....";
    		}
	  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	var items = document.getElementsByClassName('item');
	for (var i = 0; i < items.length; ++i) 
		{
    			var item = items[i];  
    			item.innerHTML = xmlhttp.responseText;
    		}
	
   

    }
  }
xmlhttp.open('GET','com.php?q='+str,true);
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

<h2><?php echo " Simple Web based IOT"; ?></h2>

<div  id='container' class='wrapper container'>

    <div class=" span-12 append-4">
<h3>Valve Controls</h3>

<?php
echo " <button id='1' type='button' onclick='updateall(this.value)' value='1'>Switch all ON</button>";
	echo " <button id='0' type='button' onclick='updateall(this.value)' value='0'>Switch all OFF</button><hr>";
mysql_select_db($dbname) or die(mysql_error());
	
$query="SELECT * FROM devices";
$results=mysql_query($query);
if (mysql_num_rows($results) > 0) 
{	$i=1;
			
	while($row=mysql_fetch_assoc($results)) 
	{	
		$macid=$row['macid'];
		$action=$row['action'];
		$status=$row['status']; //online offline or new, 1, 0, 2
		if($action==1) //changing into user readable form
			$action='OFF';
		else
			$action='ON';
		
		if($status==0) //offline
			$status='<h4><b>Device offline, please check..</b></h4>';
		elseif($status==1) //online
			$status='<b>ONLINE</b>';
		elseif($status==2) //new device
			$status='<h4><b>New Device Found</b></h4>';

		echo "<b>Valve ".$i."</b>&nbsp; &nbsp; <button class='item' id='$macid' type='button' onclick='update(this.value)' value='$macid'>Switch ".$action."</button> &nbsp; &nbsp; ".$status."<hr>";
		$i++;
		
		
	}
}
else
{
echo "<h3>No Devices added yet</h3>";
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
