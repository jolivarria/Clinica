<?php

namespace Pacientes\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Pacientes\Controller\IngresoController;
use Pacientes\Model\Dao\IIngresoDao;
use Zend\Db\Adapter\AdapterInterface;

/**
 * This is the factory for RegistrationController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class IngresoControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $controller = null;
        switch ($requestedName) {
            case IngresoController::class:     
                $objIngreso= $container->get(IIngresoDao::class);
                $sessionContainer = $container->get('UserRegistration');               
                $controller = new IngresoController($sessionContainer,$objIngreso);
                break;
            default :
                return (null === $options) ? new $requestedName : new $requestedName;
        }
        // Instantiate the controller and inject dependencies
        return $controller;
    }

}
