<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inventario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Inventario\Form\ProductoForm;
use Inventario\Model\Entity\Producto;

class EntradasController extends AbstractActionController {

    private $objEntradas;
    
    public function __construct($objEntradas) {
        $this->objEntradas = $objEntradas;
    }

    public function entradasAction() {
         $objEntradas = $this->objEntradas->obtenerTodos();
        return [
            'titulo' => 'Todas las entradas del Inventario',
            'subTitulo' => 'En esta lista se muestran todos los productos.',
            'solicitud' => $objEntradas,
        ];
    }
    
     public function nuevoAction() {
        $objProductos = $this->objProducto->obtenerTodos();
        $form = new ProductoForm();
         if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            var_dump($data);
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();               
                $objProductos = new Producto();            
                $objProductos->exchangeArray($form->getData());
                $this->objProducto->guardar($objProductos);
                $this->flashMessenger()->addSuccessMessage('Los datos sé han guardado con éxito');
                return $this->redirect()->toRoute('inventario', ['action' => 'producto']);
            }
         }
        return [
            'form' => $form,
            'titulo' => 'Productos del Inventario',
            'subTitulo' => 'En esta lista se muestran todos los productos.',
            'solicitud' => $objProductos,
        ];
    }

}
