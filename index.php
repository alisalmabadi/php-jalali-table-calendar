<!DOCTYPE html>
<html>
<head>
	<title>jalali date demo</title>
</head>

<style>
a{
	text-decoration: none;
	color:black;
}

@font-face {
  font-family: 'Tanha';
  src: url('examples/fonts/Tanha-FD.eot') format('eot'),  
       url('examples/fonts/Tanha-FD.woff') format('woff'),
       url('examples/fonts/Tanha-FD.ttf') format('truetype');  
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

.container{
	width: 100%;
	height: 100%;
}

.row{
	padding-right: 30px;
	padding-left: 30px;
}

.col5{
	width: 50%;
}

.center{
	float: none;
	margin:0 auto;
}

.year{
	padding: 20px;
	background: #74dcd2;
}

.month{
	padding: 20px;
	background: #ff4949;
}

.textcenter{
	text-align: center;
}

.margin-top{
	margin-top:15%;
}
.title{
	margin-bottom: 2%;
	font-size: 20px;
	font-weight: bold;

}
</style>

<body>
<div class="container">

<div class="row margin-top">
	<div class="title textcenter">دمو ها</div>
	<a href="examples/year.php"><div class="col5 center textcenter year">دموی تقویم سال</div></a>
		<a href="examples/month.php"><div class="col5 center textcenter month">دموی تقویم ماه</div></a>

</div>


</div>
</body>
</html>