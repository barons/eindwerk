<?php

class Barons_Auth_Acl extends Zend_Controller_Plugin_Abstract
{

    public function preDispatch(\Zend_Controller_Request_Abstract $request)
    {
        $acl = new Zend_Acl();
        
        $roles = array('ADMIN','USER','GUEST');
        $controllers = array('users','admin', 'index', 'page', 'error','noaccess', 'producten', 'admin:producten');
        
        foreach ($roles as $role) {
            $acl->addRole(new Zend_Acl_Role($role));
        }
        
        foreach ($controllers as $controller){
            //$acl->addResource($controller); kan ook
            $acl->addResource(new Zend_Acl_Resource($controller));
        }
        
        $acl->allow('ADMIN'); // acces to everything
        $acl->allow('USER'); // acces to everything
        $acl->allow('GUEST');
        $acl->deny('GUEST', 'admin:producten');
        $acl->deny('GUEST', 'admin');
        
        Zend_Registry::set('Zend_Acl', $acl);           
    }
    
}

?>