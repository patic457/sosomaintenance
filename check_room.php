<?php include"db.php";  include"session.php"; include"func.php"; 

$floor_ = $_POST['floor_'];
$id_building_ = $_POST['id_building_'];
$check_room = $_POST['check_room'];

switch ($check_room) {
	case 'service_room':
		$result_room = mysql_query("SELECT * FROM room WHERE floor='$floor_' AND id_building='$id_building_'");		
		$num = mysql_num_rows($result_room);
		$r=0;
		print "<select  id=\"room\" name=\"room\"  >";
		print"<option value=\"0\">--กรุณาเลือก--</option>";
		while($r<$num){	
		$fetch_room  = mysql_fetch_array($result_room);
		?>
		<option value="<?php echo $fetch_room['id_room']; ?>"><?php echo $fetch_room['room']; ?></option><?
		$r++;
		}
	break;

break;
}

?>