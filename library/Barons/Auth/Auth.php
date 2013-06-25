<?php

class Barons_Auth_Auth extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(\Zend_Controller_Request_Abstract $request) {
        $loginController = 'users';
        $loginAction = 'login';
        $auth = Zend_Auth::getInstance();

        $registry = Zend_Registry::getInstance();
        $acl = $registry->get('Zend_Acl');

        if (!$auth->hasIdentity()) {
            $role = "GUEST";
        } else {
            $acl = $registry->get('Zend_Acl');
            $identity = $auth->getIdentity();
            $model = new Application_Model_Users();
            $user = $model->getUserByIdentity($identity);
            Zend_Registry::set('users', $user);
            $role = $user->userRole;
        }

        if ($request->getModuleName() !== 'default' && $request->getModuleName() !== NULL) {
            $isAllowed = $acl->isAllowed($role, $request->getModuleName() . ':' .
                    $request->getControllerName(), $request->getActionName());
        } else {
            $isAllowed = $acl->isAllowed($role, $request->getControllerName(), $request->getActionName());
        }
        if (!$isAllowed) {
            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
            $redirector->gotoUrl('/noaccess');
        }
    }

}

?>