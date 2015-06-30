<?php
include_once 'iotdb.php';
mysql_select_db($dbname) or die(mysql_error());
//echo "Hello".$_GET['stoph'];
if(isset($_GET['grp']))
{
	
	$grp=$_GET['grp'];
	$starth = $_GET['starth'];
	$startm = $_GET['startm'];
	$stoph = $_GET['stoph'];
	$stopm = $_GET['stopm'];
	$frequency =$_GET['frequency'];
	$duration =$_GET['duration'];
	$repeath=$_GET['repeath'];
	
	if($starth==24) //normalising time,, 24 is same as 00,, in 2400 and 0000
		$starth=0;
	if($stoph==24)
		$stoph=0;
	$start=$starth*100+$startm;
	$stop=$stoph*100+$stopm;
	

	if($duration!=NULL and $repeath==NULL)
	{
		$stop=$starth*100 + normalize($startm,$duration);

		if($stop>2400)
			$stop=$stop-2400;
	}

	if($repeath!=NULL)
	{	$i=$start;
		
		while($i<=2400)
		{	
			$query="SELECT name FROM groups WHERE id='$grp'";
			$grps=mysql_query($query);
			$grp=mysql_fetch_assoc($grps);
			$name=$grp['name'];
			$start=$i;
			$stop=$start+$duration;
			if($stop>2400)
				break;
			if($stop==2400)
				$stop=0;
			$query="INSERT INTO tasks VALUES". "(DEFAULT,'$name','$start','$stop', '1')";
			//if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))		
			//	echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
			//echo $query;
			if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
				echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
			
				
			
			$i=$i+$repeath*100;		
		}
		echo "</br></br><span class='success'><b>New Time schedule added</b></span>";	
	}
		if($repeath==NULL)
			if($start==$stop)
			{
				echo"<span class='error'>Start time and stop time cannot be same</span>";	
			}
			else
			{
				$query="SELECT name FROM groups WHERE id='$grp'";
				$grps=mysql_query($query);
				$grp=mysql_fetch_assoc($grps);
				$name=$grp['name'];
				$query="INSERT INTO tasks VALUES". "(DEFAULT,'$name','$start','$stop', '1')";
			//if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))		
			//	echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
			//echo $query;
				if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
					echo "INSERT failed: $query<br/>".mysql_error()."<br/><br/>";
				else
					echo "</br></br><span class='success'><b>New Time schedule added</b></span>";
			}
		
}


if(isset($_GET['del'])) //deleting the entry
{

	$del = $_GET['del'];

	$query = "DELETE FROM tasks WHERE id='$del'";

	if(!mysql_query($query,mysql_connect($dbhost, $dbuser, $dbpass)))
	echo "INSERT failed: $query<br/><div class='error'>".mysql_error()."</div><br/><br/>";

}


display();

 ?>  
<?php
function normalize($startm,$duration)
{
	$tot=$startm+$duration;
	if ($tot>=60)
		{
			$tot=$tot-60;
			$tot=100+$tot;
			return $tot;
		}
	return $tot;


}



function display()
{
	$dbname='iot';
	mysql_select_db($dbname) or die(mysql_error());
	$query="SELECT * FROM tasks"; //displaying scheduled tasks
	$results=mysql_query($query);
	if (mysql_num_rows($results) > 0) 
	{	$i=1;
		echo "</br></br><h2>Scheduled Tasks</h2>";		
		while($row=mysql_fetch_assoc($results)) 
		{	$id=$row['id'];
			$start=$row['start'];
			$stop=$row['stop']; //online offline or new, 1, 0, 2
			$item=$row['item'];
			
			
			echo "<span style='color:#3B5998;font-weight:normal;'><b>Task ".$i."</b>&nbsp; &nbsp;<b>Item:</b> $item&nbsp; &nbsp; Start time : $start &nbsp; &nbsp; Stop time : $stop </span>&nbsp;<a href='javascript:del($id)'><b>DELETE</b></a><hr>";
			$i++;
		
		
		}
	}
	else
	{
		echo "</br><div class='notice'><b>No Tasks scheduled yet.</b></div>";
	}

}
?>
