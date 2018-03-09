<?  // ฟังชั่น โดย Somsak2004
function thaidate($date)
{
   
	$date_aray=explode('-',$date);
    $day=$date_aray[2];
	if (strlen($day)==2) {$day=intval($day);}
             switch ($date_aray[1])
		 {
			 case 1 : $month="มกราคม"; break;
			 case 2 : $month="กุมภาพันธ์"; break;
			 case 3 : $month="มีนาคม"; break;
			 case 4 : $month="เมษายน"; break;
			 case 5 : $month="พฤษภาคม"; break;
			 case 6 : $month="มิถุนายน"; break;
			 case 7 : $month="กรกฎาคม"; break;
			 case 8 : $month="สิงหาคม"; break;
			 case 9 : $month="กันยายน"; break;
			 case 10 : $month="ตุลาคม"; break;
			 case 11 : $month="พฤศจิกายน"; break;
			 case 12 : $month="ธันวาคม"; break;
		 }   
    $year=$date_aray[0]+543;
	if ($date=="0000-00-00") {return "ยังไม่ระบุวัน";}else{return "$day $month พศ. $year";}
}

?>