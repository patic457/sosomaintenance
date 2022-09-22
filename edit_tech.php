<? include"db.php"; include"session.php"; ?>
<table  style="border-color:#CC0000; border:dashed;"><tr><td>
<? 
if(isset($_POST['edit'])==true){
$edit=$_POST['edit'];
$resultt = mysql_query("SELECT * FROM technician WHERE id_technician='$edit'");
$fetch  = mysql_fetch_array($resultt);
$id_technician_temp = $fetch['id_technician'];
$name_temp = $fetch['name'];
$lastname_temp = $fetch['lastname'];
$job_temp = $fetch['job'];

}else{  } 
  
function a(){

$result = mysql_query("SELECT * FROM type_problem");
$num = mysql_num_rows($result);
$i=1;
while($i<=$num){
$fetch  = mysql_fetch_array($result);
$id_problem_temp = $fetch['id_problem'];
$problem_temp = $fetch['problem'];
?><option value="<? echo $id_problem_temp; ?>"><? echo $problem_temp; ?></option><?
$i++;
}};
?>
<script>
//$(document).ready(function(){$('#ftext').hide();}); 
function resetF(){ $('#eftext').hide();$('#ef2').val("");}
</script>
<body>
<form id="f1" method="post" action="check_admin_technician.php"> <input type="hidden" name="idd" value="<? echo $id_technician_temp; ?>">
<font color="red" ><strong>สำหรับแก้ไขข้อมูล ชื่อช่างเทคนิค<? echo "$name_temp $lastname_temp "; ?> กรุณาแก้ไขตรงนี้ </strong></font><p>
  <p>ยศ :
    <select  name="a">
      <option  value="" selected>--กรุณาเลือก--</option>
      <option value="นาย">นาย</option>
      <option value="นาง">นาง</option>
      <option value="นางสาว">นางสาว</option>
      <option value="ว่าที่ร้อยตรี">ว่าที่ร้อยตรี</option>
      <option value="ว่าที่ร้อยตรีหญิง">ว่าที่ร้อยตรีหญิง</option>
      <option value="จ่าสิบเอกหญิง">จ่าสิบเอกหญิง</option>
    </select>
&nbsp;  ชื่อ :
    <input type="text"  name="b" value="<? echo $name_temp; ?>">
&nbsp;นามสกุล :
    <input type="text" name="c" value="<? echo $lastname_temp; ?>">
&nbsp;ตำแหน่ง :
    <input type="text" name="d" value="<? echo $job_temp; ?>">
&nbsp;  
  <p>ความสามารถ : 

    <select name="e"  id="e">
      <option selected>--กรุณาเลือก--</option>
      <? a(); ?>
    </select>
    สังกัด :    

    <select  name="f1" id="f1">
      <option onClick="resetF();" value="" selected>--กรุณาเลือก--</option>
      <option onClick="resetF();" value="หน่วยอาคารและยานพาหนะ">หน่วยอาคารและยานพาหนะ</option>
      <option onClick="$('#eftext').show();" value="หน่วยงานภายนอก">หน่วยงานภายนอก</option>
    </select>
<label id="eftext" style="display:none">โปรดระบุ : <input type="text" id="ef2" name="f2" size="50"></label>
  <p><input type="submit" id="btt" value="ส่งข้อมูล">
</form>
</body>
</tr></td></table>