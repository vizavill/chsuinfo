

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
					<a href="index.php?c=rasp&l=<?=$sel_lecturer?>&w=<?=($sel_week+1)?>&p=<?=($person)?>" type="button" class="btn btn-default btn-md" style="display:inline"><span class="glyphicon glyphicon-chevron-left"></span></a>
				<?endif?>
				
			</div>
				<input name="p" type="hidden" value="<?=($person)?>"/>
			<div class="inline-block" style="margin-right:12px;">
				<button type="submit" class="btn btn-danger">Отобразить</button>
			</div>
		
			<div class="inline-block" style="margin-right:12px;">
				<button type="button" class="btn btn-default visible-lg-inline visible-md-inline" disabled>Сейчас в ЧГУ <? echo $now_week; ?> неделя.</button>
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
					<input type="checkbox" name="select-rasp" data-size="small" data-on-text="<span class='glyphicon glyphicon-th-list'></span>" data-off-text="<span class='glyphicon glyphicon-th'></span>" data-toggle="tooltip" data-placement="top" title="Some tooltip text!" checked>
				<?endif?>
				
				
				<button type="button" class="btn btn-default visible-sm-inline pull-right" disabled>В ЧГУ 6 неделя</button>
			</div>
		</div>
		</div>

<div class="container">
		
			
			<div class="visible-lg rasp1">
			<?if(isset($rasp)):?>
			<table class="rasp1 col-sm-12 col-md-12 col-lg-12">			
				<?if ($person == 'lecturer'):?>  
				
				 <?else:?>
					
				 <?endif?>
				 
				<?endif?>
				
				
			
			
			
			
			
			
			
			
			
			
			
			
			
				<tr>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Понедельник<div class="pull-right"><?=$rasp[1][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<$rasp[max];$i++)
								{
									echo"<li class='list-group-item day-item'>".$rasp[1][$i][discip]."</li>";
								}
							
							?>
						  </ul>
						</div>
					</td>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Вторник<div class="pull-right"><?=$rasp[2][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<$rasp[max];$i++)
								{
									echo"<li class='list-group-item day-item'>".$rasp[2][$i][discip]."</li>";
								}
							
							?>
						  </ul>
						</div>
					</td>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Среда<div class="pull-right"><?=$rasp[3][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<$rasp[max];$i++)
								{
									echo"<li class='list-group-item day-item'>".$rasp[3][$i][discip]."</li>";
								}
							
							?>
						  </ul>
						</div>
					</td>
				</tr>
				<tr>
				  <td>
						<div class="panel panel-default">
						  <div class="panel-heading">Четверг<div class="pull-right"><?=$rasp[4][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<$rasp[max];$i++)
								{
									echo"<li class='list-group-item day-item'>".$rasp[4][$i][discip]."</li>";
								}
							
							?>
						  </ul>
						</div>
					</td>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Пятница<div class="pull-right"><?=$rasp[5][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<$rasp[max];$i++)
								{
									echo"<li class='list-group-item day-item'>".$rasp[5][$i][discip]."</li>";
								}
							
							?>
						  </ul>
						</div>
					</td>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Суббота<div class="pull-right"><?=$rasp[6][date]?></div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<? for  ($i=1; $i<$rasp[max];$i++)
								{
									echo"<li class='list-group-item day-item'>".$rasp[6][$i][discip]."</li>";
								}
							
							?>
						  </ul>
						</div>
					</td>
				</tr>
			  </table>
		</div>
	<!--Для планшетов-->
	<div class="visible-md visible-sm rasp1-md-sm">
	<table class="rasp1-md-sm col-sm-12 col-md-12 col-lg-12">
				<tr>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Понедельник<div class="pull-right">23 Сен</div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<li class="list-group-item day-item">
								<!-- <div class="time"><div id="begin">13:30</div><div id="end">15:00</div></div>
								<div class="lectureinfo">Лабораторная работа <br>Алгорит обработ данных<br>1ИВТпб-01-11оп<br>218а Сов.8</div> --> sddsfdfs
							</li>
							<li class="list-group-item">Dapibus ac facilisis in</li>
							<li class="list-group-item">Morbi leo risus</li>
							<li class="list-group-item">Porta ac consectetur ac</li>
							<li class="list-group-item">Vestibulum at eros</li>
						  </ul>
						</div>
					</td>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Вторник<div class="pull-right">23 Сен</div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<li class="list-group-item">Cras justo odio</li>
							<li class="list-group-item">Dapibus ac facilisis in</li>
							<li class="list-group-item">Morbi leo risus</li>
							<li class="list-group-item">Porta ac consectetur ac</li>
							<li class="list-group-item">Vestibulum at eros</li>
						  </ul>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Среда<div class="pull-right">23 Сен</div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<li class="list-group-item day-item">
								<!-- <div class="time"><div id="begin">13:30</div><div id="end">15:00</div></div>
								<div class="lectureinfo">Лабораторная работа <br>Алгорит обработ данных<br>1ИВТпб-01-11оп<br>218а Сов.8</div> --> sddsfdfs
							</li>
							<li class="list-group-item">Dapibus ac facilisis in</li>
							<li class="list-group-item">Morbi leo risus</li>
							<li class="list-group-item">Porta ac consectetur ac</li>
							<li class="list-group-item">Vestibulum at eros</li>
						  </ul>
						</div>
					</td>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Четверг<div class="pull-right">23 Сен</div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<li class="list-group-item">Cras justo odio</li>
							<li class="list-group-item">Dapibus ac facilisis in</li>
							<li class="list-group-item">Morbi leo risus</li>
							<li class="list-group-item">Porta ac consectetur ac</li>
							<li class="list-group-item">Vestibulum at eros</li>
						  </ul>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Пятница<div class="pull-right">23 Сен</div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<li class="list-group-item day-item">
								<!-- <div class="time"><div id="begin">13:30</div><div id="end">15:00</div></div>
								<div class="lectureinfo">Лабораторная работа <br>Алгорит обработ данных<br>1ИВТпб-01-11оп<br>218а Сов.8</div> --> sddsfdfs
							</li>
							<li class="list-group-item">Dapibus ac facilisis in</li>
							<li class="list-group-item">Morbi leo risus</li>
							<li class="list-group-item">Porta ac consectetur ac</li>
							<li class="list-group-item">Vestibulum at eros</li>
						  </ul>
						</div>
					</td>
					<td>
						<div class="panel panel-default">
						  <div class="panel-heading">Суббота<div class="pull-right">23 Сен</div></div>
						  <!-- <div class="panel-body"></div> -->
						  <ul class="list-group">
							<li class="list-group-item">Cras justo odio</li>
							<li class="list-group-item">Dapibus ac facilisis in</li>
							<li class="list-group-item">Morbi leo risus</li>
							<li class="list-group-item">Porta ac consectetur ac</li>
							<li class="list-group-item">Vestibulum at eros</li>
						  </ul>
						</div>
					</td>
				</tr>
			  </table>
		</div>
	</div>
	