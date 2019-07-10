<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Expedientes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

 

    public function indexAction() {
        return [
            'titulo' => 'Expedientes del Sistema',
            'subTitulo' => 'En esta lista se muestran todos los expedientes del sistema',
        ];
    }

}
