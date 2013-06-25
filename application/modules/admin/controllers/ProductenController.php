<?php

class Admin_ProductenController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        
    }

    public function overviewadminAction() {
        $productModel = new Application_Model_Producten();
        $producten = $productModel->fetchall();
        $this->view->producten = $producten;
    }

    public function addAction() {
        $form = new Admin_Form_Addproduct();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {

            $postParams = $this->getRequest()->getPost();

            if ($this->view->form->isValid($postParams)) {
                unset($postParams['Submit']); // we schrijven de knop niet weg ...
                //unset($postParams['MAX_FILE_SIZE']); // we schrijven de max file size waar hij ook moge vandaan komen niet weg ...
                
                //$photoModel = new Admin_Model_Photo();
                //$photoModel->addPhoto($postParams['productImage']);
                
                $productModel = new Application_Model_Producten();
                $productModel->addProduct($postParams);
                $this->_redirect($this->view->url(array('/admin')));
            }
        }
    }

    public function editAction() {
        $id = $this->_getParam('productID');
        $productModel = new Application_Model_Producten();
        $product = $productModel->find($id)->current();

        $form = new Admin_Form_Addproduct();
        $form->populate($product->toArray());
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {

            $postParams = $this->getRequest()->getPost();
            
            if ($this->view->form->isValid($postParams)) {
                unset($postParams['Submit']);
                $productModel->editProduct($postParams, $id);
                
                $this->_redirect('/admin');
            }
        }
    }

}

