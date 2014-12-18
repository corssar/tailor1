<?php
require_once(FRAMEWORK_PATH.'system/tpl_engine/SmartyView.php');

//class used for generation parts of SQL query, for custom fields in BE
class Translations
{
    protected $fieldArray;
    protected $tableName;

	function __construct(){
		$this->db 	= DB::getInstance();
	}

    public function assignParameters($tableName, $fieldArray){
        $this->tableName = $tableName;
        $this->fieldArray = $fieldArray;
    }
	public function search($fieldId, $params = array())
	{ //params to return selectedFields, whereParams, linkedTables
      //or html for fields
        $result = array('whereParams'=>'');
        $langPriority = array(Context::LanguageId(), EN_LANGUAGE_ID);
        //search functionality
		if ($params['processed'])
		{

            if($params['langId'] > 0)
			{
                array_unshift($langPriority, $params['langId']);
				$result['whereParams'] .= " pt.langId=".$params['langId'];
			}

            $result['linkedTables'].= " LEFT JOIN {$this->fieldArray['rTableName']} pt ON pt.{$this->fieldArray['rFieldName']} = {$this->tableName}.id AND pt.langId = ".$langPriority[0]."
										LEFT JOIN {$this->fieldArray['rTableName']} pt1 ON pt1.{$this->fieldArray['rFieldName']} = {$this->tableName}.id AND pt1.langId = ".$langPriority[1]."
										";
            $result['selectedFields'] = ", IFNULL(IFNULL(IFNULL(pt.name, pt1.name),(Select name from {$this->fieldArray['rTableName']} where {$this->fieldArray['rFieldName']}={$this->tableName}.id Order By langId limit 1)), 'NO TRANSLATION') as translation";
            //search by keyword
            $searchKeyword = str_replace('*','%', trim($params['translation']));
            if(!empty($searchKeyword))
            {
                $result['linkedTables'].= " LEFT JOIN {$this->fieldArray['rTableName']} transl ON transl.{$this->fieldArray['rFieldName']} = {$this->tableName}.id
											";
                if(!empty($result['whereParams']))
                    $result['whereParams'].= " AND";
                $result['whereParams'].= " transl.name LIKE ('$searchKeyword')";
                $result['group'] = " group by {$this->tableName}.id";
            }
			return $result;
		}

		$result['html'].= '<select name="view['.$fieldId.'][langId]">';
		$result['html'].= '	<option value="0"></option>';
        $Languages = &Languages::getInstance();

		foreach ($Languages->GetAppLanguages() as $item)
		{
			$result['html'].= '	<option value="'.$item['id'].'"'.($params['langId']>0 && $params['langId']==$item['id']?' selected':'').'>'.$item['code'].'</option>';
		}
		$result['html'].= '</select>&nbsp;';

		$result['html'].= '<input name="view['.$fieldId.'][translation]" value="'.(trim($params['translation']) != '' ? trim($params['translation']) : '').'" type="text" size="20"/>';

		return $result;
	}
}
?>