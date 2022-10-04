<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("db.php");
include("session.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<style>
		.a1 {
			background-color: #FFCCFF;
			color: red;

		}

		.alert2 {
			background-color: #FFCCFF;
			color: red;
		}

		.alert22 {
			background-color: #66CCFF;
			color: blue;
		}

		.alert3 {
			background-color: #FFCC33;
			color: #CC6600;
		}
	</style>


	<title>ระบบจัดการงานซ่อมบำรุง</title>
	<meta http-equiv="Content-Language" content="English" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<style type="text/css">
		<!--
		.blafont {
			color: #000000
		}
		-->
	</style>
</head>

<body>

	<div id="wrap">

		<div id="header">
			<h1><a href=''>Soso Maintenance</a></h1>

		</div>

		<div id="menu">
			<ul>
				<li><a href="index.php?m=">หน้าแรก</a></li>
				<?php if ($_SESSION['user_status_session'] != '9') { ?>
					<li><a href="index.php?m=2">แจ้งซ่อม</a></li>
				<?php } else { ?>
					<li class="top"><a href="index.php?m=17">ประวัติงานที่ได้รับมอบหมาย</a></li>
				<?php } ?>
				<?php if ($_SESSION['user_status_session'] == '2') { ?>
					<li><a href="index.php?m=4">รอการอนุมัติ</a></li>
				<?php } ?>
				<?php if ($_SESSION['user_status_session'] == '1' || $_SESSION['user_status_session'] == '2') { ?>
					<li><a href="index.php?m=5">รอการดำเนินการ</a></li>
					<li><a href="index.php?m=6">อยูในระหว่างการดำเนินการ</a></li>
				<?php }
				if ($_SESSION['user_status_session'] != '9') {
				?>
					<li><a href="index.php?m=3">ประวัติการแจ้งซ่อม</a></li>
				<?php } ?>
				<li align="right">fff</li>
			</ul>

		</div>

		<div id="content">
			<div class="right" id="load_body">
				<?php
				$m_temp = '0';
				if (isset($_GET['m'])) {
					$m_temp = $_GET['m'];
				}

				if ($_SESSION['user_status_session'] == '2' && $m_temp == '') {
					$m_temp = '4';
				} else if ($_SESSION['user_status_session'] == '1' && $m_temp == '') {
					$m_temp = '5';
				} else if ($_SESSION['user_status_session'] == '0' && $m_temp == '') {
					$m_temp = '3';
				} else if ($_SESSION['user_status_session'] == '9' && $m_temp == '') {
					$m_temp = '16';
				}
				//main menu
				if ($m_temp == '') {
					echo "หน่วยอาคารสถานที่และยานพาหนะ คณะสัตวแพทยศาสตร์ มหาวิทยาเกษตรศาสตร์";
				} else if ($m_temp == '2') {
					include "user_service_form.php";
				} else if ($m_temp == '3') {
					if ($_SESSION['user_status_session'] == "0") {
						include "inbox_admin_comp.php";
					} else {
						include "search_record.php";
					}
				} else if ($m_temp == '4') {
					include "inbox_super.php";
				} else if ($m_temp == '5') {
					include "inbox_admin.php";
				} else if ($m_temp == '6') {
					include "inbox_admin_wait.php";
				} else if ($m_temp == '16') {
					include "inbox_technician_record.php";
				} else if ($m_temp == '17') {
					include "inbox_technician_comp.php";
				}

				//menu manage
				else if ($m_temp == '7') {
					include "list_building.php";
				} else if ($m_temp == '8') {
					include "list_belong.php";
				} else if ($m_temp == '9') {
					include "list_sector.php";
				} else if ($m_temp == '10') {
					include "list_room.php";
				} else if ($m_temp == '11') {
					include "list_problem.php";
				} else if ($m_temp == '12') {
					include "list_technician.php";
				} else if ($m_temp == '13') {
					include "list_prename.php";
				} else if ($m_temp == '15') {
					include "index_user.php";
				}

				//menu Other
				else if ($m_temp == '99') {
					include "search_record.php";
				} else if ($m_temp == '4.1') {
					include "browse_admin_.php";
				} else if ($m_temp == '4.2') {
					include "edit_user.php";
				} else if ($m_temp == '4.3') {
					include "user_profile.php";
				}

				?>
			</div><!-- End -->
			<div class="left">
				<h2>
					<?php
					if ($_SESSION['user_status_session'] == '0') {
						echo "สถานะผู้ใช้ทั่วไป";
					} else if ($_SESSION['user_status_session'] == '1') {
						echo "สถานะเจ้าหน้าที่";
					} else if ($_SESSION['user_status_session'] == '2') {
						echo "สถานะหัวหน้าหน่วยอาคารฯ";
					} else if ($_SESSION['user_status_session'] == '9') {
						echo "สถานะช่างเทคนิค";
					}
					?>
				</h2>
				<ul>
					<li><a href="index?m=4.3"><b>ขอต้อนรับคุณ<br><?php echo "$_SESSION[name_session] $_SESSION[lastname_session]"; ?></b></a></li>
					<?php
					$sql_list_1 = "SELECT * FROM list_service WHERE job_status='รอการอนุมัติ'";
					$sql_list_2 = "SELECT * FROM list_service WHERE job_status='อนุมัติแล้วกำลังรอการดำเนินการ'";
					$sql_list_3 = "SELECT * FROM list_service WHERE job_status='อยู่ในระหว่างการดำเนินการ'";
					$sql_list_9 = "SELECT * FROM list_service WHERE job_status='อยู่ในระหว่างการดำเนินการ' AND id_technician_a='$_SESSION[username_session]'";
					$r_list_1 = $mysqli->query($sql_list_1);
					$r_list_2 = $mysqli->query($sql_list_2);
					$r_list_3 = $mysqli->query($sql_list_3);
					$r_list_9 = $mysqli->query($sql_list_9);

					$num_list1 = mysqli_num_rows($r_list_1);
					$num_list2 = mysqli_num_rows($r_list_2);
					$num_list3 = mysqli_num_rows($r_list_3);
					$num_list9 = mysqli_num_rows($r_list_9);

					if ($_SESSION['user_status_session'] == "1" || $_SESSION['user_status_session'] == "2") {

						if ($num_list1 != '0') {
							if ($_SESSION['user_status_session'] == '2') {

								echo "<li><a>---------------------------------------</a></li>";
								echo "<li class='alert2'><a href=\"index.php?m=4\" class='blafont'>คุณมีรายการอยู่ $num_list1 รายการ<br>เพื่อรอการอนุมัติ</a></li>";
								echo "<li><a>---------------------------------------</a></li>";
							}
						} else {
							echo "<li><a>---------------------------------------</a></li>";
							echo "<li><a>ยังไม่มีรายการ<br>รอการอนุมัติ</a></li>";
							echo "<li><a>---------------------------------------</a></li>";
						}

						if ($num_list2 != '0') {
							echo "<li class='alert22'><a href=\"index.php?m=5\" class='blafont'>คุณมีรายการอยู่ $num_list2 รายการ<br>เพื่อรอการดำเนินการ</a></li>";
						} else {
							echo "<li><a>ยังไม่มีรายการ<br>รอการดำเนินการ</a></li>";
						}
						echo "<li><a>---------------------------------------</a></li>";
						if ($num_list3 != '0') {
							echo "<li class='alert3'><a href=\"index.php?m=6\" class='blafont'>คุณมีรายการอยู่ $num_list3 รายการ<br>ที่อยู่ในระหว่างการดำเนินการ</a></li>";
						} else {
							echo "<li><a>ยังไม่มีรายการ<br>อยู่ในระหว่างการดำเนินการ</a></li>";
						}
					} else if ($_SESSION['user_status_session'] == '9') {
						echo "<li><a>---------------------------------------</a></li>";
						if ($num_list9 != '0') {
							echo "<li class='alert2'><a href=\"index.php?m=16\" class='blafont'>คุณมีรายการอยู่ $num_list9 รายการ";
							echo "<br>ที่ได้รับมอบหมาย</a></li>";
						} else {
							echo "<li><a>ยังไม่มีรายการ<br>ที่ได้รับมอบหมาย</a></li>";
						}
					}
					echo "<li><a>---------------------------------------</a></li>";
					?>
					<li><a href="destroy.php" class="blafont">ออกจากระบบ</a></li>
				</ul>

				<?php if ($_SESSION['user_status_session'] == "1" || $_SESSION['user_status_session'] == "2") { ?>
					<h2>บริหารและจัดการโครงสร้าง</h2>
					<ul>
						<li><a href="index.php?m=7">จัดการ ตารางอาคาร</a></li>
						<li><a href="index.php?m=8">จัดการ ตารางสังกัด</a></li>
						<li><a href="index.php?m=9">จัดการ ตารางหน่วยงาน</a></li>
						<li><a href="index.php?m=10">จัดการ ตารางห้อง</a></li>
						<li><a href="index.php?m=11">จัดการ ตารางประเภทที่แจ้งซ่อม</a></li>
						<li><a href="index.php?m=13">จัดการ ตารางคำนำหน้า</a></li>
						<li><a href="index.php?m=15">จัดการ ตารางผู้ใช้งาน</a></li>
					</ul>
				<?php } ?>

			</div> <?php //end left 
					?>

			<div style="clear: both;"> </div>

		</div>

		<div id="bottom"> </div>

		<div id="footer"><?php include "footer.php"; ?>
		</div>
	</div>

</body>

</html>