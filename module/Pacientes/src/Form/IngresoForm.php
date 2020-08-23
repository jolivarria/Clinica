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
class IngresoForm extends Form {

    private $dbAdapter;

    /**
     * Constructor.
     */
    public function __construct(Adapter $dbAdapter) {
        parent::__construct('ingreso-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
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
            'name' => 'idingreso',
        ]);

         // Add "Concecuencia del consumo del paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'tienesFecha',
            'attributes' => [
                'id' => 'tienesFecha'
            ],
            'options' => [
                'label' => 'Tienes fecha de ingreso.',
                'value_options' => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ],
        ]);
        
        // Add "fechaNac" field.
        $this->add([
            'type' => 'text',
            'name' => 'fecha',
            'attributes' => [
                'id' => 'mask-date',
            ],
            'options' => [
                'label' => 'Fecha Ingreso:',
                'for'   => 'fec',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        
        // Add "RFC" field.
        $this->add([
            'type' => 'text',
            'name' => 'rfc',
            'attributes' => [
                'id' => 'rfc',
            ],
            'options' => [
                'label' => 'RFC:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add validation rules for the "file" field.
        $this->add([
            'type' => 'file',
            'name' => 'foto',
            'options' => [
                'label' => 'Foto:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "nombrePaciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'nombre',
            'attributes' => [
                'id' => 'nombre'
            ],
            'options' => [
                'label' => 'Nombre paciente:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "sexo paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'sexo',
            'attributes' => [
                'id' => 'sexo'
            ],
            'options' => [
                'label' => 'Sexo:',
                'value_options' => [
                    'Masculino' => 'Masculino',
                    'Femenino' => 'Femenino',
                ],
            ],
        ]);
        // Add "fechaNac" field.
        $this->add([
            'type' => 'text',
            'name' => 'fechaNac',
            'attributes' => [
                'id' => 'mask-date'
            ],
            'options' => [
                'label' => 'Fecha Nacimiento:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "Edad paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'edad',
            'attributes' => [
                'id' => 'edad'
            ],
            'options' => [
                'label' => 'Edad:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);

        // Add "Escolaridad paciente" field.
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'escolaridad',
            'options' => array(
                'label' => 'Escolaridad:',
                'empty_option' => '',
                'required' => true,
                'value_options' => [
                    'Preescolar' => 'Preescolar',
                    'Primaria' => 'Primaria',
                    'Secundaria' => 'Secundaria',
                    'Preparatoria' => 'Preparatoria',
                    'Técnico superior' => 'Técnico superior',
                    'Licenciatura' => 'Licenciatura',
                    'Ingenieria' => 'Ingenieria',
                    'Maestria' => 'Maestria',
                    'Doctorado' => 'Doctorado',
                ],
                'label_attributes' => array('class' => 'control-label')
            )
        ]);
        // Add "Ocupacion del paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'ocupacion',
            'attributes' => [
                'id' => 'ocupacion'
            ],
            'options' => [
                'label' => 'Ocupación:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "Estado Civil paciente" field.
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'estadoCivil',
            'options' => array(
                'label' => 'Estado Civil:',
                'empty_option' => '',
                'value_options' => [
                    'Soltero/a' => 'Soltero/a',
                    'Comprometido/a' => 'Comprometido/a',
                    'En Relación (más de 1 Año de noviazgo)' => 'En Relación (más de 1 Año)',
                    'Casado/a' => 'Casado/a',
                    'Unión libre o unión de hecho' => 'Unión libre',
                    'Separado/a' => 'Separado/a',
                    'Divorciado/a' => 'Divorciado/a',
                    'Viudo/a' => 'Viudo/a',
                    ' Noviazgo(período inferior a 1 año de relación amorosa)' => 'En Relación (menos de 1 Año)',
                ],
                'label_attributes' => array('class' => 'control-label')
            )
        ]);

        // Add "telefono de casa del usuario campo opcional" field
        $this->add([
            'type' => 'text',
            'name' => 'telefonoPp',
            'class' => 'span8 mask text',
            'attributes' => [
                'id' => 'mask-phone',
            ],
            'options' => [
                'label' => 'Télefono:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);

        // Add "telefono de trabajo del usuario campo opcional" field
        $this->add([
            'type' => 'text',
            'name' => 'telefonoPt',
            'class' => 'span8 mask text',
            'attributes' => [
                'id' => 'mask-phonePart',
            ],
            'options' => [
                'label' => 'Télefono de trabajo:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);

        // Add "telefono celular del usuario campo opcional" field
        $this->add([
            'type' => 'text',
            'name' => 'celular',
            'class' => 'span8 mask text',
            'attributes' => [
                'id' => 'mask-phoneTrab',
            ],
            'options' => [
                'label' => 'Celular:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);

        // Add "Municipio del paciente" field.
        // Add "Nacionalidad del paciente" field.
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'municipio',
            'options' => array(
                'label' => 'Municipio',
                'required' => true,
                'empty_option' => '',
                'value_options' => $this->getMunicipios(),
                'label_attributes' => array('class' => 'control-label')
            )
        ]);
        // Add "Nacionalidad del paciente" field.
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'nacionalidad',
            'options' => array(
                'label' => 'Nacionalidad',
                'required' => true,
                'empty_option' => '',
                'value_options' => $this->getNacionalidad(),
                'label_attributes' => array('class' => 'control-label')
            )
        ]);
        // Add "parentesco" field
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'servicioMedico',
            'attributes' => [
                'id' => 'servicioMedico',
            ],
            'options' => array(
                'label' => 'Servicio médico:',
                'empty_option' => 'Servicio Medico',
                'value_options' => array(
                    'Si' => 'Si',
                    'No' => 'No',
                ),
                'label_attributes' => array('class' => 'control-label')
            )
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'numeroServicio',
            'attributes' => [
                'id' => 'numeroServicio'
            ],
            'options' => [
                'label' => 'Numero Servicio',
                'label_attributes' => array('class' => 'control-label',
                    'id' => 'labNumServicio')
            ],
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'email',
            'attributes' => [
                'id' => 'email'
            ],
            'options' => [
                'label' => 'Correo',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);

        // Add "Ingreso paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'tipo',
            'attributes' => [
                'id' => 'tipo'
            ],
            'options' => [
                'label' => 'Tipo de ingreso:',
                'value_options' => [
                    'Voluntario' => 'Voluntario',
                    'Involuntario' => 'Involuntario',
                    'Obligatorio' => 'Obligatorio',
                ],
            ],
        ]);

        // Add "referencia del paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'referencia',
            'attributes' => [
                'id' => 'referencia'
            ],
            'options' => [
                'label' => 'Referencia del Paciente:',
                'value_options' => [
                    'Domicilio Particular' => 'Domicilio Particular',
                    'Institución Pública' => 'Institución Pública',
                    'Institución Privada' => 'Institución Privada',
                    'Hospital Psiquiatrico' => 'Hospital Psiquiatrico',
                    'Centro de Redaptación Social' => 'Centro de Redaptación Social',
                    'Otro' => 'Otro',
                ],
            ],
        ]);

        //Add otra referencia del usuario
        $this->add([
            'type' => 'text',
            'name' => 'otro',
            'attributes' => [
                'id' => 'otro'
            ],
            'options' => [
                'label' => 'Otra:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);

        // Add "referencia del paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'acude',
            'attributes' => [
                'id' => 'acude'
            ],
            'options' => [
                'label' => 'Acude:',
                'value_options' => [
                    'Solo' => 'Solo',
                    'Amigo' => 'Amigo',
                    'Vecino' => 'Vecino',
                    'Familiar' => 'Familiar',
                    'Parentesco' => 'Parentesco',
                ],
            ],
        ]);

        //Add parentesco del usuario
        $this->add([
            'type' => 'text',
            'name' => 'parentesco',
            'attributes' => [
                'id' => 'parentesco'
            ],
            'options' => [
                'label' => 'Parentesco:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);

        // Add "referencia del paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'adulo',
            'attributes' => [
                'id' => 'adulo'
            ],
            'options' => [
                'label' => 'El usuario es mayor de edad:',
                'value_options' => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ],
        ]);

        // Add "referencia del paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'drogasAlcohol',
            'attributes' => [
                'id' => 'drogasAlcohol'
            ],
            'options' => [
                'label' => 'Presenta un nivel de dependencia al alcohol o drogas',
                'value_options' => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ],
        ]);

        // Add "Concecuencia del consumo del paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'consecunciaConsumo',
            'attributes' => [
                'id' => 'consecunciaConsumo'
            ],
            'options' => [
                'label' => 'Consecuencia asociada al consumo',
                'value_options' => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ],
        ]);

        // Add "Concecuencia del consumo del paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'mental',
            'attributes' => [
                'id' => 'mental'
            ],
            'options' => [
                'label' => 'Mental o psiquiátrico que le impida beneficiarse del tratamiento:',
                'value_options' => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ],
        ]);

        // Add "criteriosAdmision  del paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'criteriosAdmision',
            'attributes' => [
                'id' => 'criteriosAdmision'
            ],
            'options' => [
                'label' => 'El usuario cumple con todos los criterios de admisión al tratamiento:',
                'value_options' => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ],
        ]);

        // Add "numero del paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'numero',
            'attributes' => [
                'id' => 'numero'
            ],
            'options' => [
                'label' => 'Numero',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        
        // Add "colonia del paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'nombreFam',
            'attributes' => [
                'id' => 'nombreFam'
            ],
            'options' => [
                'label' => 'Nombre Familiar:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "colonia del paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'domicilioFam',
            'attributes' => [
                'id' => 'domicilioFam'
            ],
            'options' => [
                'label' => 'Domicilio:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "colonia del paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'numeroFam',
            'attributes' => [
                'id' => 'numeroFam'
            ],
            'options' => [
                'label' => 'N° Casa:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "colonia del paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'coloniaFam',
            'attributes' => [
                'id' => 'coloniaFam'
            ],
            'options' => [
                'label' => 'Colonia:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "telefono de trabajo del usuario campo opcional" field
        $this->add([
            'type' => 'text',
            'name' => 'telefonoParticularFam',
            'class' => 'span8 mask text',
            'attributes' => [
                'id' => 'mask-phonePartFam',
            ],
            'options' => [
                'label' => 'Télefono particular:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "telefono de trabajo del usuario campo opcional" field
        $this->add([
            'type' => 'text',
            'name' => 'celularFam',
            'class' => 'span8 mask text',
            'attributes' => [
                'id' => 'mask-phoneCelFam',
            ],
            'options' => [
                'label' => 'Celular:',
                'label_attributes' => ['class' => 'control-label']
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
