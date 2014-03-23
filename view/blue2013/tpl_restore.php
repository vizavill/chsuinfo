
<div>
	<h2>Форма востановления пароля</h2> 
	<?if (isset($alert)):?>
		<?include_once ("tpl_alert.php");?>
	<?endif?>
    
	<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">	
		<form action="index.php?c=restore"  method="post">
			<p>Для востановления пароля вам необходимо указать номер вашего мобильного телефона, на который будет выслано бесплатное SMS сообщение с новым паролем</p>
			<p>Номер мобильного телефона в формате 10 цифр.
			<div >+7 <input type="text" placeholder="9115148679" name="phone_number"  required/></div>
			<br />
			
			
			<input  type="submit" value="Востановить пароль" />
		</form>
</div>	
</div>	