<?php 
include_once 'iotdb.php';?>
<?php
date_default_timezone_set('Asia/Kolkata');//setting IST
//echo "Time is ".date('Hi');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Devices</title>
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
<script type='text/javascript'>
function add()
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
	  document.getElementById("groups").innerHTML="Adding...";
	  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("groups").innerHTML=xmlhttp.responseText;
    }
  }
var group = document.getElementById("group").value;
xmlhttp.open('GET','managedev.php?q='+group,true);
alert("Hello! I am an alert box!!");
xmlhttp.send();
}
</script>
<script type='text/javascript'>
function edit(macid)
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
	  document.getElementById(macid).innerHTML="loading...";
	  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(macid).innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open('GET','managedev.php?edit='+macid,true);
//alert(macid);
xmlhttp.send();
}
</script>
<noscript>
Your browser doesnt support javascript</noscript>
<body >


<div  id='container' class='wrapper container'>
<div class=" span-12 append-4"><a STYLE='text-decoration:none'href='index.php'>
      <h1 style='color:#3B5998;font-weight:normal;'>IOT Based Valve control</h1></a>
    </div>

    <div class=" span-12 append-4">
<h2 style='color:#3B5998;font-weight:normal;' >Manage</h2>
<pre>
<span style='color:#3B5998;font-weight:normal;'>Add Group :</span>
<input type='text' id='group' name='group'/>

<button id='button' type='button' onclick='add();' value='add'>Add</button>

</pre>
<div id='groups'>

<?php
mysql_select_db($dbname) or die(mysql_error());
$query="SELECT * FROM groups"; //displaying groups
$results=mysql_query($query);
if (mysql_num_rows($results) > 0) 
{	$i=1;
	echo "</br></br><h2>Groups available</h2>";		
	while($row=mysql_fetch_assoc($results)) 
	{	//$id=$row['id'];
		$group=$row['name'];
		
		
		echo "<span style='color:#3B5998;font-weight:normal;'><b>".$i.".</b>&nbsp; &nbsp; <b>$group </b>&nbsp; &nbsp;</span><hr>";
		$i++;
		
		
	}
}
else
{
	echo "</br><div class='notice'><b>No groups created yet.</b></div>";
}

 ?>  
</div>

<div id='items'>

<?php
mysql_select_db($dbname) or die(mysql_error());
$query="SELECT * FROM devices"; //displaying groups
$results=mysql_query($query);
if (mysql_num_rows($results) > 0) 
{	$i=1;
	echo "</br></br><h2>Items available</h2>";		
	while($row=mysql_fetch_assoc($results)) 
	{	$macid=$row['macid'];
		//$group=$row['name'];
		
		
		echo "<span id='$macid' style='color:#3B5998;font-weight:normal;'><b>".$i.".</b>&nbsp; &nbsp; <b>$macid </b>&nbsp; &nbsp; <a href="."javascript:edit('$macid')".">edit</a></span><hr>";
		$i++;
		
		
	}
}
else
{
	echo "</br><div class='notice'><b>No groups created yet.</b></div>";
}

 ?>  
</div>
     </div>
   
    <div class="span-5">
         <?php include_once "navigation.php";?>
    </div>
</div> <!-- end of container div -->
   
<div class="push"></div>

<div class='container footer'>
<?php //include_once "footer.php";?><?php
include_once "app.php";?></div>
<?php


?>
</body>
</html>
