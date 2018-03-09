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
<table border="1" width="100%" id="table1">
<?
$id=$_GET['id'];
if (isset($_COOKIE["s_member"])) {echo"<form action=\"menu2.php?id=$id\" target=\"menu\" method=\"post\">";}else{
	echo"<form action=\"menu.php?id=$id\" target=\"menu\" method=\"post\">";}
$sql="select * from product WHERE id='$id' "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$id=$record[id];
	$id_cat=$record[id_cat];
	$name=$record[name];
	$price=$record[price];
	$price_pro=$record[price_pro];
	$pic1=$record[pic1];
	$pic2=$record[pic2];
	$pic3=$record[pic3];
	$pic4=$record[pic4];
	$pic5=$record[pic5];
	$detail=$record[detail];
}
$sql="select * from cat_product WHERE id='$id_cat' "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$name_cat=$record[name];
}
?>
	<tr>
		<td bgcolor="#C0C0C0">
		<p align="center"><b>ชื่อสินค้า : <?=$name?></b></font></td>
	</tr>
</table>
<body>
<table border="1" width="100%" id="table2">
	<tr>
		<td>
<?
$num=0;
		if ($pic1 != "nopic.jpg"){ echo "
		<p align=\"center\">
        <a href=\"images/products/$pic1\" class=\"highslide\" onclick=\"return hs.expand(this)\" title=\"ดูภาพขยาย\">
		<img border=\"0\" src=\"images/products/$pic1\" width=\"115\" height=\"90\"></a></td>
		<td> ";$num++;}
        if ($pic2 != "nopic.jpg"){ echo "
		<p align=\"center\">
        <a href=\"images/products/$pic2\" class=\"highslide\" onclick=\"return hs.expand(this)\" title=\"ดูภาพขยาย\">
		<img border=\"0\" src=\"images/products/$pic2\" width=\"115\" height=\"90\"></a></td>
		<td>";$num++;}
		if ($pic3 != "nopic.jpg"){ echo "
		<p align=\"center\">
        <a href=\"images/products/$pic3\" class=\"highslide\" onclick=\"return hs.expand(this)\" title=\"ดูภาพขยาย\">
		<img border=\"0\" src=\"images/products/$pic3\" width=\"115\" height=\"90\"></a></td>
		<td>";$num++;}
		if ($pic4 != "nopic.jpg"){ echo "
		<p align=\"center\">
        <a href=\"images/products/$pic4\" class=\"highslide\" onclick=\"return hs.expand(this)\" title=\"ดูภาพขยาย\">
		<img border=\"0\" src=\"images/products/$pic4\" width=\"115\" height=\"90\"></a></td>
		<td>";$num++;}
		if (($pic5 != "nopic.jpg") || ($num==0)){ echo "
		<p align=\"center\">
        <a href=\"images/products/$pic5\" class=\"highslide\" onclick=\"return hs.expand(this)\" title=\"ดูภาพขยาย\">
		<img border=\"0\" src=\"images/products/$pic5\" width=\"115\" height=\"90\"></a></td>";}
?>
	</tr>
</table>
<table border="1" width="100%" id="table3">
	<tr>
		<td width="423"><b>หมวดสินค้า : <?=$name_cat?></b></td>
		<td><b>ราคาปกติ : <font size="4" color="#000099"><?=$price?> </font>
		บาท</b> ราคาโปรโมชั่น <font size="5" color="#FF0000"><b><?=$price?></b></font>บาท</td>
	</tr>
</table>
<table border="1" width="100%" id="table4">
	<tr>
		<td bgcolor="#C0C0C0">
		<p align="center">รายละเอียดสินค้า</td>
	</tr>
	<tr>
		<td><?=$detail?></td>
	</tr>
</table>
	    <p align="center"><input type="submit" value="หยิบสินค้านี้เข้าสู่ตะกร้าสินค้า" name="B1"></p>
        </form>
<?include"foot.php";?>
</body>
</html>