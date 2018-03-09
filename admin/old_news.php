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
$act=$_GET['act'];
$id=$_GET['id'];
if ($act=="delete"){
           $sql5 = "DELETE  FROM news  WHERE id='$id' ";
           $dbquery = mysql_query( $sql5);
           echo "<meta http-equiv='refresh' content='0;URL=old_news.php'>";
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="Somsak2004">
<title>หน้าเกี่ยวกับโปรแกรม</title>
</head>

<body bgcolor="#C0C0C0">

<table border="1" width="100%" id="table1">
	<tr>
		<td bgcolor="#FFFF00"><p align="center"><font color="#0000FF"><b>จดหมายข่าวที่ผ่านมา!!!</b></font></td>
	</tr>
</table>
<table border="1" width="100%" id="table2">
	<tr>
		<td bgcolor="#00FF00" align="center" width="179"><b>วันที่เขียน</b></td>
		<td bgcolor="#00FF00" align="center"><b>หัวข้อ</b></td>
		<td bgcolor="#00FF00" align="center" width="70"><b>ลบ</b></td>
	</tr>
<?
$sql="select * from news ORDER BY date_post DESC "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$id=$record[id];
	$header=$record[header];
	$text=$record[text];
	$date_post=$record[date_post];
echo"
	<tr>
		<td width=\"179\" height=\"48\">
		<p align=\"center\">".thaidate($date_post)."</td>
		<td height=\"48\"><a href=\"news.php?id=$id\" title=\"ไปดูเนื้อหาข่าว\">$header</a></td>
		<td width=\"70\" height=\"48\">
		<p align=\"center\"><a href=\"old_news.php?act=delete&id=$id\" title=\"ลบจดหมายข่าวนี้ทิ้ง\">
		<img border=\"0\" src=\"images/ed_delete.gif\" width=\"18\" height=\"18\"></a></td>
	</tr>";
	}
?>
</table>
<?include"../foot.php";?>
</body>
</html>