<? ob_start();
                    include "config.php";include "function.php"; 
	                if (!isset($_COOKIE["s_member"])){
                     setcookie("s_member","", time()-(60*60*24*15), "/", false, 0);
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
	$welcome=$record[welcome];
	$home=$record[home];
	$data=$record[data];
	$term=$record[term];
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
<?
$doc=$_GET['d'];
switch ($doc){
	case "welcome" : echo $welcome;break;
	case "home" : echo $home;break;
	case "data" : echo $data;break;
	case "term" : echo $term;break;
}
?>
<?include"foot.php";?>
</body>
<? ob_end_flush();mysql_close($conn);  ?>
</html>
<!-- โดย Somsak2004 -->