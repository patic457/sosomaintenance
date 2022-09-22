<? include"session.php"; ?><link rel="stylesheet" type="text/css" href="style_adminn.css" />
<script>
$(function(){$("#btte").click(function(){var check='edit';var username=$("#usernamee").attr("value");
var prename=$("#prenamee").attr("value");var name=$("#namee").attr("value");var lastname=$("#lastnamee").attr("value");
var id_sector=$("#id_sectore").attr("value");var tel=$("#tele").attr("value");var mail=$("#maile").attr("value");var user=$("#usere").attr("value");
if(prename=='0' || name=="" || lastname==""){alert('กรุณากรอกคำนำหน้า ชื่อ-นามสกุล');}else if(id_sector=='0'){alert('กรุณาเลือกหน่วยงาน');exit();}
	else{
		$.post("check_user.php",{check:check,prename:prename,name:name,lastname:lastname,id_sector:id_sector,tel:tel,mail:mail,user:user,username:username},
		function(data){$("#msge").html(data);});
	}
});
});

</script>
<body>

<? $result_sel = mysql_query("SELECT * FROM user WHERE username='$_GET[username]'"); 
$fetch_sel  = mysql_fetch_array($result_sel); ?>

<center><table class="mana"><tr><td>
<strong>แก้ไขผู้ใช้</strong>
<form name="f1" method="post" >
ชื่อผู้ใช้ : <input id="usernamee" type="text" maxlength="10" onKeyUp="isEngNumchar(this.value,this)" onKeyUp="isSignchar(this.value,this)" value="<? echo $fetch_sel['username']; ?>" disabled ></td>
<td>รหัสผ่าน : <input onKeyUp="isEngNumchar(this.value,this)" onKeyUp="isSignchar(this.value,this)" id="password" type="password" maxlength="10" value="****" disabled ></td></tr>
<tr><td>คำนำหน้า :
    
    <?
$result_pre = mysql_query("SELECT * FROM prename");
$num_pre = mysql_num_rows($result_pre);
echo"<select id='prenamee'>";
    echo"<option  value='0'>--กรุณาเลือก--</option>";
$ii=0;
while($ii<$num_pre){	
$fetch_pre  = mysql_fetch_array($result_pre);
$id_prename_temp = $fetch_pre['id_prename'];
$prename_temp = $fetch_pre['prename'];
 ?><option <? if($id_prename_temp==$fetch_sel['id_prename']){echo"selected";} ?> value="<? echo $id_prename_temp; ?>"><? echo $prename_temp; ?></option><?
$ii++;
}
 echo"</select>";
 ?>
   
  </td>
</tr>
<tr><td>ชื่อ : <input type="text" id="namee" value="<? echo $fetch_sel['name']; ?>" ></td>
<td> นามสกุล : <input type="text" id="lastnamee" value="<? echo $fetch_sel['lastname']; ?>" ></td>
<tr><td>ชื่อหน่วยงาน :
  <select id="id_sectore">
      <option selected value="0">--กรุณาเลือก--</option>
      <? 
$result = mysql_query("SELECT * FROM sector");
$num = mysql_num_rows($result);
$i=0;
while($i<$num){	

$fetch  = mysql_fetch_array($result);
$id_sector_temp = $fetch['id_sector'];
$sector_temp = $fetch['sector'];    
       ?><option <? if($id_sector_temp==$fetch_sel['id_sector']){echo"selected";} ?> value="<? echo $id_sector_temp; ?>"><? echo $sector_temp; ?></option><?
$i++;
}
 ?>
    </select></td>
    <td>เบอร์ภายใน : <input id="tele" value="<? echo $fetch_sel['tel']; ?>" type="text" size="6" onKeyUp="isNumchar(this.value,this)" maxlength="4" ></td></tr>
    <tr>
      <td>
      อีเมล์ : <input type="text" value="<? echo $fetch_sel['mail']; ?>" id="maile">
      </td>
      <td>สิทธิ์การใช้งาน 
        <select id="usere" >
          <option <? if($fetch_sel['user_status']=='0'){echo"selected";} ?>  value="0" >ผู้ใช้ทั่วไป</option>
          <option <? if($fetch_sel['user_status']=='1'){echo"selected";} ?>  value="1">เจ้าหน้าที่</option>
          <option <? if($fetch_sel['user_status']=='2'){echo"selected";} ?>  value="2">หัวหน้าหน่วยอาคารฯ</option>
        </select>

        <p><input type="button" id="btte" value="ส่งข้อมูล">
</form>
   </td> </tr></table></center>
<div id="msge"></div>
</body>