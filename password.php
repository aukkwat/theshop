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
	$owner_name=$record[owner_name];
	$name_place=$record[name_place];
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
</head>
<?
   $act=$_GET['act'];
   
   if ($act=="new"){
         $user_email=$_POST['email'];
         $sql="select * from user WHERE email='$user_email' "; 
         $result=mysql_db_query($_dbname,$sql);
		 $total=mysql_num_rows($result);
		 if ($total != 1) {
			    echo "<script language=javascript>alert('ไม่พบชื่ออีเมล์นี้ในฐานข้อมูล มีข้อสงสัยไปเมนูติดต่อร้านค้า!!');</script>"; 
        	    echo"<meta http-equiv=\"refresh\" content=\"0;URL=password.php\" target=\"_self\"> "; die;}
         while($record=mysql_fetch_array($result)) { 
			 $username=$record[username];
			 $password=$record[password];
			 $name=$record[name];
			 $surname=$record[surname];
			 } 
         //ส่งเมล์
		$messtext="<br>
สวัสดีครับคุณ $name $surname <br>
----------------------------------------------------------------------- <br>
ที่ร้าน $name_place ในวันที่ ".thaidate($date)."มีการขอรหัสผ่าน<br>
----------------------------------------------------------------------- <br>  
 ชื่อสมาชิกของคุณคือ $username  รหัสผ่านคือ $password<br>  
--------------------------------------------------------------------------------<br>  
ขอขอบพระคุณที่ให้ความสนใจในร้านค้าออนไลน์ของเรา  <br>
หากติดขัดปัญหาใดๆสามารถสอบถามตรงเมนูติดต่อเรา ได้ตลดเวลา<br>
--------------------------------------------------------------------------------<br> 
<br> <br> 
 
																				    $owner_name<br>  
																					".thaidate($date)."
 <br>";

        $header="MIME-Version: 1.0 \r\n";
        $header.="Content-Type: text/html; charset=utf-8 \r\n";
        $header.="From: $email_shop \r\n";
        $header.="Return-Path: $email_shop \r\n";
   if   (mail ($email,"ลืม Password!!!",$messtext,$header)) {
          echo "<center><h2> ส่งข้อข้อมูลแล้ว  <br>เข้าไปตรวจเมล์ได้ครับ</h2></center>" ;
                    } else {
         echo "<center><h2> ไม่สามารถส่งเมล์</h2></center>" ;  }
echo "<meta http-equiv='refresh' content='0;URL=password.php?act=complete'>";
die;

		  
   }

?>
<body>
<form action="password.php?act=new" method="post">
<p align="center">&nbsp;</p>
<p align="center"><b><font size="4" color="#0000FF">ใส่ E-Mail ของคุณที่ใช้สมัครที่ร้านค้า</font></b><br>
<br>
<input type="text" name="email" size="46"></p>
<p align="center">
	<input type="submit" value="ขอรหัสผ่านทางอีเมล์" name="save"></p>
	</form>
<?	 if ($act=="complete"){echo "<center><h1>ส่งอีเมล์รหัสผ่านให้แล้ว!!!!</h1></center>";} ?>
<?include"foot.php";?>
</body>
<? ob_end_flush();mysql_close($conn);  ?>
</html>