<?php

class UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
    
    public function loginAction()
    {
       $loginForm = new Application_Form_Login();
       $this->view->form = $loginForm;
       if ($this->getRequest()->getPost()) {
           
           $postParams = $this->getRequest()->getPost(); // $_POST
           
           if($this->view->form->isValid($postParams)){
               $params = $this->view->form->getValues();
               
               $auth = Zend_Auth::getInstance();
               // meegeven welke database driver we gebruiken
               $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));
               // login query opbouwen
               $authAdapter->setTableName('users')
                           ->setIdentityColumn('userName')
                           ->setCredentialColumn('userPassword')
                           ->setIdentity($params['userName'])
                           ->setCredential($params['userPassword']);
               // login uitvoeren
               $result = $auth->authenticate($authAdapter);
               
               if ($result->isValid()){
                    $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
                    $redirector->gotoUrl('/admin');
               } else {
                   // alle foutmeldingen weergeven op het scherm
                   foreach($result->getMessages() as $message) {
                       echo $message;
                   }
               }
               
           }
           
       }

    }
    
    public function logoutAction(){
        $auth           = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $redirector     = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
        $redirector->gotoUrl('/loggedout');
    }


}

