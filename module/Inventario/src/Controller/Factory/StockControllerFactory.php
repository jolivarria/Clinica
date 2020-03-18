<?php 

namespace Inventario\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Inventario\Controller\StockController;
use Inventario\Model\Dao\IStockDao;
use Zend\Db\Adapter\AdapterInterface;


/**
 * This is the factory for RegistrationController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class StockControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $controller = null;
        switch ($requestedName) {
            case StockController::class:    
                $dbAdapter = $container->get(AdapterInterface::class);
                $objDao = $container->get(IStockDao::class);
                $controller = new StockController($objDao,$dbAdapter);
                break;
            default :
                return (null === $options) ? new $requestedName : new $requestedName;
        }
        // Instantiate the controller and inject dependencies
        return $controller;
    }

}
