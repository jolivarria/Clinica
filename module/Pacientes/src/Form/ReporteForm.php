<?php

namespace Pacientes\Form;

use Zend\Form\Form;
use Zend\Form\Element;

use Zend\InputFilter\InputFilter;
use Application\Validator\PhoneValidator;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAbstractServiceFactory;

//use Application\Validator\PhoneValidator;

/**
 * This form is used to collect user registration data. This form is multi-step.
 * It determines which fields to create based on the $step argument you pass to
 * its constructor.
 */
class ReporteForm extends Form {

    private $dbAdapter;

    /**
     * Constructor.
     */
    public function __construct(Adapter $dbAdapter) {
        parent::__construct('vehiculo-form');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', '');
        $this->setAttribute('id', 'form-reporte');
        $this->dbAdapter = $dbAdapter;
        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() {
        // Add "idEmpleado" field.
        $this->add([
            'type' => 'text',
            'name' => 'idReporte911',
        ]);
        // Add "idEmpleado" field.
        $this->add([
            'type' => 'hidden',
            'name' => 'solicitudIngreso_idSolicitud',
        ]);
        $this->add([
            'type' => 'hidden',
            'name' => 'vehiculos_idvehiculos',
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'vehiculos_idvehiculos',
           'options' => array(
                'label' => 'vehiculo',
                'required' => true,
                'empty_option' => 'Seleccione Vehiculo',
                'value_options' => $this->getVehiculo(),
                'label_attributes' => array('class' => 'control-label')
            )

        ]);


        // Add "Operadora del Vehiculo" field.
        $this->add([
            'type' => 'text',
            'name' => 'operadora',
            'attributes' => [
                'id' => 'operadora'
            ],
            'options' => [
                'label' => 'Operadora:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);

        // Add "Modelo del Folio" field.
        $this->add([
            'type' => 'text',
            'name' => 'folio',
            'attributes' => [
                'id' => 'folio'
            ],
            'options' => [
                'label' => 'Folio:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "Placas del Vehiculo" field.
        $this->add([
            'type' => 'text',
            'name' => 'observaciones',
            'attributes' => [
                'id' => 'observaciones'
            ],
            'options' => [
                'label' => 'Observaciones:',
                'label_attributes' => array('class' => 'control-label')
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
        $inputFilter->add([
            'name' => 'operadora',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'La entrada no se puede dejar en blanco',
                        ],
                    ],
                ],
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 10,
                        'max' => 50,
                        'messages' => [
                            \Zend\Validator\StringLength::INVALID => 'La entrada no es valida',
                            \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 10, caracteres como mínimo',
                            \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 50, caracteres como máximo',
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function getVehiculo() {
        $sql = 'SELECT idvehiculos,marca,modelo,placas,descripcion FROM vehiculos ORDER BY idvehiculos ASC';
        $statement = $this->dbAdapter->query($sql);
        $result = $statement->execute();

        $selectData = [];

        foreach ($result as $res) {
            $selectData [$res['idvehiculos']] = $res['descripcion'];
        }
        return $selectData;
    }

}
