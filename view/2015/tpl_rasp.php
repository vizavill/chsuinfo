<div class="row main">
			<div class="side">
				<div id="sidebar1" class="sidebar">
					<?if ($_COOKIE['informer1'] != 'close'):?>
					<div  id="informer1" class="item">
						<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" id="close-informer1" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong>Обновление:</strong> теперь вы можете посмотреть <a href="#">расписание аудиторий</a>.
						</div>
					</div>
					<?else:?>
					<?endif?>
					<div class="item">
						<?if ($person != 'lecturer'):?>
							<h2>Группа:</h2>
							<select name="g" class="selectpicker" data-live-search="true">
								<? foreach ($grup as $value)
								{
									if  ($sel_grup==$value[title_grup])	{	echo "<option selected>   ".$value[title_grup]." </option>"; }
									else {	echo "<option >   ".$value[title_grup]." </option>";	}
								}
								?>
							</select>
						<?else:?>
							<h2>Преподаватель:</h2>
							<select name="l" class="selectpicker" data-live-search="true"> 
								<? foreach ($lecturer as $value)
								{
									if  ($sel_lecturer==$value[name_lecturer])	{	echo "<option selected>   ".$value[name_lecturer]." </option>";  }
									else{	echo "<option >   ".$value[name_lecturer]." </option>";	}
								}
								?>
							</select>
						<?endif?>
					</div>
					<div class="item">
						<h2>Дата:</h2>
						<div class="small_datepicker tablets">
							<input type="date" class="form-control" value="2015-10-04" min="2015-09-01" max="2016-06-30">	
						</div>
						<div id="datepicker" class="datepicker  datepicker-inline desks"></div>
					</div>
					<div class="item">
						<h2>Показать:</h2>
						<div class="btn-group-vertical dop-menu">
						  <button id="go_week" type="button" class="btn btn-default">Неделя</button>
						  <button id="go_day" type="button" class="btn btn-danger gogogo">День</button>
						</div>
					</div>
				</div>
				<div id="btn-side-hide" class="side-btn"><span></span></div>
			</div>
			<div id="workplace1" class="workplace">
				<div class="table-week">
						<table class="table table-bordered">
							<caption><h3><?=$sel_week?> учебная неделя</h3><?if ($person != 'lecturer'):?><h4><?=$sel_grup?></h4><?else:?><h4><?=$sel_lecturer?></h4><?endif?></caption>
							<thead>
								<tr>
			  						<th>Время</th>
			  						<th>Дисциплина</th>
			  						<th>Неделя</th>
			  						<th>Четность</th>
			  						<?if ($person != 'lecturer'):?><th>Преподаватель</th><?else:?><th>Группа</th></h4><?endif?>
			  						<th>Адрес</th>
								</tr>
							</thead>
							<tbody>
								<?
									for($i = 1; $i <=5; $i++)
										{
											if($rasp[$i] == 0)	continue;
											if($i == 1)	$day = "Понедельник";
											if($i == 2)	$day = "Вторник";		
											if($i == 3)	$day = "Среда";				
											if($i == 4)	$day = "Четверг";				
											if($i == 5)	$day = "Пятница";
											if($i == 6)	$day = "Суббота";

											#Определяем дату дня
											foreach ($rasp[$i] as $value){$date_day = $value[date];}

											echo '<tbody><tr><td colspan="6"><strong>'.$day.'</strong> <span class="table-day-date">'.$date_day.'</span></td></tr>';
											foreach($rasp[$i] as $value)
												{
													if($value == 0)
														continue;
													echo "<tr>
															<td>".$value[start_time]."</sup>-".$value[end_time]."</sup></td>
															<td>".$value[discip]."</td>
															<td>3 - 5</td>
															<td>нечет</td>
															<td>".$value[lecturer]."</td>
															<td>".$value[address]."</td>
														</tr>";	
												}
											echo '</tbody>';
										}
			  					?>
			  				</tbody>
						</table>
				</div>

			</div>
		</div>