<?php
/**
 * Created by: melissen
 */
class LanguageController
{
    public $response = array('HTML'=>'', 'JS' => '');

    public function buildCopyContentForm()
    {
        include_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");
        include_once(FRAMEWORK_PATH."system/Languages.php");
        global $lang;


        include_once(FRAMEWORK_PATH.'system/helper/WebsiteManager.php');
        $websites = WebsiteManager::getWebsitesWithLanguages();
        $arrayData['websites'] = $websites;


        $langObj = Languages::getInstance();
        $arrayData['languages']	= $langObj->GetAllLanguages();
        //$arrayData['languageDefaultCode']	= $langObj->GetDefaultCode();
        //params for debug
        /*if($parameters)
            $arrayData['params']=serialize($parameters);
        */

        $view = new SmartyView();
        $arrayData['title'] = $lang['COPY_LANGUAGE_CONTENT'];
        $this->response['HTML'] = $view->fetch(BACKEND_PATH.'templates/languageModule/copyContentForm.tpl', $arrayData);
        $this->response['JS'] = "Menu.leftenable(); activateCopyLangValidation();".'websites = eval(\''.json_encode($websites).'\');';

        return $this->response;
    }

    public function CopyContent($parameters)
    {
        if($parameters['sourceSiteId']==$parameters['goalSiteId'] and $parameters['sourceLangId'] == $parameters['goalLangId']){
            $this->response['HTML'] = WebText::getText('BE_LangCopy_ErrorEqualParamCopy','Дана операція копіювання недопустима', true);
            return $this->response;
        }
        //delete source language content
        if(isset($parameters['deleteContent']) && $parameters['deleteContent']==='true' && ((int)$parameters['goalLangId']>0))
        {
            include_once(BACKEND_PATH."libs/FormBuilder/LanguageContent.php");
            $LanguageContentManager = new LanguageContentManager();

            if($LanguageContentManager->deleteLanguageContent($parameters['goalLangId'], $parameters['goalSiteId']))
                $this->response['HTML'] = WebText::getText('BE_LangCopy_SuccessDeleted','Видалення відбулося успішно', true);
            else
                $this->response['HTML'] = WebText::getText('BE_LangCopy_ErrorDeleted','Під час видалення відбулася помилка', true);

            $this->response['HTML'] .= '<br>';
        }

        if( isset($parameters['createContent']) && $parameters['createContent']==='true')
        {
            if((int)$parameters['sourceLangId']>0 and (int)$parameters['goalLangId']>0)
            {
                include_once(BACKEND_PATH."libs/FormBuilder/LanguageContent.php");
                $LanguageContentManager = new LanguageContentManager();

                $options = array(
                    'sourceSiteId'  => $parameters['sourceSiteId'],
                    'sourceLangId'  => $parameters['sourceLangId'],
                    'goalSiteId'  => $parameters['goalSiteId'],
                    'goalLangId'    => $parameters['goalLangId']
                );

                if($LanguageContentManager->createLanguageContent($options))
                    $this->response['HTML'] .= WebText::getText('BE_LangCopy_CopyResult','Копіювання мови відбулося успішно', true);
                else
                    $this->response['HTML'] .= WebText::getText('BE_LangCopy_CopyErrorResult','Копіювання мови відбулося з помилкою', true);
            }
            else
                $this->response['HTML'] .= WebText::getText('BE_LangCopy_ErrorParamCopy','Не передані всі параметри для копіювання мов', true);
        }

        return $this->response;
    }

//    public function buildLanguageList($parameters)
//    {
//        include_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");
//        include_once(FRAMEWORK_PATH."system/Languages.php");
//        global $lang;
//        $langObj = Languages::getInstance();
//        $arrayData['languages']	= $langObj->GetAppLanguages();
//        $arrayData['languageDefaultCode']	= $langObj->DefaultLanguageCode();
//
//       /* if(isset($parameters['deleteContent']) && $parameters['deleteContent']==='true')
//        {
//            include_once(BACKEND_PATH."libs/Custom/LanguageContent.php");
//            $LanguageContentManager = new LanguageContentManager();
//            $arrayData['tryDelete'] = true;
//            $arrayData['deletedLanguage'] = $parameters['copyLangId'];
//            $arrayData['isContentDeleted'] = $LanguageContentManager->deleteLanguageContent($parameters['copyLangId']);
//        }*/
//        $arrayData['params']=serialize($parameters);
//        /*if(isset($parameters['createContent']) && $parameters['createContent']==='true' && $arrayData['deletedLanguage']!='false')
//        {
//            include_once(BACKEND_PATH."libs/Custom/LanguageContent.php");
//            $LanguageContentManager = new LanguageContentManager();
//
//            $arrayData['tryCreate'] = true;
//            $arrayData['createdLanguage'] = $parameters['copyLangId'];
//            $arrayData['isContentCreated'] = $LanguageContentManager->createLanguageContent($arrayData['languages'][$langObj->GetDefaultCode()][id], $parameters['copyLangId']);
//        }*/
//
//        $view = new SmartyView();
//        $arrayData['title'] = $lang['COPY_LANGUAGE_CONTENT'];
//        $this->response['HTML'] = $view->fetch(BACKEND_PATH.'templates/languageModule/copyContentForm.tpl', $arrayData);
//        $this->response['JS'] = "Menu.leftenable();";
//        return $this->response;
//    }
}
