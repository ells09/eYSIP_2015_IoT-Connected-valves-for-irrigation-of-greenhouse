
<?php
include 'iotdb.php';
$q=$_GET["q"]; //q is the group name received
$macid=$_GET['edit'];
$id=$_GET['id'];
$update=$_GET['update'];
$gid=$_GET['gid'];
if($q!=null)
{
	
	mysql_select_db($dbname) or die(mysql_error());
	$query="INSERT into groups VALUES(DEFAULT,'$q')";
	$results=mysql_query($query);

	if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
		echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
	else
		echo "</br><span class='success'><b>'$q' added</b></span></br>";
	

	$query="SELECT * FROM groups"; //displaying groups
	$results=mysql_query($query);
	if (mysql_num_rows($results) > 0) 
	{	$i=1;
		echo "</br></br><h2>Groups available</h2>";		
		while($row=mysql_fetch_assoc($results)) 
		{	//$id=$row['id'];
			$group=$row['name'];
		
		
			echo "<span style='color:#3B5998;font-weight:normal;'><b>".$i.".</b>&nbsp; &nbsp; <b>$group </b>&nbsp; &nbsp;<hr>";
			$i++;
		
		
		}
	}
	else
	{
		echo "</br><div class='notice'><b>No groups created yet.</b></div>";
	}
	

}
if($macid!=null)
{

echo "<span id='$macid' style='color:#3B5998;font-weight:normal;'>&nbsp;<b>Allot group</b> </br><b>&nbsp; &nbsp;</b><b>MAC id:</b> $macid &nbsp; &nbsp; ".groups()."<button id='$macid' type='button' onclick="."update('$macid')".">Update</button></span><hr>";

}

if($update!=null)
{
echo "hello";
//mysql_select_db($dbname) or die(mysql_error());
//$query="UPDATE devices SET group='$gid' WHERE macid='$update'"; //displaying groups
}

function groups()
{
$dbname='iot';
mysql_select_db($dbname) or die(mysql_error());
$query="SELECT * FROM groups"; //displaying groups
$results=mysql_query($query);
echo "<select id='groupadd'>";	
if (mysql_num_rows($results) > 0) 
	{
	while($row=mysql_fetch_assoc($results)) 
		{	//$id=$row['id'];
			$group=$row['name'];
			$id=$row['id'];
		
			echo "<option value='$id'>$group </option>";
			$i++;
		
		
		}
	}
else
	{
		echo "<option value=''>Create a group first </option>";
	}
echo "</select>";

}
?>

