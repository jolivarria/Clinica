<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Empleados;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Empleados\Service\ImageManager;

return [
    'router' => [
        'routes' => [
            'empleados' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/empleados/',
                    'defaults' => [
                        'controller' => Controller\EmpleadosController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'empleados' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/empleados[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\EmpleadosController::class,
                        'action' => 'index',
                    ],
                ],
            ],
             'nuevo' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/nuevo[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\EmpleadosController::class,
                        'action' => 'nuevo',
                    ],
                ],
            ],
            'images' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/images[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\ImageController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'view' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/view[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\EmpleadosController::class,
                        'action' => 'view',
                    ],
                ],
            ],
//            'listar' => [
//                'type' => Segment::class,
//                'options' => [
//                    'route' => '/listar[/:action]',
//                    'defaults' => [
//                        'controller' => Controller\IndexController::class,
//                        'action' => 'listar',
//                    ],
//                ],
//            ],
//            'application' => [
//                'type' => Segment::class,
//                'options' => [
//                    'route' => '/application[/:action]',
//                    'defaults' => [
//                        'controller' => Controller\IndexController::class,
//                        'action' => 'index',
//                    ],
//                ],
//            ],
        ],
    ],
    'service_manager' => [
        // ...
        'factories' => [
            // Register the ImageManager service
            ImageManager::class => InvokableFactory::class,
        ],
    ],
    'session_containers' => [
        'UserRegistration'
    ],
    'controllers' => [
        'factories' => [
            Controller\EmpleadosController::class => InvokableFactory::class,
            Controller\EmpleadosController::class => Controller\Factory\EmpleadosControllerFactory::class,
            Controller\ImageController::class => Controller\Factory\ImageControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
//        'not_found_template' => 'error/404',
//        'exception_template' => 'error/index',
        'template_map' => [
//            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
//            'layout/admin' => __DIR__ . '/../view/layout/admin.phtml',
            'empleados/Image/index' => __DIR__ . '/../view/empleados/Image/index.phtml',
//            'error/404' => __DIR__ . '/../view/error/404.phtml',
//            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
