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
</head>
<body bgcolor="#C0C0C0">
<?
$_SESSION["admin"] = "admin";
$page=$_GET['page'];
$sql2="select * from user"; 
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
           $sql5 = "DELETE  FROM user  WHERE id='$id' ";
           $dbquery = mysql_query( $sql5);
           echo "<meta http-equiv='refresh' content='0;URL=$PHPSELF?page=$page&act='>";
   }
?>

<p align="center"><u><font size="5">รายชื่อสมาชิกของร้านค้า </font></u>
<font size="4" color="#0000FF">มี </font><b><font size="4">
<?=$total?></font></b><font size="4" color="#0000FF"> </font>
<font size="4" color="#0000FF">คน หน้า </font><font size="4"><b>
<?=$page?>/<?=$totalpage?> </b></font><font size="4" color="#0000FF">
<? if ($page>1) {echo"
<a href=\"user.php?page=1\"><font size=\"1\">[หน้าแรก]</font></a>";}?>
&nbsp;&nbsp;
<? if ($page>1) {echo"
<a href=\"user.php?page=$back\">
<img border=\"0\" src=\"images/arrow_left.gif\" width=\"16\" height=\"16\"></a>";}?>
&nbsp;&nbsp;
</font><u><font size="5">
<img border="0" src="images/b6.gif" width="46" height="45"></font></u><font size="4" color="#0000FF">&nbsp;
<? if ($page<$totalpage) {echo"
<a href=\"user.php?page=$next\"><img border=\"0\" src=\"images/arrow_right.gif\" width=\"16\" height=\"16\"></a>";}?>
&nbsp;&nbsp;
<? if ($page<$totalpage) {echo"
<a href=\"user.php?page=$totalpage\"><font size=\"1\">[หน้าสุดท้าย]</font></a></font></p>";}?>

<table border="1" width="100%" id="table1">
	<tr>
		<td align="center" bgcolor="#0000FF"><font color="#FFFF00"><b>รหัส</b></font></td>
		<td align="center" bgcolor="#0000FF"><font color="#FFFF00"><b>ชื่อ-นามสกุล</b></font></td>
		<td align="center" bgcolor="#0000FF"><font color="#FFFF00"><b>เบอร์โทร</b></font></td>
		<td align="center" bgcolor="#0000FF"><font color="#FFFF00"><b>
		E-Mail</b></font></td>
		<td align="center" bgcolor="#0000FF"><font color="#FFFF00"><b>จังหวัด</b></font></td>
		<td align="center" bgcolor="#0000FF"><font color="#FFFF00"><b>ลบทิ้ง</b></font></td>
	</tr>

	<?
$sql="select * from user ORDER BY name LIMIT $goto,$pagelen"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$id=$record[id];
	$name=$record[name];
    $surname=$record[surname];
	$email=$record[email];
	$x_tel=$record[x_tel];
	$po=$record[po];
	echo"
	<tr>
		<td align=\"center\">$id</td>
		<td align=\"center\"><a href=\"edit_user.php?id=$id\" title=\"แก้ไขสมาชิกรายนี้\" target=\"_blank\">$name $surname</a></td>
		<td align=\"center\">$x_tel</td>
		<td align=\"center\">$email</td>
		<td align=\"center\">$po</td>
		<td align=\"center\"><a href=\"user.php?act=delete&id=$id\ title=\"ลบสมาชิกรายนี้\" >
		<img border=\"0\" src=\"images/ed_delete.gif\" width=\"18\" height=\"18\"></a></td>
	</tr>";
}
	?>
</table>
<?include"../foot.php";?>
</body>
<?mysql_close($conn);  ?>
</html>
<!--- โปรแกรมโดย Somsak2004  -->