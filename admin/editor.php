<? 
@session_start();
if ($_SESSION["admin"] != "admin") {    		  						
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";die;
}
?>
<html>
<head>
<? 
include "../config.php";
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
$doc=$_GET['d'];
$act=$_GET['act'];
$wysiwyg=$_POST['wysiwyg'];
switch ($doc){
	case "welcome":$edit=$welcome; $sql2="UPDATE config SET welcome='$wysiwyg'";break;
	case "home" :$edit=$home; $sql2="UPDATE config SET home='$wysiwyg'";break;
	case "data" :$edit=$data; $sql2="UPDATE config SET data='$wysiwyg'";break;
	case "term" :$edit=$term; $sql2="UPDATE config SET term='$wysiwyg'";break;
}
if ($act=="save"){
mysql_query( $sql2) or die (mysql_error());
$sql3="select * from config"; 
$result=mysql_db_query($_dbname,$sql3);
    while($record=mysql_fetch_array($result)) {
	    $welcome=$record[welcome];
	    $home=$record[home];
	    $data=$record[data];
	    $term=$record[term];
     } 
	    switch ($doc){
	            case "welcome":$edit=$welcome;break;
	            case "home" :$edit=$home;break;
	            case "data" :$edit=$data;break;
	            case "term" :$edit=$term;break;
        }
}


?>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
<LINK HREF="style.css" REL="stylesheet" TYPE="text/css">
<STYLE TYPE="text/css">
<!--
body {
	background-image: url(images/background.gif);
}
-->
</STYLE>
</head>
<SCRIPT LANGUAGE="Javascript1.2">
_editor_url = "";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  document.write(' language="Javascript1.2"></scr' + 'ipt>');  
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
</SCRIPT>
<body bgcolor="#C0C0C0">
<form method="POST" action="<? echo"$PHPSELF?act=save&d=$doc";?>" >  
<p align="center"><font color="#0000FF"><font size="6">
หน้าแก้ไขเอกสาร :
<?
switch ($doc){
	case "welcome"  :echo"เอกสารต้อนรับ";break;
	case "home"       :echo"เอกสารหน้าแรก";break;
	case "data"         :echo"เอกสารข้อมูลร้านค้า";break;
	case "term"         :echo"เอกสารเงื่อนไขและข้อตกลง";break;
}
?>
</font></font></p>
<TEXTAREA  NAME="wysiwyg" cols="75" rows="40"><?=$edit?></TEXTAREA>
<SCRIPT LANGUAGE="javascript1.2">
			var config = new Object();    // create new config object
			config.width = "100%";
			config.height = "400px";
			config.bodyStyle = 'background-color: white; font-family: "ms sans serif" ';
			config.debug = 0;
			editor_generate('wysiwyg',config);
</SCRIPT>	
	<p align="center"><input type="submit" value="จัดเก็บเอกสาร" name="Save"></p>
</form>
<?include"../foot.php";?>
<? mysql_close($conn);  ?>
</body>
</html>