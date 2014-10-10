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
			
				<a href="index.php?c=rasp&g=<?=$sel_person?>&w=<?=($sel_week-1)?>&p=<?=($person)?>" type="button" class="btn btn-default btn-md" style="display:inline"><span class="glyphicon glyphicon-chevron-left"></span></a>
				
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
								
				<a href="index.php?c=rasp&g=<?=$sel_person?>&w=<?=($sel_week+1)?>&p=<?=($person)?>" type="button" class="btn btn-default btn-md" style="display:inline"><span class="glyphicon glyphicon-chevron-right"></span></a>
				
			</div>
			
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
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".followmodal" style="margin-right:10px;">Подписаться на рассылку</button>
				<input type="checkbox" name="select-rasp" data-size="small" data-on-text="<span class='glyphicon glyphicon-th-list'></span>" data-off-text="<span class='glyphicon glyphicon-th'></span>" data-toggle="tooltip" data-placement="top" title="Some tooltip text!" checked>
				<button type="button" class="btn btn-default visible-sm-inline pull-right" disabled>В ЧГУ 6 неделя</button>
			</div>
			
			
			<table class="table table-hover rasp">
			  <thead>
				<tr>
				  <th>Время</th>
				  <th>Дисциплина</th>
				  <th>Неделя</th>
				  <th>Ч/Н</th>
				<?if ($person == 'lecturer'):?>  
					<th>Группа</th>
				 <?else:?>
					<th>Преподаватель</th>
				 <?endif?>
				  <th>Ауд/Адрес</th>
				</tr>
			  </thead>
			  <tbody>
				
				<?
					for($i = 0; $i <=6; $i++)
					{
						//Если в этот день нет пар пропускаем его
						if($rasp[$i] == 0)
							continue;
					
						if($i == 1)
						{
							$day = "Понедельник";
						}
						
						if($i == 2)
						{
							$day = "Вторник";
						}
						
						if($i == 3)
						{
							$day = "Среда";
						}
						
						if($i == 4)
						{
							$day = "Четверг";
						}
						
						if($i == 5)
						{
							$day = "Пятница";
						}
						
						if($i == 6)
						{
							$day = "Суббота";
						}
						
						
						
						
						
						echo "<tr class='danger'><td colspan='6'>".$day." ".$value[date]."</td></tr>";
						
						foreach($rasp[$i] as $value)
						{							
							echo "<tr>
									<td>".$value[start_time]."-".$value[end_time]."</td>
									<td>".$value[discip]."</td>
									<td>c ".$value[n_week]." по ".$value[k_week]."</td>
									<td>".$value[parity]."</td>
									<td>".$value[lecturer]."</td>
									<td>".$value[address]."</td>
								</tr>";
						}
					}			
				?>
				
			  </tbody>
			</table>
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
						<button type="button" class="btn btn-default" disabled="">Подписка на: <?=$sel_lecturer?></button>
						
						
					
					 
						<?else:?>
					 
					
						
						<label>Группа: </label> <?=$sel_grup?><br>
						<?endif?>
				<!-- <label>Группа: </label> 1ПИб-01-21оп<br> или <br> -->

			</div>
			<hr>
			<div class="checkbox">
				<label>
					<input type="checkbox" value="">
					Я хочу получать расписание в виде сообщения вконтакте.
				</label>
				<hr>
				Присылать расписание в 
				<select class="selectpicker" data-width="auto">
					<option>08:00</option>
					<option>08:00</option>
					<option>08:00</option>
					<option>08:00</option>
					<option>23:00</option>
				</select>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			<button type="button" class="btn btn-primary">Сохранить настройки</button>
		  </div>
		</div>
	  </div>
	</div>