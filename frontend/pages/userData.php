<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once(FRAMEWORK_PATH."system/addresses.php");
require_once(FRAMEWORK_PATH."system/helper/DateManager.php");

class userData extends Page
{
    protected 	$template = 'Pages/userData.tpl';
    protected   $requireAuthorization = true;

    public function load()
    {
        $this->isRequireAuth();
        $cache = new CacheFace();
        if($this->pageData = $cache->get('userDataPage_'.$this->getPageId())){
            $this->templateData = unserialize($this->pageData);
        }
        else
        {
            $this->pageData = new PageData($this->getPageId());
            if(!$this->pageData->load())
                throw new CMSExeption("Data for content page was not loaded. Pageid=".$this->getPageId());

            $this->templateData['title'] = $this->pageData->getValue('title');
            $this->templateData['privateOfficeUrl'] = appUrl::checkUrl($this->pageData->getValue('text1'));
            $this->templateData['editProfileUrl'] = appUrl::checkUrl($this->pageData->getValue('text2'));

            $cache->save(serialize($this->templateData));
        }

        $user = CMSUser::getInstance();
        $address = new Addresses();

        $userAddress = $address->getUserAddress($user->userId);
        $userPhones = $user->getPhones($user->userId, 0);

        if($userInfo = $user->getUserInfo($user->userId))
        {
            $this->templateData['loginName'] = $userInfo['loginName'];

            $counter = 0;
            if(strlen($userAddress['country'])>0){
                $this->templateData['userData'][$counter] = $this->addUserDataElement(Webtext::getText('locationCountry', '̳��������������/�����:', true), 'country', $userAddress['country']);
                $counter++;
            }
            if(count($userPhones)>0){
                $this->templateData['userData'][$counter] = $this->addUserDataElement(Webtext::getText('phone', '�������:', true), 'phone', $userPhones);
                $counter++;
            }
            if(strlen($userInfo['email'])>0){
                $this->templateData['userData'][$counter] = $this->addUserDataElement(Webtext::getText('email', 'Email:', true), 'email', $userInfo['email']);
                $counter++;
            }
            if(strlen($userInfo['text1'])>0){
                $this->templateData['userData'][$counter] = $this->addUserDataElement(Webtext::getText('website', 'Website:', true), 'website', $userInfo['text1']);
                $counter++;
            }
            if(strlen($userInfo['name'])>0){
                $this->templateData['userData'][$counter] = $this->addUserDataElement(Webtext::getText('name', '��\'�:', true), 'name', $userInfo['name']);
                $counter++;
            }
            if(strlen($userInfo['surname'])>0){
                $this->templateData['userData'][$counter] = $this->addUserDataElement(Webtext::getText('surname', '�������:', true), 'name', $userInfo['surname']);
                $counter++;
            }
            if(strlen($userInfo['birthDate'])>0){
                $this->templateData['userData'][$counter] = $this->addUserDataElement(Webtext::getText('birthdate', '���� ����������:', true), 'name', date(DateManager::convert2phpDateFormat(Context::SiteSettings()->getDateFormat()), strtotime($userInfo['birthDate'])));
                $counter++;
            }

            $this->templateData['isJuridicalPerson'] = $userInfo['isJuridicalPerson'];
            if($this->templateData['isJuridicalPerson']){
                if($user->getJuridicalPersonData($user->userId)){
                    $counter = 0;
                    foreach ($user->juridicalPersonData as $key=>$value)
                    {
                        if($key == 'id' || $key == 'registerCountryId')
                            continue;

                        if(strlen($value)>0){
                            $this->templateData['jPersonData'][$counter] = $this->addUserDataElement($this->getJpersonLabel($key), $key, $value);
                            $counter++;
                        }
                    }
                    $jPersonPhones = $user->getPhones(0, $user->juridicalPersonData['id']);
                    if(count($jPersonPhones)>0){
                        $this->templateData['jPersonData'][$counter] = $this->addUserDataElement(Webtext::getText('phone', '�������:', true), 'phone', $jPersonPhones);
                        $counter++;
                    }
                }
            }
        }

        return $this->templateData;
    }

    function addUserDataElement($label, $name, $value)
    {
        $userDataElement = array();
        $userDataElement['label'] = $label;
        $userDataElement['name']  = $name;
        $userDataElement['value'] = $value;
        return $userDataElement;
    }

    function getJpersonLabel($keyName)
    {
        $label = '';
        switch($keyName)
        {
            case "personTitle": $label = Webtext::getText('title', '�����:', true);
                break;
            case "registerCountryName": $label = Webtext::getText('registerCountry', '����� ���������:', true);
                break;
            case "taxIdentificationNumber": $label = Webtext::getText('taxIdentificationNumber', '����� �������� �������:', true);
                break;
            case "employeePosition": $label = Webtext::getText('employeePosition', '������ �����������, �� ������ ��������:', true);
                break;
            case "employeeName": $label = Webtext::getText('employeeName', 'ϲ� �����������, �� ������ ��������:', true);
                break;
        }
        return $label;
    }
}

$newPage = new userData();
$newPage->run();

?>