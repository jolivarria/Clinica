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
class EntradasForm extends Form {

    
    private $dbAdapter;
    /**
     * Constructor.
     */
    public function __construct(Adapter $dbAdapter) {
        // Check input.
        // Define form name
        parent::__construct('entrada-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('id', 'form-wizard');
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
            'name' => 'identradas',
        ]);
        $this->add([
            'type' => 'hidden',
            'name' => 'productos_idproductos',
        ]);
        
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'productos_idproductos',
           'options' => array(
                'label' => 'Código',
                'required' => true,
                'empty_option' => 'Seleccione Producto',
                'value_options' => $this->getProducto(),
                'label_attributes' => array('class' => 'control-label')
            )

        ]);
        
        $this->add([
            'type' => 'number',
            'name' => 'cantidad',
            'attributes' => [
                'id' => 'cantidad',
                'maxlength' => '2',
                'required' => true,
            ],
            'options' => [
                'label' => 'Cantidad:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'precio',
            'attributes' => [
                'id' => 'Precio',
                'maxlength' => '4',
                'required' => true,
            ],
            'options' => [
                'label' => 'Precio:',
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
    
    public function getProducto() {
        $sql = 'SELECT idproductos,codigo,nombre,nombre,precio,descripcion FROM productos ORDER BY idproductos ASC';
        $statement = $this->dbAdapter->query($sql);
        $result = $statement->execute();

        $selectData = [];

        foreach ($result as $res) {
            $selectData [$res['idproductos']] = $res['codigo'];
        }
        return $selectData;
    }

}
