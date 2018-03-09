<html>
<head>
<? 
include "../config.php"; 
$sql="select * from config  "; 
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
	<frame >
	<frameset cols="190,*">
		<frame name="menu" target="frame" src="menu.php" scrolling="auto">
		<frame name="frame" src="login.php">
	<noframes>
	<body>
	<p>หมายเหตุ......บราวเซอร์ที่คุณใช้อยู่ไม่รองรับระบบเฟรมของเว็บไซต์นี้.</p>
<? mysql_close($conn); ?>
	</body>
	</noframes>
</frameset>
</html>