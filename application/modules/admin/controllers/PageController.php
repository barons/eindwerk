<?php

class Admin_PageController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        die('index van admin');
    }

    public function addAction() {
        $form = new Admin_Form_Addpage();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {

            $postParams = $this->getRequest()->getPost();

            if ($this->view->form->isValid($postParams)) {
                unset($postParams['Submit']); // we schrijven de knop niet weg ...
                //unset($postParams['MAX_FILE_SIZE']); // we schrijven de max file size waar hij ook moge vandaan komen niet weg ...
                //$test = $postParams['FILE_NAME'];
                $pageModel = new Application_Model_Page();
                $pageModel->addPage($postParams);
                $this->_redirect($this->view->url(array('/admin')));
            }
        }
    }

    public function deleteAction() {
        // action body
    }

    public function editAction() {
        $id = $this->_getParam('pageID');
        $pageModel = new Application_Model_Page();
        $page = $pageModel->find($id)->current();

        $form = new Admin_Form_Addpage();
        $form->populate($page->toArray());
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {

            $postParams = $this->getRequest()->getPost();

            if ($this->view->form->isValid($postParams)) {

                unset($postParams['Submit']);
                $pageModel->editPage($postParams, $id);
                $this->_redirect('/admin');
            }
        }
    }

}