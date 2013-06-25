<?php

class Application_Model_Page extends Zend_Db_Table_Abstract {

    protected $_name = "pages";
    protected $_primary = "pageID";

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
        $select = $this->select()
                ->where('menu = ?', self::MENU_VISIBLE)
                ->where('status = ?', self::STATUS_ONLINE);
                //->where('slug = ?', $slug);
        //->where('locale = ?', $locale);
        $result = $this->fetchAll($select);
        return $result;
    }

    
    /**
     * Get the page by slug and locale
     * @param Zend_Locale $locale
     * @param string $slug
     * @return Zend_Db_Table_Rowset
     */
    public function getPage() {
        //if ($slug === null){
        //    return;
        //}

        $select = $this->select()
                ->where('status = ?', self::STATUS_ONLINE);
                //->where('slug = ?', $slug);
        $result = $this->fetchAll($select)->current();
        return $result;
    }

    
    public function addPage($params) {
        $this->insert($params);
    }
    

    public function editProduct($params, $id) {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->update($params, $where);
    }

}

