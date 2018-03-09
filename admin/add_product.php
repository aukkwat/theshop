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
?>
<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Page-Enter" content="revealTrans(Duration=2,Transition=23)">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="Somsak2004">
<meta name="description" content="<? echo $metadesc; ?>">
<meta name="keywords" content="<? echo $metatag; ?>">
<title><? echo $title; ?></title>
<?
$id=$_GET['id'];
$act=$_GET['act'];
if ($act=="new"){
          if($pic1 !=""){
	             if($_FILES['pic1']['size']<102400){
    		           if(copy($HTTP_POST_FILES['pic1']['tmp_name'],"../images/products/".$HTTP_POST_FILES['pic1']['name']))	{ 
			                   $pic1=$HTTP_POST_FILES['pic1']['name']; }
	                    }else{
								print ' <script type="text/javascript"> alert(\'รูปต้องมีขนาดไม่เกิน 100 kb\'); history.back(); </script>';
	                     }
              }
          if($pic2 !=""){
	             if($_FILES['pic2']['size']<102400){
    		           if(copy($HTTP_POST_FILES['pic2']['tmp_name'],"../images/products/".$HTTP_POST_FILES['pic2']['name']))	{ 
			                   $pic2=$HTTP_POST_FILES['pic2']['name']; }
	                    }else{
								print ' <script type="text/javascript"> alert(\'รูปต้องมีขนาดไม่เกิน 100 kb\'); history.back(); </script>';
	                     }
              }
          if($pic3 !=""){
	             if($_FILES['pic3']['size']<102400){
    		           if(copy($HTTP_POST_FILES['pic3']['tmp_name'],"../images/products/".$HTTP_POST_FILES['pic3']['name']))	{ 
			                   $pic3=$HTTP_POST_FILES['pic3']['name']; }
	                    }else{
								print ' <script type="text/javascript"> alert(\'รูปต้องมีขนาดไม่เกิน 100 kb\'); history.back(); </script>';
	                     }
              }
          if($pic4 !=""){
	             if($_FILES['pic4']['size']<102400){
    		           if(copy($HTTP_POST_FILES['pic4']['tmp_name'],"../images/products/".$HTTP_POST_FILES['pic4']['name']))	{ 
			                   $pic4=$HTTP_POST_FILES['pic4']['name']; }
	                    }else{
								print ' <script type="text/javascript"> alert(\'รูปต้องมีขนาดไม่เกิน 100 kb\'); history.back(); </script>';
	                     }
              }
          if($pic5 !=""){
	             if($_FILES['pic5']['size']<102400){
    		           if(copy($HTTP_POST_FILES['pic5']['tmp_name'],"../images/products/".$HTTP_POST_FILES['pic5']['name']))	{ 
			                   $pic5=$HTTP_POST_FILES['pic5']['name']; }
	                    }else{
								print ' <script type="text/javascript"> alert(\'รูปต้องมีขนาดไม่เกิน 100 kb\'); history.back(); </script>';
	                     }
              }
	        if ($pic1==""){$pic1="nopic.jpg";}
	        if ($pic2==""){$pic2="nopic.jpg";}
	        if ($pic3==""){$pic3="nopic.jpg";}
	        if ($pic4==""){$pic4="nopic.jpg";}
	        if ($pic5==""){$pic5="nopic.jpg";}
            $id_cat=$_POST['id_cat'];
			$name=$_POST['name'];
			$promotion=$_POST['promotion'];
			if ($promotion=="selected"){$promotion="1";}else{$promotion="0";}
			$price=$_POST['price'];
			$price_pro=$_POST['price_pro'];
			$detail=$_POST['wysiwyg'];
            $sql7 = "INSERT INTO product (id,id_cat,name,detail,promotion,pic1,pic2,pic3,pic4,pic5,price,price_pro) VALUES ('','$id_cat','$name','$detail','$promotion','$pic1','$pic2','$pic3','$pic4','$pic5','$price','$price_pro')  ";
            $dbquery = mysql_query( $sql7) or die(mysql_error());
            echo "<meta http-equiv='refresh' content='0;URL=product.php'>";
}
?>
<script language="JavaScript">
function check_product(){
        var name=document.save.name.value;
        var id_cat=document.save.id_cat.value;
        var price=document.save.price.value;
		if (name.length==0){
			alert("กรุณาใส่ชื่อสินค้าด้วย");
			 return false;
		}
		if (id_cat=="0"){
			alert("กรุณาเลือกหมวดสินค้าด้วย");
			 return false;
		}
		if (price.length=="0"){
			alert("กรุณาใส่ราคาสินค้าด้วย");
			 return false;
		}

}
</script>
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
<form action="<? echo "$PHPSELF?act=new&id=$id";?>" method="post" name="save" enctype="multipart/form-data" onSubmit="return check_product()">
<p align="center"><u><font size="5">เพิ่มสินค้าใหม่</font></u></p>
<div align="center">
<table border="1" width="100%" id="table1" height="140">
	<tr>
		<td width="170" align="right" height="32"><b><font color="#0000FF">ชื่อสินค้า</font></b></td>
		<td height="32">
			<p><input type="text" name="name" size="80" > <b>
			<font size="2">ใส่ชื่อสินค้า</font></b></p></td>
	</tr>
	<tr>
		<td width="170" align="right" height="32"><b><font color="#0000FF">หมวดสินค้า</font></b></td>
		<td height="32">
			<p><select size="1" name="id_cat">
		    <option value="0">กรุณาเลือกหมวด</option>
	        <option value="0">==========</option>			
			<?
             $sql="select * from cat_product"; 
             $result=mysql_db_query($_dbname,$sql);
             while($record=mysql_fetch_array($result)) {
	               $id_cat=$record[id];
	               $name_cat=$record[name];
                   echo"<option value=\"$id_cat\">$name_cat</option>";
			 }
	        ?>
			</select>
			<font size="2">เลือกหมวดสินค้า</font></b></p></td>
	</tr>

	<tr>
		<td width="170" align="right" height="30">
		<font color="#0000FF"><b>ราคาสินค้าปกติ</b></font></td>
		<td>	<p><input type="text" name="price" size="27" > 
		<font size="2"><b>บาท (สำหรับราคาปกติ</b><b>/ชิ้น)</b></font></td>
	</tr>
	<tr>
		<td width="170" align="right" height="30">
		<font color="#0000FF"><b>ทำเป็นสินค้าโปรโมชั่น</b></font></td>
		<td>	<p><input type="checkbox" name="promotion" value="selected"> 
		<font size="2"><b>ติ๊กถูกหากต้องการทำสินค้ารายการนี้เป็นสินค้าโปรโมชั่น</b></font></td>
	</tr>
	<tr>
		<td width="170" align="right" height="30">
		<font color="#0000FF"><b>ราคาสินค้าโปรโมชั่น</b></font></td>
		<td>	<p>	<input type="text" name="price_pro" size="27" >
		<font size="2"><b>บาท (สำหรับราคาโปรโมชั่น</b><b>/ชิ้น)</b></font></td>
	</tr>
	<tr>
		<td width="170" align="right" height="30"><b><font color="#0000FF">เลือกภาพสินค้า 1(หลัก) </font></b></td>
		<td>	<p>		<input type="file" name="pic1" size="51" value=>
		<font size="2"><b>ขนาดภาพไม่เกิน 100 KByte</b></font></td>
	</tr>
	<tr>
		<td width="170" align="right" height="30"><b><font color="#0000FF">เลือกภาพสินค้า 2 </font></b></td>
		<td>	<p><input type="file" name="pic2" size="51" >
		<font size="2"><b>หากไม่มีปล่อยว่างไว้ได้</b></font></td></tr>
	<tr>	
			<td width="170" align="right" height="30"><b><font color="#0000FF">เลือกภาพสินค้า 3 </font></b></td>
		<td>	<p><input type="file" name="pic3" size="51" > 
		<font size="2"><b>รูปแสดงในขนาด 115x90 px.</b></font></td>
	</tr>
	<tr>
		<td width="170" align="right" height="30"><b><font color="#0000FF">เลือกภาพสินค้า 4 </font></b></td>
		<td>	<p><input type="file" name="pic4" size="51" >
		<font size="2"><b>แต่สามารถกดขยายภาพได้</b></font></td>
	</tr>
	<tr>
	     <td><p align="right"><b><font color="#0000FF">เลือกภาพสินค้า 5 </font></b></td>
		 <td><input type="file" name="pic5" size="51" > 
		 <font size="2"><b>ด้วยการแสดงภาพแบบ HS.</b></font></td>
	</tr>
	<tr>
		<td width="170" align="right" height="30"><font color="#0000FF"><b>รายละเอียดของสินค้า</b></font></td>
		<td>	<TEXTAREA  NAME="wysiwyg" cols="75" rows="40"></TEXTAREA></td>
	</tr>
</table>
</div>
<SCRIPT LANGUAGE="javascript1.2">
			var config = new Object();    // create new config object
			config.width = "100%";
			config.height = "400px";
			config.bodyStyle = 'background-color: white; font-family: "ms sans serif" ';
			config.debug = 0;
			editor_generate('wysiwyg',config);
</SCRIPT>	
<p align="center"><input type="submit" value="จัดเก็บการแก้ไข" name="save"></p>
</form>
<?include"../foot.php";?>
</body>
<? mysql_close($conn);  ?>
</html>
<!--- โปรแกรมโดย Somsak2004  -->