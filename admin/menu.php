<html>
<head>
<? include "../config.php"; 
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
	$logo=$record[logo];
}
?>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<script type="text/javascript" src="flashobject.js"></script>
<title><? echo $title; ?></title>
<base target="frame">
</head>
<body bgcolor="#C0C0C0">
<div align="center">
<u><b>ระบบจัดการร้าน</b></u><br><br>
<?include"header.php";?>
</div>
<p align="center"><font size="2" color="#0000FF">Power By
<a href="http://www.somsak2004.com" target="_blank" title="ไปเว็บ Somsak2004 ผู้ทำโปรแกรม S-Shop">Somsak2004</a><br>@สงวนลิขสิทธิ์ 2552</font></p>
<? mysql_close($conn);  ?>
</body>
</html>