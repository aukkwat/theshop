<? ob_start();
                    include "config.php";include "function.php"; 
	                if (!isset($_COOKIE["s_member"])){
                     setcookie("s_member","", time()-(60*60*24*15), "/", false, 0);
                     header("Content-Type: text/html; charset=utf-8");
					}
					
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<? 
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
	$owner_name=$record[owner_name];
	$telephone=$record[telephone];
} 
?>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
</head>
<body>
<table border="1" width="100%" id="table1">
	<tr>
		<td align="center"><b><font color="#0000FF">
		<font size="5">ขอบพระคุณสำหรับการสั่งซื้อสินค้าจากร้านเรา<br>
		ให้ตรวจสอบอีเมล์ของคุณและทำการโอนเงิน<br>
		แล้วเข้ามาใหม่ในเมนู แจ้งการโอนเงิน <br>
		สถานะการสั่งซื้อก็จะเปลี่ยน แล้วเตรียมการจัดส่ง<br>
		เมื่อส่งแล้วจะได้รหัส EMS ในการตรวจสอบ<br>
		สามารถเข้าดูได้ในหน้า ตรวจสอบสถานะ!!</font></font></b></td>
	</tr>
	<tr>
		<td align="center"><b>สามารถสอบถามได้ที่เบอร์ 
		<?=$telephone?> (<?=$owner_name?>) ในเวลาทำการ!!</b></td>
	</tr>
</table>
<p align="center"><font color="#FF0000"><b><font size="5">กรุณา 
กดปุ่ม F5 (Refresh)เพื่อปรับปรุงหน้าแสดง</font></b></font></p>
<?include"foot.php";?>
</body>
<? ob_end_flush();?>
</html>
<!-- โดย Somsak2004 -->