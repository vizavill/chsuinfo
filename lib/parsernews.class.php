<?
class parser{
	//url страницы
	var $url  = "http://www.chsu.ru/news";
	//html код
	var $html = '';
	var $html_news = '';
	//content
	var $content = "";
	//данные
	var $titles = array();
	var $text = array();
	var $full_text = array();
	var $images = array();
	var $links = array();
	var $dates = array();
	
	
	function __construct(){
		$this->html = file_get_contents($this->url);
	}
	
	function parseNews($num = 5, $full_text = false){
		for($i = 0; $i < $num; $i++){
			//titles
			$posHistory = strpos($this->html, 'history.png');
			$this->html = substr($this->html, $posHistory);
			array_push($this->titles, substr($this->html, strpos($this->html, 'history.png')+16, strpos($this->html, '</a> </h3>')-16));
			$this->html = substr($this->html, strpos($this->html, '</a> </h3>'));
			//images
			$posImage = strpos($this->html, 'small-image" src="');
			$this->html = substr($this->html, $posImage);
			array_push($this->images, substr($this->html, strpos($this->html, 'small-image" src="')+18, strpos($this->html, '" width="150" />')-18));
			$this->html = substr($this->html, strpos($this->html, '" width="150" />'));
			
			//text
			$posSum = strpos($this->html, 'width="150" /> </div>');
			$this->html = substr($this->html, $posSum);
			array_push($this->text, substr($this->html, strpos($this->html, 'width="150" /> </div>')+15, strpos($this->html, '</div> <div class="asset-more">')-15));
			$this->html = substr($this->html, strpos($this->html, '</div> <div class="asset-more">'));
			
			//links
			$posLink = strpos($this->html, 'asset-more"> <a href="');
			$this->html = substr($this->html, $posLink);
			array_push($this->links, substr($this->html, strpos($this->html, 'asset-more"> <a href="')+22, strpos($this->html, '">Узнать больше')-22));
			$this->html = substr($this->html, strpos($this->html, '">Узнать больше'));
			
			//full_text
			if($full_text){
				$this->html_news = file_get_contents($this->links[$i]);
				$posLink = strpos($this->html_news, '<div class="asset-full-content show-asset-title">');
				$this->html_news = substr($this->html_news, $posLink);
				array_push($this->full_text, strip_tags(substr($this->html_news, strpos($this->html_news, '<div class="asset-full-content show-asset-title">'), strpos($this->html_news, '<span class="metadata-entry metadata-publish-date">'))));
				$this->html_news = substr($this->html_news, strpos($this->html_news, '<span class="metadata-entry metadata-publish-date">'));
			}
			
			//dates
			$posDate = strpos($this->html, 'metadata-entry metadata-publish-date">');
			$this->html = substr($this->html, $posDate);
			array_push($this->dates, trim(substr($this->html, strpos($this->html, 'metadata-entry metadata-publish-date">')+39, strpos($this->html, '</span> <span class="metadata-entry metadata-tags')-39)));
			$this->html = substr($this->html, strpos($this->html, '</span> <span class="metadata-entry metadata-tags'));
			
			//mask
			$this->content .= '<div style="display: none;"><span style="margin-right: 16px">'.$this->dates[$i].'</span> <a href="'.$this->links[$i].'" target="_blank">'.$this->titles[$i].'</a></div>';
		}
		
		return $this->content;
	}

}

?>