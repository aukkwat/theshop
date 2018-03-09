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
	$xems=$record[ems];
	$email_shop=$record[email];
	$owner_name=$record[owner_name];
	$name_place=$record[name_place];
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
</head>
<body bgcolor="#C0C0C0">
<?  
$id=$_GET['id'];
$act=$_GET['act'];
$id_user=$_GET['id_user'];
if ($act=="update"){
$d_date_order=$_POST['d_date_order'];
$m_date_order=$_POST['m_date_order'];
$y_date_order=$_POST['y_date_order'];
$d_date_pay=$_POST['d_date_pay'];
$m_date_pay=$_POST['m_date_pay'];
$y_date_pay=$_POST['y_date_pay'];
$d_date_sent=$_POST['d_date_sent'];
$m_date_sent=$_POST['m_date_sent'];
$y_date_sent=$_POST['y_date_sent'];
$date_order="$y_date_order-$m_date_order-$d_date_order";
$date_pay="$y_date_pay-$m_date_pay-$d_date_pay";
$date_sent="$y_date_sent-$m_date_sent-$d_date_sent";
$zems=$_POST['zems'];
$status=$_POST['status'];
if (($d_date_pay=="") || ($d_date_pay==0)) {$date_pay="0000-00-00";}
if (($d_date_sent=="") || ($d_date_sent==0)) {$date_sent="0000-00-00";}

                  $sql8="UPDATE order_data SET  status='$status',date_order='$date_order',date_pay='$date_pay',date_sent='$date_sent',ems='$zems' WHERE id='$id' ";
                  mysql_query( $sql8) or die(mysql_error()); 
$sql="select * from user where id='$id_user' "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$name=$record[name];
	$surname=$record[surname];
	$email_user=$record[email];
	   switch ($status) 
		{
		case  "2":
                $subj="เตรียมจัดส่งสินค้าจาก $name_place";
		        $messtext="
				สวัสดีครับคุณ $name $surname<br>
				ตอนนี้สถานะแจ้งหารโอนเงินเปลี่ยนเป็นเตรียมจัดส่งสินค้า<br>
				ในวันนี้ ".thaidate($today)."จะจัด<br>
				ทำการส่งในวันทำการการถัดไปแล้วจะแจ้ง<br>
				ให้ทราบหลังจากส่งสินค้าแล้วอีกครั้ง!!!<br>
				<br>
				ขอขอบคุณ <br>
				$owner_name<br>
				หมายเหตุ...ระบบเมล์อัตโนมัติ....<br>
				<br>
     			";
		        break;
		case  "3":
                $subj="จัดส่งสินค้าแล้วจาก $name_place.";
		        $messtext="
				จัดส่งสินค้าแล้วนะ เลขพัสดุ EMS คือ<br>
				$zems หมายเลข Order=$id โดยคุณ<br>
				สามารถเข้าตรวจสอบโดยไม่ต้องกรอกเลขได้ที่ <br>
                หน้าเว็บไซต์ เมนูตรวจสอบสถานะ หรือ ดูประวัติสั่งซื้อ<br><br>
				ขอบคุณ<br>
				$owner_name<br>
				หมายเหตุ...ระบบเมล์อัตโนมัติ....<br>
				";
		        break;
		case  "4":
                $subj="คุณได้รับสินค้าจาก $name_place แล้ว!!!.";
		        $messtext="
								สวัสดีครับคุณ $name $surname<br>
				ตอนนี้สถานะคำสั่งซื้อเปลี่ยนเป็นได้รับสินค้าแล้ว<br>
				หลังจากที่ตรวจในวันที่ ".thaidate($today)."<br>
				    ขอบคุณสำหรับการสนับสนุนเว็บไซต์<br>
				หมายเลข EMS = $ems  โดย<br>
				มีหมายเลข Order = $id สามารถตรวจ<br>
				ได้ที่เว็บไซต์ และ ตรงประวัติสั่งซื้อ<br>
				<br>
				ขอขอบคุณ <br>
				$owner_name<br>
				หมายเหตุ...ระบบเมล์อัตโนมัติ....<br>
				<br>
     			";
		        break;

	     }
        $header="MIME-Version: 1.0 \r\n";
        $header.="Content-Type: text/html; charset=utf-8 \r\n";
        $header.="From: $email_shop \r\n";
        $header.="Return-Path: $email_shop \r\n";
        if   (mail ($email_user,$subj,$messtext,$header)) {
                      echo "<center><h2> ส่งเมล์ $subj Order=$id<br>ให้กับ $name $surname</h2></center>" ;
                                   } else {
                       echo "<center><h2> ไม่สามารถส่งเมล์</h2></center>" ;  }
					   $_SESSION["admin"]="admin";
}
echo "<meta http-equiv='refresh' content='0;URL=order2.php?id=$id'>";
}
$sql3="select * from order_data WHERE id='$id' "; 
$result=mysql_db_query($_dbname,$sql3);
while($record=mysql_fetch_array($result)) {
	$id=$record[id];
	$id_user=$record[id_user];
	$price=$record[price];
	$status=$record[status];
	$date_order=$record[date_order];
	$date_pay=$record[date_pay];
	$date_sent=$record[date_sent];
	$bank=$record[bank];
	$value=$record[value];
	$item=$record[item];
	$zems=$record[ems];
	$comment=$record[comment];
    if ($status==0) {$xstatus="เพิ่งสั่งซื้อ";}
    if ($status==1) {$xstatus="แจ้งการโอนเงิน";}
    if ($status==2) {$xstatus="เตรียมจัดส่ง";}
    if ($status==3) {$xstatus="จัดส่งแล้ว";}
    if ($status==4) {$xstatus="รับสินค้าแล้ว";}
}
$sql2="select * from user WHERE id='$id_user' "; 
$result2=mysql_db_query($_dbname,$sql2);
while($record2=mysql_fetch_array($result2)) {
	$name=$record2[name];
	$surname=$record2[surname];
}
?>
<FORM action="order2.php?act=update&id=<?=$id?>&id_user=$id_user" method="post">
<table border="1" width="100%" id="table1">
	<tr>
		<td bgcolor="#0000FF" align="center"><font color="#FFFF00">แก้ไข&amp;ปรับสถานะ 
		ของคำสั่งซื้อเลขที่ : <b><font size="4"><?=$id?></font></b></font></td>
	</tr>
</table>

<table border="1" width="100%" id="table2">
	<tr>
		<td width="206">ชื่อผู้สั่งซื้อ</td>
		<td><?echo $name." ".$surname;?></td>
	</tr>
	<tr>
		<td width="206">สถานะ</td>
		<td>
			<p><select size="1" name="status">
		          <option value="<?=$status?>"><?=$xstatus?></option>
		          <option value="<?=$status?>">----------------</option>
		          <option value="0">เพิ่งสั่งซื้อ</option>
		          <option value="1">แจ้งการโอนเงิน</option>
		          <option value="2">เตรียมจัดส่ง</option>
		          <option value="3">จัดส่งแล้ว</option>
		          <option value="4">รับสินค้าแล้ว</option>
			</select><b>ปรับสถานะตรงนี้!!!!</b></p>
		</td>
	</tr>
	<tr>
		<td width="206">เลขพัสดุ EMS </td>
		<td>
			<p><input type="text" name="zems" size="20" value="<?=$zems?>"></p>
		</td>
	</tr>
	<tr>
		<td width="206">ราคาสินค้าที่ต้องโอน</td>
		<td><b><?=$price?> </b>บาท</td>
	</tr>
	<tr>
		<td width="206">ธนาคารที่โอนมา</td>
		<td><?=$bank?></td>
	</tr>
	<tr>
		<td width="206">จำนวนเงินที่โอนมา</td>
		<td><b><?=$value?></b> บาท</td>
	</tr>
	<tr>
	<td width="206">วันที่สั่งสินค้า</td>
		<td><select size="1" name="d_date_order">
<?
     $x=explode("-",$date_order);
     $d_date_order=intval($x[2]);
	 echo "<option value=\"$d_date_order\">$d_date_order</option>";
	 echo "<option value=\"$d_date_order\">--</option>";
?>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		</select> เดือน
		<select size="1" name="m_date_order">
		<?
		$m_date_order=intval($x[1]);
         switch ($m_date_order)
		 {
			 case 0 : echo "<option value=\"0\">ยังไม่ระบุ</option>"; break;
			 case 1 : echo "<option value=\"1\">มกราคม</option>"; break;
			 case 2 : echo "<option value=\"2\">กุมภาพันธ์</option>"; break;
			 case 3 : echo "<option value=\"3\">มีนาคม</option>"; break;
			 case 4 : echo "<option value=\"4\">เมษายน</option>"; break;
			 case 5 : echo "<option value=\"5\">พฤษภาคม</option>"; break;
			 case 6 : echo "<option value=\"6\">มิถุนายน</option>"; break;
			 case 7 : echo "<option value=\"7\">กรกฎาคม</option>"; break;
			 case 8 : echo "<option value=\"8\">สิงหาคม</option>"; break;
			 case 9 : echo "<option value=\"9\">กันยายน</option>"; break;
			 case 10 : echo "<option value=\"10\">ตุลาคม</option>"; break;
			 case 11 : echo "<option value=\"11\">พฤศจิกายน</option>"; break;
			 case 12 : echo "<option value=\"12\">ธันวาคม</option>"; break;
		 }
		 echo "<option value=\"$m_date_order\">-----------</option>";
		?>
		<option value="1">มกราคม</option>
		<option value="2">กุมภาพันธ์</option>
		<option value="3">มีนาคม</option>
		<option value="4">เมษายน</option>
		<option value="5">พฤษภาคม</option>
		<option value="6">มิถุนายน</option>
		<option value="7">กรกฎาคม</option>
		<option value="8">สิงหาคม</option>
		<option value="9">กันยายน</option>
		<option value="10">ตุลาคม</option>
		<option value="11">พฤศจิกายน</option>
		<option value="12">ธันวาคม</option>
		</select> พ.ศ.<select size="1" name="y_date_order">
<?
        $year=$x[0];
		$thai_year=$year+543;
		$year1=$year+1;
		$thai_year1=$thai_year+1;
		$year2=$year-1;
		$thai_year2=$thai_year-1;
		echo"<option value=\"$year\">$thai_year</option>";
		echo"<option value=\"$year\">-----</option>";
		echo"<option value=\"$year1\">$thai_year1</option>";
		echo"<option value=\"$year2\">$thai_year2</option>";
?>
		</select>
		(<? echo thaidate($date_order);?>)</td>
	</tr>
	<tr>
		<td width="206">วันที่แจ้งโอน</td>
		<td><select size="1" name="d_date_pay">
	<?
     $y=explode("-",$date_pay);
     $d_date_pay=intval($y[2]);
	 echo "<option value=\"$d_date_pay\">$d_date_pay</option>";
	 echo "<option value=\"$d_date_pay\">--</option>";
?>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		</select> เดือน
		<select size="1" name="m_date_pay">
<?     $m_date_pay=intval($y[1]);
         switch ($m_date_pay)
		 {
			 case 0 : echo "<option value=\"0\">ยังไม่ระบุ</option>"; break;
			 case 1 : echo "<option value=\"1\">มกราคม</option>"; break;
			 case 2 : echo "<option value=\"2\">กุมภาพันธ์</option>"; break;
			 case 3 : echo "<option value=\"3\">มีนาคม</option>"; break;
			 case 4 : echo "<option value=\"4\">เมษายน</option>"; break;
			 case 5 : echo "<option value=\"5\">พฤษภาคม</option>"; break;
			 case 6 : echo "<option value=\"6\">มิถุนายน</option>"; break;
			 case 7 : echo "<option value=\"7\">กรกฎาคม</option>"; break;
			 case 8 : echo "<option value=\"8\">สิงหาคม</option>"; break;
			 case 9 : echo "<option value=\"9\">กันยายน</option>"; break;
			 case 10 : echo "<option value=\"10\">ตุลาคม</option>"; break;
			 case 11 : echo "<option value=\"11\">พฤศจิกายน</option>"; break;
			 case 12 : echo "<option value=\"12\">ธันวาคม</option>"; break;
		 }
		 echo "<option value=\"$m_date_pay\">-----------</option>";
		?>
		<option value="1">มกราคม</option>
		<option value="2">กุมภาพันธ์</option>
		<option value="3">มีนาคม</option>
		<option value="4">เมษายน</option>
		<option value="5">พฤษภาคม</option>
		<option value="6">มิถุนายน</option>
		<option value="7">กรกฎาคม</option>
		<option value="8">สิงหาคม</option>
		<option value="9">กันยายน</option>
		<option value="10">ตุลาคม</option>
		<option value="11">พฤศจิกายน</option>
		<option value="12">ธันวาคม</option>
		</select> พ.ศ.
		<select size="1" name="y_date_pay">
	<?
        $year=$y[0];
		$thai_year=$year+543;
		$year1=$year+1;
		$thai_year1=$thai_year+1;
		$year2=$year-1;
		$thai_year2=$thai_year-1;
		echo"<option value=\"$year\">$thai_year</option>";
		echo"<option value=\"$year\">-----</option>";
		echo"<option value=\"$year1\">$thai_year1</option>";
		echo"<option value=\"$year2\">$thai_year2</option>";
?>	
		</select>
		(<? echo thaidate($date_pay);?>)</td>
	</tr>
	<tr>
		<td width="206">วันที่จัดส่ง</td>
		<td><select size="1" name="d_date_sent">
	<?
     $z=explode("-",$date_sent);
     $d_date_sent=$z[2];
	 echo "<option value=\"$d_date_sent\">$d_date_sent</option>";
	 echo "<option value=\"$d_date_sent\">--</option>";
?>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		</select> เดือน
		<select size="1" name="m_date_sent">
<?     $m_date_sent=intval($z[1]);
         switch ($m_date_sent)
		 {
			 case 0 : echo "<option value=\"0\">ยังไม่ระบุ</option>"; break;
			 case 1 : echo "<option value=\"1\">มกราคม</option>"; break;
			 case 2 : echo "<option value=\"2\">กุมภาพันธ์</option>"; break;
			 case 3 : echo "<option value=\"3\">มีนาคม</option>"; break;
			 case 4 : echo "<option value=\"4\">เมษายน</option>"; break;
			 case 5 : echo "<option value=\"5\">พฤษภาคม</option>"; break;
			 case 6 : echo "<option value=\"6\">มิถุนายน</option>"; break;
			 case 7 : echo "<option value=\"7\">กรกฎาคม</option>"; break;
			 case 8 : echo "<option value=\"8\">สิงหาคม</option>"; break;
			 case 9 : echo "<option value=\"9\">กันยายน</option>"; break;
			 case 10 : echo "<option value=\"10\">ตุลาคม</option>"; break;
			 case 11 : echo "<option value=\"11\">พฤศจิกายน</option>"; break;
			 case 12 : echo "<option value=\"12\">ธันวาคม</option>"; break;
		 }
		 echo "<option value=\"$m_date_sentr\">-----------</option>";
		?>
		<option value="1">มกราคม</option>
		<option value="2">กุมภาพันธ์</option>
		<option value="3">มีนาคม</option>
		<option value="4">เมษายน</option>
		<option value="5">พฤษภาคม</option>
		<option value="6">มิถุนายน</option>
		<option value="7">กรกฎาคม</option>
		<option value="8">สิงหาคม</option>
		<option value="9">กันยายน</option>
		<option value="10">ตุลาคม</option>
		<option value="11">พฤศจิกายน</option>
		<option value="12">ธันวาคม</option>
		</select> พ.ศ.
		<select size="1" name="y_date_sent">
	<?
        $year=$y[0];
		$thai_year=$year+543;
		$year1=$year+1;
		$thai_year1=$thai_year+1;
		$year2=$year-1;
		$thai_year2=$thai_year-1;
		echo"<option value=\"$year\">$thai_year</option>";
		echo"<option value=\"$year\">-----</option>";
		echo"<option value=\"$year1\">$thai_year1</option>";
		echo"<option value=\"$year2\">$thai_year2</option>";
?>			
		</select>
		(<? echo thaidate($date_sent);?>)</td>
	</tr>
	<tr>
		<td width="206">รายการสินค้า</td>
		<td>
<?	
					  $cc=explode("@",$item);
		      		  $i=0;$order="";
			          do {
				             $ss=explode("=",$cc[$i]);
							 $id_product=$ss[0];
                             $sql2="SELECT * FROM product WHERE id='$id_product' "; 
                             $result2=mysql_db_query($_dbname,$sql2);
		                     while($record2=mysql_fetch_array($result2)) {
       	                           $name=$record2[name];
       	                           $price=$record2[price];
       	                           $price_pro=$record2[price_pro];
       	                           $promotion=$record2[promotion];
                             }
							 if ($promotion=="1") {$price=$price_pro;}
							 $price=$price*$ss[1];
 		                     if ($i != 0) {$order .= "$i. )$name ราคา $price บาท,จำนวน $ss[1] ชิ้น <br>";}
				             $i++; 
				            }
			          while ($cc[$i] != null);
                      $order .= "================================<br>ค่าจัดส่งราคา $xems บาท";
					  echo $order;
?>                 
		
		</td>
	</tr>
		<tr>
		<td width="206">คอมเม้นท์สินค้า</td>
		<td><?=$comment?></td>
	</tr>
</table>
	<p align="center"><input type="submit" value="จัดเก็บการเปลี่ยนแปลงคำสั่งซื้อ" name="save"></p>
	</FORM>
	<?include"../foot.php";?>
</body>
<? mysql_close($conn);  ?>
</html>