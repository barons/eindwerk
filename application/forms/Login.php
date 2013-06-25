<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author BaronS
 */
class Application_Form_Login extends Zend_Form{
    public function init()
    {
        //$locale     = Zend_Registry::get('Zend_Locale');
        //$url        = '/' .$locale .'/login';
        
        $this->setMethod('post');
        $this->setAttrib('enctyp', 'multipart/form-data');
        
        //login
        $this->addElement(new Zend_Form_Element_Text('userName', array(
            'label'     => "login_lbl",
            'filters'   => array('stringTrim'),
            'required'  => true
        )));
        
        //password
        $this->addElement(new Zend_Form_Element_Password('userPassword', array(
            'label'     => "password_lbl",
            'filters'   => array('stringTrim'),
            'required'  => true
        )));
        
        //submit
        $btn = new Zend_Form_Element_Button('submit', array(
            'type'     => "submit",
            'value'     => 'submit_lbl',
            'ignore'  => true
        ));
        $this->addElement($btn);
        
    }
}

?>
