	<h2>Массовая отправка сообщений</h2> 
		<?if (isset($alert)):?>
			<p class='alert'><b>Внимание!:</b> <?=$alert?></p>
		<?endif?>
		
    <div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">	
		<form action='index.php?c=starosta' method='post'>	 
			<div >Сообщение для отправки </div>
			<textarea   name='text' maxlength='130' cols='50' rows='7' wrap='hard' required></textarea>
			
		
	
			<div  class="setting_menu" id="Group1">
				<?if (isset($this->user[type]) && ($this->user[type]=='lecturer')){
				echo "<input name='type' id='lecturer' type='radio' value='lecturer'  checked />Я преподаватель<br />";
				echo "<input name='type' id='grup' type='radio' value='grup'/>Я студент";}
			else{
				echo "<input name='type' id='lecturer' type='radio' value='lecturer'   />Я преподаватель<br />";
				echo "<input name='type' id='grup' type='radio' value='grup' checked/>Я студент";  
			}?>
	
				
			</div>
			<div  id="sel_grup"   >
				<select style='width:70%'  size=10name="grup" >
					<? foreach ($grup as $value){
						if  (isset($this->user['person']) && ($this->user['person']==$value[title_grup])){		
							echo "<option selected>   ".$value[title_grup]." </option>";  
						}
						else{
							echo "<option >   ".$value[title_grup]." </option>";
						}
					}
					?>
				</select>
				
			</div>
			<div id="sel_lecturer">
			<select  style='width:70%'  size=10 name="lecturer"  >
				<? foreach ($lecturer as $value){		
					if  (isset($this->user['person']) && ($this->user['person']==$value[name_lecturer])){		
							echo "<option selected>   ".$value[name_lecturer]." </option>";  
						}
						else{
							echo "<option >   ".$value[name_lecturer]." </option>";
						}
					}
				?>
			</select>
			</div>
			<br/><br/><br/><br/><br/>
	
	

	<input class="submit2" type="submit" value="Сохранить" />
 	
		
			

			
		
	</form>
		<?foreach ($all_notif as $value){
			echo $value['send_date']." ".$value['text']."</br>";
		}
		?>

	</div>