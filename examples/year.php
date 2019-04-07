<html>
<head>
<title>Persian Calendar For Year 1398</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
@font-face {
  font-family: 'Tanha';
  src: url('fonts/Tanha-FD.eot') format('eot'),  
       url('fonts/Tanha-FD.woff') format('woff'),
       url('fonts/Tanha-FD.ttf') format('truetype');  
  font-style:normal;
  font-weight:normal;
}
Body
{  
background-color: #EEEEDD;
font-family: Tanha; 
color: #000000;
font-size: 14 px;
margin-top: 0;
margin-left: 0
}
</style>
</head>

<body>
<?php
include "../Calendar.Class.php";
$c = new Calendar;
$c->SetStyle();
?>
<div align="center">
<table width="85%">
<tr>
<td valign="top"><?php $c->ShowJalaliMonth(1398,3) ?></td>
<td valign="top"><?php $c->ShowJalaliMonth(1398,2) ?></td>
<td valign="top"><?php $c->ShowJalaliMonth(1398,1) ?></td>
</tr>
<tr>
<td valign="top"><?php $c->ShowJalaliMonth(1398,6) ?></td>
<td valign="top"><?php $c->ShowJalaliMonth(1398,5) ?></td>
<td valign="top"><?php $c->ShowJalaliMonth(1398,4) ?></td>
</tr>
<tr>
<td valign="top"><?php $c->ShowJalaliMonth(1398,9) ?></td>
<td valign="top"><?php $c->ShowJalaliMonth(1398,8) ?></td>
<td valign="top"><?php $c->ShowJalaliMonth(1398,7) ?></td>
</tr>
<tr>
<td valign="top"><?php $c->ShowJalaliMonth(1398,12) ?></td>
<td valign="top"><?php $c->ShowJalaliMonth(1398,11) ?></td>
<td valign="top"><?php $c->ShowJalaliMonth(1398,10) ?></td>
</tr>
</table>
</div>

</body>
</html>
