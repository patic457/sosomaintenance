<?php include"db.php";
$check_status_1 = $_POST['check_status_1'];
$check_status_2 = $_POST['check_status_2'];

$check_status_11 = $_GET['check_status_11'];
$check_status_22 = $_GET['check_status_22'];

switch ($check_status_1) {
    case 'building':
	
				switch ($check_status_2) {
       				case 'add':
						if($_POST['building_']=="" || $_POST['floor_']==""){print"<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');exit();</script>";}
						else{
						$sql = "insert into building values('','$_POST[building_]','$_POST[floor_]')";
						print"<script>alert('บันทึกข้อมูลอาคารสำเร็จแล้ว');Location('index.php?m=7');</script>";
						$sqlquery = mysql_query($sql) or die("Error add");  
						}     
    				 break;
					 
					 case 'edit':
						if($_POST['building_']=="" || $_POST['floor_']==""){print"<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');exit();</script>";}
						else{
						$sql = "UPDATE building SET building='$_POST[building_]' , floor='$_POST[floor_]' WHERE id_building='$_POST[id_building_]'";
						print"<script>alert('แก้ไขข้อมูลอาคารสำเร็จแล้ว');Location('index.php?m=7');</script>";
						$sqlquery = mysql_query($sql) or die("Error edit");  
						}     
    				 break;
					 
					  case 'del':
					  $sql = "DELETE FROM building WHERE id_building='$_POST[id_building_]'";
					  $sqlquery = mysql_query($sql) or die("Error del");
					  print"<script>alert('ลบข้อมูลอาคารสำเร็จแล้ว');Location('index.php?m=7');</script>";
    				 break;
					  
					 }

    break;
	
	 case 'belong':
	
				switch ($check_status_2) {
       				case 'add':
						if($_POST['belong_']==""){print"<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');exit();</script>";}
						else{
						$sql = "insert into belong values('','$_POST[belong_]')";
						
						$sqlquery = mysql_query($sql) or die("Error add");  print"<script>alert('บันทึกข้อมูลสังกัดสำเร็จแล้ว');Location('index.php?m=8');</script>";
						}     
    				 break;
					 
					 case 'edit':
						if($_POST['belong_']==""){print"<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');exit();</script>";}
						else{
						$sql = "UPDATE belong SET belong='$_POST[belong_]' WHERE id_belong='$_POST[id_belong_]'";
						
						$sqlquery = mysql_query($sql) or die("Error edit");  print"<script>alert('แก้ไขข้อมูลสังกัดสำเร็จแล้ว');Location('index.php?m=8');</script>";
						}     
    				 break;
					 
					  case 'del':
					  $sql = "DELETE FROM belong WHERE id_belong='$_POST[id_belong_]'";
					  $sqlquery = mysql_query($sql) or die("Error del");
					  print"<script>alert('ลบข้อมูลสังกัดสำเร็จแล้ว');Location('index.php?m=8');</script>";
    				 break;	 
					 
					 }
	 
    break;
	
	case 'sector':
	
				switch ($check_status_2) {
   
					 case 'add':
				
						$sql = "insert into sector values('','$_POST[sector_]','$_POST[id_belong_]','$_POST[id_building_]')";
						
						$sqlquery = mysql_query($sql) or die("Error add");print"<script>alert('บันทึกข้อมูลหน่วยงานสำเร็จแล้ว');Location('index.php?m=9');</script>";  
						    
    				 break;
					 
					 case 'edit':
						
						$sql = "UPDATE sector SET sector='$_POST[sector_]',id_belong='$_POST[id_belong_]',id_building='$_POST[id_building_]' WHERE id_sector='$_POST[id_sector_]'"; 
						
						$sqlquery = mysql_query($sql) or die("Error edit");print"<script>alert('แก้ไขข้อมูลหน่วยงานสำเร็จแล้ว');Location('index.php?m=9');</script>";  

						     
    				 break;

					  case 'del':
					  $sql = "DELETE FROM sector WHERE id_sector='$_POST[id_sector_]'";
					  
					  print"<script>alert('ลบข้อมูลหน่วยงานสำเร็จแล้ว');Location('index.php?m=9');</script>";$sqlquery = mysql_query($sql) or die("Error del");
					  
    				 break;	 
					 
					 }
	 
    break;
	
	case 'problem':
	
				switch ($check_status_2) {
       				case 'add':
						if($_POST['problem_']==""){print"<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');exit();</script>";}
						else{
						$sql = "insert into type_problem values('','$_POST[problem_]')";
						
						$sqlquery = mysql_query($sql) or die("Error add");  print"<script>alert('บันทึกข้อมูลประเภทที่แจ้งสำเร็จแล้ว');Location('index.php?m=11');</script>";
						}     
    				 break;
					 
					  case 'edit':
						if($_POST['problem_']==""&&$_POST['id_problem_']==""){print"<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');exit();</script>";}
						else{
						$sql = "UPDATE type_problem SET problem='$_POST[problem_]' WHERE id_problem='$_POST[id_problem_]'";
						
						$sqlquery = mysql_query($sql) or die("Error edit");  print"<script>alert('แก้ไขข้อมูลหน่วยงานสำเร็จแล้ว');Location('index.php?m=11');</script>";
						}     
    				 break;
					 
					  case 'del':
					  $sql = "DELETE FROM type_problem WHERE id_problem='$_POST[id_problem_]'";
					  $sqlquery = mysql_query($sql) or die("Error del");
					  print"<script>alert('ลบข้อมูลประเภทที่แจ้งสำเร็จแล้ว');Location('index.php?m=11');</script>";
    				 break;	 
					 
					 }
	 
    break;
	
	case 'room':
	
				switch ($check_status_2) {
       				case 'add':
						
						$sql = "insert into room values('','$_POST[room_]','$_POST[id_building_]','$_POST[floor_]','$_POST[id_sector_]')";
						$sqlquery = mysql_query($sql) or die("Error add");  print"<script>alert('บันทึกข้อมูลห้องสำเร็จแล้ว');Location('index.php?m=10');</script>";
						    
    				 break;
					 
					  case 'edit':

						$result_fl = mysql_query("SELECT floor FROM room WHERE id_room='$_POST[id_room_]'");
						$fetch_fl  = mysqli_fetch_array($result_fl);
						$floor_temp = $fetch_fl['floor'];
						
						if(empty($_POST['floor_'])==true){$fl = $floor_temp;}else{$fl = $_POST['floor_'];}
						$sql = "UPDATE room SET room='$_POST[room_]',id_sector='$_POST[id_sector_]',floor='$fl',id_building='$_POST[id_building_]' 
								WHERE id_room='$_POST[id_room_]'";
						
						$sqlquery = mysql_query($sql) or die("Error edit");  print"<script>alert('แก้ไขข้อมูลห้องสำเร็จแล้ว');Location('index.php?m=10');</script>";
						  
    				 break;
					 
					  case 'del':
					  $sql = "DELETE FROM room WHERE id_room='$_POST[id_room_]'";
					  $sqlquery = mysql_query($sql) or die("Error del");
					  print"<script>alert('ลบข้อมูลห้องสำเร็จแล้ว');Location('index.php?m=10');</script>";
    				 break;	 
					 
					 }
	 
    break;
	
	case 'prename':
	
				switch ($check_status_2) {
       				case 'add':
						
						$sql = "insert into prename values('','$_POST[prename_]')";
						
						$sqlquery = mysql_query($sql) or die("Error add");  print"<script>alert('บันทึกข้อมูลคำนำหน้าสำเร็จแล้ว');Location('index.php?m=13');</script>";
						    
    				 break;
					 
					  case 'edit':
						
						$sql = "UPDATE prename SET prename='$_POST[prename_]' WHERE id_prename='$_POST[id_prename_]'";
						
						$sqlquery = mysql_query($sql) or die("Error edit");  print"<script>alert('แก้ไขข้อมูลหน่วยงานสำเร็จแล้ว');Location('index.php?m=13');</script>";
						  
    				 break;
					 
					  case 'del':
					  $sql = "DELETE FROM prename WHERE id_prename='$_POST[id_prename_]'";
					  $sqlquery = mysql_query($sql) or die("Error del");
					  print"<script>alert('ลบข้อมูลคำนำหน้าสำเร็จแล้ว');Location('index.php?m=13');</script>";
    				 break;	 
					 
					 }
	 
    break;

	case 'technician':
	
				switch ($check_status_2) {
       				case 'add':
						
						$sql = "insert into technician values('','$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]')";
						
						$sqlquery = mysql_query($sql) or die("Error add");  print"<script>alert('บันทึกข้อมูลช่างเทคนิคสำเร็จแล้ว');Location('index.php?m=12');</script>";
							//print"<script>alert(\"$_POST[a]$_POST[b]$_POST[c]$_POST[d]$_POST[e]$_POST[f]\");</script";
						    
    				 break;
					 
					  case 'edit':
						
						$sql = "UPDATE technician SET prename='$_POST[a_]' , name='$_POST[b_]' , lastname='$_POST[c_]' , job='$_POST[d_]' , id_problem='$_POST[e_]' , 
								type = '$_POST[f_]' WHERE id_technician='$_POST[id_technician_]'";
						print"<script>alert('แก้ไขข้อมูลช่างเทคนิคสำเร็จแล้ว');Location('index.php?m=12');</script>";
						$sqlquery = mysql_query($sql) or die("Error edit");  
						  
    				 break;
					 
					  case 'del':
					  $sql = "DELETE FROM technician WHERE id_technician='$_POST[id_technician_]'";
					  $sqlquery = mysql_query($sql) or die("Error del");
					  print"<script>alert('ลบข้อมูลช่างเทคนิคสำเร็จแล้ว');Location('index.php?m=12');</script>";
    				 break;	 
					 
					 }
	 
    break;
		
	
}

	


?>