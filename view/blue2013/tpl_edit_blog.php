
	<h2>Управление блогом</h2> 
	<?if (isset($alert)):?>
		<p class='alert'><b>Внимание!:</b> <?=$alert?></p>
	<?endif?>
    
	<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">	
		<form action="index.php?c=edit_blog"  method="post">
		Название новости<br/> 
		<input name="title" size="50" maxlength="50" required/><br/>
		Текст<br/> 
		<textarea name="text" required cols="50" maxlength="500" rows="6"></textarea><br/>
		Автор:<br/> 
		<input name="author" size="50" maxlength="50" required/><br/>
		Дата:<br/> 
		<input name="date_post" value="<?=date("d-m-Y")?>" required type="date"/><br/>
		<input value="Опубликовать" type="submit"/>	
			
			
			
		</form>
	</div>	

	