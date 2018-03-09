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

$_SESSION["admin"] = "admin";
$page=$_GET['page'];
$sql2="select * from order_data"; 
$result2=mysql_db_query($_dbname,$sql2);
$total=mysql_num_rows($result2);
$pagelen=30; //กำหนด ให้แสดง  30 ชื่อต่อหน้า
if ($page=="") {$page=1;}
$totalpage=ceil($total/$pagelen);
$goto=($page-1)*$pagelen;
$next=$page+1;if ($next>$total) {$next=$total;}
$back=$page-1;if ($back<1){$back=1;}
$act = $_GET['act'];
   if ($act=="delete")
   {       $id=$_GET['id'];
           $sql5 = "DELETE  FROM order_data  WHERE id='$id' ";
           $dbquery = mysql_query( $sql5);
           echo "<meta http-equiv='refresh' content='0;URL=$PHPSELF?page=$page&act='>";
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
<script type="text/javascript" src="flashobject.js"></script>
</head>
<body bgcolor="#C0C0C0">
<p align="center"><u><font size="5">รายการคำสั่งซื้อล่าสุด</font></u><font size="5"> </font>
<font size="4" color="#0000FF">มี </font><b><font size="4">
<?=$total?></font></b><font size="4" color="#0000FF"> </font>
<font size="4" color="#0000FF">รายการ หน้า </font><font size="4"><b>
<?=$page?>/<?=$totalpage?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;</b></font>
<? if ($page>1) {echo"
<b><font size=\"1\" color=\"#0000FF\"><a href=\"user.php?page=1\">[หน้าแรก]</a></font></b>";}?>
<font size="4" color="#0000FF">&nbsp;&nbsp;
<? if ($page>1) {echo"
<a href=\"user.php?page=$back\"><img border=\"0\" src=\"images/arrow_left.gif\" width=\"16\" height=\"16\"></a>";}?>
&nbsp;&nbsp;
</font><u><font size="5">
<img border="0" src="images/b6.gif" width="46" height="45"></font></u><font size="4" color="#0000FF">&nbsp;
<? if ($page<$totalpage) {echo"
<a href=\"user.php?page=$next\"><img border=\"0\" src=\"images/arrow_right.gif\" width=\"16\" height=\"16\"></a>";}?>
&nbsp;&nbsp;
</font><b><font color="#0000FF">
<? if ($page<$totalpage) {echo"
<font size=\"1\"><b><a href=\"user.php?page=$totalpage\">[หน้าสุดท้าย]</a></b></font>";}?>
<br>
<span style="background-color: #FFFF00"><font size="5">หากต้องการปรับสถานะให้กดที่เลขของรหัสสินค้า!!!</font></span></font></p>
<table border="1" width="100%" id="table1">
	<tr>
		<td align="center" bgcolor="#0000FF"><font color="#FFFF00"><b>รหัส</b></font></td>
		<td align="center" bgcolor="#0000FF" width="237"><font color="#FFFF00"><b>ชื่อผู้สั่งซื้อ</b></font></td>
		<td align="center" bgcolor="#0000FF" width="383"><font color="#FFFF00">
		<b>รายการ</b></font></td>
		<td align="center" bgcolor="#0000FF" width="80"><font color="#FFFF00">
		<b>ราคา</b></font></td>
		<td align="center" bgcolor="#0000FF" width="118"><font color="#FFFF00"><b>สถานะ</b></font></td>
		<td align="center" bgcolor="#0000FF" width="65"><font color="#FFFF00"><b>ลบทิ้ง</b></font></td>
	</tr>
<?
$sql="select * from order_data ORDER BY id DESC LIMIT $goto,$pagelen"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$id=$record[id];
	$id_user=$record[id_user];
	$xprice=$record[price];
	$status=$record[status];
	$item=$record[item];
    if ($status=="0") {$status="เพิ่งสั่งซื้อ";}
    if ($status=="1") {$status="แจ้งการโอนเงิน";}
    if ($status=="2") {$status="เตรียมจัดส่ง";}
    if ($status=="3") {$status="จัดส่งแล้ว";}
    if ($status=="4") {$status="รับสินค้าแล้ว";}
    $sql2="select * from user WHERE id='$id_user'"; 
    $result2=mysql_db_query($_dbname,$sql2);
    while($record2=mysql_fetch_array($result2)) {
	    $xname=$record2[name];
	    $surname=$record2[surname];
	}
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
                     $order .= "================================<br>ค่าจัดส่งราคา $ems บาท";


    echo"
   <tr>
		<td align=\"center\"><b><a href=\"order2.php?id=$id\" title=\"ไปแก้ไขสถานะ Order ของ $id\">$id</a></b></td>
		<td align=\"center\" width=\"237\">$xname $surname</td>
		<td align=\"left\" width=\"383\">$order</td>
		<td align=\"center\" width=\"80\">$xprice</td>
		<td align=\"center\" width=\"118\">$status</td>
		<td align=\"center\" width=\"65\"><a href=\"order.php?act=delete&id=$id\" title=\"ลบ Order นี้\" >
		<img border=\"0\" src=\"images/ed_delete.gif\" width=\"18\" height=\"18\"></a></td>
	</tr>";
}
?>
</table>
<?include"../foot.php";?>
	<? mysql_close($conn); ?>
</body>
</html>
<!--- โปรแกรมโดย Somsak2004  -->