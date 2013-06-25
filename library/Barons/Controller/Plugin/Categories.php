<?php

class Barons_Controller_Plugin_Categories extends Zend_Controller_Plugin_Abstract 
{

    public function preDispatch(\Zend_Controller_Request_Abstract $request) {
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
        // bestaat de cache met naam categoriesNav?
        if (($result = $cache->load('categoriesNav')) === false) {
            // deze bestaat niet!
            // $locale = Zend_Registry::get('Zend_Locale');
            $model      = new Admin_Model_Categories();
            $cats       = $model->getMenu();
            $catscontainer = new Zend_Navigation();
            
            foreach ($cats as $cat){
                $catsMenu = new Zend_Navigation_Page_Mvc(
                        array(
                            'label' => $cat['CategorieName'],
                            'controller' => 'index'
                            //'route' => 'CategorieID',
                            //'params' => array('slug' => $cat['slug'],'lang' => $locale)
                        ));
                $catscontainer->addPage($catsMenu);
            }
            $cache->save($catscontainer, 'categoriesNav');

        } else {
           $catscontainer = $result;
        }
        Zend_Registry::set('Zend_Navigation_Cats',$catscontainer);

    }

}
?>



