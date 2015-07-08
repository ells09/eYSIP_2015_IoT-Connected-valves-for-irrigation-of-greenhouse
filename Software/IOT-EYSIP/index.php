<?php 
/*
*Project: eYSIP_2015_IoT-Connected-valves-for-irrigation-of-greenhouse
*Team members: Jayant Solanki, Kevin D'Souza
*File name: index.php
*Author: Jayant Solanki
*This is the homepage of the website, which will basically show the maunal control options
*for different sensors
*/
include_once 'iotdb.php'; //importing database config file.
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1); //for suppressing errors and notices
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Homepage</title>
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
/*
 *
 * Function Name: showgrp(grp)
 * Input: grp, stores group id
 * Output: returns the sensors under the group id
 * Logic: It is a AJAX call
 * Example Call: showgrp(34)
 *
 */
function showgrp(grp)
{
if (grp=='')
  {
  document.getElementById('controls').innerHTML='';
  return;
  } 
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
	  document.getElementById('controls').innerHTML="<span class='push-5'><img src='images/ajax.gif'/></span>";
	  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('controls').innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open('GET','control.php?grp='+grp,true);
//alert(grp);
xmlhttp.send();
}
</script>
<script type='text/javascript'>
/*
 *
 * Function Name: update(str)
 * Input: str, stores group id, duration, stores the time in minutes
 * Output: send ON/OFF signal to the esp
 * Logic: It is a AJAX call
 * Example Call: update(12-14-AA-54-76-BB)
 *
 */
function update(str)
{
var duration=document.getElementById('duration').value;
//alert(duration);
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
xmlhttp.open('GET','com.php?q='+str+'&duration='+duration,true);
xmlhttp.send();
}
</script>
<script type='text/javascript'>
/*
 *
 * Function Name: updateall(str)
 * Input: str, stores 0/1, duration, stores the time in minutes, gid, stores group id
 * Output: send ON/OFF signal to all esp of one group
 * Logic: It is a AJAX call
 * Example Call: updateall(1)
 *
 */
function updateall(str)
{
var gid=document.getElementById('groups').value;
var duration=document.getElementById('duration').value;

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
xmlhttp.open('GET','com.php?q='+str+'&gid='+gid+'&duration='+duration,true);
xmlhttp.send();
}
</script>

<noscript>
Your browser doesnt support javascript</noscript>
</head>

<body >
<div  id='container' class='wrapper container'>
<div class=" span-12 append-4" ><a STYLE='text-decoration:none'href='index.php'>
      <h1 style='color:#3B5998;font-weight:normal;
    '>IOT Based Valve control</h1></a>
    </div>
    <div class=" span-12 append-4">
<h2 style='color:#3B5998;font-weight:normal;
    '>Valve Controls</h2>
Select group <select name='groups' id='groups' onchange='showgrp(this.value)'>
<option selected="true" disabled='disabled'>Choose</option>
<?php 
mysql_select_db($dbname) or die(mysql_error()); //connecting to database
$query="SELECT * FROM groups"; //displaying groups
$results=mysql_query($query);
if (mysql_num_rows($results) > 0) 
	{		
		while($row=mysql_fetch_assoc($results)) 
		{	//$id=$row['id'];
			$group=$row['name'];
			$id=$row['id'];
			echo " <option value='$id'>$group</option>"; //showing options for selecting a group
		}
	}
?>
</select>&nbsp; &nbsp;</br></br>
<div id='controls'>

</div>


    </div>

    <div class="span-5">
         <?php include_once "navigation.php"; //including a navigation menu ?> 
    </div>
</div> <!-- end of container div -->
   
<div class="push"></div>

<div class='container footer'>
<?php //include_once "footer.php";?><?php
include_once "app.php";?></div>

</body>
</html>
