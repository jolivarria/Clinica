<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Expedientes;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Expedientes\Model\Entity\Expedientes;
use Expedientes\Model\Dao\IExpedientesDao;
use Expedientes\Model\Dao\ExpedientesDao;

use Expedientes\Model\Entity\Contrato;
use Expedientes\Model\Dao\IContratoDao;
use Expedientes\Model\Dao\ContratoDao;

class Module {

    const VERSION = '3.0.3-dev';

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig() {
        return[
            'factories' => [
                'ExpedientesTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Expedientes());
                    return new TableGateway('expedientes', $dbAdapter, null, $resultSetPrototype);
                },
                IExpedientesDao::class => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $tableGateway = $sm->get('ExpedientesTableGateway');
                    $dao = new ExpedientesDao($tableGateway, $dbAdapter);
                    return $dao;
                },
                'ContratoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Contrato());
                    return new TableGateway('contrato', $dbAdapter, null, $resultSetPrototype);
                },
                IContratoDao::class => function ($sm) {
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $tableGateway = $sm->get('ContratoTableGateway');
                    $dao = new ContratoDao($tableGateway, $dbAdapter);
                    return $dao;
                },
            ],
        ];
    }

}
