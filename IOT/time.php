<?php 
include_once 'iotdb.php';?>
<?php
date_default_timezone_set('Asia/Kolkata');//setting IST
//echo "Time is ".date('Hi');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Schedule</title>
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
$(document).ready(function () {
  $('.time').hide();
  $('#period').show();
  $('#time').change(function () {
    $('.time').hide();
    $('#'+$(this).val()).show();
  })
});
</script>
<noscript>
Your browser doesnt support javascript</noscript>
<body >


<div  id='container' class='wrapper container'>
<div class=" span-12 append-4"><a STYLE='text-decoration:none'href='index.php'>
      <h1 style='color:#3B5998;font-weight:normal;'>IOT Based Valve control</h1></a>
    </div>

    <div class=" span-12 append-4">
<h2 style='color:#3B5998;font-weight:normal;' >Add Schedule</h2>
<select id="time">
  <option value="period">Period</option>
  <option value="duration">Duration</option>
  <option value="option3">-</option>
  <option value="option4">--</option>
</select>
<div id='period' class="time">
<pre>
<form action='' method='post'>

<span style='color:#3B5998;font-weight:normal;
    '>Start time:(hhmm)</span>
<input type='text' id='start' name='start'/>
<span style='color:#3B5998;font-weight:normal;
    '>Stop time:(hhmm)</span>
<input type='text' id='stop' name='stop'/>
<input type='submit' name='submit' value='Submit' /></pre>
</form>
</div>
<div id='duration' class="time">
<pre>
<form action='' method='post'>

<span style='color:#3B5998;font-weight:normal;
    '>Start time:(hhmm)</span>
<input type='text' id='start' name='start'/>
<span style='color:#3B5998;font-weight:normal;
    '>Duration:(mm)</span>
<input type='text' id='duration' name='duration'/>
<input type='submit' name='submit' value='Submit' /></pre>
</form>
</pre>
</div>
<div>
</div>
<?php
mysql_select_db($dbname) or die(mysql_error());
if(isset($_POST['submit']))
{

$start = $_POST['start'];
$stop = $_POST['stop'];
$duration =$_POST['duration'];
if($stop==NULL)
{
	$stop=$start+$duration;
}


	$query="INSERT INTO tasks VALUES". "(DEFAULT,'$start','$stop', '1')";
//if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
//	echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
	//echo $query;
if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
	echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
else
	echo "</br><span class='success'><b>New Time schedule added</b></span>";//marked online
//mark the device online
//mysql_close();
//$mqtt->close();

}


if(isset($_GET['del'])) //deleting the entry
{

	$del = $_GET['del'];

	$query = "DELETE FROM tasks WHERE id='$del'";

	if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
	echo "INSERT failed: $query<br/><div class='error'>".mysql_error()."</div><br/><br/>";

}


$query="SELECT * FROM tasks"; //displaying scheduled tasks
$results=mysql_query($query);
if (mysql_num_rows($results) > 0) 
{	$i=1;
	echo "</br></br><h2>Scheduled Tasks</h2>";		
	while($row=mysql_fetch_assoc($results)) 
	{	$id=$row['id'];
		$start=$row['start'];
		$stop=$row['stop']; //online offline or new, 1, 0, 2
		
		echo "<span style='color:#3B5998;font-weight:normal;'><b>Task ".$i."</b>&nbsp; &nbsp; Start time : $start &nbsp; &nbsp; Stop time : $stop </span>&nbsp;<a href='?del=$id'><b>DELETE</b></a><hr>";
		$i++;
		
		
	}
}
else
{
	echo "</br><div class='notice'><b>No Tasks scheduled yet.</b></div>";
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
