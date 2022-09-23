<?php
include("db.php");
include("session.php");
include("func.php"); ?>
<script language="javascript">
	/*$(function(){$("#b").change(function(){var b_=$("#b").attr("value");var check_fl='service_fl';
$.post("check_floor.php",{b: b_,check_fl: check_fl},function(data){$("#floor_sel").html(data);});
});
});

$(function(){$("#bt").click(function(){
								var p=$("#p").attr("value");var b=$("#b").attr("value");var floor_=$("#floorr").attr("value");
								var room=$("#room").attr("value");var d=$("#d").attr("value");var l=$("#l").attr("value");
										if(p=='' || b=='0' || floor_=='0' || room=='0' || d==''){alert('กรุณากรอกข้อมูลให้ครบถ้วน');}else{
											$.post("check_form.php",{p: p,b: b,f: floor_,r: room,d: d},function(data){$("#msg_").html(data);});
										}
								});
});*/

	// function checkStatus(id_, step, s, comment, data) {
	// 	var check_status = false;
	// 	if (s == 'n') {
	// 		if (comment == '') {
	// 			alert('กรุณากรอกเหตุผล');
	// 		}
	// 	} else if (s == 'y') {
	// 		var comment = '';
	// 		check_status = true;
	// 	}

	// 	if (check_status == true) {
	// 		$.post("check_status.php", {
	// 			s: s,
	// 			comment: comment,
	// 			id: id_,
	// 			step: step
	// 		}, function(data) {
	// 			$("#msg_").html(data);
	// 		});
	// 	}
	// }

	$(function() {
		$("#s_yes").click(
			function() {
				$("#comment-div").hide();
			});
	});
	$(function() {
		$("#s_no").click(
			function() {
				$("#comment-div").show();
			});
	});
	$(function() {
		$("#bt").click(function() {
			var comment = $("#comment").attr("value");
			var s = $("input[name='s']:checked").val();
			var id_ = "<?php echo $_GET['id_list']; ?>";
			var step = '1';
			//
			var check_status = false;
			if (s == 'n') {
				if (comment == '') {
					alert('กรุณากรอกเหตุผล');
				}
			} else if (s == 'y') {
				var comment = '';
				check_status = true;
			}

			if (check_status == true) {
				alert(check_status);
				$.post("check_status.php", {
					s: s,
					comment: comment,
					id: id_,
					step: step
				}, function(data) {
					$("#msg_").html(data);
				});
			}
			//
		});
	});

	$(function() {
		$("#bt_t").click(function() {
			var t_a = $("#tech_a").attr("value");
			var t_b = $("#tech_b").attr("value");
			var id_ = "<?php echo $_GET['id_list']; ?>";
			var step = '2';
			if (t_a == '0') {
				alert('กรุณาเลือกช่างเทคนิค');
			} else {
				$.post("check_status.php", {
					tech_a: t_a,
					tech_b: t_b,
					id: id_,
					step: step
				}, function(data) {
					$("#msg_").html(data);
				});
			}
		});
	});

	$(function() {
		$("#y").click(
			function() {
				$("#comment-div").hide();
			});
	});
	$(function() {
		$("#n").click(
			function() {
				$("#comment-div").show();
			});
	});
	$(function() {
		$("#bt3").click(function() {
			var comment = $("#comment").attr("value");
			var s = $("input[name='s3']:checked").val();
			var id_ = "<?php echo $_GET['id_list']; ?>";
			var step = '3';
			//
			var check_status = false;
			if (s == 'n') {
				if (comment == '') {
					alert('กรุณากรอกเหตุผล');
				}
			} else if (s == 'y') {
				var comment = '';
				check_status = true;
			}

			if (check_status == true) {
				$.post("check_status.php", {
					s: s,
					comment: comment,
					id: id_,
					step: step
				}, function(data) {
					$("#msg_").html(data);
				});
			}
			//

			// if (s == 'n') {
			// 	if (comment == '') {
			// 		alert('กรุณากรอกเหตุผล');
			// 		exit(0);
			// 	}
			// }

			// $.post("check_status.php", {
			// 	s: s,
			// 	comment: comment,
			// 	id: id_,
			// 	step: step
			// }, function(data) {
			// 	$("#msg_").html(data);
			// });





		});
	});
</script>
<link href="style_adminn.css" rel="stylesheet" type="text/css" />


<center>
	<?
	$result_list = $mysqli->query("SELECT * FROM list_service WHERE id_list='$_GET[id_list]'");
	$fetch_list  = mysqli_fetch_array($result_list);

	$ddate = date("Y/m/d");

	$result_username = $mysqli->query("SELECT * FROM user WHERE username='$fetch_list[username]'");
	$fetch_username  = mysqli_fetch_array($result_username);

	$result_prename = $mysqli->query("SELECT * FROM prename WHERE id_prename='$fetch_username[id_prename]'");
	$fetch_prename  = mysqli_fetch_array($result_prename);
	$prename_title  = $fetch_prename['prename'];

	$result_sector = $mysqli->query("SELECT * FROM sector WHERE id_sector='$fetch_username[id_sector]'");
	$fetch_sector  = mysqli_fetch_array($result_sector);

	$result_belong = $mysqli->query("SELECT * FROM belong WHERE id_belong='$fetch_sector[id_belong]'");
	$fetch_belong  = mysqli_fetch_array($result_belong);

	$result_problem_list = $mysqli->query("SELECT * FROM type_problem WHERE id_problem='$fetch_list[id_problem]'");
	$fetch_problem_list  = mysqli_fetch_array($result_problem_list);

	$result_building_list = $mysqli->query("SELECT * FROM building WHERE id_building='$fetch_list[id_building]'");
	$fetch_building_list  = mysqli_fetch_array($result_building_list);

	$result_room_list = $mysqli->query("SELECT * FROM room WHERE id_room='$fetch_list[id_room]'");
	$fetch_room_list  = mysqli_fetch_array($result_room_list);

	$result_tech_a_list = $mysqli->query("SELECT * FROM user WHERE username='$fetch_list[id_technician_a]'");
	$fetch_tech_a_list  = mysqli_fetch_array($result_tech_a_list);

	$result_tech_a_pre_list = $mysqli->query("SELECT * FROM prename WHERE id_prename='$fetch_tech_a_list[id_prename]'");
	$fetch_tech_a_pre_list  = mysqli_fetch_array($result_tech_a_pre_list);
	$fetch_tech_a_prename_title  = $fetch_tech_a_pre_list['prename'];

	$result_tech_b_list = $mysqli->query("SELECT * FROM user WHERE username='$fetch_list[id_technician_b]'");
	$fetch_tech_b_list  = mysqli_fetch_array($result_tech_b_list);

	$result_tech_b_pre_list = $mysqli->query("SELECT * FROM prename WHERE id_prename='$fetch_tech_b_list[id_prename]'");
	$fetch_tech_b_pre_list  = mysqli_fetch_array($result_tech_b_pre_list);
	$fetch_tech_b_prename_title  = $fetch_tech_b_pre_list['prename'];

	function technician_a_sel($mysqli)
	{
		$result_t_sel = $mysqli->query("SELECT * FROM user WHERE user_status='9'");
		$num_t_sel = mysqli_num_rows($result_t_sel);
		$te = 0;
		echo "<select id='tech_a' name='tech_a'>";
		echo "<option value=\"0\">--ช่างเทคนิค--</option>";
		while ($te < $num_t_sel) {

			$fetch_t_sel  = mysqli_fetch_array($result_t_sel);
			echo "<option value=\"$fetch_t_sel[username]\">$fetch_t_sel[name] $fetch_t_sel[lastname]</option>";
			$te++;
		}
		echo "</select>";
	}; //technician_a_sel

	function technician_b_sel($mysqli)
	{
		$result_t_sel = $mysqli->query("SELECT * FROM user WHERE user_status='9'");
		$num_t_sel = mysqli_num_rows($result_t_sel);
		$te = 0;
		echo "<select id='tech_b' name='tech_b'>";
		echo "<option value=\"0\">--ไม่มีผู้ช่วย--</option>";
		while ($te < $num_t_sel) {
			$fetch_t_sel  = mysqli_fetch_array($result_t_sel);
			echo "<option value=\"$fetch_t_sel[username]\">$fetch_t_sel[name] $fetch_t_sel[lastname]</option>";
			$te++;
		}
		echo "</select>";
	}; //technician_b_sel

	/*function building_sel(){
$result_building_sel = $mysqli->query("SELECT * FROM building");
$num_building_sel = mysqli_num_rows($result_building_sel);
$build = 0;
echo"<select id='b' name='b'>";
echo"<option value=\"0\">--อาคาร--</option>";
while($build<$num_building_sel){
$fetch_building_sel  = mysqli_fetch_array($result_building_sel);
echo"<option value=\"$fetch_building_sel[id_building]\">$fetch_building_sel[building]</option>";
$build++;
}
echo"</select>";
}; //building_sel*/

	?>
	<link rel="stylesheet" type="text/css" href="style_adminn.css" />
	<div class="title">แบบฟอร์มงานแจ้งซ่อม</div>
	<p><br>
	<div><?php if ($_SESSION['user_status_session'] == '0' && $fetch_list['job_status'] != 'ดำเนินการเรียบร้อย') {
			} else { ?><a href="<?php echo "Export_page.php?id_list=$_GET[id_list]"; ?>">
				<img align="right" border="0" src="images/printer.png" width="20" height="20" title="ออกรายงาน"></a><?php } ?></div>
	<div style="text-align:left;" class="title">เลขที่ใบแจ้งซ่อม : <?php echo $fetch_list['id_list']; ?></div>
	<div style="text-align:right;" class="title">
		วันที่แจ้ง : <?php echo Conthai($fetch_list['date']); ?></div>
	<div style="text-align:right;" class="title"><?php echo "เวลา : $fetch_list[time] น."; ?></div>
	<form method="post">
		<table class="form">
			<tr>
				<th style="text-align:center;" class="form" scope="col" colspan="4">|------------------------------ ข้อมูลผู้แจ้ง -------------------------------|</th>
			</tr>
			<tr>
				<th scope="row">ผู้แจ้ง : </th>
				<td colspan="3"><?php echo $prename_title . $fetch_username['name'] . ' ' . $fetch_username['lastname'] ?></td>
			</tr>
			<tr>
				<th scope="row">สังกัด : </th>
				<td><?php echo $fetch_belong['belong']; ?></td>
				<th scope="row">หน่วยงาน : </th>
				<td><?php echo $fetch_sector['sector']; ?></td>
			</tr>
			<tr>
				<th scope="row">โทรสายตรง : </th>
				<td><?php echo $fetch_username['tel']; ?></td>
				<th scope="row">อีเมล์ : </th>
				<td><?php echo $fetch_username['mail']; ?></td>
			</tr>
			<tr>
				<th align="center" style="text-align:center; " class="form" scope="col" colspan="4">
					|------------------------------ ข้อมูลแจ้งซ่อม -------------------------------|</th>
			</tr>
			<tr>
				<th scope="row">ประเภทที่แจ้ง : </th>
				<td><?php echo $fetch_problem_list['problem']; ?></td>
				<th scope="row">อาคาร : </th>
				<td><?php echo $fetch_building_list['building']; ?></td>
			</tr>
			<tr>
				<th scope="row">ชั้น : </th>
				<td><?php echo $fetch_list['floor']; ?></td>
				<th scope="row">ห้อง : </th>
				<td><?php echo $fetch_room_list['room']; ?></td>
			</tr>
			<tr>
				<th scope="row">ลักษณะอาการเบื้องต้น : </th>
				<td colspan="2"><?php echo $fetch_list['details']; ?></td>
				<td align="center">

					<?php //===================================================================หัวหน้า============================================================ 
					?>
					<label style='font-weight:bold; color:#663300;;'>สำหรับหัวหน้าหน่วยอาคารสถานที่และยานพาหนะ</label>
					<p>
						<?

						if ($fetch_list['job_status'] == 'รอการอนุมัติ') {

							switch ($_SESSION['user_status_session']) {
								case '0':
									echo "<label style='color:black;'>รอการอนุมัติ</label>";
									break;

								case '1':
									echo "<label style='color:black;'>รอการอนุมัติ</label>";
									break;

								case '2':
									echo '<div>';
									echo "<form id='_admin' name='_admin' method='post'>";
									echo "<input name='s' type='radio' checked id='s_yes' value='อนุมัติ' /><label style='color:#CC0000;'>&nbsp;อนุมัติ</label>&nbsp;&nbsp;";
									echo "<input name='s' type='radio' id='s_no' value='ไม่อนุมัติ' /><label style='color:#CC0000;'>&nbsp;ไม่อนุมัติ</label>";
									echo "<p><label id='comment-div'  style='font-weight:bold; display:none; color:red;'>เหตุผลที่ไม่อนุมัติ : <br><textarea id='comment' rows='3'></textarea></label>";
									echo "<p><input id='bt' type='button' value='ยืนยัน'>";
									echo '</form></div>';
									break;
							}
						} else if ($fetch_list['job_status'] == 'ไม่อนุมัติ') {

							$result_username_1_sel = $mysqli->query("SELECT * FROM user WHERE username='$fetch_list[username_1]'");
							$fetch_username_1_sel  = mysqli_fetch_array($result_username_1_sel);

							$result_prename_1_sel = $mysqli->query("SELECT * FROM prename WHERE id_prename='$fetch_username_1_sel[id_prename]'");
							$fetch_prename_1_sel  = mysqli_fetch_array($result_prename_1_sel);

							echo "<p style='color:red;'><strong>$fetch_list[job_status]</strong>";
							echo "<p style='color:red;'><u>เนื่องจาก</u> $fetch_list[comment]</p>";
							echo "<p><p style='color:red; text-align:right;'>ลงชื่อ $fetch_prename_1_sel[prename]$fetch_username_1_sel[name] $fetch_username_1_sel[lastname]";
							echo "<br>วันที่ ";
							Conthai($fetch_list['date_complete']);
							echo "<br>เวลา $fetch_list[time_complete] น.</p>";
						} else {
							$result_username_1_sel = $mysqli->query("SELECT * FROM user WHERE username='$fetch_list[username_1]'");
							$fetch_username_1_sel  = mysqli_fetch_array($result_username_1_sel);

							$result_prename_1_sel = $mysqli->query("SELECT * FROM prename WHERE id_prename='$fetch_username_1_sel[id_prename]'");
							$fetch_prename_1_sel  = mysqli_fetch_array($result_prename_1_sel);

							echo "<br><p style='color:#009900;'><strong>อนุมัติ</strong></p>";
							echo "<br><p style='color:#009900; text-align:right;'>ลงชื่อ $fetch_prename_1_sel[prename]$fetch_username_1_sel[name] $fetch_username_1_sel[lastname]";
							echo "<br>วันที่ ";
							Conthai($fetch_list['date_1']);
							echo "<br>เวลา $fetch_list[time_1] น.</p>";
						}


						/*
else if($fetch_list['job_status']=='อนุมัติแล้วกำลังรอการดำเนินการ'){ 
	
		switch($_SESSION['user_status_session']){
			case '0':
						echo"<p><label style='color:blue;'>อนุมัติแล้วกำลังรอการดำเนินการ</label>"; 
			break;
		
			case '1':
						echo"<p><label style='color:blue;'>อนุมัติแล้วกำลังรอการดำเนินการ</label>";
			break;
		
			case '2':
						echo"<p><label style='color:blue;'>อนุมัติแล้วกำลังรอการดำเนินการ</label>";
			break;
		}

 }
if($fetch_list['job_status']=='อยู่ในระหว่างการดำเนินการ'){ echo"<p><label style='color:#CC6600;'>$fetch_list[job_status]</label>";	}
if($fetch_list['job_status']=='ไม่สามารถดำเนินการได้')
{echo "<p style='color:#FF7F50;'>$fetch_list[job_status]</p><u><p style='color:#FF7F50;'>เนื่องจาก</u> $fetch_list[comment]</p>";}
if($fetch_list['job_status']=='ดำเนินการเรียบร้อย'){echo "<label style='color:green;'>$fetch_list[job_status]</label><p>";}*/
						?>
						<?php //===================================================================เจ้าหน้าที่============================================================ 
						?>
				</td>
			</tr>
			<tr>
				<th style='text-align:center; color:#333333;' scope="col" colspan="4">
					|------------------------------ สำหรับเจ้าหน้าที่ -------------------------------|</th>
			</tr>
			<!--เฉพาะเจ้าหน้าที -->

			<?php if ($fetch_list['job_status'] == 'รอการอนุมัติ') {
				echo "<tr><td colspan='4' style='color:black;'>$fetch_list[job_status]</td></tr>";
			}

			if ($fetch_list['job_status'] == 'อนุมัติแล้วกำลังรอการดำเนินการ') {

				if ($_SESSION['user_status_session'] == '0') {
					echo "<tr><td colspan='4' style='color:blue;'>$fetch_list[job_status]</td></tr>";
				} else {
			?> <tr>
						<th style='color:#333333;'>ผู้รับผิดชอบ : </th>
						<td><?php technician_a_sel($mysqli) ?></td>
						<th style='color:#333333;'>ผู้ช่วยงาน : </th>
						<td><?php technician_b_sel($mysqli) ?></td>
					</tr>
					<tr>
						<td colspan="4"><input type="button" id="bt_t" value="ยืนยันเพื่อดำเนินการต่อไป"></td>
					</tr>
			<?
				}
			}
			if ($fetch_list['job_status'] == 'อยู่ในระหว่างการดำเนินการ') {
				echo "<tr><th style='color:#333333;'>ผู้รับผิดชอบ : </th><p><td colspan='3'><font color='black'>";
				echo "$fetch_tech_a_prename_title$fetch_tech_a_list[name] $fetch_tech_a_list[lastname]";
				if (isset($fetch_tech_b_list['prename']) == true) {
					echo " และ $fetch_tech_b_prename_title$fetch_tech_b_list[name] $fetch_tech_b_list[lastname]";
				}
				echo "</font></td></tr>";

				echo "<tr><th style='color:#333333;'>มอบหมายงานเมื่อวันที่ : </th><p><td><font color='black'>";
				echo "<font color='black'>";
				Conthai($fetch_list['date_2']);
				echo "</td><th style='color:#333333;'>เวลา : </th><td><font color='black'>$fetch_list[time_2] น.</td>";
				echo "</font></td></tr>";

				if ($_SESSION['user_status_session'] == '0') {
					echo "<tr><td colspan='4' style='color:#CC6600;'>$fetch_list[job_status]</td></tr>";
				} else {


					echo "<tr><th style='color:#333333;'>สถานะการดำเนินการ : </th><td colspan='3'><input checked name='s3' type='radio' id='y' value='ดำเนินการเรียบร้อย' /><font color='#333333;'>ดำเนินการเรียบร้อย</font>   ";
					echo "   <input name='s3' type='radio' id='n' value='ไม่สามารถดำเนินการได้' /><font color='#333333;'>ไม่สามารถดำเนินการได้</font> ";
					echo "<p><label id='comment-div'  style='display:none; color:red;'>เหตุผลที่ไม่สามารถดำเนินการได้ : <br><textarea id='comment' rows='3'></textarea></label>";
					echo "<p><input id='bt3' type='button' value='ยืนยัน'></td></tr>";

					echo "</td></tr>";
				}
			}

			if ($fetch_list['job_status'] == 'ไม่สามารถดำเนินการได้') {
				echo "<tr><th style='color:#333333;'>ผู้รับผิดชอบ : </th><p><td colspan='3'><font color='black'>";
				echo "$fetch_tech_a_pre_list[prename]$fetch_tech_a_list[name] $fetch_tech_a_list[lastname]";
				if (isset($fetch_tech_b_pre_list['prename']) == true) {
					echo " และ $fetch_tech_b_pre_list[prename]$fetch_tech_b_list[name] $fetch_tech_b_list[lastname]";
				}
				echo "</tr>";
				echo "<tr><th style='color:#333333;'>มอบหมายงานเมื่อวันที่ : </th><p><td><font color='black'>";
				echo "<font color='black'>";
				Conthai($fetch_list['date_2']);
				echo "</td><th style='color:#333333;'>เวลา : </th><td><font color='black'>$fetch_list[time_2] น.</td>";
				echo "</font></td></tr>";


				echo "<tr><td colspan='4' style='color:#990066;'>$fetch_list[job_status]<p>";
				echo "<p> วันที่ ";
				Conthai($fetch_list['date_complete']);
				echo " เวลา $fetch_list[time_complete] น.";
				echo "<p><u>เนื่องจาก</u> $fetch_list[comment]</td></tr>";
			}
			if ($fetch_list['job_status'] == 'ดำเนินการเรียบร้อย') {

				echo "<tr><th style='color:#333333;'>ผู้รับผิดชอบ : </th><p><td colspan='3'><font color='black'>";
				echo "$fetch_tech_a_pre_list[prename]$fetch_tech_a_list[name] $fetch_tech_a_list[lastname]";
				if (isset($fetch_tech_b_pre_list['prename']) == true) {
					echo " และ $fetch_tech_b_pre_list[prename]$fetch_tech_b_list[name] $fetch_tech_b_list[lastname]";
				}
				echo "</font></td></tr>";
				echo "<tr><th style='color:#333333;'>มอบหมายงานเมื่อวันที่ : </th><p><td><font color='black'>";
				echo "<font color='black'>";
				Conthai($fetch_list['date_2']);
				echo "</td><th style='color:#333333;'>เวลา : </th><td><font color='black'>$fetch_list[time_2] น.</td>";
				echo "</font></td></tr>";

				echo "<tr><td colspan='4' style='color:green;'>$fetch_list[job_status]<p> เมื่อวันที่ ";
				Conthai($fetch_list['date_complete']);
				echo " เวลา $fetch_list[time_complete] น.</td></tr>";
			}



			?>
		</table>
	</form>
	<div id="msg_"></div>
</center>