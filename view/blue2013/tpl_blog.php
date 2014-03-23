
	<h2>Новости проекта chsuINFO</h2> 
	<?if (isset($alert)):?>
		<p class='alert'><b>Внимание!:</b> <?=$alert?></p>
	<?endif?>
    <?foreach ($allPost as $value){ 
		
		echo "<div style='padding:10px; border: 1px solid #30AAD8; border-radius: 8px'><h3>".
			$value[title].
			"</h3>".$value[text]."<br/><b>Опубликовано:</b> ".$value[date_post]." <b>Автор:</b> ".$value[author]."</div><br/>	";
	



}?>



