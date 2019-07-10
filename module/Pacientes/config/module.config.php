<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacientes;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Pacientes\Controller\Factory\PacientesControllerFactory;
use Pacientes\Controller\Factory\SolicitudControllerFactory;

return [
    'router' => [
        'routes' => [
            'pacientes' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/pacientes[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'pacientes' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/pacientes[/:action]',
                    'defaults' => [
                        'controller' => Controller\IngresoController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'pacientes-ingreso' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/pacientes/ingreso[/:action]',
                    'defaults' => [
                        'controller' => Controller\IngresoController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'solicitud' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/pacientes/solicitud[/:action]',
                    'defaults' => [
                        'controller' => Controller\SolicitudController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'solicitud-modificar' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/solicitud/modificar[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]',
                    ],
                    'defaults' => [
                        'controller' => Controller\SolicitudController::class,
                        'action' => 'modificar',
                    ],
                ],
            ],
            'solicitud-nuevo' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/solicitud/nuevo[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\SolicitudController::class,
                        'action' => 'nuevo',
                    ],
                ],
            ],
            'solicitud-buscarfc' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/solicitud/buscarfc[/:rfc]',
                    'constraints' => [
                        'rfc' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\SolicitudController::class,
                        'action' => 'buscarfc',
                    ],
                ],
            ],
            'solicitud-detalle' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/solicitud/detalle[/:action][/:id][/:rfc]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]',
                        'rfc' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\SolicitudController::class,
                        'action' => 'detalle',
                    ],
                ],
            ],
            'solicitud-detallerpt' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/solicitud/detallerpt[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\SolicitudController::class,
                        'action' => 'detallerpt',
                    ],
                ],
            ],
            'solicitud-pdf' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/solicitud/pdf[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\SolicitudController::class,
                        'action' => 'pdf',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\IngresoController::class => PacientesControllerFactory::class,
            Controller\SolicitudController::class => SolicitudControllerFactory::class,
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
            'pacientes/index/index' => __DIR__ . '/../view/pacientes/index/index.phtml',
            'pacientes/ingreso/index' => __DIR__ . '/../view/pacientes/ingreso/index.phtml',
            'pacientes/solicitud/index' => __DIR__ . '/../view/pacientes/solicitud/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
