<?php

namespace Expedientes\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Expedientes\Controller\IndexController;
use Expedientes\Model\Dao\IExpedientesDao;
use Zend\Db\Adapter\AdapterInterface;

/**
 * This is the factory for RegistrationController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class ExpedienteControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $controller = null;
        switch ($requestedName) {
            case IndexController::class:     
                $dbAdapter = $container->get(AdapterInterface::class);
                $objExpediente= $container->get(IExpedientesDao::class);               
                $controller = new IndexController($objExpediente,$dbAdapter);
                break;
            default :
                return (null === $options) ? new $requestedName : new $requestedName;
        }
        // Instantiate the controller and inject dependencies
        return $controller;
    }

}
