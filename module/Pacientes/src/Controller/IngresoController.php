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
use Pacientes\Form\IngresoForm;
use Pacientes\Model\Entity\Ingreso;
use Zend\Db\Adapter\AdapterInterface;

class IngresoController extends AbstractActionController {

    private $sessionContainer;
    private $objIngreso;
    private $dbAdapter;

    public function __construct($sessionContainer, $objIngreso, $dbAdapter) {
        $this->sessionContainer = $sessionContainer;
        $this->objIngreso = $objIngreso;
        $this->dbAdapter = $dbAdapter;
    }

    public function indexAction() {
        $objIngreso = $this->objIngreso->obtenerView();
        return [
            'titulo' => 'Ingreso del paciente al sistema',
            'subTitulo' => 'En esta lista se muestran todos los expedientes del sistema',
            'objIngreso' => $objIngreso,
        ];
    }

    public function nuevoAction() {      
        $form = new IngresoForm($this->dbAdapter);
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();               
                $objIngreso = new Ingreso();
                $objIngreso->exchangeArray($form->getData());
                $this->objIngreso->guardarIngresos($objIngreso);
                $this->flashMessenger()->addSuccessMessage('Los datos sé han guardado con éxito');
                return $this->redirect()->toRoute('pacientes');
            }
        }   

        $viewModel = new ViewModel([
            'form' => $form,
            'titulo' => 'Nuevo Ingreso del Usuario...',
            'subTitulo' => 'Llenar los campos correctamente para nuevo ingresos al sistema',
        ]);
        return $viewModel;
    }

    // This action shows the image upload form. This page allows to upload
    // a single file.
    public function uploadAction() {
        // Create the form model.
        $form = new ImageForm();

        // Check if user has submitted the form.
        if ($this->getRequest()->isPost()) {

            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = array_merge_recursive(
                    $request->getPost()->toArray(), $request->getFiles()->toArray()
            );

            // Pass data to form.
            $form->setData($data);

            // Validate form.
            if ($form->isValid()) {

                // Move uploaded file to its destination directory.
                $data = $form->getData();

                // Redirect the user to "Image Gallery" page.
                return $this->redirect()->toRoute('images');
            }
        }

        // Render the page.
        return new ViewModel([
            'form' => $form
        ]);
    }

    public function ingresoAction() {
        
    }

    public function solicitudAction() {
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

        $form = new SolicitudForm($step);
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
                var_dump($data);
                // Save user choices in session.
                $this->sessionContainer->userChoices["step$step"] = $data;

                // Increase step
                $step ++;
                $this->sessionContainer->step = $step;


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
        $viewModel->setTemplate("pacientes/ingreso/step$step");

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

}
