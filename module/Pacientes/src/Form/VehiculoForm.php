<?php

namespace Pacientes\Form;

use Zend\Form\Form;
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
class VehiculoForm extends Form {

    private $dbAdapter;

    /**
     * Constructor.
     */
    public function __construct(Adapter $dbAdapter) {
        parent::__construct('vehiculo-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');
        //$this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('id', 'form-ingreso');
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
            'type' => 'hidden',
            'name' => 'idvehiculos',
        ]);

        // Add "Marca del Vehiculo" field.
        $this->add([
            'type' => 'text',
            'name' => 'marca',
            'attributes' => [
                'id' => 'marca'
            ],
            'options' => [
                'label' => 'Marca:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);

        // Add "Modelo del Vehiculo" field.
        $this->add([
            'type' => 'text',
            'name' => 'modelo',
            'attributes' => [
                'id' => 'modelo'
            ],
            'options' => [
                'label' => 'Modelo:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "Placas del Vehiculo" field.
        $this->add([
            'type' => 'text',
            'name' => 'placas',
            'attributes' => [
                'id' => 'placas'
            ],
            'options' => [
                'label' => 'Modelo:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "Descripcion del Vehiculo" field.
        $this->add([
            'type' => 'text',
            'name' => 'descripcion',
            'attributes' => [
                'id' => 'descripcion'
            ],
            'options' => [
                'label' => 'Descripcion:',
                'label_attributes' => array('class' => 'control-label')
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
            'name' => 'marca',
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

    public function getMunicipios() {
        $sql = 'SELECT idmunicipios,municipio FROM municipios ORDER BY idmunicipios ASC';
        $statement = $this->dbAdapter->query($sql);
        $result = $statement->execute();

        $selectData = [];

        foreach ($result as $res) {
            $selectData [$res['idmunicipios']] = $res['municipio'];
        }

        return $selectData;
    }

    public function getNacionalidad() {
        $sql = 'SELECT idnacionalidad,nacionalidad FROM nacionalidad ORDER BY idnacionalidad ASC';
        $statement = $this->dbAdapter->query($sql);
        $result = $statement->execute();

        $selectData = [];

        foreach ($result as $res) {
            $selectData [$res['nacionalidad']] = $res['nacionalidad'];
        }

        return $selectData;
    }

}
