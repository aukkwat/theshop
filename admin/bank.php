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

   $act= $_GET['act'];
   $id=$_GET['id'];
   if ($act=="delete")
   {
           $sql5 = "DELETE  FROM bank WHERE id='$id' ";
           $dbquery = mysql_query( $sql5);
           echo "<meta http-equiv='refresh' content='0;URL=$PHPSELF?act='>";
   }
if ($act=="new")
{
            $sql7 = "INSERT INTO bank (id,name_bank,branch,account_no,account_name,type) VALUES ('','ชื่อธนาคาร','สาขา','เลขบัญชี','ชื่อบัญชี','ประเภทบัญชี')  ";
            $dbquery = mysql_query( $sql7);
            echo "<meta http-equiv='refresh' content='0;URL=$PHPSELF?act='>";
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


<p align="center"><u>
<font size="5">จัดการบัญชีธนาคารสำหรับให้โอนเงิน</font></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<FORM action="<? echo "$PHPSELH?act=new";?>" method="POST">
<input type="submit" value="กดปุ่มนี้สำหรับเพิ่มบัญชีธนาคาร" name="B1"></p>
</FORM>


<table border="1" width="100%" id="table1">
	<tr>
		<td width="76" align="center" bgcolor="#0000FF"><font color="#FFFF00">
		<b>รหัส</b></font></td>
		<td width="266" align="center" bgcolor="#0000FF"><font color="#FFFF00">
		<b>ชื่อธนาคาร</b></font></td>
		<td width="254" align="center" bgcolor="#0000FF"><font color="#FFFF00">
		<b>สาขา</b></font></td>
		<td width="259" align="center" bgcolor="#0000FF"><font color="#FFFF00">
		<b>ชื่อบัญชี</b></font></td>
		<td width="259" align="center" bgcolor="#0000FF"><font color="#FFFF00">
		<b>เลขบัญชี</b></font></td>
		<td align="center" bgcolor="#0000FF"><font color="#FFFF00"><b>ลบ</b></font></td>
	</tr>

	<?
$sql="select * from bank ORDER BY name_bank"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$id=$record[id];
	$name_bank=$record[name_bank];
	$branch=$record[branch];
	$account_no=$record[account_no];
	$account_name=$record[account_name];
	$type=$record[type];
echo"
	<tr>
		<td width=\"76\" align=\"center\" bgcolor=\"#C0C0C0\"><b>$id</b></td>
		<td width=\"266\" align=\"center\" bgcolor=\"#C0C0C0\"><b>
		<a href=\"edit_bank.php?id=$id\">$name_bank</a></b></td>
		<td width=\"254\" align=\"center\" bgcolor=\"#C0C0C0\"><b>$branch</b></td>
			<td width=\"259\" align=\"center\" bgcolor=\"#C0C0C0\">
				<b>$account_name</b></td>
		<td width=\"259\" align=\"center\" bgcolor=\"#C0C0C0\">
		<b>$account_no</b></td>

		<td align=\"center\" bgcolor=\"#C0C0C0\"><b>
		<a href=\"$PHPSELF?act=delete&id=$id.php\">
		<img border=\"0\" src=\"images/ed_delete.gif\" width=\"18\" height=\"18\"></a></b></td>
	</tr>";
}
	?>
</table>
<?include"../foot.php";?>
<? mysql_close($conn);  ?>
</body>
</html>
<!--- โปรแกรมโดย Somsak2004  -->