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
<title><? echo $title; ?></title>
</head>
<body>
<p align="center"><font color="#0000FF" size="5">
<span style="background-color: #FFFFFF" >กรุณาเลือกหมวดสินค้าที่สนใจ</font></p>
<table border="1" width="100%" id="table1" height="134">
<?
$sql="select * from cat_product ORDER BY name "; 
$result=mysql_db_query($_dbname,$sql);
$total=mysql_num_rows($result);
$num=1;
if ($total<=$cols) {$loop=$total;} else {$loop=$cols;}
while($record=mysql_fetch_array($result)) {
	$id=$record[id];
	$name=$record[name];
	$pic=$record[pic];
	$sql6="select * from product where id_cat='$id' and promotion='0'"; 
    $result6=mysql_db_query($_dbname,$sql6);
    $total2=mysql_num_rows($result6);
	if ($num==1) {echo"<tr>";}
     echo "
           <td align=\"center\"><font color=\"#0000FF\">
           <a href=\"product2.php?id_cat=$id\" title \"ดูสินค้าหมวด $name\">
           <img border=\"0\" src=\"images/products/$pic\" width=\"100\" height=\"75\"></a>
           <br><a href=\"product2.php?id_cat=$id\" title \"ดูสินค้าหมวด $name\"> $name <a></font><br>มีสินค้า $total2 รายการ</td>";
      if (($num==$cols) || ($num==$loop)) {echo"</tr>";$num=0;}
	  $num++;
       }
?>
<?include"foot.php";?>
</table>
</body>
</html>