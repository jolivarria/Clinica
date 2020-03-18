<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inventario;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Inventario\Controller\Factory\ProductoControllerFactory;
use Inventario\Controller\Factory\EntradasControllerFactory;
use Inventario\Controller\Factory\SalidasControllerFactory;
use Inventario\Controller\Factory\StockControllerFactory;

return [
    'router' => [
        'routes' => [
            'inventario' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\ProductoController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'inventario' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/inventario/producto[/:action]',
                    'defaults' => [
                        'controller' => Controller\ProductoController::class,
                        'action' => 'producto',
                    ],
                ],
            ],
            'inventario-producto' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/inventario/producto[/:action]',
                    'defaults' => [
                        'controller' => Controller\ProductoController::class,
                        'action' => 'producto',
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
            'inventario-salida' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/inventario/salidas[/:action]',
                    'defaults' => [
                        'controller' => Controller\SalidasController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'inventario-salidas-nuevo' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/inventario/salidas/nuevo[/:action]',
                    'defaults' => [
                        'controller' => Controller\SalidasController::class,
                        'action' => 'nuevo',
                    ],
                ],
            ],
            'inventario-stock' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/inventario/stock[/:action]',
                    'defaults' => [
                        'controller' => Controller\StockController::class,
                        'action' => 'index',
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
            Controller\ProductoController::class => ProductoControllerFactory::class,
            Controller\EntradasController::class => EntradasControllerFactory::class,
            Controller\SalidasController::class => SalidasControllerFactory::class,
            Controller\StockController::class => StockControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'inventario/index/index' => __DIR__ . '/../view/inventario/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
