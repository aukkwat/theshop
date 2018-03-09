<? 
@session_start();
if ($_SESSION["admin"] != "admin") {    		  						
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";die;
}
include "../config.php"; include "../function.php";
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
<title>หน้าเกี่ยวกับโปรแกรม</title>
<LINK HREF="style.css" REL="stylesheet" TYPE="text/css">
<STYLE TYPE="text/css">
<!--
body {
	background-image: url(images/background.gif);
}
-->
</STYLE>
<?
$id=$_GET['id'];
$sql="select * from news where id='$id' "; 
$result=mysql_db_query($_dbname,$sql);
while($record=mysql_fetch_array($result)) {
	$x_head=$record[title];
	$x_text=$record[text];
}
$act=$_GET['act'];
$head=$_POST['head'];
$text=$_POST['wysiwyg'];
$date_post=date("Y-m-d");
if ($act=="save") {
if ($head=="") {echo '<script type="text/javascript"> alert(\'ไม่มีหัวข้อ กรุณาใส่หัวข้อก่อน\'); history.back(); </script>';}
if ($text=="") {echo '<script type="text/javascript"> alert(\'ไม่มีข้อความ กรุณาใส่ข้อความก่อน\'); history.back(); </script>';}
	   $sql4 = "INSERT INTO news (id,date_post,header,text) VALUES ('','$date_post','$head','$text') ";
        mysql_query( $sql4) or die(mysql_error()) ;
        $sql2="select * from user"; 
        $result2=mysql_db_query($_dbname,$sql2);
        while($record=mysql_fetch_array($result2)) {
	          $email=$record[email];
			  $header="MIME-Version: 1.0 \r\n";
              $header.="Content-Type: text/html; charset=utf-8 \r\n";
              $header.="From: $email_shop \r\n";
              $header.="Return-Path: $email_shop \r\n";
                   if   (mail ($email,$head,$text,$header)) {
                         echo "<center><h2> ส่งข้อข้อมูลแล้วให้อีเมล์ $email</h2></center><br>" ;
                         } else {
                         echo "<center><h2> ไม่สามารถส่งเมล์</h2></center>";}
        }
echo "<meta http-equiv='refresh' content='0;URL=old_news.php'>";
}
?>
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
<?
$sql="select * from user"; 
$result=mysql_db_query($_dbname,$sql);
$total=mysql_num_rows($result);
?>
<center>
<form method="POST" action="<? echo"$PHPSELF?act=save";?>" >  
<table border="1" width="100%" id="table1">
	<tr>
		<td align="center" bgcolor="#0000FF" height="47"><b>
		<font color="#FFFF00" size="5">หน้าส่งจดหมายข่าวถึงลูกค้าทั้งหมด <?=$total?> ราย</font></b></td>
	</tr>
	<tr>
		<td align="left">หัวข้อ : <input type="text" name="head" size="87" value="<?=$x_head?>"></td>
	</tr>
</table>
<TEXTAREA  NAME="wysiwyg" cols="75" rows="40"><?=$x_text?></TEXTAREA>
<SCRIPT LANGUAGE="javascript1.2">
			var config = new Object();    // create new config object
			config.width = "100%";
			config.height = "400px";
			config.bodyStyle = 'background-color: white; font-family: "ms sans serif" ';
			config.debug = 0;
			editor_generate('wysiwyg',config);
</SCRIPT>	
			
</center>
	<p align="center">
<?
	if ($id == null) {echo"	<input type=\"submit\" value=\"ส่งจดหมายข่าวแจ้งถึงลูกค้า\" name=\"save\">";}else{
		echo "<center><h2>ดูได้อย่างเดียว แก้ไขไม่ได้ ส่งเมล์ไม่ได้</h2></center>";}
?>
	</p>
</form>
<?include"../foot.php";?>
</body>
<? $_SESSION["admin"]="admin";mysql_close($conn); ?>
</html>