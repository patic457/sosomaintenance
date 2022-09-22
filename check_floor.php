<?php include"db.php"; 
$b = $_POST['b'];
$check_fl = $_POST['check_fl'];

switch ($check_fl) {
	case 'add_fl':
		$result_fl = mysql_query("SELECT floor FROM building WHERE id_building='$b'");
		$fetch_fl  = mysql_fetch_array($result_fl);
		$floor_temp = $fetch_fl['floor'];
		$fl=1;
		print "ชั้น :<select  id=\"c\" name=\"c\"  >";
		print"<option value=\"0\">--กรุณาเลือก--</option>";
		while($fl<=$floor_temp){	
		?>
		<option id="c" value="<?php echo $fl; ?>"><?php echo $fl; ?></option><?
		$fl++;
		}
	break;
	
	case 'edit_fl':
		$result_fl = mysql_query("SELECT floor FROM building WHERE id_building='$b'");
		$fetch_fl  = mysql_fetch_array($result_fl);
		$floor_temp = $fetch_fl['floor'];
		$fl=1;
		print "ชั้น :<select  id=\"ce\" name=\"ce\"  >";
		print"<option selected value=\"0\">--กรุณาเลือก--</option>";
		while($fl<=$floor_temp){	
		?>
		<option value="<?php echo $fl; ?>"><?php echo $fl; ?></option><?
		$fl++;
		}
	break;
	
	case 'service_fl':
	
		?>
		<script language="javascript">
        $(function(){$("#floorr").change(function(){var floorr_=$("#floorr").attr("value");var check_room='service_room';var id_building_ = <?php echo $b ?>;
        $.post("check_room.php",{floor_: floorr_,check_room: check_room,id_building_:id_building_},function(data){$("#room_sel").html(data);});
        });
        });
        </script>
		<?
		$result_fl = mysql_query("SELECT floor FROM building WHERE id_building='$b'");
		$fetch_fl  = mysql_fetch_array($result_fl);
		$floor_temp = $fetch_fl['floor'];
		$fl=1;
		print "<select  id=\"floorr\" name=\"floorr\"  >";
		print"<option value=\"0\">--กรุณาเลือก--</option>";
		while($fl<=$floor_temp){	
		?>
		<option value="<?php echo $fl; ?>"><?php echo $fl; ?></option><?
		$fl++;
		}
	break;



break;
}
?> 
</select>
