
	
		<?if (isset($alert)):?>
			<?include_once ("tpl_alert.php");?>
		<?endif?>

		
			<h2>SMS informer</h2>	
		<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
			<p>Сервис SMS информер представляет собой бесплатную рассылку расписания занятий на завтрашний день.
			<p>Наверное, каждый пропускал пары хотя бы раз, из-за того, что не знал о заменах. А может, было наоборот, Вам за утро звонили 10 человек, чтобы узнать, к какой сегодня паре.
			<p>Наш SMS сервис исправит эту проблему. С нашим сервисом вы всегда будете знать пары на завтра.
			<p>Обращаем ваше внимание на то, что SMS подписка абсолютно БЕСПЛАТНА и не тарифицируется!!!
			<br />
		
		
		
		<? if (!isset($sms)):?>
			<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
				<form action="index.php?c=sms_rasp"  method="post">
					<b>Оформить SMS подписку рассылки расписания для : <?=$person?></b>
					<br />
					Оформить подписку на  
					<select  name="count_day" id="count_day"> 
						<option>10</option>
						<option>15</option>
						<option>20</option>
					</select>  
					дней и получать SMS сообщение в 
			
					<select  name="time">
						<option>08</option>
						<option>09</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
						<option>13</option>
						<option>14</option>
						<option>15</option>
						<option>16</option>
						<option>17</option>
						<option>18</option>
						<option>19</option>
						<option>20</option>
						<option>21</option>
						<option>22</option>
						<option>23</option>
					</select>
					<b>:00</b> часов
					<br />
					<br />
					<input name='notification' value='1' type='checkbox' checked>Я хочу получать бесплатные SMS оповещения о ближайших мероприятиях университета</input>
					<br />
					<input  type="submit" name="sms" value="Оформить" /></p>
				</form>
			</div>
			
			<br/>
			<?endif?>
			<?if(isset($sms)):?>
		
			<div style="padding:10px; border: 1px solid #00ff00; border-radius: 8px" >
			<?="Вы подписаны на рассылку SMS расписания в <b>".$sms[time]."</b> час(ов). <a href='index.php?c=sms_rasp&mailing=delete&id_mailing=".$sms[id_mailing]."' class=\"red-link\">[отказаться]</a>"?>
			</div>
		<?endif?>
			
		</div>
		</br>
			<h2>VK informer (тестовый режим)</h2>
		
			<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
				<p>Сервис VK информер представляет собой бесплатную рассылку расписания занятий на завтрашний день в социальной сети Вконтакте.
				<p>Многие студенты проводят в социальных сетях много времени, сообщения приходят на смартфоны и планшеты. Поэтому пропустить важные, а может, и не совсем важные занятия теперь точно не получится.
				<br />
			
		</br>
			<? if ( !isset($vk)):?>
			<div style="padding:10px; border: 1px solid #30AAD8; border-radius: 8px">
				<form action="index.php?c=sms_rasp"  method="post">
					<b>Оформить подписку рассылки расписания на аккаунт "ВКонтакте" для : <?=$person?></b>
					<br />
					 Оформить подписку на  
					<select  name="count_day" id="count_day"> 
						<option>10</option>
						<option>15</option>
						<option>20</option>
					</select>  
					дней и получать сообщение в 
			
					<select  name="time">
						<option>08</option>
						<option>09</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
						<option>13</option>
						<option>14</option>
						<option>15</option>
						<option>16</option>
						<option>17</option>
						<option>18</option>
						<option>19</option>
						<option>20</option>
						<option>21</option>
						<option>22</option>
						<option>23</option>
					</select>
					<b>:00</b> часов
					<br />
					<br />
					<input name='notification' value='1' type='checkbox' checked>Я хочу получать бесплатные  оповещения о ближайших мероприятиях университета на свой аккаунт "ВКонтакте"</input>
					<br />
					<input  type="submit" name="vk" value="Оформить" /></p>
				</form>
			</div>
		<?endif?>	
		
		<?if(isset($vk)):?>
		
			<div style="padding:10px; border: 1px solid #00ff00; border-radius: 8px" >
			<?="Вы подписаны на рассылку расписания <b>".$user[person]."</b> в социальной сети <b>\"ВКонтакте\"</b> на аккаунт <a href='http://vk.com/id".$user[id_vk]."' class=\"red-link\">vk.com/id".$user[id_vk]."</a>. Время расслыки <b>".$vk[time]."</b> час(ов). <a href='index.php?c=sms_rasp&mailing=delete&id_mailing=".$vk[id_mailing]."' class=\"red-link\">[отказаться]</a>"?>
			</div>
		<?endif?>
		</div>
		</br>
		
		
		
