<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Expedientes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Expedientes\Form\IngresoForm;

class IngresoController extends AbstractActionController {

    private $sessionContainer;

    public function __construct($sessionContainer) {
        $this->sessionContainer = $sessionContainer;

    }

    public function indexAction() {
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

        $form = new IngresoForm($step);
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
            'titulo' => 'Ingreso del paciente al sistema',
            'subTitulo' => 'Llenar los campos correctamente para ingresar al paciente',
        ]);
        $viewModel->setTemplate("expedientes/ingreso/step$step");

        return $viewModel;
    }

    public function solicitudAction() {
        return [
            'titulo' => 'Solicitud de ingreso del paciente al sistema',
            'subTitulo' => 'En esta lista se muestran todos los expedientes del sistema',
        ];
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
