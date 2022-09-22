<?php 
include"db.php"; include"func.php"; 

$useragent = $_SERVER['HTTP_USER_AGENT'];
 
if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
} elseif (preg_match( '|Opera ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
   $browser_version=$matched[1];
    $browser = 'Opera';
} elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
       $browser_version=$matched[1];
        $browser = 'Firefox';
} elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
       $browser = 'Safari';
} else {
       // browser not recognized!
    $browser_version = 0;
    $browser= 'other';
}

if($browser=='IE')
  {
	mysql_query("set character set tis620");
	$sql = "SELECT * FROM user WHERE name LIKE '" . $_GET['q'] . "%' order by name asc ";//print "IEbrowser: $browser $browser_version";
  }
else
  {
  mysql_query("set character set utf-8");
	$sql = "SELECT * FROM user WHERE name LIKE '" . $_GET['q'] . "%' order by name asc ";//print "Fbrowser: $browser $browser_version";
  }
	$rs = mysql_query($sql);
?>
<script language="javascript" src="jquery.js"></script>


<link rel="stylesheet" type="text/css" href="style_adminn.css" />
<p align="center" class="title">รายชื่อผู้ใช้</p>
<!--<div id="bta" align="right"><img src="images/add.png" border="0" width="20" height="20" >เพิ่มข้อมูล</div>-->
              
<p><div id="del-div"></div>
<p><div id="edit-div"></div>
<br><form id="f1" method="post">
<table class="css">
<tr >
  <th scope="col">ชื่อ-นามสกุล</th>
  <th scope="col">หน่วย</th>
	<th scope="col">โทรสายตรง</th>
	<th scope="col">อีเมล์</th>
   <th scope="col">ลบ</th>
    <th scope="col">แก้ไข</th>
  </tr>

<?
$num = mysql_num_rows($rs);

$i=0;
while($i<$num)
{
$result=mysql_fetch_array($rs);

$r_prename = mysql_query("SELECT * FROM prename WHERE id_prename='$result[id_prename]'");

$r_sector = mysql_query("SELECT * FROM sector WHERE id_sector='$result[id_sector]'");

$result_prename=mysql_fetch_array($r_prename);

$result_sector=mysql_fetch_array($r_sector);

if($browser=='IE'){
	$prename_th = iconv('TIS-620', 'UTF-8', $result_prename['prename']);
	$name_th = iconv('TIS-620', 'UTF-8', $result['name']);
	$lastname_th = iconv('TIS-620', 'UTF-8', $result['lastname']);
	$sector_th = iconv('TIS-620', 'UTF-8', $result_sector['sector']);
	echo "<tr><td>$prename_th$name_th $lastname_th</td><td>$sector_th</td><td>$result[tel]</td><td>$result[mail]</td>"; 
}
else{
	echo "<tr><td>$result_prename[prename]$result[name] $result[lastname]</td><td>$result_sector[sector]</td><td>$result[tel]</td><td>$result[mail]</td>"; 
}	
?>
<td align="center">
<a href="check_user.php?check=del&&username=<? echo "$result[username]"; ?>"><img src="images/del.png" border="0" width="20" height="20" id="btd<? echo $i; ?>"title="ลบข้อมูล"></a>
</td>
<td align="center"><a href="index.php?m=15&&check=edit&&username=<? echo "$result[username]";?>">
															<img src="images/edit.png" border="0"  width="20" height="20" id="bte<? echo $i; ?>"title="แก้ไขข้อมูล"></a></td></tr>

<?     
$i++;
}
?>

