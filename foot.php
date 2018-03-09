<html>
<head>
<? include "config.php"; 
$sql="select * from config"; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$title=$record[title];
	$metatag=$record[metatag];
	$metadesc=$record[metadesc];
	$footer=$record[footer];
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
<body>
<table border="1" width="100%" bordercolordark="#808080" bordercolorlight="#C0C0C0" id="table1">
	<tr>
		<td align="center"><? echo $footer; ?></td>
	</tr>
</table>
</body>
</html>
<!-- โปรแกรมโดย Somsak2004 -->