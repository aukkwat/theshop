<? ob_start();
                    include "config.php";include "function.php"; 
	                if (!isset($_COOKIE["s_member"])){
                     setcookie("s_member","", time()-(60*60*24*15), "/", false, 0);
                     header("Content-Type: text/html; charset=utf-8");
					}
					if (!isset($_COOKIE["s_cart"])){
                     setcookie("s_cart","0=0@", time()+(60*60*24*15), "/", false, 0);
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

<frameset rows="112,*">
	<frame name="top" scrolling="no" noresize target="frame" src="top.php">
	<frameset cols="200,*">
	<?
	    if (!isset($_COOKIE["s_member"])){
		echo"<frame name=\"menu\" target=\"frame\" src=\"menu.php\" scrolling=\"auto\">";
		}else{
        echo"<frame name=\"menu\" target=\"frame\" src=\"menu2.php\" scrolling=\"auto\">";}
	?>
		<frame name="frame" src="doc.php?d=welcome">
	</frameset>
	<noframes>
	<body>

	<p>หมายเหตุ......บราวเซอร์ที่คุณใช้อยู่ไม่รองรับระบบเฟรมของเว็บไซต์นี้.</p>
<? mysql_close($conn); ?>
	</body>
	</noframes>
</frameset>
<?include"foot.php";?>
</html>
<? ob_end_flush();mysql_close($conn);  ?>
