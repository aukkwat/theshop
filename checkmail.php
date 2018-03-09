<?
@session_start();
include "config.php"; include "function.php"; 
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$email=$record[email];
  }
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
	$ems=$record[ems];
	$name_place=$record[name_place];
	$email_shop=$record[email];
	$owner_name=$record[owner_name];
	$telephone=$record[telephone];
}
?>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>

<?
$name=trim($_POST['name']);
$tel=trim($_POST['tel']);
$email=trim($_POST['email']);
$head=trim($_POST['head']);
$text=trim($_POST['text']);
$code=trim($_POST['code']);
$code=strtolower($code);
	if ($code==$_SESSION['verify_value']) {

echo"name=$name,$tel=$tel,email=$email,head=$head,text=$text,code=$code ";

		echo "<center><H3>รหัสตรวจสอบถูกต้อง </H3></center>"; 
$messtext="
 อีเมล์จาก ผู้ติดต่อในหน้าติดต่อลูกค้า  <br> 

ข้อความจากคุณ : $name <br>
----------------------------------------------------------------------- <br>
อีเมล์ : $email  <br>
----------------------------------------------------------------------- <br>  
เบอร์โทร : $tel <br>
----------------------------------------------------------------------- <br>  
โดยมีข้อความดังนี้  <br>  
-----------------------------------------------------------------------  <br>
$text
<br>
-----------------------------------------------------------------------  <br>
 <br>";

$header="MIME-Version: 1.0 \r\n";
$header.="Content-Type: text/html; charset=utf-8 \r\n";
$header.="From: $email \r\n";
$header.= "Return-Path: $email \r\n";

   if   (mail ($email_shop,$head,$messtext,$header)) {
          echo "<center><h2> ส่งข้อความเรียบร้อยแล้ว  <br>ขอบคุณสำหรับข้อความ</h2></center>" ;
                    } else {
          echo "<center><h2> ไม่สามารถส่งข้อความ</h2></center><br><br>" ;
         		  }
		
		  echo "<center><a href=doc.php?d=home><h1>กลับไปหน้าแรก</h1></a></center>";
	} else {
		echo "<center><H3>ผิดพลาด : ท่านใส่รหัส ไม่ตรงกับที่กำหนดไว้ </H3><center>";
	    echo "<script language=javascript>alert('ใส่รหัสไม่ถูกต้อง กรุณาใส่ใหม่');</script>";
	}
unset($_SESSION['verify_value']);
@session_destroy();

?>