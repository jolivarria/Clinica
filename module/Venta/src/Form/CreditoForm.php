<?php

namespace Inventario\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAbstractServiceFactory;
//use Application\Validator\PhoneValidator;

/**
 * This form is used to collect user registration data. This form is multi-step.
 * It determines which fields to create based on the $step argument you pass to
 * its constructor.
 */
class CreditoForm extends Form {

    
    private $dbAdapter;
    /**
     * Constructor.
     */
    public function __construct(Adapter $dbAdapter) {
        // Check input.
        // Define form name
        parent::__construct('credito-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('id', 'form-credito');
        $this->dbAdapter = $dbAdapter;
        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() {

        $this->add([
            'type' => 'hidden',
            'name' => 'idcredito',
        ]);
       
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'paciente_idpaciente',
           'options' => array(
                'label' => 'Paciente',
                'required' => true,
                'empty_option' => 'Seleccione Paciente',
                'value_options' => $this->getPaciente(),
                'label_attributes' => array('class' => 'control-label')
            )

        ]);
        
        $this->add([
            'type' => 'number',
            'name' => 'totalCredito',
            'attributes' => [
                'id' => 'totalCredito',
                'maxlength' => '2',
                'required' => true,
            ],
            'options' => [
                'label' => 'Cantidad:',
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
    }
    
    public function getPaciente() {
        $sql = 'SELECT idpaciente,nombre FROM paciente ORDER BY idpaciente ASC';
        $statement = $this->dbAdapter->query($sql);
        $result = $statement->execute();

        $selectData = [];

        foreach ($result as $res) {
            $selectData [$res['idpaciente']] = $res['nombre'];
        }
        return $selectData;
    }

}
