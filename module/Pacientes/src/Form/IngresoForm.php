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

        // Add "RFC" field.
        $this->add([
            'type' => 'text',
            'name' => 'RFC',
            'attributes' => [
                'id' => 'RFC'
            ],
            'options' => [
                'label' => 'RFC:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add validation rules for the "file" field.
//        $inputFilter->add([
//            'type' => 'Zend\InputFilter\FileInput',
//            'name' => 'file',
//            'required' => true,
//            'validators' => [
//                ['name' => 'fotoPaciente'],
//                [
//                    'name' => 'FileMimeType',
//                    'options' => [
//                        'mimeType' => ['image/jpeg', 'image/png']
//                    ]
//                ],
//                ['name' => 'FileIsImage'],
//                [
//                    'name' => 'FileImageSize',
//                    'options' => [
//                        'minWidth' => 128,
//                        'minHeight' => 128,
//                        'maxWidth' => 4096,
//                        'maxHeight' => 4096
//                    ]
//                ],
//            ],
//            'filters' => [
//                [
//                    'name' => 'FileRenameUpload',
//                    'options' => [
//                        'target' => './data/upload',
//                        'useUploadName' => true,
//                        'useUploadExtension' => true,
//                        'overwrite' => true,
//                        'randomize' => false
//                    ]
//                ]
//            ],
//        ]);
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
                'label' => 'Sexo',
                'required' => true,
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
                'label' => 'Fecha Nacimiento',
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
                'label' => 'Edad',
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
                'label' => 'Ocupación',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "Estado Civil paciente" field.
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'estadoCivil',
            'options' => array(
                'label' => 'Estado Civil',
                'empty_option' => '',
                'required' => true,
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
        // Add "Direccion del paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'direccion',
            'attributes' => [
                'id' => 'direccion'
            ],
            'options' => [
                'label' => 'Dirección',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "Código Postal del paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'codigoPostal',
            'attributes' => [
                'id' => 'codigoPostal'
            ],
            'options' => [
                'label' => 'Código Postal',
                'label_attributes' => array('class' => 'control-label')
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

        // Add "telefono" field
        $this->add([
            'type' => 'text',
            'name' => 'telefonoParticular',
            'class' => 'span5 m-wrap mask text',
            'attributes' => [
                'id' => 'mask-phonePart',
                'required' => true,
            ],
            'options' => [
                'label' => 'Télefono:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "telefono" field
        $this->add([
            'type' => 'text',
            'name' => 'celular',
            'class' => 'span5 m-wrap mask text',
            'attributes' => [
                'id' => 'mask-phone',
                'required' => true,
            ],
            'options' => [
                'label' => 'celular:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "telefono" field
        $this->add([
            'type' => 'text',
            'name' => 'telefonoTrabajo',
            'class' => 'span5 m-wrap mask text',
            'attributes' => [
                'id' => 'mask-phoneTrab',
                'required' => true,
            ],
            'options' => [
                'label' => 'celular:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "parentesco" field
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'servicioMedico',
            'attributes' => [
                'id' => 'servicioMedico',
                'required' => true,
            ],
            'options' => array(
                'label' => 'Servicio Médico:',
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
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);

        $this->add([
            'type' => 'button',
            'name' => 'Voluntario',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Voluntario',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        $this->add([
            'type' => 'button',
            'name' => 'Involuntario',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Involuntario',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "Tipo de Internamiento Obligatorio" field
        $this->add([
            'type' => 'button',
            'name' => 'Obligatorio',
            'attributes' => [
                'value' => 'Obligatorio',
            ],
            'options' => [
                'label' => 'Obligatorio',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "'Domicilio Particular" field
        $this->add([
            'type' => 'button',
            'name' => 'domicilioParticular',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Domicilio Particular',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "institucionPublica" field
        $this->add([
            'type' => 'button',
            'name' => 'institucionPublica',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Institución Pública',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "institucionPrivada" field
        $this->add([
            'type' => 'button',
            'name' => 'institucionPrivada',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Institución Privada',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "hospitalPsiquiatrico" field
        $this->add([
            'type' => 'button',
            'name' => 'hospitalPsiquiatrico',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Hospital Psiquiatrico',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "centroRedaptacion" field
        $this->add([
            'type' => 'button',
            'name' => 'centroRedaptacion',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Centro De Readaptación Social',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "Otros" field
        $this->add([
            'type' => 'button',
            'name' => 'otros',
            'attributes' => [
                'value' => 'otros',
            ],
            'options' => [
                'label' => 'Otros',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "Otros" field
        $this->add([
            'type' => 'text',
            'name' => 'otro',
            'attributes' => [
                'value' => '',
            ],
            'options' => [
                'label' => 'Otro',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "Solo" field
        $this->add([
            'type' => 'button',
            'name' => 'solo',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Solo',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "Amigo" field
        $this->add([
            'type' => 'button',
            'name' => 'amigo',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Amigo',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "Vecino" field
        $this->add([
            'type' => 'button',
            'name' => 'vecino',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Vecino',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        //Add "Familiar" field
        $this->add([
            'type' => 'button',
            'name' => 'familiar',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Familiar',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);
        // Add "dependencia paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'dependencia',
            'attributes' => [
                'id' => 'dependencia'
            ],
            'options' => [
                'label' => 'El usuario presenta un nivel de dependencia al alcohol o drogas',
                'required' => true,
                'value_options' => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ],
        ]);
        // Add "consecuencia paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'consecuencia',
            'attributes' => [
                'id' => 'consecuencia'
            ],
            'options' => [
                'label' => 'El usuario presenta alguna (s) consecuencia asociada al consumo',
                'required' => true,
                'value_options' => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ],
        ]);
        // Add "trastorno paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'trastorno',
            'attributes' => [
                'id' => 'trastorno'
            ],
            'options' => [
                'label' => 'El usuario no presenta algún trastorno mental o psiquiátrico que le impida
beneficiarse del tratamiento',
                'required' => true,
                'value_options' => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ],
        ]);
        // Add "criteriosAdmision paciente" field
        $this->add([
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'criteriosAdmision',
            'attributes' => [
                'id' => 'criteriosAdmision'
            ],
            'options' => [
                'label' => '¿El usuario cumple con todos los criterios de admisión al tratamiento?',
                'required' => true,
                'value_options' => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ],
        ]);
        // Add "nombrePaciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'nombreFamiliar',
            'attributes' => [
                'id' => 'nombreFamiliar'
            ],
            'options' => [
                'label' => 'Nombre Familiar:',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "direccionFamiliar del paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'direccionFamiliar',
            'attributes' => [
                'id' => 'direccionFamiliar'
            ],
            'options' => [
                'label' => 'Dirección',
                'label_attributes' => array('class' => 'control-label')
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
            'name' => 'colonia',
            'attributes' => [
                'id' => 'colonia'
            ],
            'options' => [
                'label' => 'Colonia',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "municipioFamiliar del paciente" field.
        $this->add([
            'type' => 'text',
            'name' => 'municipioFamiliar',
            'attributes' => [
                'id' => 'municipioFamiliar'
            ],
            'options' => [
                'label' => 'Colonia',
                'label_attributes' => array('class' => 'control-label')
            ],
        ]);
        // Add "telefono" field
        $this->add([
            'type' => 'text',
            'name' => 'telefonoParticularF',
            'class' => 'span5 m-wrap mask text',
            'attributes' => [
                'id' => 'mask-phonePart',
                'required' => true,
            ],
            'options' => [
                'label' => 'Télefono:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "telefono" field
        $this->add([
            'type' => 'text',
            'name' => 'celularF',
            'class' => 'span5 m-wrap mask text',
            'attributes' => [
                'id' => 'mask-phone',
                'required' => true,
            ],
            'options' => [
                'label' => 'celular:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "telefono" field
        $this->add([
            'type' => 'text',
            'name' => 'telefonoTrabajoF',
            'class' => 'span5 m-wrap mask text',
            'attributes' => [
                'id' => 'mask-phoneTrab',
                'required' => true,
            ],
            'options' => [
                'label' => 'celular:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);



        // Add "parentesco" field
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'parentesco',
            'options' => array(
                'label' => 'Parentesco:',
                'empty_option' => 'Seleccione parentesco',
                'value_options' => array(
                    '0' => 'Mamá/Papá',
                    '1' => 'Tía/Tío',
                    '2' => 'Abuela/Abuelo',
                    '3' => 'Hermano/Hermana',
                ),
                'label_attributes' => array('class' => 'control-label')
            )
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
            'name' => 'nombrePaciente',
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
