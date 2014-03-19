	<div id="content">
	
		<div id="content_c">
			<form  style="width:750px;float:left;" action="index.php?c=rasp" method="post">
			<div style="display:inline;position:relative; top:8px;">
				
				<div class="inline" style="margin-right:10px;">
				
					<select name="sel_grup" id="group" data-filter="true" data-autoWidth="false">
						<? foreach ($grup as $value)
						{
							if  (isset($_COOKIE['sel_grup']) && ($_COOKIE['sel_grup']==$value[title_grup]))
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
				</div>
				<div class="inline"  style="margin-right:10px;">
					<div class="no-wrap valign-middle" style="position:relative; top:-16px;margin-left:10px;margin-right:10px;">
						<a href="index.php?c=rasp&week=back" class="scheduleListButton" id="listLeft"></a>
						<div class="inline"  style="margin-right:0px;">
							<select name="sel_week" id="week" data-filter="true" data-autoWidth="false">
							<?for ($i=1;$i<=$week;$i++)
							{
								if (isset($_COOKIE['sel_week']) && ($_COOKIE['sel_week']==$i))
								{		
									echo "<option value=".$i." selected>   ".$i." Неделя</option>";
								}
								elseif($i==$now_week)
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
						<a href="index.php?c=rasp&week=forward" class="scheduleListButton" id="listRight"></a>
					</div>
				</div>
				<div class="inline" style="position:relative; bottom:12px;">
					<input class="customButton" type="submit" name="submit" value="Отобразить">
				</div>
				
			</div>
			</form>	
			<div class="share valign-middle inline-block">
				<span>Запостить в</span> <a href="http://vk.com/share.php?url=http://chsuinfo.ru/" target="_blank"><i class="i vk"></i></a> <a href="https://twitter.com/share?url=http://chsuinfo.ru/" target="_blank"><i class="i tw"></i></a> <a href="https://www.facebook.com/sharer/sharer.php?u=http://chsuinfo.ru/" target="_blank"><i class="i fb"></i></a>
			</div>
			
			<table class="rasp">
				<tbody>
					<tr>
						<td>
							<div class="wrap_schedule">
								<div class="title_red uppercase">Понедельник<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right">3 Мар</span></div>
								<table class="schedule">
									<tbody>							
									<?for($k=1;$k<=$rasp[max];$k++)
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
							<div class="title_red uppercase">Вторник<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right">4 Мар</span></div>
								<table class="schedule">
									<tbody>
									<?for($k=1;$k<=$rasp[max];$k++)
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
								<div class="title_red uppercase">Среда<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right">5 Мар</span></div>
								<table class="schedule">
									<tbody>
									<?for($k=1;$k<=$rasp[max];$k++)
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
									<div class="title_red uppercase">Четверг<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right">6 Мар</span></div>
									<table class="schedule">
										<tbody>
									<?for($k=1;$k<=$rasp[max];$k++)
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
									<td>
										<div class="wrap_schedule">
										<div class="title_red uppercase">Пятница<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right">7 Мар</span></div>
										<table class="schedule">
											<tbody>
									<?for($k=1;$k<=$rasp[max];$k++)
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
										<td>
											<div class="wrap_schedule">
											<div class="title_red uppercase">Суббота<span style="color: #f0c1c1;font-size: 14px;text-transform: none" class="right">8 Мар</span></div>
													<table class="schedule">
														<tbody>
									<?for($k=1;$k<=$rasp[max];$k++)
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
												<?php echo $html_comments;?>
												<div class="paginationComms">
													<a href="#">Назад</a>
													<a href="#">1</a>
													2
													<a href="#">3</a>
													<a href="#">Вперед</a>
												</div>
												
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
	