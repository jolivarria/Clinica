<?php

namespace Pacientes\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Pacientes\Controller\IngresoController;
use Pacientes\Model\Dao\ISolicitudIngresoDao;


/**
 * This is the factory for RegistrationController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class IngresoControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $controller = null;
        switch ($requestedName) {
            case IngresoController::class:     
                $objSolicitud = $container->get(ISolicitudIngresoDao::class);
                $sessionContainer = $container->get('UserRegistration');               
                $controller = new IngresoController($sessionContainer,$objSolicitud);
                break;
            default :
                return (null === $options) ? new $requestedName : new $requestedName;
        }
        // Instantiate the controller and inject dependencies
        return $controller;
    }

}
