<? ob_start();
                    include "config.php";
	                if (!isset($_COOKIE["s_member"])){
                     setcookie("s_member","", time()-(60*60*24*15), "/", false, 0);
                     header("Content-Type: text/html; charset=utf-8");
					}
					$id=$_GET['id'];
					if ($id != "") {
					$list=$_COOKIE["s_cart"];
					$item=explode("@",$list);
                    $i=0;$ii=1;	
					do {
						$num=explode("=",$item[$i]);
						if ($id==$num[0]) {$num[1]++;$check="ok";}
						$i++;$ii++;
                        $order .= $num[0]."=".$num[1]."@";
						}while ($item[$i] != null);
					if ($check != "ok") {$order .= "$id=1@";}
                     setcookie("s_cart","$order", time()+(60*60*24*15), "/", false, 0);
            	     echo"<meta http-equiv=\"refresh\" content=\"0;URL=menu2.php?id=\" target=\"_self\"> ";
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
	$logo=$record[logo];
}
$act=$_GET['act'];
if ($act=="logout") { 
	setcookie("s_member","", time()-(60*60*24*15), "/", false, 0);
	echo"<meta http-equiv=\"refresh\" content=\"0;URL=menu.php\" target=\"_self\"> ";
	}

?>

<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
<base target="main">
</head>
<body>
<div align="center">
	 <Form action="search.php" method="POST" target="frame">
            <p align="center"></a><input type="text" name="search" size="20"><br>
           <input type="submit" value="ค้นหา" name="save"></p>
     </Form>
<table border="1" width="150" bordercolorlight="#C0C0C0" bordercolordark="#008080" bgcolor="#33CC33" id="table2" height="91">
	 <Form action="basket.php" method="POST" target="frame">
		<tr>
			    <td align="center" bgcolor="#FFFFFF"><u><b><font color="#0000FF">ตะกร้าสินค้า</font></b></u><br>
	<?		
		   if($_COOKIE["s_cart"]=="0=0@"){echo"	ยังไม่มีรายการสินค้า<br>";} else {
			$xx=$_COOKIE["s_cart"];
		    $item=explode("@",$xx);
			$i=0;$ii=0;do {$ss=explode("=",$item[$i]);$ii+=$ss[1];$i++; }while ($item[$i] != null);$i=$i-1;
			echo "มีสินค้า $i รายการ<br>จำนวน $ii ชิ้น";}    
	?>
	            <input type="submit" value="ดูตะกร้าสินค้า" name="basket">
                </td>
		</tr>
	</Form>	
</table>
<div align="center">
<table border="1" width="150" id="table1" height="100" bgcolor="#00FF00" bordercolorlight="#808080" bordercolordark="#800080">
	<tr>
		<td bgcolor="#FFFFFF">
		<p align="center"><u><font color="#0000FF"><b>ยินดีต้อนรับคุณ<br>
		</b></font></u><br>
		<?=$_COOKIE["s_member"]?><br>
		<br>
	<Form action="edit.php" method="POST" target="_blank">
		<input type="submit" value="แก้ไขข้อมูล" name="B3"><br>
		<br>
	</form>
    <Form action="history.php" method="POST" target="frame">
		<input type="submit" value="ประวัติการสั่งซื้อ" name="B4"><br>
		<br>
	</form>
    <Form action="<? echo "$PHPSELF?act=logout";?>" method="POST" target="_self">
		<input type="submit" value="ออกจากระบบ" name="B1">
	</form>
		  </p>
         </td>
	</tr>
</table>
</p>
</div>
<p align="center"><font size="2" color="#0000FF">Power By
<a href="http://www.somsak2004.com" target="_blank" title="ไปเว็บ Somsak2004 ผู้ทำโปรแกรม S-Shop">Somsak2004</a><br>@สงวนลิขสิทธิ์ 2552</font></p>
		</div>
		<p align="center">
		<a target="_blank" href="http://www.unitedsme.com" title="ไปเว็บผู้ให้บริการเช่าพื้นที่เว็บไซต์">
		<img border="0" src="images/img42646362.jpg" width="126" height="58"></a><br>
		<a target="_blank" href="http://www.net-lifestyle.com" title="ไปเว็บผู้ให้บริการเช่าพื้นที่เว็บไซต์">
		<img border="0" src="images/img42646372.jpg" width="128" height="71"></a><br>
		<a target="_blank" href="http://www.krunid.com"  title="ไปเว็บครูนิจ สอนทำขนมไทย อาหารไทย ฟรีๆ">
		<img border="0" src="images/img42646392.jpg" width="125" height="47"></a><br>
		<a target="_blank" href="http://www.somsak2004.net/forum"  title="ไปบอร์ดสมศักดิ์๒๐๐๔">
		<img border="0" src="images/img42646382.jpg" width="129" height="58"></a><br>
		<a target="_blank" href="http://www.theshopthai.com"  title="ไปร้านค้าอริยา เทรดดิ้ง โดย Somsak2004">
		<img border="0" src="images/img42646352.jpg" width="124" height="57"></a>
		</p>
<?include"foot.php";?>
</body>
<? ob_end_flush();mysql_close($conn); ?></html>