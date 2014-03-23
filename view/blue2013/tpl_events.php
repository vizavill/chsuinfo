
	<h2>Предстоящие события институтов ЧГУ</h2>
	

		<?if (isset($alert)):?>
		<p class='alert'><b>Внимание!:</b> <?=$alert?></p>
	<?endif?>
	<?if ((isset($this->user[id_user]))&& ($_GET[act]!="edit")):?>
		<p class='alert'>Планируете какое-то мероприятие, но не знаете, как сообщить об этом всему университету?<br/>
		Не хотите тратиться на рекламу и пиар?<br/>
		Предлагаем вашему вниманию сервис "ПРЕДСТОЯЩИЕ СОБЫТИЯ ЧГУ"!<br/>
		Ежедневно наш сайт посещает порядка 1000 пользователей, заполните <a href='index.php?c=events&act=edit'>специальную форму</a>,  как можно более подробно описав свое событие и пусть весь университет узнает о нем!</p>
	<?elseif (!isset($this->user[id_user])):?>
		<p class='alert'>Только зарегистрированные пользователи могут добавлять события.</p>
	<?endif?>

	<?if ((isset($this->user[id_user])) && ($_GET[act]=="edit")):?>
	
	<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">

		<div style='background-color:#F9F6E7; padding:8px; border:1px solid #D9E0E7;border-radius: 8px'>
		Правила оформления события:
			<ul>
				<li  type="square">Запрещается размещение информации, которая является вульгарной или непристойной, содержит нецензурную лексику.</li>
				<li  type="square">Запрещается размещение информации, которая пропагандирует преступную деятельность или содержит советы, инструкции или руководства по совершению преступных действий</li>
				<li  type="square">Запрещается использовать изображения, содержащие сцены эротического содержания, а также сцены жестокости и насилия.</li>
				<li  type="square">При заполнении используйте свежую информацию из достоверных источников с добавлением РАБОЧИХ ссылок.</li>
				<li  type="square">Все события проходят обязательную модерацию.</li>	
			</ul>
		</div>
		<br/>
		<form enctype="multipart/form-data" action="index.php?c=events"  method="post" >
		Институт:<br/> 
		<input name="inst" size="" maxlength="50" value='<?=$event[inst]?>' required/><br/>
		Название события<br/> 
		<input name="title" size="50" maxlength="50" value='<?=$event[title]?>' required/><br/>
		Дата проведения:<br/> 
		<input name="date_event" value='<?=$event[date_event]?>' required type="date"/><br/>
		Время начала:<br/> 
		<input name="time_event" value='<?=$event[time_event]?>' required type="time"/><br/>
		Ссылка на страницу события:<br/> 
		<input name="url_event" size="50" maxlength="50" type='url' value='<?=$event[url_event]?>'required/><br/>
		Описание:<br/> 
		<textarea name="text" required cols="50" maxlength="500"  rows="6"><?=$event[text]?></textarea><br/>
		Изображение:<br/> 
		<input name="picture"  type='file' required/><br/>
		<br/>
		<?if(isset($event)):?>
		<input type='hidden' name='id_event'value="<?=$event[id]?>" />
		<input name='edit_event'value="Редактрировать" type="submit"/>		
		<?else:?>
		<input name='add_event'value="Отправить" type="submit"/>	
		<?endif?>
		</form>
	</div>
	<br/>
	<?endif?>
	
	
	
    <?foreach ($allEvent as $value){ 
		
		echo "<div style='padding:10px; border: 1px solid #30AAD8; border-radius: 8px'>
			<img src='img_event/".$value[picture]."' align='left' vspace='2' hspace='10' alt='".$value[title]."'>
		<h2>".
			$value[title]."</h2>
			
			<b>Институт: </b>".
			$value[inst].
			"<br/><b>Дата проведения: </b> ".
			$value[date_event].
			"<br/><b>Время начала: </b> ".
			$value[time_event].
			"<br/><b>Подробнее на <a href='".$value[url_event]."' target='_blank'>".$value[url_event]."</a></b><br/>
			
			<b>Описание: </b><br/>".
			$value[text].
			"			
			</div><br/>	";
	}?>
	<?if (isset($userEvent[0])):?>
	<h2>Статус ваших собыий </h2> 
	
	<?foreach ($userEvent as $value){ 
		
		echo "<div style='padding:10px; border: 1px solid #30AAD8; border-radius: 8px'>
			<img src='img_event/".$value[picture]."' align='left' vspace='2' hspace='10' alt='".$value[title]."'>
		<h2>".
			$value[title]."</h2> 
			<b>Статус:</b> ".$value[status]."
			<br/><b>Институт: </b>".
			$value[inst].
			"<br/><b>Дата проведения: </b> ".
			$value[date_event].
			"<br/><b>Время начала: </b> ".
			$value[time_event].
			"<br/><b>Подробнее на <a href='".$value[url_event]."' target='_blank'>".$value[url_event]."</a></b><br/>
			
			<b>Описание: </b><br/>".
			$value[text].
			"
			
			
			<br/><a href='index.php?c=events&act=edit&id=".$value[id]."'>редактировать</a>
			<a href='index.php?c=events&act=delete&id=".$value[id]."'>удалить</a>
			</div><br/>	";
	}?>
	<?endif?>
	



