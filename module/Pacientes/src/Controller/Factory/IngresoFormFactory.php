<?php

namespace Pacientes\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Pacientes\Form\IngresoForm;



/**
 * This is the factory for RegistrationController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class IngresoFormFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
         $data = []; // call repository via $container and fetch your data
         $form = new IngresoForm();
         $form->setCountries($data);
         return $form;
    }

}
