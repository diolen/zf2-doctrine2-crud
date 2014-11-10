<?php
namespace Cliente;

return array(
	 'doctrine' => array(
		 'driver' => array(
			 'Cliente_entities' => array(
				 'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				 'cache' => 'array',
				 'paths' => array(__DIR__ . '/../src/Cliente/Entity')
			 ),
			 'orm_default' => array(
				 'drivers' => array(
					 'Cliente\Entity' => 'Cliente_entities'
				 )
		     )
		 )
     ),

     'controllers' => array(
         'invokables' => array(
             'Cliente\Controller\Cliente' => 'Cliente\Controller\ClienteController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'cliente' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/cliente[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Cliente\Controller\Cliente',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'cliente' => __DIR__ . '/../view',
         ),
     ),    
 );