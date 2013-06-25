<?php

class Barons_Controller_Plugin_Translate extends Zend_Controller_Plugin_Abstract 
{

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        
        $lang = $request->getParam('locale');
        
        if (empty($lang)) {           
            $lang = 'nl_BE';
        } else {
            $lang = $request->getParam('locale');
        }
        // Zend moet weten in welke locale
        $locale     = new Zend_Locale('locale');
        
        // maak beschikbaar voor alle zend componenten onder de naam Zend_Locale
        Zend_Registry::set('Zend_Locale', $locale);
        $translate   = new Zend_Translate('array', array('yes' => 'ja'), $locale);
        $model       = new Application_Model_Translation();
        
        $translations= $model->getTranslationByLocale($locale);
        
        // alle vertalingen toevoegen aan het translate object
        foreach($translations as $translation)
        {
            $t = array($translation->tag => $translation->translation);
            $translate->addTranslation($t, $locale);
        }
        
        // maak beschikbaar voor alle zend componenten
        Zend_Registry::set('Zend_Translate', $translate);
    }

}

?>
