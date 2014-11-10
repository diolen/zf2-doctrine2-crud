<?php

namespace Cliente\Form;

use Zend\Form\Form;

class ClienteForm extends Form {

    public function __construct($tiposOptions = null)
    {
        parent::__construct('cliente');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));        
        $this->add(array(
            'name' => 'nombre',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nombre de ususario'
            ),
        ));
        $this->add(array(
            'name' => 'numero',
            'type' => 'Text',
            'attributes' => array(
                'maxlength' => '11',
            ),
            'options' => array(
                'label' => 'Teléfono',
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'tipo',
            'attributes' => array(
                'id' => 'tipo'
            ),
            'options' => array(
                'label' => 'Tipo de teléfono',
                'options' => $tiposOptions->getTelefonosTiposOptions(),
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Guardar',
                'id' => 'submitbutton',
            ),
        ));
    }

}
