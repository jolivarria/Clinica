<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inventario;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Inventario\Model\Entity\Producto;
use Inventario\Model\Dao\IProductoDao;
use Inventario\Model\Dao\ProductoDao;

use Inventario\Model\Entity\Entradas;
use Inventario\Model\Dao\IEntradasDao;
use Inventario\Model\Dao\EntradasDao;

use Inventario\Model\Entity\Salidas;
use Inventario\Model\Dao\ISalidasDao;
use Inventario\Model\Dao\SalidasDao;

use Inventario\Model\Entity\Stock;
use Inventario\Model\Dao\IStockDao;
use Inventario\Model\Dao\StockDao;



class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    public function getServiceConfig() {
        return[
            'factories' => [
                'ProductoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Producto());
                    return new TableGateway('productos', $dbAdapter, null, $resultSetPrototype);
                },
                IProductoDao::class => function ($sm) {
                    $tableGateway = $sm->get('ProductoTableGateway');
                    $dao = new ProductoDao($tableGateway);
                    return $dao;
                },
                'EntradasTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entradas());
                    return new TableGateway('entradas', $dbAdapter, null, $resultSetPrototype);
                },
                IEntradasDao::class => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $tableGateway = $sm->get('EntradasTableGateway');
                    $dao = new EntradasDao($tableGateway,$dbAdapter);
                    return $dao;
                },
                'SalidasTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Salidas());
                    return new TableGateway('salidas', $dbAdapter, null, $resultSetPrototype);
                },
                ISalidasDao::class => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $tableGateway = $sm->get('SalidasTableGateway');
                    $dao = new SalidasDao($tableGateway,$dbAdapter);
                    return $dao;
                },
                'StockTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Stock());
                    return new TableGateway('inventario', $dbAdapter, null, $resultSetPrototype);
                },
                IStockDao::class => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $tableGateway = $sm->get('StockTableGateway');
                    $dao = new StockDao($tableGateway,$dbAdapter);
                    return $dao;
                },
               
            ],
        ];
    }
}
