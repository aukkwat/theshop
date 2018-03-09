<? 
                    ob_start();
                    include "config.php";include "function.php"; 
	                if (!isset($_COOKIE["s_member"])){
                     setcookie("s_member","", time()-(60*60*24*15), "/", false, 0);
                     header("Content-Type: text/html; charset=utf-8");
					}
					
?>
<script language="javascript">
function checksave()
	{  OK = true;
if(document.save.name.value.length==0) 
		{ OK = false; alert('กรุณาใส่ชื่อ-นามสกุล'); return false; }
if(document.save.email.value.length==0) 
		{ OK = false; alert('กรุณาใส่อีเมล์'); return false; }
if(document.save.head.value.length==0) 
		{ OK = false; alert('กรุณาใส่หัวข้อก่อน'); return false; }
if(document.save.text.value.length==0) 
		{ OK = false; alert('กรุณาใส่ข้อความ'); return false; }
if(document.save.tel.value.length==0) 
		{ OK = false; alert('กรุณาใส่เบอร์โทรติดต่อ'); return false; }
if(document.save.code.value.length==0) 
		{ OK = false; alert('กรุณาใส่รหัสก่อน'); return false; }
if(OK==true) document.save.submit();
    	}
</script>
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
	$location=$record[location];
	$telephone=$record[telephone];
	$email=$record[email];
	$owner_name=$record[owner_name];
} 
?>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
</head>
<LINK HREF="style.css" REL="stylesheet" TYPE="text/css">
<STYLE TYPE="text/css">
<!--
body {
	background-image: url(images/background.gif);
}
-->
</STYLE>
<body>
<?
/*  Help Message  */
include("help.js");
$t1="กรุณาใส่ชื่อและนามสกุล เพื่อการติดต่อกลับหรือเป็นข้อมูลให้ร้านค้า!!";
$t2="กรุณาใส่อีเมล์ให้ถูกต้องด้วยนะ เพื่อการเมล์ติดต่อกลับให้คุณ";
$t3="เบอร์โทรของคุณกรุณากรอกด้วยนะ!!!";
$t4="หัวข้อในการติดต่อ เช่นสอบถามข้อมูลสิน การจัดส่ง กติกา หรืออะไรก็ได้";
$t5="ข้อความที่คุณจะส่งให้ร้านค้า เขียนบอกได้เลยนะ!!! รายละเอียดต่างๆ";
$t6="รหัสตรวจสอบสำหรับป้องกัน SPAMที่เข้ามาก่อนกวนในระบบ เขียนให้เหมือนตัวใหญ่หรือเล็กก็ได้";
$t7="เมื่อข้อมูลเรียบร้อยให้กดปุ่มนี้สำหรับส่งข้อความ";
?>
<center>
<FORM action="checkmail.php" method="POST" onSubmit="return checksave()" name="save">
<table border="1" width="69%" id="table1">
	<tr>
		<td bgcolor="#0000FF"><font color="#FFFF00">ข้อมูลร้านค้า : <?=$name_place?></font></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCCC">ที่อยู่ : <?=$location?><br>
		อีเมล์ร้านค้า : <a href="mailto:email"><?=$email?></a> <br>
		เบอร์โทรร้านค้า : <?=$telephone?>  <br>
		เจ้าของร้าน : <?=$owner_name?>
		</td>
	</tr>
</table>
<table border="1" width="69%" id="table2">
	<tr>
		<td align="right" width="206"><b><font color="#0000FF">ชื่อของคุณ</font></b></td>
		<td>
			<p><input type="text" name="name" size="42">
			<img border="0" src="images/q.gif" width="17" height="17" onMouseover="ddrivetip('<?=$t1?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></p>
		</td>
	</tr>
	<tr>
		<td align="right" width="206"><b><font color="#0000FF">อีเมล์ของคุณ</font></b></td>
		<td><input type="text" name="email" size="42"> 
			<img border="0" src="images/q.gif" width="17" height="17" onMouseover="ddrivetip('<?=$t2?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td align="right" width="206"><b><font color="#0000FF">เบอร์โทรติดต่อ</font></b></td>
		<td><input type="text" name="tel" size="42">
			<img border="0" src="images/q.gif" width="17" height="17" onMouseover="ddrivetip('<?=$t3?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
	<tr>
		<td align="right" width="206"><b><font color="#0000FF">หัวข้อติดต่อ</font></b></td>
		<td><input type="text" name="head" size="42"> 
			<img border="0" src="images/q.gif" width="17" height="17" onMouseover="ddrivetip('<?=$t4?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></td>
	</tr>
</table>
	<p><u><b>ข้อความที่ต้องการส่ง </b></u>
			<img border="0" src="images/q.gif" width="17" height="17" onMouseover="ddrivetip('<?=$t5?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></p>
	<p align="center"><textarea rows="15" name="text" cols="65"></textarea></p>
<p align="center"><b>กรุณาใส่รหัสตรวจสอบก่อนกดส่งข้อความ </b>
			<img border="0" src="images/q.gif" width="17" height="17" onMouseover="ddrivetip('<?=$t6?>', 200)"; onMouseout="hideddrivetip()" align="baseline"><br>
<IMG SRC="verify-image-bg.php" ALIGN="absmiddle" >&nbsp;&nbsp;
<INPUT TYPE="text" NAME="code" SIZE="8"></p>
	
	<p align="center"><input type="submit" value="ส่งข้อความให้เจ้าของร้าน" name="save"> 
			<img border="0" src="images/q.gif" width="17" height="17" onMouseover="ddrivetip('<?=$t7?>', 200)"; onMouseout="hideddrivetip()" align="baseline"></p>
	</FORM>
	</center>
<?include"foot.php";?>
</body>
<? ob_end_flush();mysql_close($conn);  ?>
</html>
<!-- โดย Somsak2004 -->