<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inventario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Inventario\Form\SalidasForm;
use Inventario\Model\Entity\Producto;

use Zend\Db\Adapter\AdapterInterface;

class SalidasController extends AbstractActionController {

    private $objSalida;
    private $objProductos;
    private $dbAdapter;
    
    public function __construct($objSalida,$objProductos,$dbAdapter) {
        $this->objSalida = $objSalida;
        $this->objProductos = $objProductos;
        $this->dbAdapter = $dbAdapter;
    }

    public function indexAction() {
         $objSalidas = $this->objSalida->obtenerView(); 
        return [
            'titulo' => 'Todas las Salidas del Inventario',
            'subTitulo' => 'En esta lista se muestran todos las salidas de productos.',
            'salidas' => $objSalidas,
        ];
    }
    
     public function nuevoAction() {
        $objProductos = $this->objSalida->obtenerTodos();
        $form = new SalidasForm($this->dbAdapter);
         if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            var_dump($data);
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();               
                $objEntradas = new Producto();            
                $objEntradas->exchangeArray($form->getData());
                $this->objEntradas->guardar($objEntradas);
                $this->flashMessenger()->addSuccessMessage('Los datos sé han guardado con éxito');
                return $this->redirect()->toRoute('inventario', ['action' => 'producto']);
            }
         }
        return [
            'form'      => $form,
            'titulo'    => 'Nueva Salida de producto al sistema',
            'subTitulo' => 'En esta lista se muestran todos los productos.',
            'solicitud' => $objProductos,
        ];
    }
    
    public function buscarproductoAction() {
        $codigo = $this->params()->fromRoute("codigo", null);
        $carro = $this->objProductos->buscarProductoCodigo($codigo);
        $viewModel = new ViewModel([
            'carro' => $carro,
        ]);
        //$viewModel->setTemplate("pacientes/ingreso/step$step");
        $viewModel->setTerminal(TRUE);
        return $viewModel;
    }

}
