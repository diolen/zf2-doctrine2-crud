<?php
namespace Cliente\Form;

class TelefonosTiposForm {
    
    private $em;


    public function __construct($em)
    {
        $this->em = $em;
    }
    
    
    public function getTelefonosTiposOptions()
    {
        $arrTipos = array();
        $tipos = $this->em->getRepository('Cliente\Entity\TelefonosTipos')->findAll();
        
        foreach($tipos as $tipo) {
            $arrTipos[$tipo->getId()] = $tipo->getTipo();
        }
        return $arrTipos;
    }
}
