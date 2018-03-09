<? 
@session_start();
  if ($_SESSION["admin"] != "admin") {    		  						
	   echo "<meta http-equiv='refresh' content='0;URL=login.php'>";die;
  }
include "../config.php"; include "../function.php";
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
	$ems=$record[ems];
}
?>
<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Somsak2004">
<title>หน้าเกี่ยวกับโปรแกรม</title>
</head>

<body bgcolor="#C0C0C0">

<p align="center">
<u><font size="6"><b>โปรแกรม S-Shop By Somsak2004</b></font></u></p>
<p align="center">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
ยินดีต้อนรับเจ้าของร้านค้าออนไลน์ S-Shop 
โปรแกรมนี้เป็นโปรแกรมกึ่งแจกฟรี โดยมีข้อตกลงการใช้โปรแกรมนี้ดังนี้ครับ</p>
<p align="center">
1. หากไม่ได้จ่ายค่าปลดลิขสิทธิ์ต้องติด Tag Link
ไปเว็บ Somsak2004</p>
<p align="center">
2. โปรแกรมสามารถใช้งานได้ทุกฟังชั่นแต่ต้องรำคาญกับชื่อผมหน่อย!</p>
<p align="center">
3. ค่าปลดลิขสิทธิ์ เอาชื่อผมออกได้ที่ 500 
บาท/ร้านค้าออนไลน์ครับ!!</p>
<p align="center">
4. ติดต่อได้ที่ E-mail ของผม 
<a href="mailto:sanma2001@hotmail.com">sanma2001@hotmail.com</a> 
สำหรับการปลด</p>
<p align="center">
5. คุณจะได้ Source Code 
โปรแกรมที่ไม่ได้เข้ารหัสหลังจากโอนเงิน!!!</p>
<p align="center">
ท้ายนี้ขอบคุณที่สนใจโปรแกรมที่ออกจากเว็บผมเรื่อยๆ 
เนื่องจากทำโปรแกรม ฟรีๆให้ใช้มามากเลยอยากทำแบบกึ่งขายโปรแกรม 
โดยเขียนขึ้นเองใช้หลักการง่ายๆไม่ให้ยุ่งยากอะไร 
สามารถใช้งานได้ง่ายทั้งผู้ซื้อและผู้ขาย 
มีระบบสมาชิกจดจำการสั่งซื้อประวัติการสั่งซื้อได้ด้วยครับ</p>
<p align="center">
Somsak2004</p>
<p align="center">
&nbsp;</p>
<?include"../foot.php";?>
</body>

</html>