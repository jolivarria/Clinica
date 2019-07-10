<?php

namespace Empleados\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Empleados\Service\ImageManager;
use Empleados\Controller\EmpleadosController;
use Empleados\Model\Dao\IEmpleadoDao;

/**
 * This is the factory for RegistrationController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class EmpleadosControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $controller = null;
        switch ($requestedName) {
            case EmpleadosController::class:
                $imageManager = $container->get(ImageManager::class);
                $sessionContainer = $container->get('UserRegistration');
                $empladoDao = $container->get(IEmpleadoDao::class);
                $controller = new EmpleadosController($sessionContainer, $imageManager,$empladoDao);
                break;
            default :
                return (null === $options) ? new $requestedName : new $requestedName;
        }
        // Instantiate the controller and inject dependencies
        return $controller;
    }

}
