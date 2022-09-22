<?php include"session.php"; ?><link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script>
$(function(){$("#bt").click(function(){var check='add';var password=$("#password").attr("value");var username=$("#username").attr("value");
var prename=$("#prename").attr("value");var name=$("#name").attr("value");var lastname=$("#lastname").attr("value");
var id_sector=$("#id_sector").attr("value");var tel=$("#tel").attr("value");var mail=$("#mail").attr("value");var user=$("#user").attr("value");
if(id_sector=="0"){alert('กรุณาเลือกหน่วยงาน');}else{
$.post("check_user.php",{check:check,username:username,password:password,prename:prename,name:name,lastname:lastname,id_sector:id_sector,tel:tel,mail:mail,user:user},function(data){$("#msg").html(data);});
}
});
});

</script>
<body>
<center><table class="mana"><tr><td>
<strong>เพิ่มผู้ใช้</strong>
<form name="f1" method="post" >
ชื่อผู้ใช้ : <input id="username" type="text" maxlength="10" onKeyUp="isEngNumchar(this.value,this)" onKeyUp="isSignchar(this.value,this)" value="" ></td>
<td>รหัสผ่าน : <input onKeyUp="isEngNumchar(this.value,this)" onKeyUp="isSignchar(this.value,this)" id="password" type="password"  maxlength="10" value="" ></td></tr>
<tr><td>คำนำหน้า :
    
    <?
$result_pre = mysql_query("SELECT * FROM prename");
$num_pre = mysqli_num_rows($result_pre);
echo"<select id='prename'>";
    echo"<option selected value=''>--กรุณาเลือก--</option>";
$ii=0;
while($ii<$num_pre){	
$fetch_pre  = mysqli_fetch_array($result_pre);
$id_prename_temp = $fetch_pre['id_prename'];
$prename_temp = $fetch_pre['prename'];
 ?><option value="<?php echo $id_prename_temp; ?>"><?php echo $prename_temp; ?></option><?
$ii++;
}
 echo"</select>";
 ?>
   
  </td>
</tr><tr><td>ชื่อ : <input type="text" id="name" ></td><td> นามสกุล : <input type="text" id="lastname"></td>
<tr><td>ชื่อหน่วยงาน :
  <select id="id_sector">
      <option  value="0" selected>--กรุณาเลือก--</option>
      <?php 
$result = mysql_query("SELECT * FROM sector");
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
    <td>เบอร์ภายใน : <input id="tel" type="text" size="6" onKeyUp="isNumchar(this.value,this)" maxlength="4"></td></tr>
    <tr>
      <td>
      อีเมล์ : <input type="text" id="mail">
      </td>
      <td>สิทธิ์การใช้งาน 
        <select id="user" >
          <option  selected value="0" >ผู้ใช้ทั่วไป</option>
          <option value="1">เจ้าหน้าที่</option>
			<option value="9">ช่างเทคนิค</option>
          <option value="2">หัวหน้าหน่วยอาคารฯ</option>
        </select>

        <p><input type="button" id="bt" value="ส่งข้อมูล">
</form>
   </td> </tr></table></center>
</body>