<?php include"session.php"; ?><link rel="stylesheet" type="text/css" href="style_adminn.css" />


<center><table class="mana"><tr><td>
<strong>จัดการผู้ใช้</strong>
<form name="f1" method="post" action="check_admin_user.php">
ชื่อผู้ใช้ : <input name="username" type="text" maxlength="10" onkeyup="isEngNumchar(this.value,this)" value="" ></td>
<td>รหัสผ่าน : <input onkeyup="isEngNumchar(this.value,this)" name="password" type="password" maxlength="10" value="" ></td></tr>
<tr><td>คำนำหน้า :
    
    <?php prename_t($mysqli); ?>
   
  </td>
<td>ประเภทของผู้ใช้ : 
        <select name="f" >
          <option  value="" selected>--กรุณาเลือก--</option>
          <?php 
$resultt = $mysqli->query("SELECT * FROM type_user");
$numm= mysqli_num_rows($resultt);
$i=0;
while($i<$numm){	
$fetchh  = mysqli_fetch_array($resultt);
$id_type_user_temp = $fetchh['id_type_user'];
$type_user_temp = $fetchh['type_user'];    
       ?><option value="<?php echo $id_type_user_temp; ?>"><?php echo $type_user_temp; ?></option><?
$i++;
}

 ?>
        </select>
</td></tr><tr><td>ชื่อ : <input type="text" name="b" ></td><td> นามสกุล : <input type="text" name="c"></td>
<tr><td>ชื่อหน่วยงาน :
  <select name="d">
      <option selected>--กรุณาเลือก--</option>
      <?php 
$result = $mysqli->query("SELECT * FROM sector");
$num = mysqli_num_rows($result);
$i=0;
while($i<$num){	

$fetch  = mysqli_fetch_array($result);
$id_sector_temp = $fetch['id_sector'];
$sector_temp = $fetch['sector'];    
       ?><option value="<?php echo $id_sector_temp; ?>"><?php echo $sector_temp; ?></option><?
$i++;
}
 ?>
    </select></td>
    <td>เบอร์ภายใน : <input name="e" type="text" size="6"  maxlength="4"></td></tr>
    <tr>
      <td>
      อีเมล์ : <input type="text" name="mail">
      </td>
      <td>สิทธิ์การใช้งาน 
        <select name="g" >
          <option  selected value="0" >ผู้ใช้ทั่วไป</option>
          <option value="1">เจ้าหน้าที่</option>
          <option value="2">หัวหน้าหน่วยอาคารฯ</option>
        </select>

        <p><input type="submit" value="ส่งข้อมูล">
</form>
   </td> </tr></table></center>