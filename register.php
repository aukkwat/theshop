<? ob_start();
                    include "config.php";include "function.php"; 
	                if (!isset($_COOKIE["s_member"])){
                     setcookie("s_member","", time()-(60*60*24*15), "/", false, 0);
                     header("Content-Type: text/html; charset=utf-8");
					}

 ?>
<html>
<head>
<? 
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
	$name_place=$record[name_place];
	$owner_name=$record[owner_name];
	$logo=$record[logo];
	$email_shop=$record[email];
} 
?>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
<base target="_self">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){		//v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script language="JavaScript">
function check_cd(){
        var po=document.save.po.value;
        var am=document.save.am.value;
        var tb=document.save.tb.value;
        var address=document.save.address.value;
        var post=document.save.post.value;
        var username=document.save.username.value;
        var password=document.save.password.value;
        var name=document.save.name.value;
        var surname=document.save.surname.value;
        var email=document.save.email.value;
		if (po=="0"){
			alert("กรุณาเลือกจังหวัดด้วยครับ");
			 return false;
		}
		if (am=="0"){
			alert("กรุณาเลือกอำเภอด้วยครับ");
			 return false;
		}
		if (tb=="0"){
			alert("กรุณาเลือกตำบลด้วยครับ");
			 return false;
		}
		if (address.length==0){
			alert("กรุณากรอกบ้านเลขที่ของที่อยู่ด้วยครับ");
			document.save.address.focus();  
			 return false;
		}
		if (post.length==0){
			alert("กรุณากรอกรหัสไปรษณีย์ด้วยครับ");
			document.save.post.focus();  
			 return false;
		}
		if (username.length==0){
			alert("กรุณากรอก Username ด้วยครับ");
			document.save.username.focus();  
			 return false;
		}
		if (password.length==0){
			alert("กรุณากรอก Password ด้วยครับ");
			document.save.password.focus();  
			 return false;
		}		if (name.length==0){
			alert("กรุณากรอกชื่อด้วยครับ");
			document.save.name.focus();  
			 return false;
		}
		if (surname.length==0){
			alert("กรุณากรอกนามสกุลด้วยครับ");
			document.save.surname.focus();  
			 return false;
		}
		    if (email.length==0){
			alert("กรุณากรอกอีเมล์ด้วยครับ");
			document.save.email.focus();  
			 return false;
		}
}
</script>
</head>
<body bgcolor="#C0C0C0">
<?  
                           $name=trim($_POST['name']);
	                       $surname=trim($_POST['surname']);
                           $username=trim($_POST['username']);
	                       $password=trim($_POST['password']);
	                       $address=trim($_POST['address']);
	                       $condo=trim($_POST['condo']);
	                       $road=trim($_POST['road']);
	                       $post=trim($_POST['post']);
	                       $x_tel=trim($_POST['x_tel']);
	                       $email=trim($_POST['email']);
	                       $comment=trim($_POST['comment']);
    if ($_POST['username'] != ""){
         $sql="SELECT * FROM user WHERE username='$username' "; 
         $result=mysql_db_query($_dbname,$sql);
		 $total=mysql_num_rows($result);
		if($total>0)  {
			echo "<script language=javascript>alert('มีผู้ใช้ USERNAME นี้แล้ว กรุณาเปลี่ยนชื่อ');</script>"; $_GET['send']="no";
		}
      }
    if ($_POST['email'] != ""){
         $sql="SELECT * FROM user WHERE email='$email' "; 
         $result=mysql_db_query($_dbname,$sql);
		 $total=mysql_num_rows($result);
		if($total>0)  {
			echo "<script language=javascript>alert('มีผู้ใช้ E-mail นี้แล้ว กรุณาเปลี่ยนใช้อีเมล์อื่น');</script>"; $_GET['send']="no";
		}
      }
     if ($_POST['email'] != ""){
        $email=trim($_POST['email']);	
        $pattern = "^.+@.+.\..+$";
		if(!ereg($pattern, $email))  {
			echo "<script language=javascript>alert('รูปแบบอีเมล์ของ $email ไม่ถูกต้อง');</script>"; $_GET['send']="no";
		}
      }
    if ($_GET['send']=="ok") {
                            
	                        $a1=$_POST['po'];$a2=explode("&",$a1);$a3=explode("=",$a2[0]);$po=$a3[1];
                            $sql="SELECT * FROM province  WHERE id='$po' "; 
                            $result=mysql_db_query($_dbname,$sql);
                            while($record=mysql_fetch_array($result)) {
                    	              $p_id=$record[id];
                       	              $p_name=$record[name];
						    }
							$po=$p_name;
                            $a1=$_POST['am'];$a2=explode("&",$a1);$a3=explode("=",$a2[0]);$am=$a3[1]; 
						    $sql2="SELECT * FROM amphur  WHERE id='$am' "; 
                            $result2=mysql_db_query($_dbname,$sql2);
                            while($record=mysql_fetch_array($result2)) {
                    	              $a_id=$record[id];
                       	              $a_name=$record[name];
							}
							$am=$a_name;
	                        $tb=$_POST['tb'];
       					    $sql3="SELECT * FROM tumbon  WHERE id='$tb' "; 
                            $result3=mysql_db_query($_dbname,$sql3);
                            while($record=mysql_fetch_array($result3)) {
                    	              $t_id=$record[id];
                       	              $t_name=$record[name];
							}
							$tb=$t_name;
                            $date=date("Y-m-d");
							$order_no=0;
                            $sql4 = "INSERT INTO user (id,username,password,name,surname,x_tel,email,address,condo,road,tb,am,po,post,text) VALUES ('','$username','$password','$name','$surname','$x_tel','$email','$address','$condo','$road','$tb','$am','$po','$post','$comment') ";
                            mysql_query( $sql4) or die(mysql_error()) ;
							setcookie("s_member","$name", time()+(60*60*24*15), "/", false, 0);
       					    $sql5="SELECT * FROM user  WHERE name='$name' and surname='$surname'"; 
                            $result5=mysql_db_query($_dbname,$sql5);
                            while($record=mysql_fetch_array($result5)) {
                    	              $member_id=$record[id];
							}
							setcookie("member_id","$member_id", time()+(60*60*24*15), "/", false, 0);
							$messtext="
							                            <br>
สวัสดีครับคุณ $name $surname <br>
----------------------------------------------------------------------- <br>
ยินดีต้อนรับสู่ร้าน $name_place ในวันที่ ".thaidate($date)."<br>
----------------------------------------------------------------------- <br>  
           ชื่อสมาชิกของคุณคือ $username  รหัสผ่านคือ $password<br>  

--------------------------------------------------------------------------------<br>  
ขอขอบพระคุณที่ให้ความสนใจในร้านค้าออนไลน์ของเรา  <br>
หากติดขัดปัญหาใดๆสามารถสอบถามตรงเมนูติดต่อเรา ได้ตลอดเวลา<br>
--------------------------------------------------------------------------------<br> 
<br> <br> 
 
																				    $owner_name<br>  
																					".thaidate($date)."
 <br>";

        $header="MIME-Version: 1.0 \r\n";
        $header.="Content-Type: text/html; charset=utf-8 \r\n";
        $header.="From: $email_shop \r\n";
        $header.="Return-Path: $email_shop \r\n";
   if   (mail ($email,"Welcome!!!",$messtext,$header)) {
          echo "<center><h2> ส่งข้อข้อมูลแล้ว  <br>เข้าไปตรวจเมล์ได้ครับ</h2></center>" ;
                    } else {
         echo "<center><h2> ไม่สามารถส่งเมล์</h2></center>" ;  }

echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
die;
} 

/*  Help Message  */
include("help.js");
$t1="เลือกจังหวัดที่คุณอยู่ แล้วอำเภอจะมีให้เลือกต่อไปนะครับ จะได้ไม่ต้องมากรอกชื่อจังหวัดครับ";
$t2="เลือกอำเภอของจังหวัดที่คุณอยู่ แล้วตำบลจะมีให้เลือกต่อไปนะครับ จะได้ไม่ต้องมากรอกชื่ออำเภอครับ";
$t3="เลือกตำบลที่คุณอยู่ หลังจากเลือก จังหวัดอำเภอของคุณแล้วครับ อาจงงๆ แต่ประหยัดเวลาในการกรอกครับ";
$t4="ใส่เลขที่บ้านหรือเลขที่ห้องของคุณในการจัดส่งของไปรษณีย์";
$t5="จะใส่ไม่ใส่ก็ได้ในกรณีที่ไม่ได้อยู่หมู่บ้าน หรือคอนโดนะครับ แล้วแต่กรณีๆ";
$t6="กรณีมีชื่อถนน ควรจะใส่ไว้สำหรับให้ไปรษณีย์ได้ส่งไวขึ้น แต่หากไม่มีก็ปล่อยว่างได้นะครับ";
$t7="รหัสไปรษณีย์อันนี้จำเป็นต้องใส่นะครับ ตอนแรก่าจะลงแบบให้เลือก แต่ไม่ไหวกรอกข้อมูลไม่ไหวครับ";
$t8="ชื่อของคุณอันนี้จำเป็นต้องใส่นะครับ ไม่ใส่ละก็โปรแกรมไม่ผ่านให้สั่งนะครับ";
$t9="นามสกุล สมควรก็ต้องใส่งั้นไปรณีย์เวลาส่ง EMS ไปให้จะวุ่นนะครับ";
$t10="เบอร์โทรใส่ไม่ใส่ก็ได้ หากใส่เวลาเกิดอะไรจะได้สะดวกในการที่ผมจะได้โทรไปตรวจสอบครับ";
$t11="อีเมล์สำหรับการติดต่อ จำเป็นต้องใส่นะครับเพื่อเป็นการยืนยันครับ หากไม่มียืมเพื่อนใช้ได้นะครับ";
$t12="เป็นการคอมเม้นท์ แบบว่าจะเอาไรพิเศษ หรือ จะบอกอะไรก็ใส่ในตรงนี้ครับ";
$t13="หากกรอกข้อมูลครบถ้วนแล้วค่อยกดยืนยันนะครับ จะได้ไม่ต้องเสียเวลามากรอกข้อมูลใหม่ครับ!!!!";
$t14="ชื่อ Username เอาไว้ทำการเข้าระบบ หรือใช้ในการ Login";
$t15="รหัสผ่านหรือPasswordเอาไว้ทำการเข้าระบบ หรือใช้ในการ Login!!!";
?>
<Form action="<? echo $PHP_SELF."?send=ok"; ?>" method="POST" name="save"  onSubmit="return check_cd()">
<center>
<p align="center"><img border="0" src="images/<?=$logo?>" width="960" height="50"></p>
<table border="1" width="100%" bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF" bgcolor="#805380" bordercolor="#000000" id="table2" height="70">
	<tr>
		<td>
		<p align="center"><font size="5" color="#00FF00"><b>กรุณากรอกข้อมูลของคุณเพื่อเป็นสมาชิกร้าน</b></font>
		</td>
	</tr>
</table>
<table border="1" width="100%" id="table1">
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>จังหวัด</b></td>
		<td bgcolor="#808080">
			<p><select size="1" name="po"  id="po" onChange="MM_jumpMenu('parent',this,0)">
<?        $po="";
            if ($_POST['po'] != ""){$a1=$_POST['po'];$a2=explode("&",$a1);$a3=explode("=",$a2[0]);$po=$a3[1]; }
			if ($_GET['po'] != ""){$po=$_GET['po'];}
			if ($po == ""){
                     echo "<option value=\"0\">=====เลือกจังหวัด====</option>"; 
                     echo "<option value=\"?po=$p_id\">-----------------------------</option>"; 
			}else{ 
							$sql="SELECT * FROM province  WHERE id='$po' "; 
                            $result=mysql_db_query($_dbname,$sql);
                            while($record=mysql_fetch_array($result)) {
                    	              $p_id=$record[id];
                       	              $p_name=$record[name];
			                           echo "<option value=\"?po=$p_id\" >$p_name</option><option value=\"?po=$p_id\">----------------------------</option>";}
			                 }
			$sql="SELECT * FROM province  ORDER BY name"; 
            $result=mysql_db_query($_dbname,$sql);
			$show=1;
            while($record=mysql_fetch_array($result)) {
                    	$p_id=$record[id];
                       	$p_name=$record[name];
                        echo "<option value=\"?po=$p_id\">$show .) $p_name</option>";
						$show++;
			}
?>			
			</select>
			<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t1?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></p>
		</td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>อำเภอ</b></td>
		<td bgcolor="#808080"><select size="1" name="am"  id="am" onChange="MM_jumpMenu('parent',this,0)">
<?
           $am="";
           if ($_POST['am'] != ""){$a1=$_POST['am'];$a2=explode("&",$a1);$a3=explode("=",$a2[0]);$am=$a3[1]; }
           if ($_GET['am'] != ""){$am=$_GET['am'];}
		    if ($am == ""){
                     echo "<option value=\"0\">=====เลือกอำเภอ====</option>"; 
                     echo "<option value=\"?am=$a_id&po=$po\">-----------------------------</option>"; 
			         }else{
						    $sql2="SELECT * FROM amphur  WHERE id='$am' "; 
                            $result2=mysql_db_query($_dbname,$sql2);
                            while($record=mysql_fetch_array($result2)) {
                    	              $a_id=$record[id];
                       	              $a_name=$record[name];
				                      echo "<option value=\"?am=$a_id&po=$po\">$a_name</option>
									  <option value=\"?am=$a_id&po=$po\">----------------------------</option>";}
					 }
            $sql2="SELECT * FROM amphur WHERE provinceID='$po' ORDER BY name"; 
            $result2=mysql_db_query($_dbname,$sql2);
			$show2=1;
            while($record=mysql_fetch_array($result2)) {
                    	$a_id=$record[id];
                       	$a_name=$record[name];
                        echo "<option value=\"?am=$a_id&po=$po\">$show2 .) $a_name</option>";
						$show2++;
			}		
		?>
		</select>
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t2?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>ตำบล</b></td>
		<td bgcolor="#808080"><select size="1" name="tb"  id="tb">

<?        
	      if ($_POST['tb'] != ""){
   	                        $tb=$_POST['tb'];
       					    $sql3="SELECT * FROM tumbon  WHERE id='$tb' "; 
                            $result3=mysql_db_query($_dbname,$sql3);
                            while($record=mysql_fetch_array($result3)) {
                    	              $t_id=$record[id];
                       	              $t_name=$record[name];
				                      echo "<option value=\"$t_id\">$t_name</option>
									  <option value=\"\">----------------------------</option>";
							}
			}
            echo "<option value=\"0\">=====เลือกตำบล====</option>"; 
            echo "<option value=\"?am=$a_id&po=$po&tb=$tb\">-----------------------------</option>"; 
            $sql3="SELECT * FROM tumbon  WHERE amphurID='$am' ORDER BY name"; 
            $result3=mysql_db_query($_dbname,$sql3);
            while($record=mysql_fetch_array($result3)) {
                    	$t_id=$record[id];
                       	$t_name=$record[name];
                        echo "<option value=\"$t_id\">$t_name</option>";
						$show3++;
			}		
?>		
		</select>
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t3?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>บ้านเลขที่</b></td>
		<? $address=$_POST['address']; ?>
		<td bgcolor="#808080"><input type="test" name="address" id="address" size="42" value="<?=$address?>">
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t4?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>หมู่บ้าน/คอนโด</b></td>
		<? $condo=$_POST['condo']; ?>
		<td bgcolor="#808080"><input type="text" name="condo" id="condo" size="42" value="<?=$condo?>">
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t5?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>ถนน</b></td>
		<? $road=$_POST['road']; ?>
		<td bgcolor="#808080"><input type="text" name="road" size="42" id="road" value="<?=$road?>">
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t6?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>รหัสไปรษณีย์</b></td>
		<? $post=$_POST['post']; ?>
		<td bgcolor="#808080"><input type="text" name="post" id="post" size="15" value="<?=$post?>">
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t7?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>UserName</b></td>
		<td bgcolor="#808080">
		<? $name=$_POST['name']; ?>
		<p><input type="text" name="username" size="24" id="username" value="<?=$username?>">
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t14?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></p>
		</td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>Password</b></td>
		<? $surname=$_POST['surname']; ?>
		<td bgcolor="#808080"><input type="text" name="password" id="password" size="42" value="<?=$password?>">
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t15?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>ชื่อ</b></td>
		<td bgcolor="#808080">
		<? $name=$_POST['name']; ?>
		<p><input type="text" name="name" size="24" id="name" value="<?=$name?>">
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t8?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></p>
		</td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>นามสกุล</b></td>
		<? $surname=$_POST['surname']; ?>
		<td bgcolor="#808080"><input type="text" name="surname" id="surname" size="42" value="<?=$surname?>">
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t9?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>เบอร์โทร</b></td>
		<? $x_tel=$_POST['x_tel']; ?>
		<td bgcolor="#808080"><input type="text" name="x_tel" id="x_tel" size="24" value="<?=$x_tel?>">
		<img border="0" src="images/q.gif" width="17" height="17" onMouseover="ddrivetip('<?=$t10?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>อีเมล์</b></td>
		<? $email=$_POST['email']; ?>
		<td bgcolor="#808080"><input type="text" name="email" id="email" size="24" value="<?=$email?>">
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t11?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td width="210" bgcolor="#999999" align="right"><b>หมายเหตุ (Comment)<br>ส่วนบุคคล</b></td>
		<td bgcolor="#808080">		
		<? $comment=$_POST['comment']; ?>
		<p><textarea rows="5" name="comment" cols="60" id="comment" ><?=$comment?></textarea>
		<img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t12?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></p></td>
	</tr>	
</table>
</center>
	<p align="center"><input type="submit" value="ยืนยันข้อมูล" name="save"><img border="0" src="images/q.gif" width="17" height="17"  onMouseover="ddrivetip('<?=$t13?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></p>
</Form>
<?include"foot.php";?>
</body>
</HTML>
<? ob_end_flush();mysql_close($conn);  ?>
<!--- โปรแกรมโดย Somsak2004  -->