<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacientes;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Pacientes\Model\Entity\SolicitudIngreso;
use Pacientes\Model\Dao\ISolicitudIngresoDao;
use Pacientes\Model\Dao\SolicitudIngresoDao;
use Pacientes\Model\Entity\Ingreso;
use Pacientes\Model\Dao\IIngresoDao;
use Pacientes\Model\Dao\IngresoDao;

class Module {

    const VERSION = '3.0.3-dev';

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig() {
        return[
            'factories' => [
                'SolicitudTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new SolicitudIngreso());
                    return new TableGateway('solicitudingreso', $dbAdapter, null, $resultSetPrototype);
                },
                ISolicitudIngresoDao::class => function ($sm) {
                    $tableGateway = $sm->get('SolicitudTableGateway');
                    $dao = new SolicitudIngresoDao($tableGateway);
                    return $dao;
                },
                'IngresoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Ingreso());
                    return new TableGateway('ingreso', $dbAdapter, null, $resultSetPrototype);
                },
                IIngresoDao::class => function ($sm) {
                    $tableGateway = $sm->get('IngresoTableGateway');
                    $dao = new SolicitudIngresoDao($tableGateway);
                    return $dao;
                }, 
            ],
        ];
    }

}
