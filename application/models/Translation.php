<?php

class Application_Model_Translation extends Zend_Db_Table_Abstract
{
    protected $_name    = "translate";
    protected $_primary = "translateID";
    
    public function getTranslationByLocale(Zend_Locale $locale)
    {
        $select = $this->select()->where('locale = ?', $locale);
        $result = $this->fetchAll($select);
        return $result;
    }
}

