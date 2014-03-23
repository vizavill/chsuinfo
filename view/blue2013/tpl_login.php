
		<? if (!isset($user)): ?>
			<div class="auth_block">
			<form action='index.php?c=login' method='post'>
				+7 <input  size=13 placeholder=" номер телефона." required type='text' name='phoneNumber'/>
				<br/>
				<input  size=15 placeholder=" пароль" required type='password' name='password'/>
				<input   type='hidden' name='remember' value='true'/>
				<br/>
				<input type='submit' name='submit'/>
			</form>
			<a href='index.php?c=reg'>Регистрация</a></br>
			<a href='index.php?c=restore'>Забыл пароль</a></br>
		  <a href='<?=$linkAuthVk?>'>Войти через ВКонтакте</a>
			</div>
		<?endif?>
		<? if (isset($user)): ?>
			<div align="center">
			<h3><?=$user[first_name]?> <?=$user[last_name]?></h3>
			<img  width="160" align='bottom' src="<?=$user[photo_200]?>">
			
			<form action='index.php?c=login' method='post'>
			<input type='submit' name='logout' value='Выйти'>
			</form>
			</div>
		<?endif?>

		<?if (($this->mUsers->Can('edit_blog'))):?>
			<div class="left_block">
				<a href="index.php?c=edit_blog">Добавить запись в блог</a><br/>
				<a href="index.php?c=notif_all">Массовая рассылка</a><br/>
				<a href="#">Панель администратора</a><br/>
			</div>
		<?endif?>
		<?if (isset($user) && ($user[person]=='')):?>
			<div class='alert'">
				Для оформления SMS подписки, укажите в <a href="index.php?c=setting">настройках профиля</a> ваше имя и группу.
			</div>
		<?endif?>
		<?if (0):?>
			<div class='alert'">
				Добавь учика в друзья<a href="index.php?c=setting">настройках профиля</a> ваше имя и группу.
			</div>
		<?endif?>
		<?if (isset($user) && count($all_notif) && $all_notif[0]['send_all']==1):?>
			<div class="starosta_notif_block">
			<h2>Староста <?=$all_notif[0]['grup']?></h2>
				<?=$all_notif[0]['text']?>
			</div>
		<?endif?>	
			
		<!-- VK Widget -->
		<div style="margin-top:15px" id="vk_groups"></div>	
		