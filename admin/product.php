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
<div align="center">
	<table border="1" width="84%" id="table2">
		<tr>
			<td bgcolor="#0000FF">
			<p align="center"><u><font size="5" color="#FFFF00">
			<b>เลือกหมวดสินค้า</font></b></u></td>
		</tr>
	</table>
<?	
      $sql="select * from cat_product ORDER BY name"; 
      $result=mysql_db_query($_dbname,$sql);
         while($record=mysql_fetch_array($result)) {
	             $id=$record[id];
	             $name=$record[name];
	             $pic=$record[pic];
                 $sql2="select * from product WHERE id_cat='$id' and promotion='0' "; 
                 $result2=mysql_db_query($_dbname,$sql2);
                 $totol_price=mysql_num_rows($result2);
                 $sql3="select * from product WHERE id_cat='$id' and promotion='1' "; 
                 $result3=mysql_db_query($_dbname,$sql3);
                 $totol_price_pro=mysql_num_rows($result3);

                 echo"
	            <table border=\"1\" width=\"84%\" bgcolor=\"#808080\" id=\"table3\" height=\"117\">
		        <tr>
			            <td bgcolor=\"#FFFF00\">
			            <a href=\"product2.php?id_cat=$id\" title=\"ไปดูสินค้าในหมวดสินค้า $name\">
			            <img border=\"0\" src=\"../images/products/$pic\" width=\"100\" height=\"75\" align=\"left\"></a>&nbsp;&nbsp;
			            ชื่อหมวดสินค้า : <b><a href=\"product2.php?id_cat=$id\"  title=\"ไปดูสินค้าในหมวดสินค้า $name\">$name</a></b><br>
			            &nbsp;&nbsp;==================================================<br>
			           &nbsp;&nbsp; มีสินค้าปกติ&nbsp; 
			           <b>$totol_price</b> รายการ <br>
			           &nbsp;&nbsp;สินค้าโปรโมชั่น <b>$totol_price_pro</b> รายการ</td>
		</tr>";
		 }
?>
	</table>
 </div>
</body>
<?include"../foot.php";?>
<?mysql_close($conn);  ?>
</html>
<!--- โปรแกรมโดย Somsak2004  -->