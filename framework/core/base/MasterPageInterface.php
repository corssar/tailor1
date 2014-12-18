<?

abstract class MasterPageInterface {
	
	/**
	 * ���������� HTML ���� ����������������, ������� ���������� ���������� � ��������������.
	 *
	 * @return array
	 */	
	abstract public function load();

	/**
	 * ������������ � ������� �� ����� �������������� � �������� (������ ��������������)
	 *
	 * @param string $pageHTMl
	 * @param string $pageHeaderHTML
	 */	
	abstract public function run($pageHTML, $pageHeaderHTML, $pageHeaderMETA, $pageHeaderJS, $pageHeaderCSS);
	
	
}

?>