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
$sql="select * from cat_product WHERE id='$id' "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$id=$record[id];
	$name=$record[name];
	$pic=$record[pic];
}
if ($act=="update"){
   $c_name=$_POST['c_name'];
   if($c_pic!=""){
	        if($_FILES['c_pic']['size']<102400){
    		           if(copy($HTTP_POST_FILES['c_pic']['tmp_name'],"../images/products/".$HTTP_POST_FILES['c_pic']['name']))	{ 
			                   $c_pic=$HTTP_POST_FILES['c_pic']['name']; }
	                    }else{
			 	                print "<script>";
				                print "alert('รูปต้องมีขนาดไม่เกิน 100 k'); ";
				                print "location.href='edit_cat.php?id=$id&act='; ";
				                print "</script>";	
	                     }
              }
	          if ($c_pic==""){$c_pic=$pic;}
              $sql4 = "UPDATE cat_product  SET  name='$c_name',pic='$c_pic'  WHERE id='$id' ";
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
<script type="text/javascript" src="../highslide/highslide.js"></script>
<script type="text/javascript">
    hs.graphicsDir = '../highslide/graphics/';
</script>
<title><? echo $title; ?></title>
<LINK HREF="style.css" REL="stylesheet" TYPE="text/css">
</head>
<body bgcolor="#C0C0C0">

<form action="<? echo "$PHPSELF?act=update&id=$id";?>" method="post" name="save" enctype="multipart/form-data">
<p align="center"><u><font size="5">แก้ไขหมวดสินค้า</font></u></p>
<div align="center">
<table border="1" width="95%" id="table1" height="211">
	<tr>
		<td width="114" align="right" height="41"><b><font color="#0000FF">รหัส</font></b></td>
		<td height="41"><b><?=$id?></b></td>
	</tr>
	<tr>
		<td width="114" align="right" height="49"><b><font color="#0000FF">ชื่อหมวดสินค้า</font></b></td>
		<td height="49">
			<p><input type="text" name="c_name" size="80" Value="<?=$name?>"></p>

		</td>
	</tr>
	<tr>
		<td width="114" align="right"><b><font color="#0000FF">รูปภาพ</font></b></td>
		<td>
		<a href="../images/products/<?=$pic ?>" class="highslide" onclick="return hs.expand(this)">
		<img border="0" src="../images/products/<?=$pic?>"  width="100" height="75" align="left"  title="คลิ๊กเพื่อดูภาพปกติของ <?=$pic?>"></a><p>
		<br>&nbsp;
		<a href="../images/products/<?=$pic ?>" class="highslide" onclick="return hs.expand(this)">
		ภาพขนาด กว้าง100px&nbsp; X สูง	75 px<br>&nbsp;</td></tr>
		<tr><td> 
			<p align="right"><b><font color="#0000FF">เลือกภาพใหม่</font></b></td>
			<td><input type="file" name="c_pic" size="51" value="<? echo $pic; ?>"></td>
	</tr>
</table>
</div>
	<p align="center"><input type="submit" value="จัดเก็บการแก้ไข" name="save"></p>
</form>
<?include"../foot.php";?>
<? mysql_close($conn);  ?>
</body>
</html>
<!--- โปรแกรมโดย Somsak2004  -->