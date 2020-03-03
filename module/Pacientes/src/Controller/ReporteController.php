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
use Pacientes\Form\ReporteForm;
use Pacientes\Model\Dao\ReporteDao;
use DOMPDFModule\View\Model\PdfModel;
use Zend\Db\Adapter\AdapterInterface;

class ReporteController extends AbstractActionController {

    private $objReporte911;
    private $objSolicitud;
    private $objVehiculo;
    private $dbAdapter;

    public function __construct($objReporte911, $objSolicitud, $objVehiculo, $dbAdapter) {
        $this->objSolicitud = $objSolicitud;
        $this->objReporte911 = $objReporte911;
        $this->objVehiculo = $objVehiculo;
        $this->dbAdapter = $dbAdapter;
    }

    public function indexAction() {
        $reporte911 = $this->objReporte911->obtenerTodos();
        return [
            'titulo' => 'Reporte al 911 de Solicitud del paciente al sistema',
            'subTitulo' => 'En esta lista se muestran todos los expedientes del sistema',
            'solicitud' => $reporte911,
        ];
    }

    public function nuevoAction() {
        // Determine the current step.
        $step = 1;
        if (isset($this->sessionContainer->step)) {
            $step = $this->sessionContainer->step;
        }

        // Ensure the step is correct (between 1 and 3).
        if ($step < 1 || $step > 3)
            $step = 1;

        if ($step == 1) {
            // Init user choices.
            $this->sessionContainer->userChoices = [];
        }

        $form = new SolicitudForm(1);
        // Check if user has submitted the form
        if ($this->request->getPost("submit")) {

            // Fill in the form with POST data
            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = array_merge_recursive(
                    $request->getPost()->toArray(), $request->getFiles()->toArray()
            );


            //$data = $this->params()->fromPost();

            $form->setData($data);
            // Validate form
            if ($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                // Save user choices in session.
                $this->sessionContainer->userChoices["step$step"] = $data;


                $this->sessionContainer->step = $step;

                $objSolicitud = new SolicitudIngreso();
                $objSolicitud->exchangeArray($form->getData());
                $this->objSolicitud->guardar($objSolicitud);
                $this->flashMessenger()->addSuccessMessage('Los datos sé han guardado con éxito');
                return $this->redirect()->toRoute('pacientes', ['action' => 'solicitud']);

                // If we completed all 3 steps, redirect to Review page.
                if ($step > 3) {

                    return $this->redirect()->toRoute('empleados', ['action' => 'review']);
                }

                // Go to the next step.
                return $this->redirect()->toRoute('empleados', ['action' => 'nuevo']);
            }
        }

        $viewModel = new ViewModel([
            'form' => $form,
            'step' => $step,
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
        $viewModel = new ViewModel([
            'paciente' => $solicitud,
        ]);
        //$viewModel->setTemplate("pacientes/ingreso/step$step");
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

    public function reporteAction() {
        $id = $this->params()->fromRoute("id", null);
        $obj = $this->objSolicitud->obtnerID($id);
       
        $form = new ReporteForm($this->dbAdapter);
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            $form->setData($data);
            //Validate form     
            if ($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                $objRepoerte = new \Pacientes\Model\Entity\Reporte;
                $objRepoerte->exchangeArray($form->getData());
                $this->objReporte911->guardar($objRepoerte);
                
                $this->flashMessenger()->addSuccessMessage('Los datos sé han guardado con éxito');
                return $this->redirect()->toRoute('pacientes', ['action'
                            => 'solicitud']);               
            }
        }

//            // Go to the next step.
//            return $this->redirect()->toRoute('empleados', [ 'action' => 'nuevo']);
//        }
//        
        $viewModel = new ViewModel([
            'titulo' => 'Reporte al 911 de Solicitud del paciente al sistema',
            'subTitulo' => 'Esta pantalla realizamos el reporte ante el 911 para garantizar la seguridad del usuario',
            'paciente' => $obj,
            'form' => $form,
        ]);
        return $viewModel;
    }

    public function obtenercarroAction() {
        $idCarro = $this->params()->fromRoute("id", null);
        $carro = $this->objVehiculo->obtnerID($idCarro);
        $viewModel = new ViewModel([
            'carro' => $carro,
        ]);
        //$viewModel->setTemplate("pacientes/ingreso/step$step");
        $viewModel->setTerminal(TRUE);
        return $viewModel;
    }

    public function vehiculosAction() {
        
    }

    public function detallerptAction() {
        $id = $this->params()->fromRoute("id", null);
        $objReporte = $this->objReporte911->obtnerIdSolicitud($id);
        $objSolicitud = $this->objSolicitud->obtnerID($id);
        $pdf = new PdfModel();
        $pdf->setOption('filename', 'reporte-datalle');
        $pdf->setOption("paperSize", "a4"); //Defaults to 8x11
        $pdf->setOption('paperOrientation', 'portrait'); // Defaults to "portrait"

        $pdf->setVariables([
            'rfc' => $objSolicitud->getRFC(),
            'paciente' => $objSolicitud->getNombrePaciente(),
            'edad' => $objSolicitud->getEdad(),
            'responsable' => $objSolicitud->getNombreFamiliar(),
            'domicilio' => $objSolicitud->getDomicilio(),
            'colonia' => $objSolicitud->getColonia(),
            'folio' => $objReporte->getFolio(),
            'operadora' => $objReporte->getOperadora(),
            'fecha' => $objSolicitud->getFechaSolicitud(),
            'domicilio' => $objSolicitud->getDomicilio(),
            'colonia' => $objSolicitud->getColonia(),
            'folio' => $objReporte->getFolio(),
            'fecha' => $objReporte->getFechaReporte(),
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
