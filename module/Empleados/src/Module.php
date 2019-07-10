<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Empleados;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Empleados\Model\Entity\Empleado;
use Empleados\Model\Dao\IEmpleadoDao;
use Empleados\Model\Dao\EmpleadoDao;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getServiceConfig(){
        return[
            'factories'=>[
                'EmpleadoTableGateway'=> function ($sm){
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Empleado());
                    return new TableGateway('Empleados',$dbAdapter,null,$resultSetPrototype);
                },
                IEmpleadoDao::class => function ($sm){
                    $tableGateway =  $sm->get('EmpleadoTableGateway');
                    $dao = new EmpleadoDao($tableGateway);
                    return $dao;
                },      
            ],
        ];
    }
}
