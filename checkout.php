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
	$act=$_GET['act'];
	$item=$_COOKIE["s_cart"];
if ($item=="0=0@") {echo "<script language=javascript>alert('ตะกร้าว่างเปล่าสั่งสินค้าไม่ได้นะ!!!');</script>"; 
        	                   echo"<meta http-equiv=\"refresh\" content=\"0;URL=basket.php\" target=\"_self\"> ";die;}
if ($_COOKIE["s_member"]=="") {echo "<script language=javascript>alert('ต้องเป็นสมาชิกหรือเข้าระบบก่อนถึงจะสั่งสินค้าได้!!!');</script>"; 
        	                   echo"<meta http-equiv=\"refresh\" content=\"0;URL=basket.php\" target=\"_self\"> ";die;}

if ($act=="checkout"){
	setcookie("s_cart","0=0@", time()-(60*60*24*15), "/", false, 0);
	$id_user=$_COOKIE["member_id"];
    $date_order=date("Y-m-d");
    $date_pay="0000-00-00";
    $date_sent="0000-00-00";
	$status=0;
    $price=$_GET['p'];
	$comment=$_POST['comment'];
    $sql4 = "INSERT INTO order_data (id,id_user,date_order,date_pay,date_sent,item,status,price,comment) VALUES ('','$id_user','$date_order','$date_pay','$date_sent','$item','$status','$price','$comment') ";
    mysql_query( $sql4) or die(mysql_error()) ;
//เรียกเลข order
$sql="select * from order_data ORDER BY id DESC LIMIT 0,1 "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$id_order=$record[id];
	$item=$record[item];
	$price=$record[price];
}
//ส่งเมล์
$sql="select * from user WHERE id='$id_user' "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$u_name=$record[name];
	$u_surname=$record[u_surname];
	$u_email=$record[email];
}
//รายการสินค้า
					$list=$item;$list_item="";
					$item=explode("@",$list);
                    $i=0;$ii=1;	
					do {
						$num=explode("=",$item[$i]);
						$i++;$ii++;
						}while ($item[$i] != null);$i--;
                   $list_item.="มีสินค้า $i รายการ $ii ชิ้น<br>";
	 $net=0;
for ($s=1;$s<=$i;$s++){
     $dd=explode("=",$item[$s]);
	 $id_product=$dd[0];$number=$dd[1];
	 $sql="select * from product WHERE id='$id_product'"; 
     $result=mysql_db_query($_dbname,$sql);
     while($record=mysql_fetch_array($result)) {
	         $promotion=$record[promotion];
	         $name=$record[name];
	         $price=$record[price];
	         $price_pro=$record[price_pro];
	 }
	 if ($promotio=="1") {$price=$price_pro;}
	$total=((intval($number))*(intval($price)));
	$list_item .= "$s .) $name    ราคา   $total บาท<br>";
		$net += $total;
}
	$list_item .= "$s .) ค่าจัดส่งทางไปรษณีย์   $ems บาท<br>";
	$net += $ems;
	$list_item .= "<br>รวมเป็นเงินทั้งหมด <b>$net</b> บาท<br>";


$messtext="อีเมล์จาก $name_place  เรื่องแจ้งการสั่งซื้อ<br> 
                            <br>
ชื่อคุณ $u_name $u_surname <br>
----------------------------------------------------------------------- <br>
รหัส Order = $order_no สั่งในวันที่ ".thaidate($date_order)."<br>
----------------------------------------------------------------------- <br>  
โดยมีมูลค่าทั้งหมดที่ราคา $price ดังมีรายการต่อไปนี้ <br>  
----------------------------------------------------------------------- <br>
$list_item
<br>  
คอมเม้นท์ของคำสั่งซื้อ<br>
$comment<br><br>
ขอบคุณสำหรับการ สั่งสินค้าจากร้านของเรา <br>  
---------------------------------------------------------------------------------<br>  
$owner_name<br>เบอร์โทร $telephone<br>  
".thaidate($date_order)."
 <br>";
							
        $header="MIME-Version: 1.0 \r\n";
        $header.="Content-Type: text/html; charset=utf-8 \r\n";
        $header.="From: $email_shop \r\n";
        $header.="Return-Path: $email_shop \r\n";
        if   (mail ($u_email,"สั่งซื้อสินค้า คำสั่งซื้อที่ $order_no",$messtext,$header)) {
              echo "<center><h2> ส่งข้อข้อมูลแล้ว  <br>เข้าไปตรวจเมล์ได้ครับ</h2></center>" ;
                    } else {
              echo "<center><h2> ไม่สามารถส่งเมล์</h2></center>" ;  }


$messtext1="มีคำสั่งซื้อใหม่เข้ามา $price บาท  <br> 
<br>
สมาชิกชื่อคุณ $u_name $u_surname <br>
----------------------------------------------------------------------- <br>
รหัส Order = $order_no สั่งมาในวันที่ ".thaidate($date_order)."<br>
----------------------------------------------------------------------- <br>  
โดยมีรายการสั่งสินค้าดังนี้ <br>  
----------------------------------------------------------------------- <br>
$list_item <br>
---------------------------------------------------------------------------------<br>  
คอมเม้นท์ของคำสั่งซื้อ<br>
$comment<br><br>
เข้าไปตรวจสอบที่หลังร้านได้!!
 <br><br>";
        $header1="MIME-Version: 1.0 \r\n";
        $header1.="Content-Type: text/html; charset=utf-8 \r\n";
        $header1.="From: $u_email \r\n";
        $header1.="Return-Path: $u_email \r\n";
        if   (mail ($email_shop,"คำสั่งซื้อใหม่ที่ $order_no",$messtext1,$header1)) {
              echo "<center><h2> ส่งข้อมูลให้ $owner_name แล้ว </h2></center>" ;
                    } else {
              echo "<center><h2>ผิดพลาด: ไม่สามารถส่งเมล์ให้ $owner_name </h2></center>" ;  }

echo"<meta http-equiv=\"refresh\" content=\"0;URL=thank.php\" target=\"_self\"> ";
} 
?>
</head>
<body>
<table border="1" width="100%" bgcolor="#0000FF" id="table1">
	<tr>
		<td>
		<p align="center"><b><font color="#FFFF00">
		หน้ายืนยันการสั่งซื้อ และเข้าสู่ระบบชำระค่าสินค้า</font></b></td>
	</tr>
</table>
<table border="1" width="100%" id="table2">
	<tr>
		<td align="center" bgcolor="#C0C0C0"><b>รายการคำสั่งซื้อ</b></td>
		<td align="center" bgcolor="#C0C0C0"><b>รายชื่อธนาคาร</b></td>
	</tr>
	<tr>
		<td>
<?		
			$xx=$_COOKIE["s_cart"];
		    $item=explode("@",$xx);
			$i=0;$order="";$net=0;
			do {
				$ss=explode("=",$item[$i]);
                $sql="select * from product WHERE id='$ss[0]' "; 
                $result=mysql_db_query($_dbname,$sql);
                while($record=mysql_fetch_array($result)) {
					$name=$record[name];
					$price=intval($record[price]);
					$price_pro=intval($record[price_pro]);
					$promotion=$record[promotion];
				}
					if ($promotion=="1"){$price=$price_pro;}
                    $p_price=$price*intval($ss[1]);
				if ($ss[0] != "0"){echo "$i. )$name จำนวน $ss[1] ชิ้น ราคา $p_price บาท<br>";}
				$net += $p_price;
				$i++; 
				}
			while ($item[$i] != null);		
            echo"====================================<br>ค่าจัดส่ง EMS       ราคา ".$ems."บาท";
			$net += $ems;

?>
		</td>
		<td>
<?
                $sql="select * from bank ORDER BY name_bank "; 
                $result=mysql_db_query($_dbname,$sql);
                while($record=mysql_fetch_array($result)) {
					$name_bank=$record[name_bank];
					$branch=$record[branch];
					$account_no=$record[account_no];
					$account_name=$record[account_name];
					$type=$record[type];
					echo "ธนาคาร         : $name_bank <br>";
					echo "สาขา            : $branch <br>";
					echo "ชื่อบัญชี        : $account_name <br>";
					echo "เลขบัญชี       : $account_no <br>";
					echo "ประเภทบัญชี  : $type <br>";
					echo "===========================================<br>";
				}
?>		
		</td>
	</tr>
	<FORM action="<? echo "$PHPSELF?act=checkout&p=$net";?>" method="POST">
	<tr>
		<td><font color="#0000FF">รวมเป็นเงิน</font> <b>
		<font size="4"><?=$net?></font></b> <font color="#0000FF">บาท</font></td>
		<td><b><font color="#0000FF" size="2">
		หมายเหตุ..การโอนเงินกรุณาโอนเป็นเศษเงินสตางค์มาด้วยเพื่อ<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		เพื่อง่ายต่อการตรวจสอบและเก็บใบโอนเงินเพื่อเป็น<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		หลักฐานในการชำระค่าสินค้าด้วย</font></b></td>
	</tr>
</table>
<p align="center"><b><font size="2">คอมเม้นสำหรับคำสั่งซื้อนี้ 
เช่นเปลี่ยนที่จัดส่ง,ขออะไรพิเศษๆ 
หรืออื่นสำหรับแจ้งเจ้าของร้าน</font></b><br>
<textarea rows="7" name="comment" cols="71"></textarea></p>
	<p align="center"><input type="submit" value="<-----  ยืนยันการสั่งซื้อ   ----->" name="B1"></p>
</form>
<?include"foot.php";?>
</body>
<? ob_end_flush();mysql_close($conn); ?>
</html>
<!-- โดย Somsak2004 -->