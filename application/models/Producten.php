<?php

class Application_Model_Producten extends Zend_Db_Table_Abstract
{
   // definiëren hoe de tabel eruit ziet
    
    protected $_name = 'product';
    protected $_primary = 'productID';
    
    public function getProduct()
    {    
        $this->fetchAll(); // select * from nieuws
    }
    
    public function addProduct($params)
    {
        $this->insert($params);
    }
    
    public function editProduct($params, $id)
    {    
       $where = $this->getAdapter()->quoteInto('productID = ?', $id);
       $this->update($params, $where);
    }
    
    public function deleteProduct($id)
    {
       // beveilig de variabele dmv de adapater
       $where = $this->getAdapter()->quoteInto('productID = ?', $id);
       $this->delete($where);
    }
    
    public function detailProduct($id)
    {
        $this->fetchAll($id);
    }
    
}

?>