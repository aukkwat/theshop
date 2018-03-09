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
$id=$_GET['id'];
$act=$_GET['act'];
$sql="select * from bank WHERE id='$id' "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$id=$record[id];
	$name_bank=$record[name_bank];
	$branch=$record[branch];
	$account_no=$record[account_no];
	$account_name=$record[account_name];
	$type=$record[type];
}
if ($act=="update"){
              $c_name=$_POST['c_name'];
	          if ($c_pic==""){$c_pic=$pic;}
              $sql4 = "UPDATE bank  SET  name_bank='$c_name_bank',branch='$c_branch',account_no='$c_account_no',account_name='$c_account_name',type='$c_type'  WHERE id='$id' ";
              mysql_query( $sql4) or die (mysql_error());
		      echo "<meta http-equiv='refresh' content='0;URL=$PHPSELF?id=$id&act='>";die;
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
<LINK HREF="style.css" REL="stylesheet" TYPE="text/css">
</head>
<body bgcolor="#C0C0C0">

<form action="<? echo "$PHPSELF?act=update&id=$id";?>" method="post" name="save">
<p align="center"><u><font size="5">แก้ไขรายการบัญชีธนาคาร</font></u></p>
<div align="center">
<table border="1" width="95%" id="table1" height="211">
	<tr>
		<td width="114" align="right" height="27"><b><font color="#0000FF">รหัส</font></b></td>
		<td><b><?=$id?></b></td>
	</tr>
	<tr>
		<td width="114" align="right" height="35"><b><font color="#0000FF">ชื่อธนาคาร</font></b></td>
		<td>
			<p><input type="text" name="c_name_bank" size="53" Value="<?=$name_bank?>"> 
			<br>ชื่อธนาคารให้ใส่เช่น กรุงเทพ,กรุงไทย,กสิกร 
			เป็นต้น</p>

		</td>
	</tr>
	<tr>
		<td width="114" align="right" ><font color="#0000FF"><b>
		สาขาธนาคาร</b></font></td>
		<td>
		
		<p>
		<input type="text" name="c_branch" size="54" Value="<?=$branch?>"> 
		<br>สาขาของธนาคาร</td></tr>
		<tr>
	<td> 
			<p align="right"><font color="#0000FF"><b>ชื่อบัญชี</b></font></td>
			<td><input type="text" name="c_account_name" size="80" Value="<?=$account_name?>"> 
			<br>ชื่อบัญชีของคุณ</td>
	</tr>
		<tr>
	<td> 
			<p align="right"><font color="#0000FF"><b>เลขบัญชี</b></font></td>
			<td><input type="text" name="c_account_no" size="46" Value="<?=$account_no?>"> 
			<br>เลขบัญชีของคุณ</td>
	</tr>
		<tr>
	<td> 
			<p align="right"><font color="#0000FF"><b>ชนิดบัญชี</b></font></td>
			<td><input type="text" name="c_type" size="46" Value="<?=$type?>"> 
			<br>ชนิดบัญชีเช่น ออมทรัพย์,ฝากประจำ,กระแสรายวัน 
			หรือ อื่นๆ</td>
	</tr>
</table>

</div>

	<p align="center"><input type="submit" value="จัดเก็บการแก้ไข" name="save"></p>
</form>
</body>
<?include"../foot.php";?>
<? mysql_close($conn);  ?>
</html>
<!--- โปรแกรมโดย Somsak2004  -->