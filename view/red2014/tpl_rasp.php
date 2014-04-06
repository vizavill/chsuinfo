	<div id="content">

		<div id="content_c">
			<form  style="width:820px;float:left;" action="index.php?c=rasp" method="get">
			<div style="display:inline;position:relative; top:8px;">
				
				<div class="inline" style="margin-right:10px;">
				<?if ($person != 'lecturer'):?>
					<select name="g" id="group" data-filter="true" data-autoWidth="false">
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
					<select name="l" id="prepod" data-filter="true" data-autoWidth="false"> 
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
				<div class="inline"  style="margin-right:10px;">
					<div class="no-wrap valign-middle" style="position:relative; top:-16px;margin-left:10px;margin-right:10px;">
						<a href="index.php?c=rasp&g=<?=$sel_person?>&w=<?=($sel_week-1)?>&p=<?=($person)?>" class="scheduleListButton" id="listLeft"></a>
						
						<div class="inline"  style="margin-right:0px;">
							<select name="w" id="week" data-filter="true" data-autoWidth="false">
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
							</div>
						<a href="index.php?c=rasp&g=<?=$sel_person?>&w=<?=($sel_week+1)?>&p=<?=($person)?>" class="scheduleListButton" id="listRight"></a>
					</div>
				</div>
				<div class="inline" style="position:relative; bottom:12px;">
					<input class="customButton" type="submit" value="Отобразить">
				</div>
				<div class="inline week1">
					Сейчас в ЧГУ <b><? echo $now_week; ?></b> неделя.
				</div>
			</div>

				<input type="hidden" name="p" value="<?=($person)?>">

			</form>	
			<div class="share valign-middle inline-block">
				<div style="display:inline; float:right;">
					<?php 
						$url_soc = '';
						if(isset($_COOKIE['sel_week']) && isset($_COOKIE['sel_grup']) && isset($_COOKIE['person']) && $_COOKIE['person'] == 'group')
						{		
							$url_soc = '?g='.$sel_grup.'&w='.$sel_week.'&p='.$person;
						}
						
						if(isset($_COOKIE['sel_week']) && isset($_COOKIE['sel_lecturer']) && isset($_COOKIE['person']) && $_COOKIE['person'] == 'lecturer')
						{		
							$url_soc = '?l='.$sel_lecturer.'&w='.$sel_week.'&p='.$person;
						}
					?>
					
					<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8">
					</script>
					<script type="text/javascript">
					 new Ya.share({
					  element: 'sharerasp',
					  theme: 'counter',
					  link: 'http://chsuinfo.ru/index.php<? echo $url_soc;?>',
					  elementStyle: {
					   'type': 'button',
					   'border': false,
					   'quickServices': ['vkontakte']                  
									},
					  l10n: 'ru' // Вывод английской версии        
					 });
					</script>
					<span id="sharerasp"></span>
				</div>
				<div style="display:inline; float:right; padding-top:5px;">
					<script type="text/javascript">
					  VK.init({apiId: 4212807, onlyWidgets: true});
					</script>

					<!-- Put this div tag to the place, where the Like block will be -->
					<div id="vk_like"></div>
					<script type="text/javascript">
					VK.Widgets.Like("vk_like", {type: "mini", pageUrl:"http://chsuinfo.ru"});
					</script>
				</div>
			</div>
			
			<table class="rasp">
				<tbody>
					<tr>
						<td>
							<div class="wrap_schedule">
								<div class="title_red uppercase">Понедельник<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right"><?=$rasp[1][date]?></span></div>
								<table class="schedule">
									<tbody>							
									<?
									if((!isset($_COOKIE['sel_grup']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") == false) || (!isset($_COOKIE['sel_lecturer']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") != false)){
										for($i=0;$i<5;$i++)
												echo "<tr>
												<td>
													<span class='no-wrap'></span><br>
													<span class='gray no-wrap'></span>
												</td>
												<td>
													<div>
														<span class='bold'></span><br>
														<span class='gray no-wrap'></span>
														<span class='right m20left no-wrap'></span>
													</div>
												</td>
											</tr>";	
									}
									
									for($k=1;$k<=$rasp[max];$k++)
									{
										echo "<tr>
											<td>
												<span class='no-wrap'>".$rasp[1][$k][start_time]."</span><br>
												<span class='gray no-wrap'>".$rasp[1][$k][end_time]."</span>
											</td>
											<td>
												<div>
													<span class='bold'>"
													.$rasp[1][$k][discip]."</span><br>
													<span class='gray no-wrap'>".$rasp[1][$k][lecturer]."</span>
													<span class='right m20left no-wrap'>".$rasp[1][$k][address]."</span>
												</div>
											</td>
										</tr>";	
									}
									?>
									</tbody>
								</table>
							</div>
						</td>
						<td>
							<div class="wrap_schedule">
							<div class="title_red uppercase">Вторник<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right"><?=$rasp[2][date]?></span></div>
								<table class="schedule">
									<tbody>
									<?
									if((!isset($_COOKIE['sel_grup']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") == false) || (!isset($_COOKIE['sel_lecturer']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") != false)){
										for($i=0;$i<5;$i++)
												echo "<tr>
												<td>
													<span class='no-wrap'></span><br>
													<span class='gray no-wrap'></span>
												</td>
												<td>
													<div>
														<span class='bold'></span><br>
														<span class='gray no-wrap'></span>
														<span class='right m20left no-wrap'></span>
													</div>
												</td>
											</tr>";	
									}
									for($k=1;$k<=$rasp[max];$k++)
									{
										echo "<tr>
											<td>
												<span class='no-wrap'>".$rasp[2][$k][start_time]."</span><br>
												<span class='gray no-wrap'>".$rasp[2][$k][end_time]."</span>
											</td>
											<td>
												<div>
													<span class='bold'>"
													.$rasp[2][$k][discip]."</span><br>
													<span class='gray no-wrap'>".$rasp[2][$k][lecturer]."</span>
													<span class='right m20left no-wrap'>".$rasp[2][$k][address]."</span>
												</div>
											</td>
										</tr>";	
									}
									?>
									</tbody>
								</table>
								</div>
							</td>
							<td>
							
								<div class="wrap_schedule">
								<div class="title_red uppercase">Среда<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right"><?=$rasp[3][date]?></span></div>
								<table class="schedule">
									<tbody>
									<?
									if((!isset($_COOKIE['sel_grup']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") == false) || (!isset($_COOKIE['sel_lecturer']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") != false)){
										for($i=0;$i<5;$i++)
												echo "<tr>
												<td>
													<span class='no-wrap'></span><br>
													<span class='gray no-wrap'></span>
												</td>
												<td>
													<div>
														<span class='bold'></span><br>
														<span class='gray no-wrap'></span>
														<span class='right m20left no-wrap'></span>
													</div>
												</td>
											</tr>";	
									}
									for($k=1;$k<=$rasp[max];$k++)
									{
										echo "<tr>
											<td>
													<span class='no-wrap'>".$rasp[3][$k][start_time]."</span><br>
											<span class='gray no-wrap'>".$rasp[3][$k][end_time]."</span>
											</td>
											<td>
												<div>
													<span class='bold'>"
													.$rasp[3][$k][discip]."</span><br>
													<span class='gray no-wrap'>".$rasp[3][$k][lecturer]."</span>
													<span class='right m20left no-wrap'>".$rasp[3][$k][address]."</span>
												</div>
											</td>
										</tr>";	
									}
									?>	
									</tbody>
								</table>
									</div>
								</td>
								<td>
									<div class="wrap_schedule">
									<div class="title_red uppercase">Четверг<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right"><?=$rasp[4][date]?></span></div>
									<table class="schedule">
										<tbody>
									<?
									if((!isset($_COOKIE['sel_grup']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") == false) || (!isset($_COOKIE['sel_lecturer']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") != false)){
										for($i=0;$i<5;$i++)
												echo "<tr>
												<td>
													<span class='no-wrap'></span><br>
													<span class='gray no-wrap'></span>
												</td>
												<td>
													<div>
														<span class='bold'></span><br>
														<span class='gray no-wrap'></span>
														<span class='right m20left no-wrap'></span>
													</div>
												</td>
											</tr>";	
									}
									for($k=1;$k<=$rasp[max];$k++)
									{
										echo "<tr>
											<td>
												<span class='no-wrap'>".$rasp[4][$k][start_time]."</span><br>
												<span class='gray no-wrap'>".$rasp[4][$k][end_time]."</span>
											</td>
											<td>
												<div>
													<span class='bold'>"
													.$rasp[4][$k][discip]."</span><br>
													<span class='gray no-wrap'>".$rasp[4][$k][lecturer]."</span>
													<span class='right m20left no-wrap'>".$rasp[4][$k][address]."</span>
												</div>
											</td>
										</tr>";	
									}
									?>
										</tbody>
									</table>
										</div>
									</td>
								</tr>
								<tr>
									<td style="vertical-align:top">
										<div class="wrap_schedule">
										<div class="title_red uppercase">Пятница<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right"><?=$rasp[5][date]?></span></div>
										<table class="schedule">
											<tbody>
									<?
									if((!isset($_COOKIE['sel_grup']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") == false) || (!isset($_COOKIE['sel_lecturer']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") != false)){
										for($i=0;$i<5;$i++)
												echo "<tr>
												<td>
													<span class='no-wrap'></span><br>
													<span class='gray no-wrap'></span>
												</td>
												<td>
													<div>
														<span class='bold'></span><br>
														<span class='gray no-wrap'></span>
														<span class='right m20left no-wrap'></span>
													</div>
												</td>
											</tr>";	
									}
									for($k=1;$k<=$rasp[max];$k++)
									{
										echo "<tr>
											<td>
												<span class='no-wrap'>".$rasp[5][$k][start_time]."</span><br>
												<span class='gray no-wrap'>".$rasp[5][$k][end_time]."</span>
											</td>
											<td>
												<div>
													<span class='bold'>"
													.$rasp[5][$k][discip]."</span><br>
													<span class='gray no-wrap'>".$rasp[5][$k][lecturer]."</span>
													<span class='right m20left no-wrap'>".$rasp[5][$k][address]."</span>
												</div>
											</td>
										</tr>";	
									}
									?>
											</tbody>
										</table>
											</div>
										</td>
										<td style="vertical-align:top">
											<div class="wrap_schedule">
											<div class="title_red uppercase">Суббота<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right"><?=$rasp[6][date]?></span></div>
													<table class="schedule">
														<tbody>
									<?
									if((!isset($_COOKIE['sel_grup']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") == false) || (!isset($_COOKIE['sel_lecturer']) && strpos($_SERVER['REQUEST_URI'], "p=lecturer") != false)){
										for($i=0;$i<5;$i++)
												echo "<tr>
												<td>
													<span class='no-wrap'></span><br>
													<span class='gray no-wrap'></span>
												</td>
												<td>
													<div>
														<span class='bold'></span><br>
														<span class='gray no-wrap'></span>
														<span class='right m20left no-wrap'></span>
													</div>
												</td>
											</tr>";	
									}
									for($k=1;$k<=$rasp[max];$k++)
									{
										echo "<tr>
											<td>
												<span class='no-wrap'>".$rasp[6][$k][start_time]."</span><br>
												<span class='gray no-wrap'>".$rasp[6][$k][end_time]."</span>
											</td>
											<td>
												<div>
													<span class='bold'>"
													.$rasp[6][$k][discip]."</span><br>
													<span class='gray no-wrap'>".$rasp[6][$k][lecturer]."</span>
													<span class='right m20left no-wrap'>".$rasp[6][$k][address]."</span>
												</div>
											</td>
										</tr>";	
									}
									?>
														</tbody>
													</table>
												</div>
											</td>
											<td style="vertical-align:top; padding-top:20px;" colspan="2">
												<div class="htmlcomments"></div>
												<div id="commField">
													<form>
														<input id="commFieldText" type="text" placeholder="Введите сообщение..."/>
														<input id="commFieldSubmit" class="customButtonMini" type="button"  value="Отправить"/>
													</form>
												</div>
												
										    </td>
								</tr>
				</tbody>
			</table>
		</div>
			
		</div>
	</div>
	