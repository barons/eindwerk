<?php

class Admin_PhotoController extends Zend_Controller_Action
{
    // definiëren hoe de tabel eruit ziet
    
    protected $_name = 'photo';
    protected $_primary = 'PhotoID';
    
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction($params)
    {
        $this->insert($params);
    }


}



