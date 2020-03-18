<?php 

namespace Inventario\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Inventario\Controller\SalidasController;
use Inventario\Model\Dao\ISalidasDao;
use Inventario\Model\Dao\IProductoDao;
use Zend\Db\Adapter\AdapterInterface;


/**
 * This is the factory for RegistrationController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class SalidasControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $controller = null;
        switch ($requestedName) {
            case SalidasController::class:
                $dbAdapter = $container->get(AdapterInterface::class);
                $objDao = $container->get(ISalidasDao::class);
                $objProductos = $container->get(IProductoDao::class);
                $controller = new SalidasController($objDao,$objProductos,$dbAdapter);
                break;
            default :
                return (null === $options) ? new $requestedName : new $requestedName;
        }
        // Instantiate the controller and inject dependencies
        return $controller;
    }

}
