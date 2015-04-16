<html>
<head>
<title>
Auto Populate Database
</title>
</head>

<body>
<h1 style='color:#00688B;'> Please select the relation </h1>

<form action="index.php" method="get">

<?php
include('config.php');
include('data.php');

$con=mysqli_connect($host,$user,$password,$dbname) or die(mysqli_error($con));

$result = mysqli_query($con, "SELECT table_name FROM information_schema.tables where table_schema='".$dbname."'") or die ("Error  = ".mysqli_error($con));
echo "<SELECT name='table'>  ";
while ($row = mysqli_fetch_assoc($result)) {
	$t=$row['table_name'];
	echo "<option value=$t>".$t."</option>";
}
?>
<input type="submit" value="Submit">
</form>
<br>

<?php
echo "<br>";
if (isset($_GET['table']))
{
	echo "<form action='fill.php' method='get'>";
	echo "<table>";
	$result = mysqli_query($con, "SELECT column_name,column_type FROM information_schema.columns where table_name='".$_GET['table']."' order by ordinal_position") or die ("Error  = ".mysqli_error($con));
	while ($row = mysqli_fetch_assoc($result)) 
	{
		$t=$row['column_name'];
		echo "<tr>";
		echo "<td>";
		echo $t;
		echo "</td>";
		echo "<td>";
		echo "<SELECT name=$t>  ";

		foreach($data as $value) 
		{
			echo "<option value=$value>"."$value"."</option>";
		}

		echo "</select>";
		echo "</td>";
		echo "</tr>";

	}

	echo "</table>";
	echo "<input name='table' value='".$_GET['table']."' hidden>";
	echo "<input type='submit' value='Submit'>";
}

?>

</body>

</html>