<?php

namespace Cliente\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cliente\Form\ClienteForm;
use Cliente\Form\ClienteFilter;
use Cliente\Form\TelefonosTiposForm;
use Cliente\Entity\Clientes;
use Cliente\Entity\Telefonos;

class ClienteController extends AbstractActionController {

    public function getEntityManager()
    {
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

    public function indexAction()
    {
        $em = $this->getEntityManager();
        $telefonos = $em->getRepository('Cliente\Entity\Telefonos')->findAll();
        return new ViewModel(array(
            'telefonos' => $telefonos
        ));
    }

    public function addAction()
    {
        $em = $this->getEntityManager();
        
        $telefonosTiposOptions = new TelefonosTiposForm($em);
        $form = new ClienteForm($telefonosTiposOptions);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $clienteFilter = new ClienteFilter();
            $form->setInputFilter($clienteFilter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();

                $cliente = new Clientes();
                $cliente->setNombre($data['nombre']);
                $cliente->setFechaAlta(new \DateTime());
                $em->persist($cliente);
                $em->flush();
                
                $cli = $em->find('Cliente\Entity\Clientes', $cliente->getId());
                $telefonosTipos = $em->find('Cliente\Entity\TelefonosTipos', $data['tipo']);
                
                $telefono = new Telefonos();
                $telefono->setCliente($cli);
                $telefono->setTelefonoTipo($telefonosTipos);
                $telefono->setTelefonoNumero($data['numero']);
                $em->persist($telefono);
                $em->flush();                

                return $this->redirect()->toRoute('cliente');
            }
        }
        return new ViewModel(array(
            'form' => $form
        ));        
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cliente', array( 'action' => 'add' ));
        }
        
        $em = $this->getEntityManager();
        
        try {
            $cliente = $em->getRepository('Cliente\Entity\Telefonos')->find($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('cliente', array( 'action' => 'index' ));
        }
        
        $telefonosTiposOptions = new TelefonosTiposForm($em);
        $form = new ClienteForm($telefonosTiposOptions);
        $form->bind($cliente);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $clienteFilter = new ClienteFilter();
            $form->setInputFilter($clienteFilter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                
                $cliente->setNombre($data['nombre']);
                //$cliente->setFechaAlta(new \DateTime());
                $em->persist($cliente);
                $em->flush();

                $telefonosTipos = $em->find('Cliente\Entity\TelefonosTipos', $data['tipo']);
                
                $telefono = new Telefonos();
                $telefono->setCliente($cliente);
                $telefono->setTelefonoTipo($telefonosTipos);
                $telefono->setTelefonoNumero($data['numero']);
                $em->persist($telefono);
                $em->flush();

                return $this->redirect()->toRoute('cliente');
            }
        }

        return new ViewModel( array(
            'id' => $id,
            'form' => $form,
        ));
    }

    public function deleteAction()
    {
        $em = $this->getEntityManager();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('cliente');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('cliente');
        }

        $cliente = $em->getRepository('Cliente\Entity\Telefonos')->find($id);
        return array(
            'id' => $id,
            'cliente' => $cliente
        );
    }

}
