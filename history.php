<? ob_start();
                    include "config.php";include "function.php"; 
	                if (!isset($_COOKIE["s_member"])){
                     setcookie("s_member","", time()-(60*60*24*15), "/", false, 0);
                     header("Content-Type: text/html; charset=utf-8");
					}
					
?>
<html>
<head>
<meta http-equiv="Content-Language" content="th">
<? 
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
	$ems=$record[ems];
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
<p align="center"><font color="#0000FF"><u><b>ประวัติการสั่งซื้อสินค้าของคุณ</b></u></font></p>
<table border="1" width="100%" id="table1">
	<tr>
		<td align="center" bgcolor="#C0C0C0" width="90"><b>รหัส
		Order</b></td>
		<td align="center" bgcolor="#C0C0C0" width="180"><b>สถานะ</b></td>
		<td align="center" bgcolor="#C0C0C0" width="201"><b>จำนวนเงิน</b></td>
		<td align="center" bgcolor="#C0C0C0"><b>รายการ</b></td>
		<td align="center" bgcolor="#C0C0C0" width="141"><b>วันสั่งซื้อ</b></td>
	</tr>
	<?
        $member=$_COOKIE["member_id"];
        $sql="SELECT * FROM order_data WHERE id_user='$member' ORDER BY id DESC"; 
        $result=mysql_db_query($_dbname,$sql);
        $total=mysql_num_rows($result);
        if ($total < 1) {echo "<br><br><center><b><h1>ไม่เคยมีประวัติการสั่งซื้อของคุณ</h1></b></center>";die;
		}else{
		while($record=mysql_fetch_array($result)) {
       	              $u_order_no=$record[id];
       	              $status=$record[status];
       	              $date_order=$record[date_order];
       	              $x_price=$record[price];
       	              $item=$record[item];
					  if ($status==0){$status="เพิ่งสั่งซื้อ";}
					  if ($status==1){$status="แจ้งการโอนเงิน";}
					  if ($status==2){$status="เตรียมการจัดส่ง";}
					  if ($status==3){$status="จัดส่งแล้ว";}
					  if ($status==4){$status="ได้รับสินค้าแล้ว";}
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
                     $order .= "================================<br>ค่าจัดส่งราคา $ems บาท <br>================================";
					  echo"
	                          <tr>
		                            <td width=\"90\" align=\"center\">$u_order_no</td>
		                            <td width=\"180\" align=\"center\">$status</td>
		                            <td width=\"201\">
		                                  <p align=\"center\"><b>$x_price</b></td>
		                            <td>$order</td>
		                            <td width=\"141\">
		                                   <p align=\"center\"><font size=\"2\">".thaidate($date_order)."</font></td>
	                                </tr>";
		                 }  //end while
		} // end if
	?>
</table>
<?include"foot.php";?>
</body>
<? ob_end_flush();mysql_close($conn);  ?>
</html>
<!-- โดย Somsak2004 -->