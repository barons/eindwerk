<?php

class Barons_Controller_Plugin_Navigation extends Zend_Controller_Plugin_Abstract
{
    
    public function preDispatch(\Zend_Controller_Request_Abstract $request)
    {
        /* cache aanmaken */
        $frontendOptions = array(
          'lifetime' => 3600, // 1 uur in de cache
          'automatic_serialization' => true
        );
        
        $backendOptions = array(
          'cache_dir' => APPLICATION_PATH.'/../cache'
        );
        
        
        $cache = Zend_Cache::factory('Core',
                                     'File',
                                     $frontendOptions,
                                     $backendOptions
        );
        
        // bestaat de cache met naam navigation?
        if (($result = $cache->load('navigation')) === false) {
            // deze bestaat niet!
            //$locale = Zend_Registry::get('Zend_Locale');
            $model = new Application_Model_Page();
            $pages = $model->getMenu();

            $container = new Zend_Navigation();

            foreach ($pages as $page){

                $menu = new Zend_Navigation_Page_Mvc(
                        array(
                            'label' => $page['title'],
                            'controller' => 'index',
                            'route' => 'page',
                            'params' => array('slug' => $page['slug'])
                        ));
                $container->addPage($menu);
            }

            $cache->save($container, 'navigation');
            
        } else {
           $container = $result;
        }
        
        Zend_Registry::set('Zend_Navigation_Menu',$container);
    }
    
}

?>