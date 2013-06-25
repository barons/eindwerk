<?php

class Admin_Form_Addproduct extends Zend_Form {

    public function init() {
        // $locale     = Zend_Registry::get('Zend_Locale');
        // $url        = '/' .$locale .'/login';
        $model = new Admin_Model_Categories();
        //$names = $model->getAll();

        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');

        //title
        $this->addElement(new Zend_Form_Element_Text('productTitle', array(
            'label' => "product title",
            'filters' => array('StringTrim'),
            'required' => true
        )));

        //teaser
        $this->addElement(new Zend_Form_Element_Text('productTeaser', array(
            'label' => "product teaser",
            'filters' => array('StringTrim'),
            'required' => true
        )));
        //content
        $this->addElement(new Zend_Form_Element_Textarea('productContent', array(
            'label' => "product content",
            'filters' => array('StringTrim'),
            'required' => true
        )));

        //price
        $this->addElement(new Zend_Form_Element_Text('productPrice', array(
            'label' => "product price",
            'filters' => array('StringTrim'),
            'required' => true
        )));

        //categorie
        /*
        $this->addElement('select', 'cars', array(
            'multiOptions' => array($cats)
        ));*/

        /*$this->addElement(new Zend_Form_Element_File('productImage', array(
            'label' => 'upload an image:',
            'required' => true,
            'maxfilesize' => 1000000,
            'destination' => 'productimages',
            'description' => 'click browse and click on the image file you would like to upload',
        )));*/


        //submit
        $this->addElement(new Zend_Form_Element_Button('Submit', array(
            'type' => 'submit',
            'label' => 'product toevoegen',
            'required' => false,
            'ignore' => true
        )));
    }

}

