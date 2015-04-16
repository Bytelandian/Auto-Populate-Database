<html>
<head>
<title>
Auto Populate Database
</title>
</head>

<body>

<?php
include('config.php');
include('data.php');

function getvalue($a)
{
	global $names;
	global $id;
	global $phone;
	global $year;
	global $gender;
	global $address;
	global $email;
	global $date;
	global $small;
	global $date_time;
	global $text;
	global $food;
	global $iit;

	if ($a==='id')
		return  $id[array_rand($id)];
	if ($a==='SmallNumbericalValues')
		return  $small[array_rand($small)];
	else if ($a==='year')
		return  $year[array_rand($year)];
	else if ($a==='phone')
		return $phone[array_rand($phone)];
	else if ($a==='date')
		return "\"".$date[array_rand($date)]."\"";
	else if ($a==='DateTime')
		return "\"".$date_time[array_rand($date_time)]."\"";
	else if ($a==='names')
		return "\"".$names[array_rand($names)]."\"";
	else if ($a==='gender')
		return "\"".$gender[array_rand($gender)]."\"";
	else if ($a==='address')
		return "\"".$address[array_rand($address)]."\"";
	else if ($a==='email')
		return "\"".$email[array_rand($email)]."\"";
	else if ($a==='RandomText')
		return "\"".$text[array_rand($text)]."\"";
	else if ($a==='iit')
		return "\"".$iit[array_rand($iit)]."\"";
	else if ($a==='food')
		return "\"".$food[array_rand($food)]."\"";

}

$con=mysqli_connect($host,$user,$password,$dbname) or die(mysqli_error($con));

if (isset($_GET['table']))
{
	$y=0;
	while ($y<10)
	{
		$table=$_GET['table'];
		$result = mysqli_query($con, "SELECT column_name,column_type FROM information_schema.columns where table_name='".$_GET['table']."' order by ordinal_position") or die ("Error  = ".mysqli_error($con));

		$count=0;
		$attr=array();
		$s="";
		$value="";
		while ($row = mysqli_fetch_assoc($result)) 
		{
			$attr[$count]=$row['column_name'];
			if ($_GET[$row['column_name']]==="default")
			{
				$fault="LOL";
			}
			else
			{
				if ($s=="")
				{
					$s=$row['column_name'];
					$value=getvalue($_GET[$row['column_name']]);
				}
				else
				{
					$s=$s.",".$row['column_name'];
					$value=$value.",".getvalue($_GET[$row['column_name']]);	
				}
			}
			$count+=1;
		}
		echo "INSERT into $table($s) VALUES($value)";
		$result = mysqli_query($con, "INSERT into `$table`($s) VALUES($value)") or die ("Error  = ".mysqli_error($con));
		$y+=1;
	}
}

?>

</body>

</html>