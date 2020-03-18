<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inventario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Inventario\Form\EntradasForm;
use Inventario\Model\Entity\Entradas;
use Zend\Db\Adapter\AdapterInterface;


class EntradasController extends AbstractActionController {

    private $objEntradas;
    private $objProductos;
    private $dbAdapter;

    public function __construct($objEntradas, $objProductos, $dbAdapter) {
        $this->objEntradas = $objEntradas;
        $this->objProductos = $objProductos;
        $this->dbAdapter = $dbAdapter;
    }

    public function indexAction() {
        $objEntradas = $this->objEntradas->obtenerView();        
        return [
            'titulo' => 'Todas las entradas del Inventario',
            'subTitulo' => 'En esta lista se muestran todos los productos.',
            'entradas' => $objEntradas,
        ];
    }

    public function nuevoAction() {
        $objProductos = $this->objEntradas->obtenerTodos();
        $form = new EntradasForm($this->dbAdapter);
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();           
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $objEntradas = new Entradas();
                $objEntradas->exchangeArray($form->getData());
                $this->objEntradas->guardar($objEntradas);              
                $this->flashMessenger()->addSuccessMessage('Los datos sé han guardado con éxito');
                return $this->redirect()->toRoute('inventario-entradas');
            }
        }
        return [
            'form' => $form,
            'titulo' => 'Nueva entrada de producto al sistema',
            'subTitulo' => 'En esta lista se muestran todos los productos.',
            'solicitud' => $objProductos,
        ];
    }

    public function buscarproductoAction() {
        $codigo = $this->params()->fromRoute("codigo", null);
        $producto = $this->objProductos->buscarProductoCodigo($codigo);
        $viewModel = new ViewModel([
            'producto' => $producto,
        ]);
        //$viewModel->setTemplate("pacientes/ingreso/step$step");
        $viewModel->setTerminal(TRUE);
        return $viewModel;
    }

}
