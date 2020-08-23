<?php

namespace Expedientes\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Expedientes\Controller\ContratoController;
use Expedientes\Model\Dao\IContratoDao;
use Zend\Db\Adapter\AdapterInterface;

use Expedientes\Model\Dao\IExpedientesDao;


/**
 * This is the factory for RegistrationController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class ContratoControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $controller = null;
        switch ($requestedName) {
            case ContratoController::class:     
                $dbAdapter = $container->get(AdapterInterface::class);
                $objContrato = $container->get(IContratoDao::class);
                $objExpediente = $container->get(IExpedientesDao::class);
                $controller = new ContratoController($objContrato,$objExpediente,$dbAdapter);
                break;
            default :
                return (null === $options) ? new $requestedName : new $requestedName;
        }
        // Instantiate the controller and inject dependencies
        return $controller;
    }

}
