<? 
@session_start();
if ($_SESSION["admin"] != "admin") {    		  						
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";die;
}
include "../config.php"; 
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
	$logo=$record[logo];
}
?>
<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
<script type="text/javascript" src="flashobject.js"></script>
</head>
<body bgcolor="#C0C0C0">

<? 

$set=$_GET['set'];
if ($set=="true")
{
         $sql="SELECT * FROM config WHERE id=1"; 
         $result=mysql_db_query($_dbname,$sql);
         $t_title=$_POST['t_title'];
         $t_metatag=$_POST['t_metatag'];
         $t_metadesc=$_POST['t_metadesc'];
         $t_owner_name=$_POST['t_owner_name'];
         $t_email=$_POST['t_email'];
         $t_footer=$_POST['t_footer'];
		 $t_username=$_POST['t_username'];
		 $t_password=$_POST['t_password'];
		 $t_item=$_POST['t_item'];
		 $t_cols=$_POST['t_cols'];
         $t_name_place=$_POST['t_name_place'];
         $t_location=$_POST['t_location'];
         $t_telephone=$_POST['t_telephone'];
         $t_ems=$_POST['t_ems'];
		if ($t_logo !="")
			{
			if(copy($HTTP_POST_FILES['t_logo']['tmp_name'],"../images/".$HTTP_POST_FILES['t_logo']['name'])) 
				      {
				      echo "คัดลอกไฟล์โลโก้เรียบร้อยแล้ว";
    				  $t_logo=$HTTP_POST_FILES['t_logo']['name']; 
					  	$sql2 = "UPDATE config  SET  logo='$t_logo' WHERE id=1";
 	                    $dbquery = mysql_query( $sql2);
			          } else {
					  echo"คัดลอกไฟล์โลโก้์ไม่ได้.";

					  }
		     } 
        	  $t_title=trim($t_title);
	          $t_metatag=trim($t_metatag);
	          $t_metadesc=trim($t_metadesc);
              $t_footer=trim($t_footer);
	          $t_owner_name=trim($t_owner_name);
	          $t_email=trim($t_email);
			  $t_username=trim($t_username);
			  $t_password=trim($t_password);
			  $t_name=trim($t_name);
			  $t_surname=trim($t_surname);
			  $t_name_place=trim($t_name_place);
			  $t_telephone=trim($t_telephone);
			  $t_location=trim($t_location);
              $sql4 = "UPDATE config  SET  title='$t_title',metatag='$t_metatag', metadesc='$t_metadesc', name_place='$t_name_place', owner_name='$t_owner_name',email='$t_email',footer='$t_footer',telephone='$t_telephone',location='$t_location',username='$t_username',password='$t_password',cols='$t_cols',item='$t_item',ems='$t_ems'  WHERE id=1";
              $dbquery = mysql_query( $sql4);
              echo "<meta http-equiv='refresh' content='0;URL=setting.php'>";                       

}

$sql="SELECT * FROM config WHERE id=1"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
	$owner_name=$record[owner_name];
    $email=$record[email];
	$footer=$record[footer];
	$logo=$record[logo];
	$name_place=$record[name_place];
    $username=$record[username];
    $password=$record[password];
    $cols=$record[cols];
    $item=$record[item];
    $name_telephone=$record[telephone];
    $name_location=$record[location];
    $ems=$record[ems];
	$title=trim($title);
	$metatag=trim($metatag);
	$metadesc=trim($metadesc);
    $footer=trim($footer);
    $logo=trim($logo);
	$owner_name=trim($owner_name);
	$email=trim($email);
	$name_telephone=trim($name_telephone);
    $name_location=trim($name_location);
    $username=trim($username);
	$password=trim($password);
}

 ?>
<u><b><font size="6">ตั้งค่าระบบร้านค้าออนไลน์</font></b></u><FORM METHOD="POST" ACTION="setting.php?set=true"  name="save" enctype="multipart/form-data">
<p align="left">
<font color="#0000FF"><b>
ใส่ Title (บรรทัดบนสุดของ Browser)
&nbsp;</b></font></p>
	<p align="left"><input type="text" name="t_title" size="120" value="<? echo $title; ?>"><br>
	<br>
	<b><font color="#0000FF">USERNAME :</font></b><input type="text" name="t_username" size="40" value="<? echo $username; ?>"><b><font color="#0000FF"> 
	PASSWORD:</font></b><input type="text" name="t_password" size="40" value="<? echo $password; ?>"></p>

<p><img border="0" src="../images/<? echo $logo; ?>" width="990" height="50"></a></p>
<p align="left"><b><font color="#0000FF">รูปโลโก้ของร้านค้า 990x50 px.</font></b></p>
	<p align="left"><input type="file" name="t_logo" size="50" id="t_logo" value="<? echo $logo; ?>"></p>

<p align="left"><font color="#0000FF"><b>ชื่อเจ้าของร้าน(ใช้การส่งอีเมล์ติดต่อของเว็บ)</b></font>&nbsp;&nbsp;
 
<input type="text" name="t_owner_name" size="80" value="<? echo $owner_name; ?>"></p>

<p align="left"><font color="#0000FF"><b>ชื่อร้านค้า </b></font>&nbsp;
 
<input type="text" name="t_name_place" size="80" value="<? echo $name_place; ?>"></p>

<p align="left"><font color="#0000FF"><b>สถานที่ (บ้านเลขที่ หรือ ที่อยู่)</b></font>&nbsp;
 
<input type="text" name="t_location" size="80" value="<? echo $name_location; ?>"></p>

<p align="left"><font color="#0000FF"><b>เบอร์โทรร้านค้า(เบอร์ติดต่อ)</b></font>&nbsp;
 
<input type="text" name="t_telephone" size="40" value="<? echo $name_telephone; ?>"></p>

<p align="left"><b><font color="#0000FF">อีเมล์เจ้าของ(ใช้ในการติดต่อผู้อาศัย)</font></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="t_email" size="50" value="<? echo $email; ?>"><br>
<br>
<b><font color="#0000FF">จำนวนแถวแสดงสินค้า/หน้า(เมนู สินค้า)</font></b>&nbsp;&nbsp;<input type="text" name="t_cols" size="21" value="<? echo $cols; ?>"></p>
<p align="left"><b><font color="#0000FF">จำนวนรายชื่อลูกค้า/หน้า (เมนู ตรวจสถานะ)</font>&nbsp;&nbsp;</b>&nbsp; &nbsp;<input type="text" name="t_item" size="21" value="<? echo $item; ?>"></p>
<p align="left"><b><font color="#0000FF">ค่าจัดส่ง EMS (เวลาคิดเงิน</font>)&nbsp;</b>&nbsp; &nbsp;<input type="text" name="t_ems" size="21" value="<? echo $ems; ?>"> 
ในตะกร้าสินค้า!</p>

<p align="left"><font size="4" color="#0000FF">Footer ด้านล่างหรือ Tag Link (ใช้ HTML ได้)</font></p>
	<p align="left"><textarea name="t_footer" rows="8"cols="60"><? echo $footer; ?></textarea></p>

<p align="left"><font size="4" color="#0000FF">คำอธิบายเมต้าของเ็ว็บนี้ (Meta Description)</font></p>
	<p align="left"><textarea name="t_metadesc" rows="8"cols="60"><? echo $metadesc; ?></textarea></p>

<p align="left"><font size="4" color="#0000FF">คำค้นหาเมต้าแท็ก(มีผลในการค้นหาเ็ว็บคุณ-SEO ใช้ , เป็นตัวคั่น)</font></p>
	<p align="left"><textarea name="t_metatag" rows="8"cols="60"><? echo $metatag; ?></textarea></p>

	<p align="left">
	<input type="submit" value="จัดเก็บข้อมูล" name="save" style="float: left"><input type="reset" value="ยกเลิก" name="save" style="float: left"></p>

</FORM>
<?include"../foot.php";?>
<? mysql_close($conn);  ?>
</body>
</html>
<!--- โปรแกรมโดย Somsak2004  -->