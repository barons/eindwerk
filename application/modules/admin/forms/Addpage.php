<?php

class Admin_Form_Addpage extends Zend_Form {

    public function init() {
        // $locale     = Zend_Registry::get('Zend_Locale');
        // $url        = '/' .$locale .'/login';
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');

        //title
        $this->addElement(new Zend_Form_Element_Text('title', array(
            'label' => "page title",
            'filters' => array('StringTrim'),
            'required' => true
        )));

        //content
        $this->addElement(new Zend_Form_Element_Textarea('content', array(
            'label' => "page content",
            'filters' => array('StringTrim'),
            'required' => true
        )));
        
        //slug
        $this->addElement(new Zend_Form_Element_Text('slug', array(
            'label' => "page slug",
            'filters' => array('StringTrim'),
            'required' => true
        )));

        //submit
        $this->addElement(new Zend_Form_Element_Button('Submit', array(
            'type' => 'submit',
            'label' => 'pagina toevoegen',
            'required' => false,
            'ignore' => true
        )));
    }

}

