<?php

class
ReservedRequestData
{
    static function userRegistration()
    {
        $data = array("viewId" => array('value' => 36),

            "name" => array('value' => request::getValidatedString($_POST['regName']),
                'required' => true, 'rule' => array()),
            "email" => array('value' => request::getValidatedString($_POST['regEmail']),
                'required' => true,
                'rule' => array('userEmailUnique', 'emailFormat')),
            "password" => array('value' => request::getValidatedString($_POST['regPassword']),
                'required' => true,
                'rule' => array()),
            "password_confirm" => array('value' => request::getValidatedString($_POST['regPasswordConfirm']),
                'required' => true,
                'rule' => array('passwordEquals')),
            "text1" => array('value' => request::getValidatedString($_POST['regDeliveryCity']),
                'required' => false,
                'rule' => array()),);
        return $data;
    }

    static function userLogin()
    {
        $data = array("email" => array('value' => request::getValidatedString($_POST['email']),
            'required' => true,
            'rule' => array('emailFormat')),
            "password" => array('value' => request::getValidatedString($_POST['password']),
                'required' => true,
                'rule' => array()));

        return $data;
    }

    static function user()
    {
        $data = array("password" => array('value' => request::getValidatedString($_POST['regPassword']),
            'required' => false, 'rule' => array()),
            "text1" => array('value' => request::getValidatedString($_POST['regDeliveryCity']),
                'required' => false, 'rule' => array()),
            "name" => array('value' => request::getValidatedString($_POST['regName']),
                'required' => true, 'rule' => array()),
            "text2" => array('value' => request::getValidatedString($_POST['regStreet']),
                'required' => false, 'rule' => array()),
            "phoneNumber" => array('value' => request::getValidatedString($_POST['regPhone']),
                'required' => false, 'rule' => array())
        );
        return $data;
    }
    static function changePass()
    {
        $data = array("password_old" => array('value' => request::getValidatedString($_POST['oldRegPassword']),
                'required' => false, 'rule' => array()),
            "password" => array('value' => request::getValidatedString($_POST['regPassword']),
                'required' => false, 'rule' => array()),
            "password_confirm" => array('value' => request::getValidatedString($_POST['regPasswordConfirm']),
                'required' => true,
                'rule' => array())
        );
        return $data;
    }

    static function juridicalPerson()
    {
        $data = array("title" => array('value' => request::getValidatedString($_POST['ud']['personTitle']),
            'required' => true, 'rule' => array()),
            "countryId" => array('value' => request::getValidatedString($_POST['ud']['registerCountry']),
                'required' => true, 'rule' => array()),
            "taxIdentificationNumber" => array('value' => request::getValidatedString($_POST['ud']['taxIdentificationNumber']),
                'required' => true, 'rule' => array()),
            "employeePosition" => array('value' => request::getValidatedString($_POST['ud']['employeePosition']),
                'required' => true, 'rule' => array()),
            "employeeName" => array('value' => request::getValidatedString($_POST['ud']['employeeName']),
                'required' => true, 'rule' => array())
        );
        return $data;
    }

    static function shortAddress($post = null)
    {
        if ($post == null) {
            $post = $_POST;
        }

        $data = array("countryName" => array('value' => request::getValidatedString($post['regCountry']),
            'required' => false, 'rule' => array()),
            "cityName" => array('value' => request::getValidatedString($post['regCity']),
                'required' => false, 'rule' => array()),
            "street" => array('value' => request::getValidatedString($post['regStreet']),
                'required' => false, 'rule' => array()),
            "houseNumber" => array('value' => request::getValidatedString($post['regStreetNr']),
                'required' => false, 'rule' => array()),
            "zipCode" => array('value' => request::getValidatedString($post['regZipCode']),
                'required' => false, 'rule' => array()),
            "phoneNumber" => array('value' => request::getValidatedString($post['regPhone']),
                'required' => false, 'rule' => array()),
            "gender" => array('value' => request::getValidatedString($post['gender']),
                'required' => true, 'rule' => array()),
            "surname" => array('value' => request::getValidatedString($post['regSurname']),
                'required' => true, 'rule' => array()),
            "name" => array('value' => request::getValidatedString($post['regName']),
                'required' => true, 'rule' => array())
        );
        return $data;
    }

    static function contactFormData()
    {
        $data = array(
            "email" => array(
                'value' => request::getValidatedString($_POST['cf']['email']),
                'required' => true,
                'rule' => 'emailFormat'
            ),
            /*            "phoneNumber" => array(
                            'value' => request::getValidatedString($_POST['cf']['phoneNumber']),
                            'required' => false,
                            'rule' => 'phoneNumberFormat'
                        ),
            */
            "name" => array(
                'value' => request::getValidatedString($_POST['cf']['name']),
                'required' => true,
                'rule' => ''
            ),
            "contactMessage" => array(
                'value' => request::getValidatedString($_POST['cf']['contactMessage']),
                'required' => true,
                'rule' => ''
            )
        );
        return $data;
    }

    static function orderSiteFormData()
    {
        $data = array(
            "email" => array(
                'value' => request::getValidatedString($_POST['cf']['email']),
                'required' => true,
                'rule' => 'emailFormat'
            ),
            "phoneNumber" => array(
                'value' => request::getValidatedString($_POST['cf']['phoneNumber']),
                'required' => true,
                'rule' => 'phoneNumberFormat'
            ),
            "name" => array(
                'value' => request::getValidatedString($_POST['cf']['name']),
                'required' => true,
                'rule' => ''
            ),
            "contactText" => array(
                'value' => request::getValidatedString($_POST['cf']['contactText']),
                'required' => true,
                'rule' => ''
            ),
            "workType" => array(
                'value' => request::getValidatedString($_POST['cf']['workType']),
                'required' => true,
                'rule' => ''
            ),
            "cost" => array(
                'value' => request::getValidatedString($_POST['cf']['cost']),
                'required' => false,
                'rule' => ''
            )
        );
        return $data;
    }

    static function poiItem()
    {
        $data = array("typeId" => array('value' => request::getValidatedString($_POST['poi']['mainType']),
            'required' => true, 'rule' => array()),
            "site" => array('value' => request::getValidatedString(trim($_POST['poi']['website'])),
                'required' => false, 'rule' => array())
        );
        return $data;
    }

    static function fieldsRulesRegExContent($rule)
    {
        $ret = '';
        $rulesContent = array(
            'emailFormat' => '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,6})$/',
            'phoneNumberFormat' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/',
            'urlFormat' => '/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/'
        );
        if (isset($rulesContent[$rule]))
            $ret = $rulesContent[$rule];
        return $ret;
    }
}

?>