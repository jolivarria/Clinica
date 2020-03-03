<?php

namespace Pacientes\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Pacientes\Validator\CURPValidator;

//use Application\Validator\PhoneValidator;

/**
 * This form is used to collect user registration data. This form is multi-step.
 * It determines which fields to create based on the $step argument you pass to
 * its constructor.
 */
class SolicitudForm extends Form {

    /**
     * Constructor.
     */
    public function __construct($step) {
        // Check input.
        if (!is_int($step) || $step < 1 || $step > 3)
            throw new \Exception('Step is invalid');

        // Define form name
        parent::__construct('ingreso-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('id', 'form-wizard');
        $this->addElements($step);
        $this->addInputFilter($step);
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements($step) {
        if ($step == 1) {
            // Add "idEmpleado" field.
            $this->add([
                'type' => 'hidden',
                'name' => 'idSolicitud',
            ]);

//            // Add "RFC" field.
            $this->add([
                'type' => 'text',
                'name' => 'RFC',
                'attributes' => [
                    'id' => 'RFC',
                    'maxlength' => '10',
                    'required' => true,
                ],
                'options' => [
                    'label' => 'RFC:',
                    'label_attributes' => array('class' => 'control-label')
                ],
            ]);
            // Add "folio" field.
//            $this->add([
//                'type' => 'text',
//                'name' => 'folio',                
//                'attributes' => [
//                    'id' => 'folio',
//                    'maxlength' => '10',
//                    'required' => true,
//                    'pattern'=>'[0-9]{10}',
//                ],
//                'options' => [
//                    'label' => 'Folio:',
//                    'label_attributes' => array('class' => 'control-label')
//                ],
//            ]);
            // Add "operadora" field.
//            $this->add([
//                'type' => 'text',
//                'name' => 'operadora',
//                'required' => true,
//                'attributes' => [
//                    'id' => 'operadora',
//                    'maxlength' => '10',
//                    'pattern'=>'[A-Za-z]{10}',
//                ],
//                'options' => [
//                    'label' => 'Operadora:',
//                    'label_attributes' => array('class' => 'control-label')
//                ],
//            ]);
            // Add "nombrePaciente" field.
            $this->add([
                'type' => 'text',
                'name' => 'nombrePaciente',
                'attributes' => [
                    'id' => 'nombrePaciente',
                    'required' => true,
                ],
                'options' => [
                    'label' => 'Nombre paciente:',
                    'label_attributes' => array('class' => 'control-label')
                ],
            ]);

            $this->add([
                'type' => 'Zend\Form\Element\Radio',
                'name' => 'sexo',
                'options' => [
                    'label' => 'Sexo paciente',
                    'required' => true,
                    'value_options' => [
                        'Masculino' => 'Masculino',
                        'Femenino' => 'Femenino',
                    ],
                ],
            ]);

            //Add "Edad" field
            $this->add([
                'type' => 'number',
                'name' => 'edad',
                'attributes' => [
                    'id' => 'edad',
                    'required' => true,
                    'min' => '1',
                    'step' => '1',
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
                    'id' => 'nombreFamiliar',
                    'required' => true,
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
                    'required' => true,
                    'value_options' => [
                        'Mamá/Papá' => 'Mamá/Papá',
                        'Tía/Tío' => 'Tía/Tío',
                        'Abuela/Abuelo' => 'Abuela/Abuelo',
                        'Hermano/Hermana' => 'Hermano/Hermana',
                        'Amigo/Amiga' => 'Amigo/Amiga',
                        'Conocido/Conocida' => 'Conocido/Conocida'
                    ],
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
                    'required' => true,
                ],
                'options' => [
                    'label' => 'Télefono:',
                    'label_attributes' => ['class' => 'control-label']
                ],
            ]);
            //Add "costo" field
            $this->add([
                'type' => 'number',
                'name' => 'costo',
                'class' => 'span8 mask text',
                'attributes' => [
                    'min' => '0',
                    'step' => '0.01',
                    'required' => true,
                    'data-number-to-fixed' => "2",
                    'data-number-stepfactor' => "100",
                    'id' => 'mask-phone',
                ],
                'options' => [
                    'label' => 'Costo:',
                    'label_attributes' => array('class' => 'control-label')
                ],
            ]);

            $this->add([
                'type' => 'Zend\Form\Element\Radio',
                'name' => 'tipoSolicitud',
                'options' => [
                    'label' => 'Tipo solicitud ?',
                    'required' => true,
                    'value_options' => [
                        'Foranea' => 'Foranea',
                        'Local' => 'Local',
                    ],
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
            // Add "Colonia" field
            $this->add([
                'type' => 'text',
                'name' => 'colonia',
                'class' => 'control-label',
                'attributes' => [
                    'id' => 'colonia',
                ],
                'options' => [
                    'label' => 'Colonia:',
                    'label_attributes' => ['class' => 'control-label']
                ],
            ]);

            $this->add([
                'type' => 'text',
                'name' => 'municipio',
                'class' => 'control-label',
                'attributes' => [
                    'id' => 'municipio',
                    'required' => true,
                ],
                'options' => [
                    'label' => 'Municipio:',
                    'label_attributes' => ['class' => 'control-label']
                ],
            ]);
        } else if ($step == 2) {
            
        } else if ($step == 3) {
            
        }
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
    private function addInputFilter($step) {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);
//
        if ($step == 1) {
//            $inputFilter->add([
//                'name' => 'RFC',
//                'required' => true,
//                'filters' => [
//                    ['name' => 'StringTrim'],
//                    ['name' => 'StripTags'],
//                    ['name' => 'StripNewlines'],
//                    ['name' => 'StringToUpper'],
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
//                        'name' => CURPValidator::class,
//                        'options' => [
//                            'format' => CURPValidator::CURP_FORMAT
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
//            $inputFilter->add([
//                'name' => 'folio',
//                'required' => true,
//                'filters' => [
//                    ['name' => 'StringTrim'],
//                    ['name' => 'StripTags'],
//                    ['name' => 'StripNewlines'],
//                    ['name' => 'StringToUpper'],
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
//                            'min' => 5,
//                            'max' => 10,
//                            'messages' => [
//                                \Zend\Validator\StringLength::INVALID => 'La entrada no es valida',
//                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 5, caracteres como mínimo',
//                                \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 10, caracteres como máximo',
//                            ],
//                        ],
//                    ],
//                    [
//                        'name' => 'IsFloat',
//                        'options' => [
//                            'messages' => [
//                                \Zend\I18n\Validator\IsFloat::INVALID => 'La entrda debe de ser numero',
//                                \Zend\I18n\Validator\IsFloat::NOT_FLOAT => 'La entrda debe de ser numero',
//                            ],
//                        ],
//                    ],
//                ],
//            ]);
//            $inputFilter->add([
//                'name' => 'operadora',
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
//                            'max' => 50,
//                            'messages' => [
//                                \Zend\Validator\StringLength::INVALID => 'La entrada no es valida',
//                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 10, caracteres como mínimo',
//                                \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 50, caracteres como máximo',
//                            ],
//                        ],
//                    ],
//                ],
//            ]);
            $inputFilter->add([
                'name' => 'nombrePaciente',
                'required' => true,
                'filters' => [
//                    ['name' => 'StringTrim'],
//                    ['name' => 'StripTags'],
//                    ['name' => 'StripNewlines'],
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

            $inputFilter->add([
                'name' => 'edad',
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
                            'min' => 2,
                            'max' => 2,
                            'messages' => [
                                \Zend\Validator\StringLength::INVALID => 'La entrada no es valida',
                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 2, caracteres como mínimo',
                                \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 2, caracteres como máximo',
                            ],
                        ],
                    ],
                    [
                        'name' => 'greaterThan',
                        'options' => [
                            'min' => 17,
                            'inclusive' => false,
                            'messages' => [
                                \Zend\Validator\GreaterThan::NOT_GREATER => 'La entrda debe de ser Igual o Mayor a 18',
                            ],
                        ]
                    ],
                    [
                        'name' => 'IsInt',
                        'options' => [
                            'messages' => [
                                \Zend\I18n\Validator\IsInt::NOT_INT => 'La entrda debe de ser numero',
                            ],
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name' => 'nombreFamiliar',
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
            $inputFilter->add([
                'name' => 'parentesco',
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
                ],
            ]);

            $inputFilter->add([
                'name' => 'costo',
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
                            'min' => 2,
                            'max' => 6,
                            'messages' => [
                                \Zend\Validator\StringLength::INVALID => 'La entrada no es valida',
                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 2, caracteres como mínimo',
                                \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 2, caracteres como máximo',
                            ],
                        ],
                    ],
                    [
                        'name' => 'IsFloat',
                        'options' => [
                            'messages' => [
                                \Zend\I18n\Validator\IsFloat::INVALID => 'La entrda debe de ser numero',
                                \Zend\I18n\Validator\IsFloat::NOT_FLOAT => 'La entrda debe de ser numero',
                            ],
                        ],
                    ],
                ],
            ]);
            $inputFilter->add([
                'name' => 'tipoSolicitud',
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
        } else if ($step == 2) {
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
        } else if ($step == 3) {
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
    }

}
