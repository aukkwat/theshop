<? ob_start();
	                if (!isset($_COOKIE["s_member"])){
                     setcookie("s_member","", time()-(60*60*24*15), "/", false, 0);
                     header("Content-Type: text/html; charset=utf-8");
					}
                    include "config.php";include "function.php"; 
	 
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
    $name_place=$record[name_place];
	$email_shop=$record[email];
    $telephone=$record[telephone];
    $owner_name=$record[owner_name];
} 
?>
<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
</head>
<?  
$send=$_GET['send'];
if ($send=="ok") 
{    
	  $id=$_GET['id'];
	    					    $sql="SELECT * FROM order_data WHERE id='$id' ORDER BY id DESC LIMIT 0,1"; 
                                $result=mysql_db_query($_dbname,$sql);
	                            while($record=mysql_fetch_array($result)) {
                       	              $id_order=$record[id];
                       	              $status=$record[status];
                       	              $price=$record[price];
                       	              $date_order=$record[date_order];
							     }
								 $status=intval($status);
								 if ($status != 0) { echo "<br><br><center><b><h1> คำสั่งซื้อนี้ ไม่สามารถแจ้งการโอนเงินได้<br> เพราะสถานะไม่ใช่ เพิ่งสั่งซื้อ</h1></b></center>";die;}

      $bank=$_POST['bank'];

      $x_price=trim($_POST['x_price']);
      if ($x_price == "") { echo "<br><br><center><b><h1> คุณไม่ได้ใส่จำนวนเงินโอน กดเมนูแจ้งการโอนเงินใหม่!!</h1></b></center>";die;}      
	  $day=$_POST['day'];
      $month=$_POST['month'];
      $year=$_POST['year'];
	  $day_pay=$year."-".$month."-".$day;
      if (!isset($_COOKIE["s_member"])){
		  echo "<br><br><center><b><h1>ไม่มีข้อมูล กรุณาสมัครสมาชิกหรือเข้าสู่ระบบก่อน</h1></b></center>";die;
	  } else {
          $sql9="UPDATE order_data SET  status='1',value='$x_price',bank='$bank',date_pay='$day_pay' WHERE id='$id' ";
          mysql_query( $sql9) or die (mysql_error());
          				    $member=$_COOKIE["member_id"];
							$sql="SELECT * FROM user WHERE id='$member' "; 
                            $result=mysql_db_query($_dbname,$sql);
                            while($record=mysql_fetch_array($result)) {
                    	              $u_id=$record[id];
                       	              $u_name=$record[name];
                       	              $u_surname=$record[surname];
                       	              $u_date_order=$record[date_order];
  									  $u_email=$record[email];
							}
$messtext="     อีเมล์จาก $name_place เรื่องปรับสถานะ  <br> 
 <br>
ชื่อคุณ $u_name $u_surname <br>
----------------------------------------------------------------------- <br>
รหัส Order  $id_order แจ้งโอนเงินในวันที่ ".thaidate($day_pay)."<br>
----------------------------------------------------------------------- <br>  
คุณได้ทำการโอนเงินจำนวน $x_price บาท เข้าธนาคาร $bank <br>  
----------------------------------------------------------------------- <br><br>
<br>  
ขอบคุณสำหรับการชำระค่าสินค้า ตอนนี้สถานะของคำสั่งซื้อนี้เปลี่ยนเป็น แจ้งการโอนเงิน<br>  
แล้วทางร้านจะตรวจสอบ เมื่อตรวจสอบแล้วจะแจ้งสถานะเป็น เตรียมการจัดส่ง<br>
จากนั้นเมื่อส่งสินค้าทาง EMS แล้วคุณจะได้รหัสพัสดุ สามารถตรวจสอบการเดินทาง<br>
ของพัสดุในเมนู ตรวจสอบสถานะ และสถานะจะเปลี่ยนเป็น จัดส่งสินค้าแล้ว แทน<br>
---------------------------------------------------------------------------------<br>  
$owner_name<br>  
Tel : $telephone <br>
".thaidate($day_pay)."
 <br>";
							
        $header="MIME-Version: 1.0 \r\n";
        $header.="Content-Type: text/html; charset=utf-8 \r\n";
        $header.="From: $email_shop\r\n";
        $header.="Return-Path: email_shop \r\n";
        if   (mail ($u_email,"ปรับสถานะ",$messtext,$header)) {
              echo "<center><h2> ส่งข้อข้อมูลแล้ว  <br>เข้าไปตรวจเมล์ได้ครับ</h2></center>" ;
                    } else {
              echo "<center><h2> ไม่สามารถส่งเมล์</h2></center>" ;  }


$messtext1="  สมาชิกโอนเงินค่าสินค้า จำนวน $x_price บาท  <br> 
<br>
สมาชิกชื่อคุณ $u_name $u_surname <br>
----------------------------------------------------------------------- <br>
รหัส Order คือ $id_order โอนเงินมาในวันที่ ".thaidate($day_pay)."<br>
----------------------------------------------------------------------- <br>  
คุณได้ทำการโอนเงินจำนวน $x_price บาท เข้าธนาคาร $bank <br>  
----------------------------------------------------------------------- <br>
เข้าไปตรวจยอดเงินและปรับสถานะด้วย! <br>
---------------------------------------------------------------------------------<br>  
 <br><br>";
        $header1="MIME-Version: 1.0 \r\n";
        $header1.="Content-Type: text/html; charset=utf-8 \r\n";
        $header1.="From: $u_email \r\n";
        $header1.="Return-Path: $u_email \r\n";
        if   (mail ($email_shop,"โอนเงินค่าสินค้า order=$id_order",$messtext1,$header1)) {
              echo "<center><h2> ส่งข้อมูลให้ $owner_name แล้ว </h2></center>" ;
                    } else {
              echo "<center><h2>ผิดพลาด: ไม่สามารถส่งเมล์ให้ $owner_name </h2></center>" ;  }
       die;
	  }
}

if (isset($_COOKIE["s_member"])){
							    $id_user=$_COOKIE["member_id"];
							    $sql="SELECT * FROM user WHERE id='$id_user' "; 
                                $result=mysql_db_query($_dbname,$sql);
	                            while($record=mysql_fetch_array($result)) {
                       	              $u_name=$record[name];
                       	              $u_surname=$record[surname];
							     }
                               echo"
                                       <p align=\"center\">
                                       <b>สวัสดีคุณ <font color=\"#0000FF\">$u_name $u_surname </font> ";
  							    $sql="SELECT * FROM order_data WHERE id_user='$id_user' ORDER BY id DESC LIMIT 0,1"; 
                                $result=mysql_db_query($_dbname,$sql);
	                            while($record=mysql_fetch_array($result)) {
                       	              $id_order=$record[id];
                       	              $status=$record[status];
                       	              $price=$record[price];
                       	              $date_order=$record[date_order];
							     }
								 if ($status==0) {$x_status="เพิ่งสั่งซื้อ";}
								 if ($status==1) {$x_status="แจ้งการโอนเงิน";}
								 if ($status==2) {$x_status="เตรียมส่งสินค้า";}
								 if ($status==3) {$x_status="ส่งสินค้าแล้ว";}
								 if ($status==4) {$x_status="ได้รับสินค้าเรียบร้อย";}

                                 if ($id_order>1){
									 echo "มีคำสั่งซื้อล่าสุดเมื่อวันที่ ".thaidate($date_order)." สถานะ <font color=\"#0000FF\"><b>"."$x_status</b></font><br>";
                                     echo "จำนวนเงิน $price บาท หากโอนเงินเลือกธนาคารแล้วใส่จำนวนเงินที่โอนได้เลย";}

}else{
                               echo"
                                       <p align=\"center\">
                                       <b>สวัสดีคุณ <font color=\"#0000FF\">ผู้มาเยือน</font> 
                                       ไม่พบข้อมูลของคุณ Cookie ในเครื่องคุณอาจโดนลบ ให้ไป login หรือ สมัครสมาชิก<br>
                                       ก่อนนะครับ ไม่เช่นนั้น ระบบไม่สามารถทราบได้ว่าคุณเป็นใคร..<br>
									   หรือไปเมนูติดต่อเรา หรือโทรสอบถามได้ที่เบอร์ $telephone ($owner_name)</b></p>";
}
?>
<body>
<Form action="<? echo $PHP_SELF."?send=ok&id=$id_order"; ?>" method="POST" name="save" method="POST"  >
<center>
<table border="1" width="90%" bgcolor="#00FF00" bordercolor="#0000FF" id="table1" height="97">
	<tr>
		<td bgcolor="#6699FF">
		<p align="center"><font size="5"><b>แจ้งการโอนเงิน<br>
&nbsp;เลือก ธนาคาร ใส่จำนวน และ วันที่โอน</b></font></td>
	</tr>
</table>
<table border="1" width="90%" id="table2" height="136">
<tr>
		<td align="right" bgcolor="#C0C0C0" width="236"><b>คำสั่งซื้อที่ <?=$id_order?>  </b></td>
		<td bgcolor="#C0C0C0">
			<b>จำนวนเงิน <?=$price?> บาท</b>
		</td>
	</tr>

	<tr>
		<td align="right" bgcolor="#C0C0C0" width="236"><b>ธนาคารที่โอน</b></td>
		<td bgcolor="#C0C0C0">
			<p><font color="#FFFF00">
			<select size="1" name="bank" style="font-weight: 700">
<?
$sql="select * from bank ORDER BY name_bank "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$name_bank=$record[name_bank];
	$branch=$record[branch];
    echo 	"<option value=\"$name_bank\">$name_bank สาขา $branch</option>";
}
?>
			</select></font></p>
		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#C0C0C0" width="236"><b>จำนวนเงิน</b></td>
		<td bgcolor="#C0C0C0">
			<p><font color="#FFFF00">
			<input name="x_price" size="20" style="font-weight: 700"></font><b> บาท</b></p>

		</td>
	</tr>
	<tr>
		<td align="right" bgcolor="#C0C0C0" width="236"><b>วันที่โอน</b></td>
		<td bgcolor="#C0C0C0"><font color="#FFFF00">
		<select size="1" name="day" style="font-weight: 700">
		       <? 
	   $day=date("j");
	   echo"<option value=\"$day\">$day</option>"; 
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
		</select></font><b> เดือน 
		</b> 
		
		<select size="1" name="month" style="font-weight: 700">
		<?
        $month=date("n");
         switch ($month)
		 {
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
		</select><b> พ.ศ. 
		</b> <select size="1" name="year" style="font-weight: 700">
		<?
        $year=date("Y");
		$thai_year=$year+543;
		$year1=$year+1;
		$thai_year1=$thai_year+1;
		$year2=$year-1;
		$thai_year2=$thai_year-1;
		echo"<option value=\"$year\">$thai_year</option>";
		echo"<option value=\"$year1\">$thai_year1</option>";
		echo"<option value=\"$year2\">$thai_year2</option>";
?>
		</select></font></td>
	</tr>
</table>
</center>
	<p align="center"><input type="submit" value="ส่งข้อมูลการโอนเงิน" name="save"></p>
</form>
<?include"foot.php";?>
</body>
<? ob_end_flush();mysql_close($conn); ?>
</html>
<!--- โปรแกรมโดย Somsak2004  -->