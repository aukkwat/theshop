<?                ob_start();
                    include "config.php";
 	                if (!isset($_COOKIE["s_member"])){
                     setcookie("member","", time()-(60*60*24*15), "/", false, 0);
                     header("Content-Type: text/html; charset=UTF-8");
					 $u_name="XXXXX";
					 $u_surname="XXXXXXXXX";
                     $u_date_order="xx xxxxxxx xxxx";
                     $u_order_no="XXX";
					 $status=9;
                     $date_order="0000-00-00";
                     $date_pay="0000-00-00";
    	             $date_sent="0000-00-00";
					 $ems="ยังไม่มีเลข EMS";
					}else{
						    $member=$_COOKIE["member_id"];
							$sql="SELECT * FROM user WHERE id='$member' "; 
                            $result=mysql_db_query($_dbname,$sql);
                            while($record=mysql_fetch_array($result)) {
                    	              $u_id=$record[id];
                       	              $u_name=$record[name];
                       	              $u_surname=$record[surname];
                       	              $u_date_order=$record[date_order];
 							}
                            $sql="SELECT * FROM order_data WHERE id_user='$member' ORDER BY id DESC LIMIT 0,1 "; 
                            $result=mysql_db_query($_dbname,$sql);
							$total=mysql_num_rows($result);
							if ($total != 1){$status=8;$date_order="0000-00-00";$date_pay="0000-00-00";$date_sent="0000-00-00";$ems="ยังไม่มีเลข EMS";$u_order_no="XXX"; }
							if ($total == 1){
                            while($record=mysql_fetch_array($result)) {
                    	              $u_order_no=$record[id];
                    	              $status=$record[status];
                       	              $date_order=$record[date_order];
                       	              $date_pay=$record[date_pay];
                       	              $date_sent=$record[date_sent];
                      	              $ems=$record[ems];
							}//end while
							}//end if
                    }
  							if ($ems=="") {$ems="ยังไม่มีเลข EMS";}
							if ($u_order_no=="") {$u_order_no="XXX";}
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
    $item_name=$record[item];
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
<body>


<? include "function.php"; ?>
<center>
<table border="1" width="100%" bgcolor="#000080" bordercolor="#FFFF00" height="108">
	<tr>
		<td align="center" width="158" height="32">
		<font color="#FFFF00"><b>ชื่อ</b></font></td>
		<td align="center" width="128" height="32">
		<font color="#FFFF00"><b>สถานะ</b></font></td>
		<td align="center" width="87" height="32">
		<font color="#FFFF00"><b>วันสั่งซีดี</b></font></td>
		<td align="center" width="82" height="32">
		<font color="#FFFF00"><b>วันโอนเงิน</b></font></td>
		<td align="center" width="76" height="32">
		<font color="#FFFF00"><b>วันส่งซีดี</b></font></td>
		<td align="center" height="32"><font color="#FFFF00"><b>เลข EMS</b></font></td>
		<td align="center" width="57" height="32"><font color="#FFFF00">
		<b>รหัส Order</b></font></td>
	</tr>
	<tr>
		<td align="center" width="158"><font color="#00FF00" size="2"><b><? echo "คุณ ".$u_name." ".$u_surname;?></b></font></td>
		<td align="center" width="128"><font color="#00FFFF" size="2"><b>
		<?
		switch ($status){
          case 0:echo "เพิ่งสั่งซีดี.";break;
          case 1:echo "แจ้งการโอนเงินแล้ว.";break;
          case 2:echo "เตรียมจัดส่ง.";break;
          case 3:echo "จัดส่งแล้ว.";break;
          case 4:echo "ได้รับซีดีแล้ว.";break;
          case 8:echo "ไม่เคยสั่งซื้อ";break;
		  case 9:echo "ยังไม่ระบุ";break;
         }
		?>
		</b></font></td>
		<td align="center" width="85"><font color="#FFFFFF" size="2"><b><? echo thaidate($date_order);?></b></font></td>
		<td align="center" width="85"><font color="#FFFFFF" size="2"><b><? echo thaidate($date_pay);?></b></font></td>
		<td align="center" width="85"><font color="#FFFFFF" size="2"><b><? echo thaidate($date_sent);?></b></font></td>
		<td align="center"><font color="#00FFFF" size="2"><b><?=$ems;?></b></font></td>
		<td align="center" width="57"><font color="#00FF00"><b><?=$u_order_no?></b></font></td>
	</tr>
</table>

</center>
<p><b><font color="#00FF00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</font>
ในกรณีเข้ามาครั้งแรกจะไม่เห็นข้อมูลใดๆเนื่องจากยังไม่ได้ตั้งค่า Cookie
ในบราวเซอร์ของคุณ ระบบจะแสดงคำสั่งซื้อล่าสุดของคุณกรณีที่คุณสั่งซื้อแล้ว
</b></p>
<hr>
<p align="center"><b><font size="5" color="#FFFF00">
<span style="background-color: #0000FF">
รายชื่อล่าสุดผู้สั่งสินค้าและสถานะพร้อมการตรวจสอบ แสดงครั้งละ <?=$item_name?> รายการ</font></b></p>
<center>


<table border="1" width="90%" id="table1">
	<tr>
		<td bgcolor="#0000FF" width="90" align="center"><b>
		<font color="#FFFF00">รหัส Order</font></b></td>
		<td bgcolor="#0000FF" align="center"><b>
		<font color="#FFFF00">ชื่อผู้สั่ง</font></b></td>
		<td bgcolor="#0000FF" width="150" align="center"><b><font color="#FFFF00">
		สถานะ</font></b></td>
		<td bgcolor="#0000FF" width="280" align="center"><b>
		<font color="#FFFF00">ตรวจสถานะ EMS</font></b></td>
	</tr>
<?
							$sql="SELECT * FROM order_data ORDER BY id DESC LIMIT 0,$item_name"; 
                            $result=mysql_db_query($_dbname,$sql);
                            while($record=mysql_fetch_array($result)) {
                    	              $id=$record[id];
                       	              $id_user=$record[id_user];
									  $status=$record[status];
									  $o_ems=$record[ems];
                                              $sql2="SELECT * FROM user WHERE id='$id_user' "; 
                                              $result2=mysql_db_query($_dbname,$sql2);
                                              while($record2=mysql_fetch_array($result2)) {
												  $name=$record2[name];
												  $po=$record2[po];
											  }
                          	echo"
	                               <tr>
		                                  <td bgcolor=\"#FFFF00\" width=\"90\" align=\"center\"><b>$id</b></td>
		                                  <td bgcolor=\"#FFFF00\" align=\"center\"><b>คุณ $name <br>[$po]</b></td>
		                                  <td bgcolor=\"#FFFF00\" width=\"150\" align=\"center\"><b>";
						   switch ($status) {
                             case 0 : echo "สั่งใหม่";break;  //สั่งใหม่
                             case 1 : echo "แจ้งการโอนเงินแล้ว";break;   //โอนเงิน
                             case 2 : echo "เตรียมการจัดส่ง";break;   //เตรียมส่ง
                             case 3 : echo "จัดส่งแล้ว";break;   //ส่งแล้ว
                             case 4 : echo "ได้รับซีดีแล้ว";break;   //รับแล้ว
						   }
                            if ($o_ems==""){
			                 echo"
							      </b></td>
		                                  <td bgcolor=\"#FFFF00\" width=\"280\" align=\"center\">
										  <input type=\"button\" value=\"ยังไม่มีเลขพัสดุ EMS\"   </td></tr>";}
			
?>

<form name="o_ems" method="post" action="check_ems.php" i>

<?
	                 if ($o_ems != ""){
			                 echo"

						      </b></td>
		                                  <td bgcolor=\"#FFFF00\" width=\"280\" align=\"center\">
										  <input type=\"submit\" value=\"$o_ems\" name=\"o_ems\" >
		                                  </td></tr>";}
							}
?>
</table>
</form>
</center>
<?include"foot.php";?>
</body>
</html>
<? ob_end_flush();mysql_close($conn); ?>
<!--- โปรแกรมโดย Somsak2004  -->