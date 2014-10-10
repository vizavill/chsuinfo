<div id="content">
		<div id="content_c">
			<?
			if (isset($alertOk))
			{
				include_once ("tpl_alert_ok.php");
			}
			elseif(isset($alertFail))
			{
				include_once ("tpl_alert_fail.php");
			}
			elseif(isset($alertNotif))
			{
				include_once ("tpl_alert_notif.php");
			}
			?>
			<h1>VK INFORMER (ТЕСТОВЫЙ РЕЖИМ)</h1>
			Сервис VK информер представляет собой бесплатную рассылку расписания занятий на завтрашний день в социальной сети Вконтакте.<br>
Многие студенты проводят в социальных сетях много времени, сообщения приходят на смартфоны и планшеты. Поэтому пропустить важные, а может, и не совсем важные занятия теперь точно не получится. 
			
			
			
			<? if ( !isset($vk)):?>
				<form action="index.php?c=sms_vk_rasp"  method="post">
					<h3>Оформить подписку рассылки расписания на аккаунт "ВКонтакте" для : <?=$person?></h3>

					Получать сообщение в 			
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
					:00 часов <br>
					
					<input type="checkbox"> Я хочу получать бесплатные оповещения о ближайших мероприятиях университета на свой аккаунт "ВКонтакте"  
					<br>
					<input name='vk' class="blueButton" type="submit" value="Подключить VK информер" style="margin-top:10px;">
				</form>
		<?endif?>	
		
		<?if(isset($vk)):?>
		
			<div class="message-green" style="margin-top:10px;" >
			<?="Вы подписаны на рассылку расписания <b>".$user[person]."</b> в социальной сети <b>\"ВКонтакте\"</b> на аккаунт <a href='http://vk.com/id".$user[id_vk]."'  class=\"red-link\">vk.com/id".$user[id_vk]."</a>. Время расслыки <b>".$vk[time]."</b> час(ов). <a href='index.php?c=sms_vk_rasp&mailing=delete&id_mailing=".$vk[id_mailing]."'  class=\"red-link\">[отказаться]</a>"?>
			</div>
		<?endif?>
			
		
			
			
			
			
			
		</div>	
	</div>