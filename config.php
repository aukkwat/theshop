﻿<?php
//* กำหนดค่าเริ่มต้นที่ใช้งานฐานข้อมูล *
// สร้างโดย Somsak2004 
$_hostname ="mysql";  //ชื่อโฮสของ MySQL
$_dbname    ="theshop";    // ชื่อฐานข้อมูล MySQL
$_dbuser      ="aukkwat";     // ชื่อผู้ใช้ฐานข้อมูล
$_dbpass      ="bigmaster";   // รหัสผ่านฐานข้อมูล
mysql_connect($_hostname,$_dbuser,$_dbpass) or die("ติดต่อฐานข้อมูลไม่ได้"); 
mysql_select_db($_dbname) or die("เลือกฐานข้อมูลไม่ได้"); 
$conn=mysql_connect($_hostname,$_dbuser,$_dbpass); 
mysql_query("SET NAMES UTF8"); 
?> 
