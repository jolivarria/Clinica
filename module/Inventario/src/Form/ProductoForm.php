<?php

namespace Inventario\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

//use Application\Validator\PhoneValidator;

/**
 * This form is used to collect user registration data. This form is multi-step.
 * It determines which fields to create based on the $step argument you pass to
 * its constructor.
 */
class ProductoForm extends Form {

    /**
     * Constructor.
     */
    public function __construct() {
        // Check input.
        // Define form name
        parent::__construct('producto-form');

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


        $this->add([
            'type' => 'hidden',
            'name' => 'idproductos',
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'codigo',
            'attributes' => [
                'id' => 'codigo',
                'maxlength' => '10',
                'required' => true,
            ],
            'options' => [
                'label' => 'Código:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        $this->add([
            'type' => 'text',
            'name' => 'nombre',
            'attributes' => [
                'id' => 'nombre',
                'maxlength' => '10',
                'required' => true,
            ],
            'options' => [
                'label' => 'Nombre:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'unidadMedida',
            'options' => array(
                'label' => 'Unidad de Medida:',
                'empty_option' => 'Seleccione una unidad de medida',
                'required' => true,
                'value_options' => [
                    'Kilo' => 'Kilo',
                    'Pieza' => 'Pieza',
                    'Paquete' => 'Paquete',
                    'Cuveta' => 'Cuventa',
                    'Litro' => 'Litro',
                    'Caja' => 'Caja'
                ],
                'label_attributes' => array('class' => 'control-label')
            )
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'precio',
            'class' => '',
            'attributes' => [
                'id' => 'precio',
                'required' => true,
            ],
            'options' => [
                'label' => 'Precio:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);


        $this->add([
            'type' => 'text',
            'name' => 'descripcion',
            'class' => 'control-label',
            'attributes' => [
                'id' => 'descripcion',
            ],
            'options' => [
                'label' => 'Descripcion:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);

        // Add the submit button
        $this->add([
            'type' => 'submit',
            'name' => 'submit',
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
