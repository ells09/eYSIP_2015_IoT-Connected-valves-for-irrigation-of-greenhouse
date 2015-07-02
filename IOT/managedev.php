
<?php
include 'iotdb.php';
$q=$_GET["q"]; //q is the group name received
$macid=$_GET['edit'];
$id=$_GET['id'];
$update=$_GET['update'];
$gid=$_GET['gid'];
$del=$_GET['del'];
if($q!=null)
{
	
	mysql_select_db($dbname) or die(mysql_error());
	$query="SELECT * FROM groups where"."(name='$q')";
	$results=mysql_query($query);
	if (mysql_num_rows($results) > 0) 
	{
	echo "<span class='error'>Enter Unique group name</span>";
	}
	else
	{
		$query="INSERT into groups VALUES(DEFAULT,'$q')";
		
		if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
			echo "INSERT failed: $query".mysql_error()."<br/>";
		else
			echo "</br><span class='success'><b>'$q' added</b></span></br>";
		
	}	
	

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
	
	mysql_select_db($dbname) or die(mysql_error());
	$query="SELECT name FROM groups WHERE id='$gid'";
	$grps=mysql_query($query);
	$grp=mysql_fetch_assoc($grps);
	$name=$grp['name'];
	if($name=='')
		$name="<span style='color: #0088FF;'><b>New Device Found</b></span>";
	$query = "UPDATE devices SET devices.group = '$gid', devices.status='1' WHERE devices.macid = '$update'"; //updating item with group id
				
	if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
		echo "UPDATE failed: $query<br/>".mysql_error()."<br/><br/>";
	echo " <span id='$update' style='color:#3B5998;font-weight:normal;'><b></b><b>MAC id:</b> $update &nbsp; &nbsp;<b>Group:</b> $name&nbsp; &nbsp; <a href="."javascript:edit('$update')".">edit</a></span>";
	
	
}

if($del!=null)
{
	
	$query = "DELETE FROM groups WHERE name='$del'";

	if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
	echo "INSERT failed: $query<br/><div class='error'>".mysql_error()."</div><br/><br/>";
	$query="SELECT * FROM groups"; //displaying groups
	$results=mysql_query($query);
	if (mysql_num_rows($results) > 0) 
	{	$i=1;
		echo "</br></br><h2>Groups available</h2>";		
		while($row=mysql_fetch_assoc($results)) 
		{	//$id=$row['id'];
			$group=$row['name'];
		
		
			echo "<span style='color:#3B5998;font-weight:normal;'><b>".$i.".</b>&nbsp; &nbsp; <b>$group </b>&nbsp; &nbsp;<a href="."javascript:del('$group')".">delete</a><hr>";
			$i++;
		
		
		}
	}
	else
	{
		echo "</br><div class='notice'><b>No groups created yet.</b></div>";
	}
	
	
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

