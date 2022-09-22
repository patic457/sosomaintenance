 <script type="text/javascript">  


 function isSignchar(str,obj){  //ใส่ลงไป onkeyup="isEngNumchar(this.value,this)"
     var orgi_text="/[\@\#\%\/\\\^\&\*\(\)\_\+\!]/;";
     var str_length=str.length;  
     var str_length_end=str_length-1;  
     var isThai=true;  
     var Char_At="";  
    for(i=0;i<str_length;i++){  
         Char_At=str.charAt(i);  
         if(orgi_text.indexOf(Char_At)==-1){  
             isThai=false;  
         }     
     }  
     if(str_length>=1){  
         if(isThai==false){  
             obj.value=str.substr(0,str_length_end);  
        }  
     }  
     return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด  
}  
 
 function isEngNumchar(str,obj){  //ใส่ลงไป onkeyup="isEngNumchar(this.value,this)"
     var orgi_text="abcdefghijklmnopqrstuvwxyz1234567890";  
     var str_length=str.length;  
     var str_length_end=str_length-1;  
     var isThai=true;  
     var Char_At="";  
    for(i=0;i<str_length;i++){  
         Char_At=str.charAt(i);  
         if(orgi_text.indexOf(Char_At)==-1){  
             isThai=false;  
         }     
     }  
     if(str_length>=1){  
         if(isThai==false){  
             obj.value=str.substr(0,str_length_end);  
        }  
     }  
     return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด  
}  
 
 function isThaiEngchar(str,obj){  //ใส่ลงไป onkeyup="isThaiEngchar(this.value,this)"
     var orgi_text="ๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวง ผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦabcdefghijklmnopqrstuvwxyz";  
     var str_length=str.length;  
     var str_length_end=str_length-1;  
     var isThai=true;  
     var Char_At="";  
    for(i=0;i<str_length;i++){  
         Char_At=str.charAt(i);  
         if(orgi_text.indexOf(Char_At)==-1){  
             isThai=false;  
         }     
     }  
     if(str_length>=1){  
         if(isThai==false){  
             obj.value=str.substr(0,str_length_end);  
        }  
     }  
     return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด  
}  
 
 function isThaichar(str,obj){  //ใส่ลงไป onkeyup="isThaichar(this.value,this)"
     var orgi_text="ๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวง ผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ";  
     var str_length=str.length;  
     var str_length_end=str_length-1;  
     var isThai=true;  
     var Char_At="";  
    for(i=0;i<str_length;i++){  
         Char_At=str.charAt(i);  
         if(orgi_text.indexOf(Char_At)==-1){  
             isThai=false;  
         }     
     }  
     if(str_length>=1){  
         if(isThai==false){  
             obj.value=str.substr(0,str_length_end);  
        }  
     }  
     return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด  
}  

function isEngchar(str,obj){  //ใส่ลงไป onkeyup="isEngchar(this.value,this)"
     var orgi_text="abcdefghijklmnopqrstuvwxyz";  
     var str_length=str.length;  
     var str_length_end=str_length-1;  
     var isThai=true;  
     var Char_At="";  
    for(i=0;i<str_length;i++){  
         Char_At=str.charAt(i);  
         if(orgi_text.indexOf(Char_At)==-1){  
             isThai=false;  
         }     
     }  
     if(str_length>=1){  
         if(isThai==false){  
             obj.value=str.substr(0,str_length_end);  
        }  
     }  
     return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด  
}  

function isNumchar(str,obj){  //ใส่ลงไป onkeyup="isNumchar(this.value,this)"
     var orgi_text="1234567890";  
     var str_length=str.length;  
     var str_length_end=str_length-1;  
     var isThai=true;  
     var Char_At="";  
    for(i=0;i<str_length;i++){  
         Char_At=str.charAt(i);  
         if(orgi_text.indexOf(Char_At)==-1){  
             isThai=false;  
         }     
     }  
     if(str_length>=1){  
         if(isThai==false){  
             obj.value=str.substr(0,str_length_end);  
        }  
     }  
     return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด  
}  
 </script> 
<? 


function ConThai($dall){

$year = substr($dall,0,4);
$mouth = substr($dall, 5,-3);
$day = substr($dall,-2);

$year = $year+543;
$year = substr($year,2);

if($mouth=="01"){$mo = "ม.ค.";}else if($mouth=="02"){$mo = "ก.พ.";}else if($mouth=="03"){$mo = "มี.ค.";}else if($mouth=="04"){$mo = "เม.ย.";}
else if($mouth=="05"){$mo = "พ.ค.";}else if($mouth=="06"){$mo = "มิ.ย.";} else if($mouth=="07"){$mo = "ก.ค.";} else if($mouth=="08"){$mo = "ส.ค.";}
else if($mouth=="09"){$mo = "ก.ย.";} else if($mouth=="10"){$mo = "ต.ค.";} else if($mouth=="11"){$mo = "พ.ย.";} else if($mouth=="12"){$mo = "ธ.ค.";}      

print"$day $mo $year";

};

function ConMath($dall){

$year = substr($dall,0,4);
$mouth = substr($dall, 5,-3);
$day = substr($dall,-2);

$year = $year+543;
$year = substr($year,2);   

$conmath="$day-$mouth-$year";

};

function prename_t(){
$result_pre = mysql_query("SELECT * FROM prename");
$num_pre = mysql_num_rows($result_pre);
echo"<select id='a' name='a'>";
    echo"<option selected value=''>--กรุณาเลือก--</option>";
$ii=0;
while($ii<$num_pre){	
$fetch_pre  = mysql_fetch_array($result_pre);
$id_prename_temp = $fetch_pre['id_prename'];
$prename_temp = $fetch_pre['prename'];
 ?><option value="<? echo $id_prename_temp; ?>"><? echo $prename_temp; ?></option><?
$ii++;
}
 echo"</select>";
};

?>
