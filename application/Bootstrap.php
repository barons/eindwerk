<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initRegisterControllerPlugins() {

        $this->bootstrap('frontcontroller');
        $front = $this->getResource('frontcontroller');
        //$front->registerPlugin(new Barons_Controller_Plugin_Translate());
        $front->registerPlugin(new Barons_Controller_Plugin_Navigation());
        $front->registerPlugin(new Barons_Controller_Plugin_Categories);
        $front->registerPlugin(new Barons_Auth_Acl());
        $front->registerPlugin(new Barons_Auth_Auth());
    }

    public function _initDbAdapter() {
        $this->bootstrap('db');
        $db = $this->getResource('db');

        Zend_Registry::set('db', $db);
    }

    public function _initRouter(array $options = null) {

        $router = $this->getResource('frontcontroller')->getRouter();

        // default page
        $router->addRoute('index', new Zend_Controller_Router_Route('/', array(
            'controller' => 'producten',
            'action' => 'overview'
        )));
        
        $router->addRoute('home', new Zend_Controller_Router_Route('/home', array(
            'controller' => 'producten',
            'action' => 'overview'
        )));

        $router->addRoute('page', new Zend_Controller_Router_Route('/page', array(
            'controller' => 'page',
            'action' => 'index'
        )));

        // login url
        $router->addRoute('login', new Zend_Controller_Router_Route('/login', array(
            'controller' => 'users',
            'action' => 'login'
        )));

        // logout url
        $router->addRoute('logout', new Zend_Controller_Router_Route('/logout', array(
            'controller' => 'users',
            'action' => 'logout'
        )));
        // after logout url
        $router->addRoute('loggedout', new Zend_Controller_Router_Route('/loggedout', array(
            'controller' => 'page',
            'action' => 'loggedout'
        )));

        // overview page for admin
        $router->addRoute('admin', new Zend_Controller_Router_Route('/admin', array(
            'module' => 'admin',
            'controller' => 'producten',
            'action' => 'overviewAdmin'
        )));
        // add url for admin
        $router->addRoute('addadmin', new Zend_Controller_Router_Route('admin/producten/add', array(
            'module' => 'admin',
            'controller' => 'producten',
            'action' => 'add'
        )));
        // add url for admin
        $router->addRoute('addpage', new Zend_Controller_Router_Route('/admin/pages/add', array(
            'module' => 'admin',
            'controller' => 'page',
            'action' => 'add'
        )));

        // noaccess url
        $router->addRoute('noaccess', new Zend_Controller_Router_Route('/noaccess', array(
            'controller' => 'noaccess',
            'action' => 'index'
        )));
    }

}

