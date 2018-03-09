<?  ob_start();
                    include "config.php";
                     setcookie("s_member","", time()-(60*60*24*15), "/", false, 0);
                     setcookie("member_id","", time()-(60*60*24*15), "/", false, 0);
					 header("Content-Type: text/html; charset=utf-8");
    $sql="select * from config"; 
    $result=mysql_db_query($_dbname,$sql);
    while($record=mysql_fetch_array($result)) {
	    $title=$record[title];
	    $metatag=$record[metatag];
	    $metadesc=$record[metadesc];
     } 
?>
<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
</head>
<body>
<? echo "ออกจากระบบ"; ?>
<meta http-equiv="refresh" content="0;URL=menu.php" target="menu">
<?include"foot.php";?>
</body>
<? mysql_close($conn); ?>
</html>
<!--- โปรแกรมโดย Somsak2004  -->