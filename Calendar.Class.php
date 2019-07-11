﻿<?php
//--------------------------------------------
//Class Name : Persian Calendar Class
//Published Date: 20 Apr 2005
//Author Email : haghparast@gmail.com
//License : Freeware
//--------------------------------------------
class Calendar
{
	var $OutputText = "";
	function SetStyle()
	{
		$Style = 
				"
				<style>
				table {
				background-color: #EEEEDD;
				border-width: 0;
				font-size: 18px;
				}
				
				td.day {
				border:1px solid #bfbf94; background-color: #EEEEDD;
				text-align: center;
				direction: rtl 
				}
				
				td.month {
				border:1px solid #8e8d89; background-color: #1ee4bd;
				font-size : 15px;
				text-align: center;
				direction: rtl ;
				}
				
				td.today {
				border:1px solid #c6a646; background-color: #FFCCFF;
				text-align: center;
				direction: rtl 
				}

				a{
					text-decoration:none;
					color:black;
				}

				td.day:hover {
  				  background: #262f34;
				}

				td.day:hover a{
  				  color: white;
				}


				td.day {
  				  transition: all ease-in-out 3s;
				}
				</style>
				";
		print $Style;
	}
	
	function ReturnMonthName($monname)
	{
			switch ($monname)
			{
			case 1: 
				return "فروردين";
				break;
			case 2: 
				return "ارديبهشت";
				break;
			case 3: 
				return "خرداد";
				break;
			case 4: 
				return "تير";
				break;
			case 5: 
				return "مرداد";
				break;
			case 6: 
				return "شهريور";
				break;
			case 7: 
				return "مهر";
				break;
			case 8: 
				return "آبان";
				break;
			case 9: 
				return "آذر";
				break;
			case 10: 
				return "دى";
				break;
			case 11: 
				return "بهمن";
				break;
			case 12: 
				return "اسفند";
				break;
			}
	}
	function div($a,$b) 
	{
		return (int) ($a / $b);
	}
	function gregorian_to_jalali ($g_y, $g_m, $g_d)
	{
		$g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		$j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);     
	
	   $gy = $g_y-1600;
	   $gm = $g_m-1;
	   $gd = $g_d-1;
	
	   $g_day_no = 365*$gy+$this->div($gy+3,4)-$this->div($gy+99,100)+$this->div($gy+399,400);
	
	   for ($i=0; $i < $gm; ++$i)
		  $g_day_no += $g_days_in_month[$i];
	   if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
		  /* leap and after Feb */
		  $g_day_no++;
	   $g_day_no += $gd;
	
	   $j_day_no = $g_day_no-79;
	
	   $j_np = $this->div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
	   $j_day_no = $j_day_no % 12053;
	
	   $jy = 979+33*$j_np+4*$this->div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */
	
	   $j_day_no %= 1461;
	
	   if ($j_day_no >= 366) {
		  $jy += $this->div($j_day_no-1, 365);
		  $j_day_no = ($j_day_no-1)%365;
	   }
	
	   for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
		  $j_day_no -= $j_days_in_month[$i];
	   $jm = $i+1;
	   $jd = $j_day_no+1;
	
	   return array($jy, $jm, $jd);
	}
	
	function jalali_to_gregorian($j_y, $j_m, $j_d)
	{
		$g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		$j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
		
	   $jy = $j_y-979;
	   $jm = $j_m-1;
	   $jd = $j_d-1;
	
	   $j_day_no = 365*$jy + $this->div($jy, 33)*8 + $this->div($jy%33+3, 4);
	   for ($i=0; $i < $jm; ++$i)
		  $j_day_no += $j_days_in_month[$i];
	
	   $j_day_no += $jd;
	
	   $g_day_no = $j_day_no+79;
	
	   $gy = 1600 + 400*$this->div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
	   $g_day_no = $g_day_no % 146097;
	
	   $leap = true;
	   if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */
	   {
		  $g_day_no--;
		  $gy += 100*$this->div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */
		  $g_day_no = $g_day_no % 36524;
	
		  if ($g_day_no >= 365)
			 $g_day_no++;
		  else
			 $leap = false;
	   }
	
	   $gy += 4*$this->div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
	   $g_day_no %= 1461;
	
	   if ($g_day_no >= 366) {
		  $leap = false;
	
		  $g_day_no--;
		  $gy += $this->div($g_day_no, 365);
		  $g_day_no = $g_day_no % 365;
	   }
	
	   for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
		  $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
	   $gm = $i+1;
	   $gd = $g_day_no+1;
	
	   return array($gy, $gm, $gd);
	}
	
	function EvaluateLeap($jyear)
	{
		list( $gyear, $gmonth, $gday1 ) = $this->jalali_to_gregorian($jyear, 12, 29);
		list( $gyear, $gmonth, $gday2 ) = $this->jalali_to_gregorian($jyear+1, 1, 1);
		if ($gday2 - $gday1 > 1) return true; else return false;
	}

	function CalculateTotalDays($jmonth)
	{
		switch ($jmonth)
		{
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			$TotalDays = 31;
			break;
			case 7:
			case 8:
			case 9:
			case 10:
			case 11:
			$TotalDays = 30;
			break;
			case 12:
			$TotalDays = 29;
			break;
		}
		return $TotalDays;
	}
	function ShowJalaliMonth($jyear,$jmonth)
	{
	$todaygyear = date("Y");
	$todaygmonth = date("m");
	$todaygday = date("d");
	$staff_id=null;
	list( $todayjyear, $todayjmonth, $todayjday ) = $this->gregorian_to_jalali($todaygyear, $todaygmonth, $todaygday);

   

	list( $gyear, $gmonth, $gday ) = $this->jalali_to_gregorian($jyear, $jmonth, 1);
	$FirstDay = mktime(0,0,0,$gmonth,$gday,$gyear);
	$FirstDayArray = getdate($FirstDay);
	$DayOfWeek = $FirstDayArray['wday'];

	$current_year_shamsi=$todayjyear;

	switch ($DayOfWeek)
	{
		case 0:
		$Difference = -1;
		break;
		case 1:
		$Difference = -2;
		break;
		case 2:
		$Difference = -3;
		break;
		case 3:
		$Difference = -4;
		break;
		case 4:
		$Difference = -5;
		break;
		case 5:
		$Difference = -6;
		break;
		case 6:
		$Difference = 0;
		break;
	}
	$this->OutputText = '<table width="100%">'."\n";
	$this->OutputText .= '  <tr>'."\n";
	$this->OutputText .= '	<td class="month" colspan="7" width="100%">'.$this->ReturnMonthName($jmonth).'&nbsp;&nbsp;'.$jyear.'</td>'."\n";
	$this->OutputText .= '  </tr>'."\n";
	$this->OutputText .= '  <tr>'."\n";
	$this->OutputText .= '	<td class="month">جمعه</td>'."\n";
	$this->OutputText .= '	<td class="month">پنجشنبه</td>'."\n";
	$this->OutputText .= '	<td class="month">چهارشنبه</td>'."\n";
	$this->OutputText .= '	<td class="month">سه شنبه</td>'."\n";
	$this->OutputText .= '	<td class="month">دوشنبه</td>'."\n";
	$this->OutputText .= '	<td class="month">يکشنبه</td>'."\n";
	$this->OutputText .= '	<td class="month">شنبه</td>'."\n";
	$this->OutputText .= '  </tr>'."\n";
	for ($i=0;$i<6;$i++)
		{
			$Const = 7*$i+$Difference ;
			$DaysInMonth = $this->CalculateTotalDays($jmonth);
			$leap = $this->EvaluateLeap($jyear);
			if (($jmonth == 12) && ($leap == true)) $DaysInMonth++;
			$this->OutputText .= '  <tr>'."\n";
			$this->OutputText .= '	<td ';
			$tOutput=$Const + 7;
            $tdate=$current_year_shamsi.'-'.sprintf('%02d', $jmonth).'-'.sprintf('%02d', $tOutput);
            if(isset($arr_all_off_day)  &&  in_array($tdate, $arr_all_off_day)) {
               					$highlight = 'highlight';
            	}else{
                				$highlight = '';
             	}

		  if (($Const + 7  == $todayjday) && ($jmonth == $todayjmonth) && ($current_year_shamsi == $todayjyear)) $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date today date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'"; else
  $Output = $Const + 7;
   if(($Output>0) && ($Output<=$DaysInMonth) && ($Output<$todayjday)){
       $this->OutputText .= "class=\" nottoday ct-tooltipss-load tooltipstered  day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">'."\n";
   }else{
                 $this->OutputText .= "class=\" ct-tooltipss-load ct-weekday tooltipstered selected_date day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }

			//$this->OutputText .= '>'."\n";
			$Output = $Const + 7;
			if (($Output>0) && ($Output<=$DaysInMonth)) $this->OutputText .= $Output;
			$this->OutputText .= '	</td>'."\n";
			$this->OutputText .= '	<td ';
			$tOutput=$Const + 6;
			$tdate=$current_year_shamsi.'-'.sprintf('%02d', $jmonth).'-'.sprintf('%02d', $tOutput);
                 if(isset($arr_all_off_day)  &&  in_array($tdate, $arr_all_off_day)) {
                     $highlight = 'highlight';
                 }else{
                     $highlight = '';
                 }

			  if (($Const + 6  == $todayjday) && ($jmonth == $todayjmonth) && ($current_year_shamsi == $todayjyear)) $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date today date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'"; else
                     $Output = $Const + 6;
             if(($Output>0) && ($Output<=$DaysInMonth) && ($Output<$todayjday)) {
                 $this->OutputText .= "class=\"nottoday ct-tooltipss-load tooltipstered  day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }else{
                 $this->OutputText .= "class=\" ct-tooltipss-load ct-weekday tooltipstered selected_date day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }
                 $Output = $Const + 6;

			if (($Output>0) && ($Output<=$DaysInMonth)) $this->OutputText .= $Output;
			$this->OutputText .= '	</td>'."\n";
			$this->OutputText .= '	<td ';
			$tOutput=$Const+ 5 ;
                 $tdate=$current_year_shamsi.'-'.sprintf('%02d', $jmonth).'-'.sprintf('%02d', $tOutput);
                 if(isset($arr_all_off_day)  &&  in_array($tdate, $arr_all_off_day)) {
                     $highlight = 'highlight';
                 }else{
                     $highlight = '';
                 }

		   if (($Const + 5  == $todayjday) && ($jmonth == $todayjmonth) && ($current_year_shamsi == $todayjyear)) $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date today date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'"; else
                     $Output = $Const + 5;
             if(($Output>0) && ($Output<=$DaysInMonth) && ($Output<$todayjday)) {
                 $this->OutputText .= "class=\"nottoday ct-tooltipss-load tooltipstered  day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }else{
                 $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }
             $Output = $Const + 5;

			if (($Output>0) && ($Output<=$DaysInMonth)) $this->OutputText .= $Output;
			$this->OutputText .= '	</td>'."\n";
			$this->OutputText .= '	<td ';
			$tOutput= $Const+4;

			$tdate=$current_year_shamsi.'-'.sprintf('%02d', $jmonth).'-'.sprintf('%02d', $tOutput);
                 if(isset($arr_all_off_day)  &&  in_array($tdate, $arr_all_off_day)) {
                     $highlight = 'highlight';
                 }else{
                     $highlight = '';
                 }

			   if (($Const + 4  == $todayjday) && ($jmonth == $todayjmonth) && ($current_year_shamsi == $todayjyear)) $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date today date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'"; else
                     $Output = $Const + 4;
             if(($Output>0) && ($Output<=$DaysInMonth) && ($Output<$todayjday)) {
                 $this->OutputText .= "class=\"nottoday ct-tooltipss-load tooltipstered  day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }else{
                 $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }
                 $Output = $Const + 4;


			if (($Output>0) && ($Output<=$DaysInMonth)) $this->OutputText .= $Output;
			$this->OutputText .= '	</td>'."\n";
			$this->OutputText .= '	<td ';
			$tOutput=$Const + 3 ;
			 $tdate=$current_year_shamsi.'-'.sprintf('%02d', $jmonth).'-'.sprintf('%02d', $tOutput);
                 if(isset($arr_all_off_day)  &&  in_array($tdate, $arr_all_off_day)) {
                     $highlight = 'highlight';
                 }else{
                     $highlight = '';
                 }

			  if (($Const + 3  == $todayjday) && ($jmonth == $todayjmonth) && ($current_year_shamsi == $todayjyear)) $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date today date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'"; else
                     $Output = $Const + 3;
             if(($Output>0) && ($Output<=$DaysInMonth) && ($Output<$todayjday)) {
                 $this->OutputText .= "class=\"nottoday ct-tooltipss-load tooltipstered day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }else{
                 $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }
                 $Output = $Const + 3;


			if (($Output>0) && ($Output<=$DaysInMonth)) $this->OutputText .= $Output;
			$this->OutputText .= '	</td>'."\n";
			$this->OutputText .= '	<td ';
			$tOutput=$Const+2;
                 $tdate=$current_year_shamsi.'-'.sprintf('%02d', $jmonth).'-'.sprintf('%02d', $tOutput);
                 if(isset($arr_all_off_day)  &&  in_array($tdate, $arr_all_off_day)) {
                     $highlight = 'highlight';
                 }else{
                     $highlight = '';
                 }

			 if (($Const + 2  == $todayjday) && ($jmonth == $todayjmonth) && ($current_year_shamsi == $todayjyear)) $this->OutputText .= "class=\" ct-tooltipss-load ct-weekday tooltipstered selected_date today date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'"; else
                     $Output = $Const + 2;
             if(($Output>0) && ($Output<=$DaysInMonth) && ($Output<$todayjday)) {
                 $this->OutputText .= "class=\"nottoday ct-tooltipss-load  tooltipstered  day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }else{
                 $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }
                 $Output = $Const + 2;

			if (($Output>0) && ($Output<=$DaysInMonth)) $this->OutputText .= $Output;
			$this->OutputText .= '	</td>'."\n";
			$this->OutputText .= '	<td ';
			$tOutput=$Const+1;
                 $tdate=$current_year_shamsi.'-'.sprintf('%02d', $jmonth).'-'.sprintf('%02d', $tOutput);
                 if(isset($arr_all_off_day)  &&  in_array($tdate, $arr_all_off_day)) {
                     $highlight = 'highlight';
                 }else{
                     $highlight = '';
                 }

			if (($Const + 1  == $todayjday) && ($jmonth == $todayjmonth) && ($current_year_shamsi == $todayjyear)) $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date today date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate'"; else
                     $Output = $Const + 1;
             if(($Output>0) && ($Output<=$DaysInMonth) && ($Output<$todayjday)) {
                 $this->OutputText .= "class=\"nottoday ct-tooltipss-load tooltipstered  day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate' ";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }else{
                 $this->OutputText .= "class=\"ct-tooltipss-load ct-weekday tooltipstered selected_date day date_single RR offsingledate $highlight\" id='$tdate' data-prov_id='$staff_id' data-selected_dates='$tdate' ";
                 $this->OutputText .= '><a href="javascript:void(0)">' . "\n";
             }
                 $Output = $Const + 1;

			if (($Output>0) && ($Output<=$DaysInMonth)) $this->OutputText .= $Output;
			$this->OutputText .= '	</td>'."\n";
			$this->OutputText .= '  </tr>'."\n";
		}
	$this->OutputText .= '</table>'."\n";
	print $this->OutputText;
	}
}

