<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inventario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        return new ViewModel();
    }

    public function listarAction() {
        return [
        "productos" => [
            "Television",
            "NoteBook",
            "Clular",
            "Touch lcd"
            ],
            "titulo"=> "Action Listar"
        ];
       
    }

    public function verAction() {
        $adminTemp = $this->layout();
        $adminTemp->var ="Datos de el metodo Ver Action";
        $adminTemp->setTemplate("layout/admin");
        return new ViewModel();
    }

}
