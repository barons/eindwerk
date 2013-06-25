<?php

class ProductenController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
    }

    public function overviewAction()
    {
        $productModel = new Application_Model_Producten();
        $producten = $productModel->fetchall();
        $this->view->producten = $producten;
    }

    public function detailAction()
    {
        $id = $this->_getParam('productID');
        $productModel = new Application_Model_Producten();
        $product = $productModel->find($id)->current();
        
        $this->view->producten = $product;
    }


}



