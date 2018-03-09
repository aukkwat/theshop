<? 
@session_start();
   if ($_SESSION["admin"] != "admin") {    		  						
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";die;
}
include "../config.php"; 
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
	$logo=$record[logo];
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
<?
$id_product=$_GET['id_product'];
$act=$_GET['act'];
$page=$_GET['page'];
$sql2="select * from product WHERE promotion='1' ORDER BY name "; 
$result2=mysql_db_query($_dbname,$sql2);
$total_price=mysql_num_rows($result2);
$pagelen=30; //กำหนด ให้แสดง  30 ชื่อต่อหน้า
if ($page=="") {$page=1;}
$totalpage=ceil($total_price/$pagelen);
$goto=($page-1)*$pagelen;
$next=$page+1;if ($next>$total) {$next=$total;}
$back=$page-1;if ($back<1){$back=1;}
   if ($act=="delete")
   {
           $sql5 = "DELETE  FROM product  WHERE id='$id_product' ";
           $dbquery = mysql_query( $sql5);
           echo "<meta http-equiv='refresh' content='0;URL=$PHPSELF?page=$page&id_cat=$id_cat&act='>";
   }
?>
<div align="center">
	<table border="1" width="90%" id="table2">
		<tr>
			<td bgcolor="#0000FF">
			<p align="center"><font size="4" color="#FFFF00">
			<u>
			<b>รายการสินค้าโปรโมชั่น มี <?=$total_price?> รายการ</b></u></font><font size="4" color="#FFFF00"> </font>
			<font size="5" color="#FFFF00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
			<? if ($page>1) {echo"
			<a href=\"product2.php?id_cat=$id_cat&page=$back\" title=\"ย้อนกลับหน้าที่แล้ว\">
			<img border=\"0\" src=\"images/arrow_left.gif\" width=\"16\" height=\"16\"></a>";}?>
			<img border="0" src="images/ic_calender.gif" width="20" height="20">
			<? if ($page<$totalpage) {echo"
			<a href=\"product2.php?id_cat=$id_cat&page=$next\" title=\"ไปหน้าต่อไป\">
			<img border=\"0\" src=\"images/arrow_right.gif\" width=\"16\" height=\"16\"></a>";}?>
						
			<font size="5" color="#FFFF00">
			&nbsp; </font><font size="4" color="#FFFF00">
			หน้าที่</font><font size="5" color="#FFFF00">
			</font><b><font size="5" color="#FFFF00">
			<?=$page?>/<?=$totalpage?></font></b></td>
		</tr>
	</table>
		<table border="1" width="90%" id="table4">
		<tr>
			<td width="74" align="center" bgcolor="#669999"><b>รหัส</b></td>
			<td align="center" bgcolor="#669999"><b>ชื่อสินค้า</b></td>
			<td width="107" align="center" bgcolor="#669999"><b>ราคา</b></td>
			<td width="52" align="center" bgcolor="#669999"><b>ลบ</b></td>
		</tr>
<?
$sql="select * from product WHERE promotion='1' ORDER BY name LIMIT $goto,$pagelen "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$id_product=$record[id];
	$name_product=$record[name];
	$price=$record[price];
echo"
		<tr>
			<td width=\"74\" align=\"center\"><b>$id_product</b></td>
			<td align=\"center\"><b><a href=\"edit_product.php?id=$id_product\" title=\"ไปแก้ไขสินค้า $name_product\">
			$name_product</a></b></td>
			<td width=\"107\" align=\"center\"><b>$price</b></td>
			<td width=\"52\" align=\"center\">
			<a href=\"promotion.php?id_product=$id_product&act=delete&page=$page\" title=\"ลบสินค้ารายการนี้\">
			<img border=\"0\" src=\"images/ed_delete.gif\" width=\"18\" height=\"18\"></a></td>
		</tr>	";
}	
?>
		
		</table>
</div>
</body>
<?include"../foot.php";?>
<? mysql_close($conn); ?>
</html>
<!--- โปรแกรมโดย Somsak2004  -->