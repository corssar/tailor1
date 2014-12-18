<?

abstract class MasterPageInterface {
	
	/**
	 * Возвращает HTML всех ОбъектовСтраницы, которые необходимо отобразить в МастерСтранице.
	 *
	 * @return array
	 */	
	abstract public function load();

	/**
	 * Конструирует и выводит на экран МастерСтраницу и Страницу (внутри МастерСтраницы)
	 *
	 * @param string $pageHTMl
	 * @param string $pageHeaderHTML
	 */	
	abstract public function run($pageHTML, $pageHeaderHTML, $pageHeaderMETA, $pageHeaderJS, $pageHeaderCSS);
	
	
}

?>