<?php

class Application_Model_Users extends Zend_Db_Table_Abstract
{
    protected $_name    = "users";
    protected $_primary = "userID";
    
    public function getUserByIdentity($identity){
        $select     = $this->select()->where('userName = ?', $identity);
        $result     = $this->fetchAll($select)->current();
        return $result;
    }

}

