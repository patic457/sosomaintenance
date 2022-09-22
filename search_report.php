<?php include"db.php"; include"session.php";include"func.php"


?>
<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script language="javascript">
$(function(){$("#bt").click(function(){var techh=$("#techh").attr("value"); var month=$("#month").attr("value"); var year=$("#year").attr("value");
var id_building=$("#build").attr("value");var job_status_=$("#job_status_").attr("value");var var_check ='ALL';
$.post("check_search_report.php",{tech: techh,month: month,year: year,id_building: id_building,job_status: job_status_,var_check: var_check},function(data){$("#List").html(data);});
});
});

$(function(){$("#build").change(function(){var id_building=$("#build").attr("value");var var_check = 'build';
$.post("check_search_report.php",{id_building: id_building,var_check: var_check},function(data){$("#sel_sector").html(data);});
});
});

</script>

<?

function tech($mysqli){
$re_tech = $mysqli->query("SELECT * FROM technician");
$num_tech = mysqli_num_rows($re_tech);
$i_tech=0;
echo"<select id=\"techh\" name='techh'>";
echo"<option selected value=\"0\">--ช่างเทคนิคทุกคน--</option>";
while($i_tech<$num_tech){
$fetch_list_tech  = mysqli_fetch_array($re_tech);
$id_tech_temp = $fetch_list_tech['id_technician'];
$prename_temp = $fetch_list_tech['prename'];
$name_temp =  $fetch_list_tech['name']; 
$lastname_temp =  $fetch_list_tech['lastname']; 
echo"<option value=\"$id_tech_temp\">$prename_temp$name_temp  $lastname_temp</option>";
$i_tech++;
}
echo"</select>";
};//End tech()

function build(){
$re_build = $mysqli->query("SELECT * FROM building");
$num_build = mysqli_num_rows($re_build);
$i_build=0;
echo"<select id=\"build\" name=\"build\">";
echo"<option selected value=\"0\">--ทุกอาคาร--</option>";
while($i_build<$num_build){
$fetch_list_build  = mysqli_fetch_array($re_build);
$id_building_temp = $fetch_list_build['id_building'];
$building_temp = $fetch_list_build['building'];
echo"<option value=\"$id_building_temp\">$building_temp</option>";
$i_build++;
}
echo"</select>";
};//End build()



?>
<center>
<form id="form1" name="form1" method="post" action="">

 เดือน : 
 
  <label id="m">
  <select  id="month" name="month">
    <option  	selected value="0">ทุกเดือน</option>
    <option value="01">มกราคม</option>
    <option value="02">กุมภาพันธ์</option>
    <option value="03">มีนาคม</option>
    <option value="04">เมษายน</option>
    <option value="05">พฤษภาคม</option>
    <option value="06">มิถุนายน</option>
    <option value="07">กรกฎาคม</option>
    <option value="08">สิงหาคม</option>
    <option value="09">กันยายน</option>
    <option value="10">ตุลาคม</option>
    <option value="11">พฤศจิกายน</option>
    <option value="12">ธันวาคม</option>
  </select>
  </label>
  
  ประจำปี : 
 
  <label id="y">
  <select  id="year" name="year">
  <option value="2011" selected="selected">2554</option>
  </select>
  </label> 
  <label id="b">
อาคาร : <?php build(); ?>
  </label>
  <p>
    <!--<label id="s">
หน่วยงาน :   
<select id="sector" name='sector'>";
<option selected value=\"\">--ทุกหน่วยงาน--</option>";
<div id="sel_sector"></div>
</select>
  </label>-->
  </p>
  <p>&nbsp; </p>
  <p><label id="tech">  
ช่างเทคนิค :  <?php tech($mysqli); ?> 
 </label>
<label id="job">
สถานะการแจ้งซ่อม :    
	<select  id="job_status_"  name="job_status_" >
    <option selected value="0">----------- ทุกสถานะ -----------</option>
    <option value="รอการอนุมัติ">รอการอนุมัติ</option> 
	<option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
	<option value="อนุมัติแล้วกำลังรอการดำเนินการ">อนุมัติแล้วกำลังรอการดำเนินการ</option>
	<option value="อยู่ในระหว่างการดำเนินการ">อยู่ในระหว่างการดำเนินการ</option> 
	<option value="ดำเนินการเรียบร้อย">ดำเนินการเรียบร้อย</option>
 	<option value="ไม่สามารถดำเนินการได้">ไม่สามารถดำเนินการได้</option>
	</select>
  </label>
  <label>
  <input type="button" name="button" id="bt" value="ยืนยัน" />
  </label>
</form></center>
<p><p><p>
<div id="List"></div>