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
} 

$search=$_GET['search'];
$page=$_GET['page'];
$sql2="select * from product WHERE name LIKE '%$search%' and detail  LIKE '%$search%' ORDER BY name"; 
$result2=mysql_db_query($_dbname,$sql2);
$total=mysql_num_rows($result2);
$pagelen=10; //กำหนด ให้แสดง  10 ชื่อต่อหน้า
if ($page=="") {$page=1;}
$totalpage=ceil($total/$pagelen);
$goto=($page-1)*$pagelen;
$next=$page+1;if ($next>$total) {$next=$total;}
$back=$page-1;if ($back<1){$back=1;}

?>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<script type="text/javascript" src="highslide/highslide.js"></script>
<script type="text/javascript">
    hs.graphicsDir = 'highslide/graphics/';
</script>
<title><? echo $title; ?></title>
<LINK HREF="style.css" REL="stylesheet" TYPE="text/css">
</head>
<body>
<table border="1" width="100%" id="table1">
	<tr>
		<td bgcolor="#0000FF"><font color="#FFFF00">หน้าการค้นหา &nbsp; หน้า
		<b><?=$page?>/<?=$totalpage?> </b> <b>&nbsp; &nbsp;</font>
		<? if ($page>1) {echo"
		<a href=\"search.php?page=$back\"><img border=\"0\" src=\"images/arrow_left.gif\" width=\"16\" height=\"16\"></a>";}?>
		
		<img border="0" src="images/ed_charmap.gif" width="18" height="18">
		<? if ($page<$totalpage) {echo"
		<a href=\"search.php?page=$next\"><img border=\"0\" src=\"images/arrow_right.gif\" width=\"16\" height=\"16\"></a>";}?>
		
		</td>
	</tr>
	<tr>
		<td bgcolor="#0000FF"><font color="#FFFF00">ผลการค้นหาพบ 
		<b><font size="4"><?=$total?></font></b> รายการ</font></td>
	</tr>
</table>
<table border="1" width="100%" id="table2">
	<tr>
		<td width="87" align="center" bgcolor="#C0C0C0" height="25">รหัส</td>
		<td width="487" align="center" bgcolor="#C0C0C0" height="25">ชื่อ</td>
		<td align="center" bgcolor="#C0C0C0" height="25">รูป</td>
		<td width="134" align="center" bgcolor="#C0C0C0" height="25">ราคา</td>
	</tr>
<?
$sql2="select * from product WHERE name LIKE '%$search%' and detail  LIKE '%$search%' ORDER BY name LIMIT $goto,$pagelen"; 
$result2=mysql_db_query($_dbname,$sql2);
while($record=mysql_fetch_array($result2)) {
	$id=$record[id];
	$name=$record[name];
	$price=$record[price];
	$pic1=$record[pic1];
	$promotion=$record[promotion];
	$price_pro=$record[price_pro];
    if ($promotion==1) {$pro="<br><font color=\"#0000FF\" size=\"2\">ราคาโปรโมชั่น</font><br><b><font size=\"4\" color=\"#FF0000\">$price_pro</font></b>";}else{$pro="";}
    echo"
	<tr>
		<td width=\"87\">
		<p align=\"center\">$id</td>
		<td width=\"487\">
		<p align=\"center\"><a href=\"product3.php?id=$id\">$name</a></td>
		<td>
		<p align=\"center\">
        <a href=\"images/products/$pic1\" class=\"highslide\" onclick=\"return hs.expand(this)\" title=\"ดูภาพขยาย\">
		<img border=\"0\" src=\"images/products/$pic1\" width=\"115\" height=\"90\"></a></td>
		<td width=\"134\">
		<p align=\"center\"><b><font size=\"4\">$price$pro</font></b></td>	</tr>";
}

?>
</table>
</body>
<? ob_end_flush();mysql_close($conn);  ?>
</html>
<!-- โดย Somsak2004 -->