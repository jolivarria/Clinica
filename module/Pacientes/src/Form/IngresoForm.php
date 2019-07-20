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
                'id' => 'fechaNac'
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
                    'En Relación ( más de 1 Año de noviazgo)' => 'En Relación ( más de 1 Año de noviazgo)',
                    'Casado/a' => 'Casado/a',
                    'Unión libre o unión de hecho' => 'Unión libre o unión de hecho',
                    'Separado/a' => 'Separado/a',
                    'Divorciado/a' => 'Divorciado/a',
                    'Viudo/a' => 'Viudo/a',
                    ' Noviazgo(período inferior a 1 año de relación amorosa)' => ' Noviazgo(período inferior a 1 año de relación amorosa)',
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

        // Add "nombrePaciente" field
        //Add "Hombre" field
        $this->add([
            'type' => 'button',
            'name' => 'Hombre',
            'attributes' => [
            ],
            'options' => [
                'label' => 'Hombre',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);

        //Add "Mujer" field
        $this->add([
            'type' => 'button',
            'name' => 'Mujer',
            'attributes' => [
                'value' => 'Hola',
            ],
            'options' => [
                'label' => 'Mujer',
                'label_attributes' => array('class' => 'btn btn-info')
            ],
        ]);

        //Add "Edad" field
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

        //Add "nombreFamiliar" field
        $this->add([
            'type' => 'text',
            'name' => 'nombreFamiliar',
            'attributes' => [
                'id' => 'nombreFamiliar'
            ],
            'options' => [
                'label' => 'Nombre del familiar:',
                'label_attributes' => array('class' => 'control-label')
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
        // Add "telefono" field
        $this->add([
            'type' => 'text',
            'name' => 'telefono',
            'class' => 'span8 mask text',
            'attributes' => [
                'id' => 'mask-phone',
            ],
            'options' => [
                'label' => 'Télefono:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "domicilio" field
        $this->add([
            'type' => 'text',
            'name' => 'domicilio',
            'class' => 'control-label',
            'attributes' => [
                'id' => 'domicilio',
            ],
            'options' => [
                'label' => 'Domicilio:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);

        // Add "motivoAtencion" field
        $this->add([
            'type' => 'text',
            'name' => 'motivoAtencion',
            'attributes' => [
                'id' => 'motivoAtencion'
            ],
            'options' => [
                'label' => 'Motivo de Atencion:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "motivoAtencion" field
        $this->add([
            'type' => 'text',
            'name' => 'motivoAtencion',
            'attributes' => [
                'id' => 'motivoAtencion'
            ],
            'options' => [
                'label' => 'Motivo de Atencion:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "lesiones" field
        $this->add([
            'type' => 'text',
            'name' => 'lesiones',
            'attributes' => [
                'id' => 'lesiones'
            ],
            'options' => [
                'label' => 'Lesiones:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);

        // Add "diacnostico" field
        $this->add([
            'type' => 'text',
            'name' => 'diacnostico',
            'attributes' => [
                'id' => 'diacnostico'
            ],
            'options' => [
                'label' => 'Diacnostico:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);

        // Add "planTerapeutico" field
        $this->add([
            'type' => 'text',
            'name' => 'planTerapeutico',
            'attributes' => [
                'id' => 'planTerapeutico'
            ],
            'options' => [
                'label' => 'Plan Terapeutico:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "pronostico" field
        $this->add([
            'type' => 'text',
            'name' => 'pronostico',
            'attributes' => [
                'id' => 'pronostico'
            ],
            'options' => [
                'label' => 'Pronostico:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);
        // Add "nombreMedico" field
        $this->add([
            'type' => 'text',
            'name' => 'nombreMedico',
            'attributes' => [
                'id' => 'nombreMedico'
            ],
            'options' => [
                'label' => 'Nombre médico:',
                'label_attributes' => ['class' => 'control-label']
            ],
        ]);


        // Add "phone" field
        $this->add([
            'type' => 'text',
            'name' => 'phone',
            'attributes' => [
                'id' => 'phone'
            ],
            'options' => [
                'label' => 'Mobile Phone',
            ],
        ]);

        // Add "street_address" field
        $this->add([
            'type' => 'text',
            'name' => 'street_address',
            'attributes' => [
                'id' => 'street_address'
            ],
            'options' => [
                'label' => 'Street address',
            ],
        ]);

        // Add "city" field
        $this->add([
            'type' => 'text',
            'name' => 'city',
            'attributes' => [
                'id' => 'city'
            ],
            'options' => [
                'label' => 'City',
            ],
        ]);

        // Add "state" field
        $this->add([
            'type' => 'text',
            'name' => 'state',
            'attributes' => [
                'id' => 'state'
            ],
            'options' => [
                'label' => 'State',
            ],
        ]);

        // Add "post_code" field
        $this->add([
            'type' => 'text',
            'name' => 'post_code',
            'attributes' => [
                'id' => 'post_code'
            ],
            'options' => [
                'label' => 'Post Code',
            ],
        ]);

        // Add "country" field
        $this->add([
            'type' => 'select',
            'name' => 'country',
            'attributes' => [
                'id' => 'country',
            ],
            'options' => [
                'label' => 'Country',
                'empty_option' => '-- Please select --',
                'value_options' => [
                    'US' => 'United States',
                    'CA' => 'Canada',
                    'BR' => 'Brazil',
                    'GB' => 'Great Britain',
                    'FR' => 'France',
                    'IT' => 'Italy',
                    'DE' => 'Germany',
                    'RU' => 'Russia',
                    'IN' => 'India',
                    'CN' => 'China',
                    'AU' => 'Australia',
                    'JP' => 'Japan'
                ],
            ],
        ]);


        // Add "billing_plan" field
        $this->add([
            'type' => 'select',
            'name' => 'billing_plan',
            'attributes' => [
                'id' => 'billing_plan',
            ],
            'options' => [
                'label' => 'Billing Plan',
                'empty_option' => '-- Please select --',
                'value_options' => [
                    'Free' => 'Free',
                    'Bronze' => 'Bronze',
                    'Silver' => 'Silver',
                    'Gold' => 'Gold',
                    'Platinum' => 'Platinum'
                ],
            ],
        ]);

        // Add "payment_method" field
        $this->add([
            'type' => 'select',
            'name' => 'payment_method',
            'attributes' => [
                'id' => 'payment_method',
            ],
            'options' => [
                'label' => 'Payment Method',
                'empty_option' => '-- Please select --',
                'value_options' => [
                    'Visa' => 'Visa',
                    'MasterCard' => 'Master Card',
                    'PayPal' => 'PayPal'
                ],
            ],
        ]);

        // Add the submit button
        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Siguiente >>',
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
//
//            $inputFilter->add([
//                'type' => 'Zend\InputFilter\FileInput',
//                'name' => 'file',
//                'required' => true,
//                'validators' => [
//                    [
//                        'name' => '\Zend\Validator\File\IsImage',
//                        'options' => [
//                            'messages' => [
//                                \Zend\Validator\File\IsImage::FALSE_TYPE => 'La entrada no se puede dejar en blanco',
//                                \Zend\Validator\File\IsImage::NOT_DETECTED => 'La entrada no se puede dejar en blanco',
//                            ],
//                        ],
//                    ],
//                    [
//                        'name' => 'FileUploadFile'],
//                    [
//                        'name' => 'FileMimeType',
//                        'options' =>
//                        [
//                            'mimeType' =>
//                            [
//                                'image/jpeg',
//                                'image/png'
//                            ],
//                        ],
//                    ],
//                    ['name' => 'FileIsImage'],
//                    [
//                        'name' => 'FileImageSize',
//                        'options' => [
//                            'minWidth' => 128,
//                            'minHeight' => 128,
//                            'maxWidth' => 4096,
//                            'maxHeight' => 4096
//                        ]
//                    ],
//                    [
//                        'name' => 'NotEmpty',
//                        'options' => [
//                            'messages' => [
//                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La entrada no se puede dejar en blanco',
//                            ],
//                        ],
//                    ],
//                ],
//                'filters' => [
//                    [
//                        'name' => 'FileRenameUpload',
//                        'options' => [
//                            'target' => './data/upload',
//                            'useUploadName' => true,
//                            'useUploadExtension' => true,
//                            'overwrite' => true,
//                            'randomize' => false
//                        ]
//                    ]
//                ],
//            ]);
//            // Add validation rules for the "file" field.
//            $inputFilter->add([
//                'name' => 'email',
//                'required' => true,
//                'filters' => [
//                    ['name' => 'StringTrim'],
//                ],
//                'validators' => [
//                    [
//                        'name' => 'NotEmpty',
//                        'options' => [
//                            'messages' => [
//                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La entrada no se puede dejar en blanco',
//                            ],
//                        ],
//                    ],
//                    [
//                        'name' => 'EmailAddress',
//                        'options' => [
//                            'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
//                            'useMxCheck' => false,
//                            'messages' => [
//                                \Zend\Validator\EmailAddress::INVALID_FORMAT => 'La entrada no es una dirección de correo electrónico válida. Usa el formato básico local-part @ hostname',
//                                \Zend\Validator\EmailAddress::INVALID => 'La entrada no es valida',
//                            ],
//                        ],
//                    ],
//                ],
//            ]);
//
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
//
//            $inputFilter->add([
//                'name' => 'fecha_nac',
//                'required' => true,
//                'filters' => [
//                    ['name' => 'StringTrim'],
//                    ['name' => 'StripTags'],
//                    ['name' => 'StripNewlines'],
//                ],
//                'validators' => [
//                    [
//                        'name' => 'NotEmpty',
//                        'options' => [
//                            'messages' => [
//                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La entrada no se puede dejar en blanco',
//                            ],
//                        ],
//                    ],
//                    [
//                        'name' => 'StringLength',
//                        'options' => [
//                            'min' => 10,
//                            'max' => 10,
//                            'messages' => [
//                                \Zend\Validator\StringLength::INVALID => 'La entrada no es valida',
//                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 10, caracteres como mínimo',
//                                \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 10, caracteres como máximo',
//                            ],
//                        ],
//                    ],
//                ],
//            ]);
//
//            // Add input for "password" field
//            $inputFilter->add([
//                'name' => 'password',
//                'required' => true,
//                'filters' => [
//                ],
//                'validators' => [
//                    [
//                        'name' => 'NotEmpty',
//                        'options' => [
//                            'messages' => [
//                                \Zend\Validator\NotEmpty::IS_EMPTY => 'No puede dejar vacío el campo password',
//                            ],
//                        ],
//                    ],
//                    [
//                        'name' => 'StringLength',
//                        'options' => [
//                            'min' => 6,
//                            'max' => 15,
//                            'messages' => [
//                                \Zend\Validator\StringLength::INVALID => 'No puede dejar vacío el campo password',
//                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 6, caracteres como mínimo',
//                                \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 15, caracteres como máximo',
//                            ],
//                        ],
//                    ],
//                ],
//            ]);
//
//            // Add input for "confirm_password" field
//            $inputFilter->add([
//                'name' => 'confirm_password',
//                'required' => true,
//                'filters' => [
//                ],
//                'validators' => [
//                    [
//                        'name' => 'Identical',
//                        'options' => [
//                            'token' => 'password',
//                            'messages' => [
//                                \Zend\Validator\Identical::MISSING_TOKEN => 'La entrada no es una dirección de correo electrónico válida. Usa el formato básico local-part @ hostname',
//                                \Zend\Validator\Identical::NOT_SAME => 'El campo password no corresponde',
//                            ],
//                        ],
//                    ],
//                    [
//                        'name' => 'NotEmpty',
//                        'options' => [
//                            'messages' => [
//                                \Zend\Validator\NotEmpty::IS_EMPTY => 'No puede dejar vacío el campo confirmar password',
//                            ],
//                        ],
//                    ],
//                ],
//            ]);
//
////            $inputFilter->add([
////                'name'     => 'phone',
////                'required' => true,
////                'filters'  => [
////                ],
////                'validators' => [
////                    [
////                        'name'    => 'StringLength',
////                        'options' => [
////                            'min' => 3,
////                            'max' => 32
////                        ],
////                    ],
////                    [
////                        'name' => PhoneValidator::class,
////                        'options' => [
////                            'format' => PhoneValidator::PHONE_FORMAT_INTL
////                        ]
////                    ],
////                ],
////            ]);
//            // Add input for "street_address" field
//            $inputFilter->add([
//                'name' => 'street_address',
//                'required' => true,
//                'filters' => [
//                    ['name' => 'StringTrim'],
//                ],
//                'validators' => [
//                    [
//                        'name' => 'NotEmpty',
//                        'options' => [
//                            'messages' => [
//                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La entrada no se puede dejar en blanco "Dirección"',
//                            ],
//                        ],
//                    ],
//                    [
//                        'name' => 'StringLength',
//                        'options' => [
//                            'min' => 15,
//                            'max' => 90,
//                            'messages' => [
//                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 15 caracteres como minimo',
//                                \Zend\Validator\StringLength::TOO_LONG => 'Dirección es muy largo 90 caracteres como maximo',
//                            ],
//                        ],
//                    ],
//                ],
//            ]);
//
//            // Add input for "city" field
//            $inputFilter->add([
//                'name' => 'city',
//                'required' => true,
//                'filters' => [
//                    ['name' => 'StringTrim'],
//                ],
//                'validators' => [
//                    [
//                        'name' => 'NotEmpty',
//                        'options' => [
//                            'messages' => [
//                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La entrada no se puede dejar ne blanco "Ciudad"',
//                            ],
//                        ],
//                    ],
//                    ['name' => 'StringLength',
//                        'options' => [
//                            'min' => 4,
//                            'max' => 20,
//                            'messages' => [
//                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 4 caracteres como minimo',
//                                \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 20 caracteres como maximo',
//                            ],
//                        ],
//                    ],
//                ],
//            ]);
//
//            // Add input for "state" field
//            $inputFilter->add([
//                'name' => 'state',
//                'required' => true,
//                'filters' => [
//                    ['name' => 'StringTrim'],
//                ],
//                'validators' => [
//                    ['name' => 'StringLength', 'options' => ['min' => 1, 'max' => 32]]
//                ],
//            ]);
//
//            // Add input for "post_code" field
//            $inputFilter->add([
//                'name' => 'post_code',
//                'required' => true,
//                'filters' => [
//                ],
//                'validators' => [
//                    ['name' => 'IsInt'],
//                    ['name' => 'Between', 'options' => ['min' => 0, 'max' => 999999]]
//                ],
//            ]);
//
//            // Add input for "country" field
//            $inputFilter->add([
//                'name' => 'country',
//                'required' => false,
//                'filters' => [
//                    ['name' => 'Alpha'],
//                    ['name' => 'StringTrim'],
//                    ['name' => 'StringToUpper'],
//                ],
//                'validators' => [
//                    ['name' => 'StringLength', 'options' => ['min' => 2, 'max' => 2]]
//                ],
//            ]);
//
//            // Add input for "billing_plan" field
//            $inputFilter->add([
//                'name' => 'billing_plan',
////                    'required' => true,
//                'filters' => [
//                ],
//                'validators' => [
//                    [
//                        'name' => 'InArray',
//                        'options' => [
//                            'haystack' => [
//                                'Free',
//                                'Bronze',
//                                'Silver',
//                                'Gold',
//                                'Platinum'
//                            ]
//                        ]
//                    ]
//                ],
//            ]);
//
//            // Add input for "payment_method" field
//            $inputFilter->add([
//                'name' => 'payment_method',
////                    'required' => true,
//                'filters' => [
//                ],
//                'validators' => [
//                    [
//                        'name' => 'InArray',
//                        'options' => [
//                            'haystack' => [
//                                'PayPal',
//                                'Visa',
//                                'MasterCard',
//                            ]
//                        ]
//                    ]
//                ],
//            ]);
//        }
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
