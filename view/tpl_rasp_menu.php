
	<form action="index.php?c=rasp" id="form_rasp" method="post">     
	
	<div class="rasp_menu" name="Group1" id="Group1"  >
		<legend>Расписание для:</legend>
			<?if (isset($_COOKIE['person'])&& ($_COOKIE['person']=='lecturer')){
				echo "<input name='person' id='lecturer' type='radio' value='lecturer' checked='checked' />Преподавателя<br />";
				echo "<input name='person' id='grup' type='radio' value='grup'/>Студента";}
			else{
				echo "<input name='person' id='lecturer' type='radio' value='lecturer'  />Преподавателя<br />";
				echo "<input name='person' id='grup' type='radio' value='grup' checked='checked'/>Студента";
			}
			?> 
    </div>
	
    <div class="rasp_menu" name="Group2" id="Group2"  >
		<legend>Тип</legend>
			<?if (isset($_COOKIE['wd']) && ($_COOKIE['wd']=='date')){
				echo "<input name='wd' id='date' type='radio' value='date' checked='checked' />Дата<br />";
				echo "<input name='wd' id='week' type='radio' value='week'/>Неделя";}
			else{
				echo "<input name='wd' id='date' type='radio' value='date' />Дата<br />";
				echo "<input name='wd' id='week' type='radio' value='week'  checked='checked'/>Неделя";  
			}
			?>
    
	</div>
	<div class="rasp_menu" style="width: 27%">
	<select name="sel_grup" id="sel_grup" >
		<? foreach ($grup as $value){
			if  (isset($_COOKIE['sel_grup']) && ($_COOKIE['sel_grup']==$value[title_grup]))
		{		
		echo "<option selected>   ".$value[title_grup]." </option>";  
		}
		else{
			echo "<option >   ".$value[title_grup]." </option>";
		}
		}
		?>
	</select>
    
    <select name="sel_lecturer" id="sel_lecturer" style="width:175px" >
		<? foreach ($lecturer as $value){
			if (isset($_COOKIE['sel_lecturer']) && ($_COOKIE['sel_lecturer']==$value[name_lecturer])){		
				echo "<option selected>   ".$value[name_lecturer]." </option>";
			}
			else{
				echo "<option >   ".$value[name_lecturer]." </option>";
			}
		}
		?>
	</select>


	<div id="sel_week">
	неделя
	<select name="sel_week" style="width:58px" >
		<?for ($i=1;$i<=$week;$i++){
			if (isset($_COOKIE['sel_week']) && ($_COOKIE['sel_week']==$i)){		
				echo "<option selected>   ".$i." </option>";
			}
			elseif($i==$now_week){
				echo "<option selected>   ".$i." </option>";
			}
			else{
				echo "<option>   ".$i." </option>";
			}
		}
		?>
	</select>
	</div>
	
    
   <?if (isset($_COOKIE['sel_date'])){
	$date=$_COOKIE['sel_date'];
   }
   else{
	$date=date('d-m-Y');
   }
   echo"<input  id='sel_date' type='text' name='sel_date' class='tcal' value='$date' />"
	?>

</div>
<br />
<input style="margin-left:15px;" type="submit" name="submit" value="Показать">
<br /><br /><br />
<br />
</form>
