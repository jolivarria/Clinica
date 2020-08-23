<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Venta;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Inventario\Controller\Factory\ProductoControllerFactory;
use Inventario\Controller\Factory\EntradasControllerFactory;

return [
    'router' => [
        'routes' => [
            'venta' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\ProductoController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'venta' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/venta[/:action]',
                    'defaults' => [
                        'controller' => Controller\VentaController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'venta-credito' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/venta/credito[/:action]',
                    'defaults' => [
                        'controller' => Controller\CreditoController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'inventario-producto-nuevo' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/inventario/producto/nuevo[/:action]',
                    'defaults' => [
                        'controller' => Controller\ProductoController::class,
                        'action' => 'nuevo',
                    ],
                ],
            ],
            'inventario-entradas' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/inventario/entradas[/:action]',
                    'defaults' => [
                        'controller' => Controller\EntradasController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'inventario-entradas-nuevo' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/inventario/entradas/nuevo[/:action]',
                    'defaults' => [
                        'controller' => Controller\EntradasController::class,
                        'action' => 'nuevo',
                    ],
                ],
            ],
            'inventario-buscarproducto' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/inventario/buscarproducto[/:codigo]',
                    'constraints' => [
                        'codigo' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\EntradasController::class,
                        'action' => 'buscarproducto',
                    ],
                ],
            ],
            
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\VentaController::class => InvokableFactory::class,
            Controller\CreditoController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'venta/index/index' => __DIR__ . '/../view/venta/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
