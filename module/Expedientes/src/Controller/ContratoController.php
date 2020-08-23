<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Expedientes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Expedientes\Model\Entity\Contrato;
use Expedientes\Form\ContratoForm;

use DOMPDFModule\View\Model\PdfModel;
use Zend\Db\Adapter\AdapterInterface;

class ContratoController extends AbstractActionController {

    private $objContrato;
    private $objExpediente;
    private $dbAdapter;

    public function __construct($objContrato, $objExpediente, $dbAdapter) {
        $this->objContrato = $objContrato;
        $this->objExpediente = $objExpediente;
        $this->dbAdapter = $dbAdapter;
    }

    public function indexAction() {

        $objContrato = $this->objContrato->obtenerView();      
        return [
            'titulo' => 'Contratos de los Expedientes....',
            'subTitulo' => 'Contrato para el representante legal',
            'objContrato' => $objContrato,
        ];
    }
    
    public function nuevoAction() { 
        $id = $this->params()->fromRoute("id", null);
        $objExpedientes = $this->objExpediente->obtenerExpediente($id);
        $form = new ContratoForm();
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            $form->setData($data);
            // Validate form
            if ($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                $contrato = new Contrato();
                $contrato->exchangeArray($form->getData());
                $this->objContrato->guardar($contrato);
                $this->flashMessenger()->addSuccessMessage('Los datos sé han guardado con éxito');
                return $this->redirect()->toRoute('expedientes');
            }
        }
        return [
            'titulo' => 'Consentimiento Informado de Renovacion....',
            'subTitulo' => 'Contrato para el representante legal',
            'objExpedientes' => $objExpedientes,
            'form' => $form,
        ];
    }
    
    public function reporteAction(){
        $id = $this->params()->fromRoute("id", null);
        $contrato = $this->objContrato->buscarContrato($id);
//        var_dump($contrato);
               
        $pdf = new PdfModel();
        $pdf->setOption('filename', 'contrato');
        $pdf->setOption("paperSize", "Letter"); //Defaults to 8x11
        $pdf->setOption('paperOrientation', 'portrait'); // Defaults to "portrait"

        $pdf->setVariables([
            'numeroExpediente'  => $contrato[0]['numeroExpediente'],
            'tiempo'            => $contrato[0]['tiempo'],
            'costoTratamiento'  => $contrato[0]['costoTratamiento'],
            'pagoIngreso'       => $contrato[0]['pagoIngreso'],
            'nombre'            => $contrato[0]['nombre'],
            'nombreFam'         => $contrato[0]['nombreFam'],
            'cantidadPago'      => $contrato[0]['cantidadPago'],
            'plazo'             => $contrato[0]['plazo'],
            'sexo'              => $contrato[0]['sexo'],
            'edad'              => $contrato[0]['edad'],
          
        ]);

        return $pdf;
       
    }

}
