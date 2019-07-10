<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Empleados\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Empleados\Form\EmpleadoForm;
use Empleados\Form\ImageForm;
use Empleados\Controller\Factory\EmpleadosControllerFactory;
use Zend\Session\Container;
use Empleados\Model\Dao\IEmpleadoDao;

class EmpleadosController extends AbstractActionController {

    /**
     * Session container.
     * @var Zend\Session\Container
     */
    private $sessionContainer;
    private $empleadoDao;

    /**
     * imageManager.
     * Servicio para administrar imagenes
     * en el servidor
     */
    private $imageManager;

    /**
     * Constructor. Its goal is to inject dependencies into controller.
     */
    public function __construct($sessionContainer, $imageManager, $empleadoDao) {
        $this->sessionContainer = $sessionContainer;
        $this->imageManager = $imageManager;
        $this->empleadoDao = $empleadoDao;
        //$this->sessionContainer->id=0;
    }

    /**
     * 
     * @return type
     */
    public function indexAction() {
        // Determine the current step.
        return [
            'titulo' => 'Empleados del Sistema',
            'subTitulo' => 'Muestra todo los usuarios del sistema',
            'empleados' => $this->empleadoDao->obtenerEmpleado(),
        ];
    }

    /**
     * Mètodo que guarda a un empleado
     */
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
//        if() {
//            $step --;
//          
//        }

        $form = new EmpleadoForm($step);
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
        ]);
        $viewModel->setTemplate("empleados/step$step");

        return $viewModel;
    }

    /**
     * The "review" action shows a page allowing to review data entered on previous
     * three steps.
     */
    public function reviewAction() {
        // Validate session data.
        if (!isset($this->sessionContainer->step) ||
                $this->sessionContainer->step <= 3 ||
                !isset($this->sessionContainer->userChoices)) {
            throw new \Exception('Sorry, the data is not available for review yet');
        }

        // Retrieve user choices from session.
        $userChoices = $this->sessionContainer->userChoices;

        return new ViewModel([
            'userChoices' => $userChoices
        ]);
    }

    public function viewAction() {

        return new ViewModel([
//            'userChoices' => $userChoices
        ]);
    }

}
