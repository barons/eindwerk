<?php

class Admin_Model_Categories extends Zend_Db_Table_Abstract {
    protected $_name = "categorys";
    protected $_primary = "CategorieID";

    const MENU_VISIBLE = 1;
    const MENU_INVISIBLE = 0;
    const STATUS_ONLINE = 1;
    const STATUS_OFFLINE = 0;

    /**
     * Get the navigation by locale, visibility and status
     * @param Zend_Locale $locale
     * @return Zend_Db_Table_Rowset
     */
    public function getMenu() {
        $select = $this->select();
        $result = $this->fetchAll($select);
        return $result;
    }
    
    public function getAll(){
        $select = $this->select();
        $result = $this->fetchAll($select);
        return $result;
    }

}