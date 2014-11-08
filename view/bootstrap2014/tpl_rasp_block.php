<div class="container">
	<form role="form" action="index.php?c=rasp" method="get">
		<div class="row" style="padding-left:15px">
			
			<div class="inline-block" style="margin-right:12px;">
			
				<?if ($person != 'lecturer'):?>
					<select name="g"  class="selectpicker" data-live-search="true" data-width="230px">
						<? foreach ($grup as $value)
						{
							if  ($sel_grup==$value[title_grup])
							{		
								echo "<option selected>   ".$value[title_grup]." </option>";  
							}
							else
							{
								echo "<option >   ".$value[title_grup]." </option>";
							}
						}
						?>
					</select>
					 
						<?else:?>
					<select name="l"  class="selectpicker" data-live-search="true" data-width="230px"> 
						<? foreach ($lecturer as $value)
						{
							if  ($sel_lecturer==$value[name_lecturer])
							{		
								echo "<option selected>   ".$value[name_lecturer]." </option>";  
							}
							else
							{
								echo "<option >   ".$value[name_lecturer]." </option>";
							}
						}
						?>
					</select>
						<?endif?>
			</div>
			
			<div class="inline-block" style="margin-right:12px;">
				<?if ($person != 'lecturer'):?>
					<a href="index.php?c=rasp&g=<?=$sel_grup?>&w=<?=($sel_week-1)?>&p=<?=($person)?>" type="button" class="btn btn-default btn-md" style="display:inline"><span class="glyphicon glyphicon-chevron-left"></span></a>
				<?else:?>
					<a href="index.php?c=rasp&l=<?=$sel_lecturer?>&w=<?=($sel_week-1)?>&p=<?=($person)?>" type="button" class="btn btn-default btn-md" style="display:inline"><span class="glyphicon glyphicon-chevron-left"></span></a>
				<?endif?>
				
				<select name="w" class="selectpicker" data-live-search="true" data-width="127px" data-size="10">
					<?for ($i=1;$i<=$week;$i++)
					{
						if ($sel_week==$i)
						{		
							echo "<option value=".$i." selected>   ".$i." Неделя</option>";
						}
						elseif($i==$now_week && $sel_week==NULL)
						{
							echo "<option value=".$i." selected>   ".$i." Неделя</option>";
						}
						else
						{
							echo "<option value=".$i." >   ".$i." Неделя</option>";
						}
					}
					?>		 
					</select>
								
				<?if ($person != 'lecturer'):?>
					<a href="index.php?c=rasp&g=<?=$sel_grup?>&w=<?=($sel_week+1)?>&p=<?=($person)?>" type="button" class="btn btn-default btn-md" style="display:inline"><span class="glyphicon glyphicon-chevron-left"></span></a>
				<?else:?>
					<a href="index.php?c=rasp&l=<?=$sel_lecturer?>&w=<?=($sel_week+1)?>&p=<?=($person)?>" type="button" class="btn btn-default btn-md" style="display:inline"><span class="glyphicon glyphicon-chevron-right"></span></a>
				<?endif?>
				
			</div>
				<input name="p" type="hidden" value="<?=($person)?>"/>
			<div class="inline-block" style="margin-right:12px;">
				<button type="submit" class="btn btn-danger">Отобразить</button>
			</div>
		
			<div class="inline-block" style="margin-right:12px;">
				<button type="button" class="btn btn-default visible-lg-inline visible-md-inline" disabled>В ЧГУ <? echo $now_week; ?> неделя.</button>
			</div>
		
			<div class="inline-block" style="float:right">
				<div id="vk_like_big" class="visible-md-inline visible-lg-inline pull-right" style="display:absolute; top:6px;"></div>
				<div id="vk_like_mini" class="visible-sm-inline pull-right" style="display:absolute; top:6px;"></div>
				<script type="text/javascript">
					VK.Widgets.Like("vk_like_big", {type: "button", height: 24});
					VK.Widgets.Like("vk_like_mini", {type: "mini", height: 24});
				</script>
			</div>
		</div>
		</form>		
		<hr>
		
		<div class="row" style="padding-left:15px;padding-right: 15px;">
			<div id="msg"></div>
			<!--
			<div class="alert alert-danger" role="alert">Расписание на данную неделю не найдено</div>
			<div class="alert alert-info" role="alert">Отобразите ваше расписание</div>
			
			<div class="follow">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".followmodal">Подписаться на рассылку</button>
				<button type="button" class="btn btn-success">Изменить настройки рассылки</button>
			</div>
			
			<div class="alert alert-danger fade in" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">?</span><span class="sr-only">Close</span></button>
			  <strong>Ошибка!</strong> Вы должны войти в профиль. <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".authmodal">Войти в профиль</button>
			</div>
			
			<div class="alert alert-success fade in" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">?</span><span class="sr-only">Close</span></button>
			  <strong>Отлично!</strong> Вы успешно подписались на расписание.
			</div>
			-->
			
			<div class="follow">
				<?if((isset($sel_lecturer)  && $person == 'lecturer') || (isset($sel_grup) && $person == 'group')):?>
				
					<?if(!isset($vk)):?>
						<a type="button" class="btn btn-primary followbtn" data-toggle="modal" data-target=".followmodal" style="margin-right:10px;">Подписаться на рассылку</a>
					<?endif?>
					<?if(isset($vk)):?>
						<a type="button" class="btn btn-danger followbtn" style="margin-right:10px;" href="index.php?c=vk_rasp&mailing=delete&id_mailing=<?=$vk[id_mailing]?>">Отписаться от рассылки</a>
					<?endif?>
				<?endif?>
				
				<?if(!((isset($sel_lecturer)  && $person == 'lecturer') || (isset($sel_grup))  && $person == 'group')):?>
					<div class="alert alert-info" role="alert">Отобразите ваше расписание</div>
					
				<?else:?>
					<input type="checkbox" name="select-rasp" data-size="small" data-on-text="<span class='glyphicon glyphicon-th-list'></span>" data-off-text="<span class='glyphicon glyphicon-th'></span>" data-toggle="tooltip" data-placement="top" <?if($_COOKIE['view'] == 'block') echo 'checked';?>>
				<?endif?>
				
				
				<button type="button" class="btn btn-default visible-sm-inline pull-right" disabled>В ЧГУ <? echo $now_week; ?> неделя</button>
			</div>
			
			
			<div class="visible-lg row">
			<?if(isset($rasp)):?>
			<table class="col-sm-12 col-md-12 col-lg-12">		
				<?if ($person == 'lecturer'):?>  
				
				 <?else:?>
					
				 <?endif?>
				 
				<?endif?>
				
				
			
			
			
			
			
			
			
			
			
			
			
			
			
				<tr>
					<td class="col-sm-4 col-md-4 col-lg-4">
						<div class="panel panel-default">
						  <div class="panel-heading">Понедельник<div class="pull-right"><?=$rasp[1][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							
								<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[1][$i][start_time]."</div>
												<div id='end'>".$rasp[1][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo'>
												<div id='lecture'>".$rasp[1][$i][discip]."</div>
												<div id='with'>".$rasp[1][$i][lecturer]."</div>
												<div id='addr'>".$rasp[1][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}								
								?>
								
									
									
							
						  </ul>
						</div>
					</td>
					<td class="col-sm-4 col-md-4 col-lg-4">
						<div class="panel panel-default">
						  <div class="panel-heading">Вторник<div class="pull-right"><?=$rasp[2][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[2][$i][start_time]."</div>
												<div id='end'>".$rasp[2][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo'>
												<div id='lecture'>".$rasp[2][$i][discip]."</div>
												<div id='with'>".$rasp[2][$i][lecturer]."</div>
												<div id='addr'>".$rasp[2][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}
								
								?>
						  </ul>
						</div>
					</td>
					<td class="col-sm-4 col-md-4 col-lg-4">
						<div class="panel panel-default">
						  <div class="panel-heading">Среда<div class="pull-right"><?=$rasp[3][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[3][$i][start_time]."</div>
												<div id='end'>".$rasp[3][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo'>
												<div id='lecture'>".$rasp[3][$i][discip]."</div>
												<div id='with'>".$rasp[3][$i][lecturer]."</div>
												<div id='addr'>".$rasp[3][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}
								
								?>
						  </ul>
						</div>
					</td>
				</tr>
				<tr>
					<td class="col-sm-4 col-md-4 col-lg-4">
						<div class="panel panel-default">
						  <div class="panel-heading">Четверг<div class="pull-right"><?=$rasp[4][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[4][$i][start_time]."</div>
												<div id='end'>".$rasp[4][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo'>
												<div id='lecture'>".$rasp[4][$i][discip]."</div>
												<div id='with'>".$rasp[4][$i][lecturer]."</div>
												<div id='addr'>".$rasp[4][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}
								
								?>
						  </ul>
						</div>
					</td>
					<td class="col-sm-4 col-md-4 col-lg-4">
						<div class="panel panel-default">
						  <div class="panel-heading">Пятница<div class="pull-right"><?=$rasp[5][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[5][$i][start_time]."</div>
												<div id='end'>".$rasp[5][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo'>
												<div id='lecture'>".$rasp[5][$i][discip]."</div>
												<div id='with'>".$rasp[5][$i][lecturer]."</div>
												<div id='addr'>".$rasp[5][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}
								
								?>
						  </ul>
						</div>
					</td>
					<td class="col-sm-4 col-md-4 col-lg-4">
						<div class="panel panel-default">
						  <div class="panel-heading">Суббота<div class="pull-right"><?=$rasp[6][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[6][$i][start_time]."</div>
												<div id='end'>".$rasp[6][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo'>
												<div id='lecture'>".$rasp[6][$i][discip]."</div>
												<div id='with'>".$rasp[6][$i][lecturer]."</div>
												<div id='addr'>".$rasp[6][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}
								
								?>
						  </ul>
						</div>
					</td>
				</tr>
			  </table>
		</div>
	<!--Для планшетов-->
	<div class="visible-md visible-sm rasp1-md-sm row">
	<table class="rasp1-md-sm col-sm-12 col-md-12 col-lg-12">
				<tr>
					<td class="col-sm-6 col-md-6 col-lg-6">
						<div class="panel panel-default">
						  <div class="panel-heading">Понедельник<div class="pull-right"><?=$rasp[1][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[1][$i][start_time]."</div>
												<div id='end'>".$rasp[1][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo shortnfo'>
												<div id='lecture'>".$rasp[1][$i][discip]."</div>
												<div id='with'>".$rasp[1][$i][lecturer]."</div>
												<div id='addr'>".$rasp[1][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}								
								?>
						  </ul>
						</div>
					</td>
					<td class="col-sm-6 col-md-6 col-lg-6">
						<div class="panel panel-default">
						  <div class="panel-heading">Вторник<div class="pull-right"><?=$rasp[2][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[2][$i][start_time]."</div>
												<div id='end'>".$rasp[2][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo shortnfo'>
												<div id='lecture'>".$rasp[2][$i][discip]."</div>
												<div id='with'>".$rasp[2][$i][lecturer]."</div>
												<div id='addr'>".$rasp[2][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}								
								?>
						  </ul>
						</div>
					</td>
				</tr>
				<tr>
					<td class="col-sm-6 col-md-6 col-lg-6">
						<div class="panel panel-default">
						  <div class="panel-heading">Среда<div class="pull-right"><?=$rasp[3][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[3][$i][start_time]."</div>
												<div id='end'>".$rasp[3][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo shortnfo'>
												<div id='lecture'>".$rasp[3][$i][discip]."</div>
												<div id='with'>".$rasp[3][$i][lecturer]."</div>
												<div id='addr'>".$rasp[3][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}								
								?>
						  </ul>
						</div>
					</td>
					<td class="col-sm-6 col-md-6 col-lg-6">
						<div class="panel panel-default">
						  <div class="panel-heading">Четверг<div class="pull-right"><?=$rasp[4][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[4][$i][start_time]."</div>
												<div id='end'>".$rasp[4][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo shortnfo'>
												<div id='lecture'>".$rasp[4][$i][discip]."</div>
												<div id='with'>".$rasp[4][$i][lecturer]."</div>
												<div id='addr'>".$rasp[4][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}								
								?>
						  </ul>
						</div>
					</td>
				</tr>
				<tr>
					<td class="col-sm-6 col-md-6 col-lg-6">
						<div class="panel panel-default">
						  <div class="panel-heading">Пятница<div class="pull-right"><?=$rasp[5][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[5][$i][start_time]."</div>
												<div id='end'>".$rasp[5][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo shortnfo'>
												<div id='lecture'>".$rasp[5][$i][discip]."</div>
												<div id='with'>".$rasp[5][$i][lecturer]."</div>
												<div id='addr'>".$rasp[5][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}								
								?>
						  </ul>
						</div>
					</td>
					<td class="col-sm-6 col-md-6 col-lg-6">
						<div class="panel panel-default">
						  <div class="panel-heading">Суббота<div class="pull-right"><?=$rasp[6][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<=$rasp[max];$i++)
									{
										echo"<li class='list-group-item'>";
										//echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
										echo "<div class='time'>
												<div id='begin'>".$rasp[6][$i][start_time]."</div>
												<div id='end'>".$rasp[6][$i][end_time]."</div>
											</div>";
											
										echo"<div class='lectureinfo shortnfo'>
												<div id='lecture'>".$rasp[6][$i][discip]."</div>
												<div id='with'>".$rasp[6][$i][lecturer]."</div>
												<div id='addr'>".$rasp[6][$i][address]."</div>
											</div>";
											
										echo"</li>";
									}								
								?>
						  </ul>
						</div>
					</td>
				</tr>
			  </table>
		</div>
	  </div>
	</div>
	
	
	<div class="modal fade followmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">Подписка на расписание</h4>
		  </div>
		  <div class="modal-body">
			<div>
				<?if ($person != 'lecturer'):?>
						<button type="button" class="btn btn-default" disabled="">Подписка на: <?=$sel_grup?></button>
						<?else:?>
						<button type="button" class="btn btn-default" disabled="">Подписка на: <?=$sel_lecturer?></button>
						<?endif?>

			</div>
			<hr>
			<div class="checkbox">
				<label>
					<input type="checkbox" onclick="checkAddress(this)">
					Я хочу получать расписание в виде сообщения вконтакте.
				</label>
				<hr>
				Присылать расписание в 
				<select class="selectpicker" data-width="auto" id="time">
					<? for($i=8; $i<=23; $i++) echo "<option value=\"{$i}\">{$i}:00</option>"; ?>
				</select>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			<button type="button" class="btn btn-primary" id="saveFollow" data-loading-text="Сохраняем..." disabled>Сохранить настройки</button>
		  </div>
		</div>
	  </div>
	</div>