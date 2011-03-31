<?php



include 'inc/sql-config.php';
include 'inc/sql-opendb.php';

// end an open new game

$query = "SELECT * FROM games ;";
$res = mysql_query($query,$conn);

while($row = mysql_fetch_array($res)){
		//$id = $row['id'];
		$gameid = $row['id'];
		$path = $row['path'];
		echo "was: " . $path . "<br/>";
		$path2 = str_replace("->","###", $path);
		$path3 = str_replace("[","", $path2);
		$path4 = str_replace("]","", $path3);
		echo "changed to: " . $path4 . "<br/>";
		mysql_query("UPDATE games SET path = '".$path4."' WHERE id = '".$gameid."'");
		echo "-------------------------------------------------------------------------------------------------------";

}


include 'inc/sql-closedb.php';

?>