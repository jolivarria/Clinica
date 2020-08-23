<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacientes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Pacientes\Form\SolicitudForm;
use Pacientes\Model\Entity\SolicitudIngreso;
use DOMPDFModule\View\Model\PdfModel;

class SolicitudController extends AbstractActionController {

    private $sessionContainer;
    private $objSolicitud;
    private $objIngreso;

    public function __construct($sessionContainer, $objSolicitud,$objIngreso) {
        $this->sessionContainer = $sessionContainer;
        $this->objSolicitud = $objSolicitud;
        $this->objIngreso = $objIngreso;
        
    }

    public function indexAction() {
        $solicitud = $this->objSolicitud->obtenerTodos();
        return [
            'titulo' => 'Solicitud de ingreso del paciente al sistema',
            'subTitulo' => 'En esta lista se muestran todos los expedientes del sistema',
            'solicitud' => $solicitud,
        ];
    }

    public function nuevoAction() {
        $form = new SolicitudForm(1);
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            $form->setData($data);
            // Validate form
            if ($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();             
                $objSolicitud = new SolicitudIngreso();
                $objSolicitud->exchangeArray($form->getData());
                $this->objSolicitud->guardar($objSolicitud);
                $this->flashMessenger()->addSuccessMessage('Los datos sé han guardado con éxito');
                return $this->redirect()->toRoute('pacientes', ['action' => 'solicitud']);
            }
        }

        $viewModel = new ViewModel([
            'form' => $form,
            'step' => 1,
            'titulo' => 'Solicitud de ingreso del paciente al sistema',
            'subTitulo' => 'Llenar los campos correctamente para la solicitud del ingreso',
        ]);
        $viewModel->setTemplate("pacientes/solicitud/nuevo");

        return $viewModel;
    }

    public function modificarAction() {
        $step = 1;
        $id = $this->params()->fromRoute("id", null);
        $solicitud = $this->objSolicitud->obtnerID($id);
        $form = new SolicitudForm($step);
        $form->bind($solicitud);
        $viewModel = new ViewModel([
            'form' => $form,
            'step' => $step,
            'titulo' => 'Editar solicitud del paciente al sistema',
            'subTitulo' => 'Llenar los campos correctamente para la solicitud del ingreso',
        ]);

        return $viewModel;
    }

    public function borrarAction() {
        return [
            'titulo' => 'Ingreso al sistema del Sistema',
            'subTitulo' => 'En esta lista se muestran todos los expedientes del sistema',
        ];
    }

    public function editarAction() {
        return [
            'titulo' => 'Editar ingreso del paciente al sistema',
            'subTitulo' => 'En esta lista se muestran todos los expedientes del sistema',
        ];
    }

    public function buscarfcAction() {
        $rfc = $this->params()->fromRoute("rfc", null);
        $solicitud = $this->objSolicitud->buscarRFC($rfc);
        $ingreso = $this->objIngreso->buscarRFC($rfc); 
//        var_dump($solicitud);
//        var_dump($ingreso);
        $viewModel = new ViewModel([
            'paciente' => $solicitud,
            'ingreso' => $ingreso,
        ]);
       
        $viewModel->setTerminal(TRUE);
        return $viewModel;
    }

    public function detalleAction() {

        $id = $this->params()->fromRoute("id", null);
        $obj = $this->objSolicitud->obtnerID($id);

        $rfc = $this->params()->fromRoute("rfc", null);
        $solicitud = $this->objSolicitud->obtenerDetalle($rfc);
        $countSolicitud = $this->objSolicitud->obtenerDetalleConunt($rfc);
        $viewModel = new ViewModel([
            'paciente' => $obj,
            'solicitud' => $solicitud,
            'countSolicitud' => $countSolicitud,
        ]);
        return $viewModel;
    }

    public function detallerptAction() {
        $id = $this->params()->fromRoute("id", null);
        $obj = $this->objSolicitud->obtnerID($id);

        $pdf = new PdfModel();
        $pdf->setOption('filename', 'reporte-datalle');
        $pdf->setOption("paperSize", "a4"); //Defaults to 8x11
        $pdf->setOption('paperOrientation', 'portrait'); // Defaults to "portrait"

        $pdf->setVariables([
            'rfc' => $obj->getRFC(),
            'paciente' => $obj->getNombrePaciente(),
            'folio' => $obj->getFolio(),
            'operadora' => $obj->getOperadora(),
            'fecha' => $obj->getFechaSolicitud(),
            'domicilio' => $obj->getDomicilio(),
            'colonia' => $obj->getColonia(),
        ]);

        return $pdf;
    }

//    public function pdfAction() {
//        $pdfCreator = $serviceManager->get('PdfCreator');
//        $pdfCreator->setLayoutTemplate('layout/pdf')
//                ->createHtml('view', ['variable1' => $variable1Value])
//                ->setPdfFileName('./../file.pdf')
//                ->setHasXvfb(false)
//                ->output();
//    }
}
