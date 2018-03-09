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
	$welcome=$record[welcome];
	$home=$record[home];
	$data=$record[data];
	$term=$record[term];
    $cols=$record[cols];
} 
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
</head>
<body>
<?
$id_cat=$_GET['id_cat'];
$page=$_GET['page'];
$sql3="select * from product WHERE id_cat='$id_cat' and promotion='0' order by name "; 
$result3=mysql_db_query($_dbname,$sql3);
$total=mysql_num_rows($result3);
while($record3=mysql_fetch_array($result3)) {
	$id=$record3[id];
	$name=$record3[name];
	$price=$record3[price];
	$pic1=$record3[pic1];
	$pic2=$record3[pic2];
	$pic3=$record3[pic3];
	$pic4=$record3[pic4];
	$pic5=$record3[pic5];
}
$sql2="select * from cat_product WHERE id='$id_cat' "; 
$result2=mysql_db_query($_dbname,$sql2);
while($record2=mysql_fetch_array($result2)) {
	$cat_name=$record2[name];
}
$pagelen=30; //กำหนด ให้แสดง  30 ชื่อต่อหน้า
if ($page=="") {$page=1;}
$totalpage=ceil($total/$pagelen);
$goto=($page-1)*$pagelen;
$next=$page+1;if ($next>$total) {$next=$total;}
$back=$page-1;if ($back<1){$back=1;}
?>
<table border="1" width="100%" bgcolor="#0000FF" id="table1">
	<tr>
		<td>
		<p align="center"><font color="#FFFF00" size="4">สินค้าในหมวด : <?=$cat_name?> มี  
		</font><font color="#00FF00" size="4"><b><?=$total?></b></font><font color="#FFFF00" size="4"> รายการ,หน้า  
		</font><font color="#FFFFFF" size="4"><b><?=$page?>/<?=$totalpage?></b></font><font color="#FFFF00" size="4">&nbsp;&nbsp;
        <? if ($page>1) {echo"
		<a href=\"$PHPSELF?id_cat=$id_cat&page=$back\" title=\"ย้อนกลับหน้าที่แล้ว\">
		<img border=\"0\" src=\"images/arrow_left.gif\" width=\"16\" height=\"16\">";}?>
		<img border="0" src="images/ed_charmap.gif" width="18" height="18">
	    <? if ($page<$totalpage) {echo"
		<a href=\"$PHPSELF?id_cat=$id_cat&page=$next\" title=\"ไปหน้าต่อไป\">
		<img border=\"0\" src=\"images/arrow_right.gif\" width=\"16\" height=\"16\"> ";}?>


		</font></td>
	</tr>
</table>
<table border="1" width="100%" id="table2">
<?
$sql="select * from product WHERE id_cat='$id_cat' and promotion='0' ORDER BY name LIMIT $goto,$pagelen "; 
$result=mysql_db_query($_dbname,$sql);
$total=mysql_num_rows($result);
$num=1;
if ($total<=$cols) {$loop=$total;} else {$loop=$cols;}
while($record=mysql_fetch_array($result)) {
	$id=$record[id];
	$name=$record[name];
	$price=$record[price];
	$pic1=$record[pic1];
	$pic2=$record[pic2];
	$pic3=$record[pic3];
	$pic4=$record[pic4];
	$pic5=$record[pic5];
    if ($num==1) {echo"<tr>";}
     echo "
		<td>
        <a href=\"images/products/$pic1\" class=\"highslide\" onclick=\"return hs.expand(this)\" title=\"ดูภาพขยาย\">
		<p align=\"center\">
		<img border=\"0\" src=\"images/products/$pic1\" width=\"115\" height=\"90\" align=\"center\"></a>";
		if (isset($_COOKIE["s_member"])) {echo"<form action=\"menu2.php?id=$id\" target=\"menu\" method=\"post\">";}else{
			echo"<form action=\"menu.php?id=$id\" target=\"menu\" method=\"post\">";}
      echo"
		<input type=\"submit\" value=\" หยิบใส่ตะกร้า \" name=\"B2\">
		</form>
		ชื่อสินค้า :<b>$name</b><br>ราคา : <b>$price</b> บาท<br>
		<form action=\"product3.php?id=$id\" method=\"post\">
		<input type=\"submit\" value=\"ดูรายละเอียด\" name=\"B1\">
		</form></td></p>";
      if (($num==$cols) || ($num==$loop)) {echo"</tr>";$num=0;}
	  $num++;
       }
?>
</table>
<?include"foot.php";?>
</body>
</html>
