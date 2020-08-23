<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Expedientes;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Expedientes\Controller\Factory\ExpedienteControllerFactory;
USE Expedientes\Controller\Factory\ContratoControllerFactory;

return [
    'router' => [
        'routes' => [
            'expedientes' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/expedientes[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'expedientes-contrato' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/expedientes/contrato[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ContratoController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'contrato-nuevo' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/expedientes/contrato/nuevo[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ContratoController::class,
                        'action' => 'nuevo',
                    ],
                ],
            ],
            'reporte' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/expedientes/reporte[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ContratoController::class,
                        'action' => 'reporte',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => ExpedienteControllerFactory::class,
            Controller\IngresoController::class => ExpedienteControllerFactory::class,
            Controller\ContratoController::class => ContratoControllerFactory::class,
        ],
    ],
    'session_containers' => [
        'UserRegistration'
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'expedientes/index/index' => __DIR__ . '/../view/expedientes/index/index.phtml',
            'expedientes/ingreso/index' => __DIR__ . '/../view/expedientes/ingreso/index.phtml',
            'expedientes/contrato/index' => __DIR__ . '/../view/expedientes/contrato/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
