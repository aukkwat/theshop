<? 
@session_start();
if ($_SESSION["admin"] != "admin") {    		  						
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";die;
}
include "../config.php"; include"../function.php";
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
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
</head>
<body bgcolor="#C0C0C0">
<table border="1" width="100%" id="table1">
	<tr>
		<td bgcolor="#FF00FF">
		<p align="center"><b><span style="background-color: #FF00FF">
		รายงานยอดโอนเงินเข้าธนาคารแต่ละบัญชี</b></td>
	</tr>
</table>

<?
$sql="select * from bank ORDER by name_bank "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$name_bank=$record[name_bank];
	$branch=$record[branch];
echo"
<table border=\"1\" width=\"100%\" id=\"table2\">
	<tr>
		<td bgcolor=\"#FFFF00\" width=\"350\">ธนาคาร : $name_bank</td>
		<td bgcolor=\"#FFFF00\">สาขา : $branch</td>
	</tr>
</table>
<table border=\"1\" width=\"100%\" id=\"table3\">";
echo"
	<tr>
		<td align=\"center\" width=\"145\"><b><font color=\"#0000FF\">
		วันที่</font></b></td>
		<td align=\"center\" width=\"199\"><b><font color=\"#0000FF\">
		ยอดโอน</font></b></td>
		<td align=\"center\" width=\"120\"><b><font color=\"#0000FF\">
		เลข Oder</font></b></td>
		<td align=\"center\"><b><font color=\"#0000FF\">ผู้โอน</font></b></td>
	</tr>";
$sql2="select * from order_data WHERE bank='$name_bank' ORDER BY id DESC"; 
$result2=mysql_db_query($_dbname,$sql2);
while($record2=mysql_fetch_array($result2)) {
	$value=$record2[value];
	$date_pay=$record2[date_pay];
	$id_order=$record2[id];
	$id_user=$record2[id_user];
    $sql3="select * from user WHERE id='$id_user' "; 
    $result3=mysql_db_query($_dbname,$sql3);
    while($record3=mysql_fetch_array($result3)) {
	    $name=$record3[name];
	    $surname=$record3[surname];
	}
	echo"
	<tr>
		<td width=\"145\">
		<p align=\"center\">".thaidate($date_pay)."</td>
		<td width=\"199\">
		<p align=\"center\"><b>$value</b></td>
		<td width=\"120\">
		<p align=\"center\"><b>$id_order</b></td>
		<td>$name $surname</td>
	</tr>";
  }
echo"</table>";
}
?>
</body>
<?include"../foot.php";?>
<?mysql_close($conn);  ?>
</html>
<!-- โดย Somsak2004 -->