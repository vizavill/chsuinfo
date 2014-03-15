	<h2>Расписание занятий</h2>

			
	 <div style=" height: 25px; margin-left:15px;border-radius: 8px; margin-bottom:10px;  text-align:center; border: 1px solid red;">
<?="<h2 style='padding-left: 25px'>Сейчас в ЧГУ ".$now_week." неделя</h2>"?>
</div>



				<?include_once("tpl_rasp_menu.php")?>	
		
			
			

<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px" id="center">		
	<h2>Расписание занятий на  <?echo $interim; if($wd=='week') echo" неделю." ?></h2>
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
	padding: 0 5px 0 5px;'><p> ".$value[date]." ".$value[day]."  </p></div></td></tr>";
		
		}
		$k=$value[day];
	    echo "<td bgcolor='#EEEEEE' align='center'><p>".$value[para]." пара<br />".$value[time]."</p></td>";
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

	
	
	
	
	</div>