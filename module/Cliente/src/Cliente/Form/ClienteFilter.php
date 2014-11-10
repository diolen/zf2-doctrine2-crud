<?php

namespace Cliente\Form;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ClienteFilter implements InputFilterAwareInterface {

    public $id;
    public $nombre;
    public $numero;
    public $tipo;
    protected $inputFilter;                       // <-- Add this variable

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->numero = (isset($data['numero'])) ? $data['numero'] : null;
        $this->tipo = (isset($data['tipo'])) ? $data['tipo'] : null;
    }

    
    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }            
    
    
    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'id',
                'required' => false,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'nombre',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 4,
                            'max' => 50,
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name' => 'numero',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),                    
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 8,
                            'max' => 11,
                        ),
                    ),
                ),
            ));            

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
