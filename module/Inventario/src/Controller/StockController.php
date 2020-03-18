<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inventario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class StockController extends AbstractActionController {

    private $objStock;


    public function __construct($objStock) {
        $this->objStock = $objStock;
        
    }
    public function indexAction() {
         $stock = $this->objStock->obtenerView();        
         
        return [
            'titulo' => 'Inventario ver existencias de almacen',
            'subTitulo' => 'Se mustra todas las existencia de los productos.',
            'stock' => $stock,
        ];
       
    }   
}
