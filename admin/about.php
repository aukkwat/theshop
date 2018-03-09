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
<p align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span lang="th">ยินดีกับเจ้าของร้านออนไลน์ โปรแกรมนี้ผมเขียนขึ้นให้กับ 
สมาชิกเว็บไซต์ผมใช้นะครับ 
ขอบคุณทุกท่านที่ให้ความสนใจในโปรแกรมต่างๆที่ออกจาเว็บผมนะครับ โดยโปรแกรมนี้
</span>code <span lang="th">ผมเขียนขึ้นเอง อาจจะหยิบ </span>Script
<span lang="th">จากโน่นจากนี้ให้ออกมาเป็นโปรแกรมร้านค้าแบบง่ายๆ 
โดยมีจุดประสงค์สำหรับผู้ที่ไม่ค่อยมีความรู้เท่าไหร่ 
แบบว่าเพิ่งหัดแต่อยากเป็นเจ้าของร้านเปิดขายในประเทศเป็นการทดสอบ 
โปรแกรมนี้สำเร็จในวันที่ </span>16 <span lang="th">ธันวาคม </span>2551
<span lang="th">โดยเป็นโปรแกรมแบบเบื้อต้นโดยใส่ความสามารถพื้นฐาน 
โดยเน้นที่ขายของที่หน้าเน็ตแล้วจัดส่งสินค้าทางพัสดุไปรษณีย์ด้วย </span>EMS
<span lang="th">หรือ จดหมายลงทะเบียน 
โดยโปรแกรมนี้สามารถแสดงให้ลูกค้าเห็นและตรวจสอบสถานะ เลขพัสดุได้ 
เพื่อความสบายใจทั้ง </span>2 <span lang="th">ฝ่ายครับ</span>!!! <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><u>
<span lang="th">กติกาการใช้โปรแกรม...</span>S-Shop (16<span lang="th"> ธค.
</span>2551)</u></b><span lang="th"><br>
</span>1. <span lang="th">สามารถใช้โปรแกรมได้ฟรีๆ แต่ต้องมีคำว่า </span>&quot;<font color="#0000ff" size="2">Power 
By
<a title="ไปเว็บ Somsak2004 ผู้ทำโปรแกรม S-Shop" target="_blank" href="http://www.somsak2004.com">
Somsak2004</a>@สงวนลิขสิทธิ์ 2552 &quot;</font><span lang="th">ที่ด้านซ้าย</span>-<span lang="th">ล่างในหน้าแรก 
ห้ามแก้ไขโดยเด็ดขาด</span>!!!<font color="#0000ff" size="2"><br>
</font>2. <span lang="th">สามารถแก้ไขได้ทุกส่วนตามความต้องการ 
โดยมีเงื่อนไขตามข้อ </span>1 <span lang="th">อย่างเดียว</span><br>
3. <span lang="th">เมื่อ </span>Login <span lang="th">เข้าหลังร้าน 
เมื่อใช้งานกรุณากดลงทะเบียนการใช้โปรแกรมแบบออนไลน์ (ไม่เสียค่าใช้จ่ายใด) 
เพียงแสดงตนว่าใช้โปรแกรม</span><br>
4. <span lang="th">หากจะสนับสนุนผู้เขียน ผู้ผลิตโปรแกรม 
สามารถเข้าไปดูที่หน้าลงทะเบียน ค่าปลดล็อคลิขสิทธิ์ที่ </span>500 <span lang="th">
บาท</span>/<span lang="th">เว็บไซต์ครับ..กรุณาถือว่าเป็นการสนับสนุนนักพัฒนาคนไทยครับ...<br>
</span>5. <span lang="th">
กรณีต้องการอะไรพิเศษตามความต้องการส่วนตัวต้องจ้างนะครับ 
เพราะผู้เขียนไม่รับทำฟรีๆให้แก่บุคคลใด (งั้นตายแน่ๆ)<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <u>
<font color="#0000FF"><b>แหล่งสอบถามและที่มาของโปรแกรม<br>
</b></font></u></span>1. <a target="_blank" href="http://www.somsak2004.com">
http://www.somsak2004.com</a> <span lang="th">เว็บไซต์หลักของผม แหล่งผลิต </span>
Web Application <span lang="th">ภาษาไทยที่ใช้ฟรีๆ<br>
</span>2. <a target="_blank" href="http://www.somsak2004.net/">
http://www.somsak2004.net</a>&nbsp; <span lang="th">เว็บไซต์สำรอง เป็นที่วางเว็บ</span>
<span lang="th"><a target="_blank" href="http://www.somsak2004.net/forum">
บอร์ดสมศักดิ์๒๐๐๔</a></span><br>
3. <a target="_blank" href="http://www.theshopthai.com">
http://www.theshopthai.com</a> <span lang="th">เว็บทำร้านค้า ณ 
วันนี้ไม่เสร็จซักที มัวแต่ไปทำให้คนอื่น </span>:~~~(<br>
<br>
<span lang="th">ด้วยความปรารถนาดีจาก<br>
</span>Somsak2004<br>
16 <span lang="th">ธันวาคม </span>2551</p>
<?include"../foot.php";?>
</body>
</html>