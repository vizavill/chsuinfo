	<h2>Настройки пользователя</h2>
		<?if (isset($alert)):?>
			<p class='alert'><b>Внимание!:</b> <?=$alert?></p>
		<?endif?>
	
		<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
			Ваше имя:  <b style='color:red'> <?=$first_name." ".$last_name?></b>
			<br/>
			Ваш номер телефона: <b style='color:red'> <?=$phone_number?></b>
			<br/>
			Вы студент (преподаватель): <b style='color:red'><?=$person?></b>
			<br/>
			
		<?if ($this->user[id_vk]==0):?>
			 <a href='<?=$linkAuthVk?>'>Привязать аккаунт Вконтакте</a>
		<?else:?>
			<a href='<?=$linkAuthVk?>'>Загрузить данные из профиля "ВКонтакте"</a>
		<?endif?>	
		</div>
	
		<br/>

		<form action="index.php?c=setting"  method="post">
	
			<div  class="setting_menu" id="Group1">
				<?if (isset($this->user[type]) && ($this->user[type]=='lecturer')){
				echo "<input name='type' id='lecturer' type='radio' value='lecturer'  checked />Я преподаватель<br />";
				echo "<input name='type' id='grup' type='radio' value='grup'/>Я студент";}
			else{
				echo "<input name='type' id='lecturer' type='radio' value='lecturer'   />Я преподаватель<br />";
				echo "<input name='type' id='grup' type='radio' value='grup' checked/>Я студент";  
			}?>
	
				
			</div>
			<div class="setting_menu" id="sel_grup"   >
				<select  name="grup" >
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
				<input type='text' placeholder="Имя" name='first_name'  value='<?=$first_name?>'></input></br>
				<input type='text' placeholder="Фамилия" name='last_name'  value='<?=$last_name?>'></input>
			</div>
			<div class="setting_menu" id="sel_lecturer">
			<select  name="lecturer"  >
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
	
	<em>Если вы желаете получать оповещения от старосты вашей группы укажите ваше имя (фамилию) и группу в которой вы обучаетесь.</em>
<br/>

	<input  type="submit" value="Сохранить" />
 	
		
			

			
		
	</form>
		


		