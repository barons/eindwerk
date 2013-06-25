<?php

class Application_Form_AddCart extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAttrib('enctyp', 'multipart/form-data');
        
        //quantity
        $this->addElement(new Zend_Form_element_('quantity', array(
            'label'     => "quantity_lbl",
            'filters'   => array('digits'),
            'required'  => true
        )));
        
        //submit
        $btn = new Zend_Form_Element_Button('add', array(
            'type'     => "submit",
            'value'     => 'add_lbl',
            'ignore'  => true
        ));
        $this->addElement($btn);
    }


}

