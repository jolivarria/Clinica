<?php

namespace Expedientes\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

//use Application\Validator\PhoneValidator;

/**
 * This form is used to collect user registration data. This form is multi-step.
 * It determines which fields to create based on the $step argument you pass to
 * its constructor.
 */
class ContratoForm extends Form {

    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct('contrato-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('id', 'form-wizard');
        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() {

        // Add "idEmpleado" field.
        $this->add([
            'type' => 'hidden',
            'name' => 'idcontrato',
        ]);
        // Add "idEmpleado" field.
        $this->add([
            'type' => 'hidden',
            'name' => 'idexpedientes',
        ]);

        // Add "idEmpleado" field.
        $this->add([
            'type' => 'hidden',
            'name' => 'idpaciente',
        ]);

         // Add "Tiempo de estancia del paciente" field.
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'tiempo',
            'attributes' => [
                'id' => 'tiempo',
            ],
            'options' => array(
                'label' => 'Tiempo',
                'empty_option' => '',                
                'required' => true,
                'value_options' => [
                    '3 Meses' => '3 Meses',
                    '6 Meses' => '6 Meses',
                    '12 Meses' => '12 Meses',
                ],
                'label_attributes' => array('class' => 'control-label')
            )
        ]);
        
        //Add "costo" field
        $this->add([
            'type' => 'number',
            'name' => 'costoTratamiento',
            'class' => 'span8 mask text',
            'attributes' => [
                'min' => '0',
                'step' => '0.01',
                'required' => true,
                'data-number-to-fixed' => "2",
                'data-number-stepfactor' => "100",
                'id' => 'costoTratamiento',
            ],
            'options' => [
                'label' => 'Costo:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        
        //Add "costo" field
        $this->add([
            'type' => 'number',
            'name' => 'pagoIngreso',
            'class' => 'span8 mask text',
            'attributes' => [
                'min' => '0',
                'step' => '0.01',
                'required' => true,
                'data-number-to-fixed' => "2",
                'data-number-stepfactor' => "100",
                'id' => 'pagoIngreso',
            ],
            'options' => [
                'label' => 'Pago de Ingreso:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);

        // Add "plazo" field
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'plazo',
            'attributes' => [
                'id' => 'plazo',
            ],
            'options' => array(
                'label' => 'Plazo',
                'empty_option' => '',
                'required' => true,
                'value_options' => [
                    'Semanal' => 'Semanal',
                    'Quincenal' => 'Quincenal',
                    'Mensual' => 'Mensual',
                    
                ],
                'label_attributes' => array('class' => 'control-label')
            )
        ]);
        
         //Add "costo" field
        $this->add([
            'type' => 'number',
            'name' => 'cantidadPago',
            'class' => 'span8 mask text',
            'attributes' => [
                'min' => '0',
                'step' => '0.01',
                'required' => true,
                'data-number-to-fixed' => "2",
                'data-number-stepfactor' => "100",
                'id' => 'cantidadPago',
            ],
            'options' => [
                'label' => 'Pagos:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);

        // Add the submit button
        $this->add([
            'type' => 'submit',
            'name' => 'btnGuardar',
            'attributes' => [
                'value' => 'Guardar',
                'id' => 'submitbutton',
            ],
        ]);
    }

    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter() {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);
    }

}
