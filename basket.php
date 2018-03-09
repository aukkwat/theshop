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
    $ems=$record[ems];
} 

$act=$_GET['act'];
if ($act=="update") {
			$xx=$_COOKIE["s_cart"];
		    $item=explode("@",$xx);
			$i=0;$order="";
			do {
				$ss=explode("=",$item[$i]);
				$count[$i]="count".$i;
				$post[$i]=strval($_POST[$count[$i]]);
				if ($post[$i]==null) {$post[$i]="0";}
 				$order .= "$ss[0]=$post[$i]@";
				$i++; 
				}
			while ($item[$i] != null);
			$i=$i-1;
			setcookie("s_cart","$order", time()+(60*60*24*15), "/", false, 0);
    	    echo"<meta http-equiv=\"refresh\" content=\"0;URL=basket.php\" target=\"_self\"> ";
}
if ($act=="delete") {
	$id=$_GET['id'];
			$xx=$_COOKIE["s_cart"];
		    $item=explode("@",$xx);
    		$i=0;$order="";
			do {
				$ss=explode("=",$item[$i]);
				if ($ss[0]!=$id) {$order .= "$ss[0]=$ss[1]@";}
				$i++; 
				}
			while ($item[$i] != null);
			setcookie("s_cart","$order", time()+(60*60*24*15), "/", false, 0);
    	    echo"<meta http-equiv=\"refresh\" content=\"0;URL=basket.php\" target=\"_self\"> ";
}
?>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
</head>
<body>
<?  
$list=$_COOKIE["s_cart"];
$item=explode("@",$list);
$i=0;	do {$item[$i];$i++;}while ($item[$i] != null);$i=$i-1;

?>
<table border="1" width="100%" bgcolor="#0000FF" id="table1">
	<tr>
		<td align="center"><font color="#FFFF00"><b>
		ตะกร้าสินค้าของคุณ มี <?=$i?> รายการ</b></font></td>
	</tr>
</table>
<table border="1" width="100%" id="table2">
	<tr>
		<td align="center" bgcolor="#C0C0C0" width="40"><b>ลบ</b></td>
		<td align="center" bgcolor="#C0C0C0" width="60"><b>รหัส</b></td>
		<td align="center" bgcolor="#C0C0C0" width="370"><b>	รายการ</b></td>
		<td align="center" bgcolor="#C0C0C0" ><b>จำนวน</b></td>
		<td align="center" bgcolor="#C0C0C0" width="180"><b>มูลค่า</b></td>
	</tr>
<form action="basket.php?act=update" method="post" >
<?
					$list=$_COOKIE["s_cart"];
					$item=explode("@",$list);
                    $i=0;$ii=1;	
					do {
						$num=explode("=",$item[$i]);
						$i++;$ii++;
						}while ($item[$i] != null);$i--;
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

	echo"
	<tr>
		<td width=\"40\" align=\"center\"><a href=\"basket.php?act=delete&id=$id_product\">
		<img border=\"0\" src=\"images/ed_delete.gif\" width=\"18\" height=\"18\"></a></td>
		<td width=\"60\" align=\"center\"><b>$id_product</b></td>
		<td align=\"center\" width=\"370\"><b>$name</b></td>
		<td align=\"center\" ><input type=\"text\" name=\"count$s\" size=\"5\" value=\"$number\"></td>
		<td align=\"center\" width=\"180\"><b>$total</b></td>
	</tr>
	";
	$net += $total;
	$net += $ems;
}
?>
</table>
<table border="1" width="100%" id="table3">
	<tr>
		<td align="right"><font color="#0000FF"><b>ค่าจัดส่ง</b></font></td>
		<td width="180" align="center"><font color="#0000FF"><b><?=$ems?></b></font></td>
	</tr>
	<tr>
		<td align="right" bgcolor="#C0C0C0"><b><font size="4">รวมทั้งหมด</font></b></td>
		<td width="180" align="center" bgcolor="#C0C0C0"><b><font size="4"><?=$net?></font></b></td>
	</tr>
</table>
	<table border="1" width="100%" id="table4">
		<tr>
			<td>
			<p align="center">
			<input type="submit" value="ปรับปรุงตะกร้าสินค้า" name="B3"></td>
			</form>
			<td>
			<p align="center">
			<form action="product.php" method="post" >
			<input type="submit" value="กลับไปหน้าซื้อของต่อ" name="B2"></td>
          </form>
		</tr>
</table>
	<form action="checkout.php" method="post" >
	<p align="center"><input type="submit" value="เข้าสู่หน้าสั่งซื้อของรายการในตะกร้านี้" name="B1"></p>
	</form>
<?include"foot.php";?>
</body>
<? ob_end_flush();mysql_close($conn);  ?>
</html>