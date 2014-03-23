	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
	<link rel="stylesheet" type="text/css" href="../view/template_hi/tcal.css" />
	<link rel="shortcut icon" href="favicon.ico" ></link>
	<link rel="stylesheet" type="text/css" href="view/images/style.css" />
	<script type="text/javascript" src="../new/view/js/tcal.js"></script> 
	<script type="text/javascript" src="../new/view/js/jquery.js"></script>
	<script type="text/javascript" src="../new/view/js/main.js"></script>
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>
	<script type="text/javascript">
	VK.Widgets.Group("vk_groups", {mode: 2, width: "190", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '33ADDB'}, 43257191);
	</script>
	
	
 
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />

	

	<title>Расписание ЧГУ</title>
</head>
<body>


<div class="width=100% height=100% align-left"></div><div class="width=100% height=100% align-left"></div><div class="align-left"></div>
	<div id="content">
		<div class="header">
			
		
			<h1><a href="http://chsuinfo.ru">chsuINFO.ru</a></h1>
		</div>
		<?include_once("tpl_menu.php")?>

		
		
		

		<div class="right"><h2>Расписание занятий</h2>

			
	 



					
		
			
			

<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px" id="center">		

		<table width='100%'>	
	<?
    if (!empty($mas_rasp)){
	foreach ($mas_rasp as $value){
		echo"<div ><tr style='padding:10px; border: 1px solid #30AAD8; border-radius: 8px'>";
		if ($value[day]!=$k){
			echo "<tr ><td style=' width:151px' align='center'><div style='background: #33ADDB url(hmleftbg.gif) repeat-x;line-height: 28px;
	width: 193px;
	background: #33ADDB url(hmleftbg.gif) repeat-x;
	color: #FFFFFF;
	padding: 0 5px 0 5px;'><p>".$value[day]."  </p></div></td></tr>";
		
		}
		$k=$value[day];
	    echo "<td bgcolor='#EEEEEE' align='center'><p>".$value[para]."<br />".$value[time]."</p></td>";
		echo "<td bgcolor='#EEEEEE' align='center'><p>".$value[discip]."<br/>".$value[lecturer]."</p></td>";
		echo "<td bgcolor='#EEEEEE' align='center'><p>".$value[address]."</p></td>";
		echo"</tr></div>";
		
	}
	
	}
	  
	else 
	{
	echo"<p class='error'>Извините, но занятия не найдены!</p>";
	}
	?>
	</table>
<a href='index.php?c=rasp&act=print'>print</a>
	
	
	
	
	</div>
	</div>



		<div class="left">

			
	 
<?include_once("tpl_login.php")?>


				
		
			
			
		</div>

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<div class="footer">












			
			<p><a href="http://vk.com/vizavill">Вадим Осюков</a>

</p>













</div></div></body></html>