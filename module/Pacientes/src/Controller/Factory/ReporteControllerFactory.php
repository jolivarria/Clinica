<?php

namespace Pacientes\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Pacientes\Controller\SolicitudController;
use Pacientes\Model\Dao\ISolicitudIngresoDao;
use Pacientes\Controller\ReporteController;
use Pacientes\Model\Dao\IReporteDao;
use Pacientes\Model\Dao\IVehiculosDao;
use Zend\Db\Adapter\AdapterInterface;
/**
 * This is the factory for RegistrationController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class ReporteControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $controller = null;
        switch ($requestedName) {
            case ReporteController::class:
                $dbAdapter = $container->get(AdapterInterface::class);
                $objSolicitud = $container->get(ISolicitudIngresoDao::class);
                $objReporte911 = $container->get(IReporteDao::class);
                $objVehiculo = $container->get(IVehiculosDao::class);
                $sessionContainer = $container->get('UserRegistration');
                $controller = new ReporteController($objReporte911, $objSolicitud, $objVehiculo, $dbAdapter);
                break;
            default :
                return (null === $options) ? new $requestedName : new $requestedName;
        }
        // Instantiate the controller and inject dependencies
        return $controller;
    }

}
