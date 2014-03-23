<?if (($this->mUsers->Can('send_sms_group'))):?>
	<h2>Кабинет старосты группы <?=$this->user[starosta]?></h2> 
		<?if (isset($alert)):?>
			<p class='alert'><b>Внимание!:</b> <?=$alert?></p>
		<?endif?>
		
    <div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">	
		<form action='index.php?c=starosta' method='post'>	 
			<div >Сообщение для группы (в этом месяце осталось <?=$count_not?> сообщений) </div>
			<textarea   name='text' maxlength='130' cols='50' rows='7' wrap='hard' required></textarea>
			<br/>
			<br/>
			Контакты
			<br/>
			<select  style='width:70%'  size=10  multiple name="mas_number[]">
				<?
					foreach($all_odnogrup as $value){
						echo "<option value='$value[phone_number]'> 7".$value[phone_number]." - ".$value[first_name]." ".$value[last_name]."</option>";
					}
				?>
			</select>
			<br>
			* для того чтобы выбрать несколько получателей удерживайте клавишу Ctrl.
			<br/>
			<input name='sendAll' type="checkbox"  value="true" />Отправить сообщение всем одногруппникам, также сообщение для одногруппников выведется в левом блоке сайта. При выборочной отправке сообщение в блоке с лева не отобразится.</p>
			<input type="submit"  value="Отправить" /></p>
		</form>	
		<?foreach ($all_notif as $value){
			echo $value['send_date']." ".$value['text']."</br>";
		}
		?>

	</div>
	<?else:?>
		<h2>Кабинет старосты</h2>
		<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
			Если Вы староста, то этот сервис специально для Вас. Здесь Вы легко сможете оповестить одногруппников о каком-либо событии в виде SMS сообщения. Так же есть возможность отправить SMS одному или нескольким одногруппникам. Для того, чтобы получить доступ к кабинету старосты, отправьте на электронный адрес <b>vizavil@ya.ru</b> фотографию или скан удостоверения старосты и номер телефона, который Вы использовали при регистрации на сайте.
		</div>
	<?endif?>