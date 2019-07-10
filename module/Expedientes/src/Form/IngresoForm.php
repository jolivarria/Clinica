<?php

namespace Expedientes\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Application\Validator\PhoneValidator;

//use Application\Validator\PhoneValidator;

/**
 * This form is used to collect user registration data. This form is multi-step.
 * It determines which fields to create based on the $step argument you pass to
 * its constructor.
 */
class IngresoForm extends Form {

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
                'name' => 'idEmpleado',
            ]);

            // Add "file" field.
            $this->add([
                'type' => 'file',
                'name' => 'file',
                'attributes' => [
                    'id' => 'file'
                ],
                'options' => [
                    'label' => 'Seleccione Imagen:',
                    'label_attributes' => array('class' => 'control-label')
                    
                ],
            ]);
            // Add "email" field
            $this->add([
                'type' => 'text',
                'name' => 'email',
                'attributes' => [
                    'id' => 'email'
                ],
                'options' => [
                    'label' => 'Correo Electrónico:',
                    'label_attributes' => array('class' => 'control-label')
                ],
            ]);

            // Add "nombreCompleto" field
            $this->add([
                'type' => 'text',
                'name' => 'nombre_completo',
                'class' => 'control-label',
                'attributes' => [
                    'id' => 'nombre_completo',
                    
                    
                ],
                'options' => [
                    'label' => 'Nombre Completo:',
                     'label_attributes' => ['class' => 'control-label']
                    
                ],
            ]);

            // Add "fecha_nac" field
            $this->add([
                'type' => 'text',
                'name' => 'fecha_nac',
                'attributes' => [
                    'id' => 'fecha_nac'
                ],
                'options' => [
                    'label' => 'Fecha Nacimiento:',
                    'label_attributes' => ['class' => 'control-label']
                ],
            ]);

            // Add "password" field
            $this->add([
                'type' => 'password',
                'name' => 'password',
                'attributes' => [
                    'id' => 'password'
                ],
                'options' => [
                    'label' => 'Elegir Password',
                ],
            ]);

            // Add "confirm_password" field
            $this->add([
                'type' => 'password',
                'name' => 'confirm_password',
                'attributes' => [
                    'id' => 'confirm_password'
                ],
                'options' => [
                    'label' => 'Confirmar Password',
                ],
            ]);
        } else if ($step == 2) {

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
        } else if ($step == 3) {

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
        }



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
    private function addInputFilter($step) {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        if ($step == 1) {
            $inputFilter->add([
                'type' => 'Zend\InputFilter\FileInput',
                'name' => 'file',
                'required' => true,
                'validators' => [
                    [
                        'name' => '\Zend\Validator\File\IsImage',
                        'options' => [
                            'messages' => [
                            \Zend\Validator\File\IsImage::FALSE_TYPE => 'La entrada no se puede dejar en blanco',
                             \Zend\Validator\File\IsImage::NOT_DETECTED => 'La entrada no se puede dejar en blanco',
                            ],
                        ],
                    ],
                    [
                        'name' => 'FileUploadFile'],
                    [
                        'name' => 'FileMimeType',
                        'options' =>
                        [
                            'mimeType' =>
                            [
                                'image/jpeg',
                                'image/png'
                            ],
                        ],
                    ],
                    ['name' => 'FileIsImage'],
                    [
                        'name' => 'FileImageSize',
                        'options' => [
                            'minWidth' => 128,
                            'minHeight' => 128,
                            'maxWidth' => 4096,
                            'maxHeight' => 4096
                        ]
                    ],
                    [
                        'name' => 'NotEmpty',
                        'options' => [
                            'messages' => [
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La entrada no se puede dejar en blanco',
                            ],
                        ],
                    ],
                ],
                'filters' => [
                    [
                        'name' => 'FileRenameUpload',
                        'options' => [
                            'target' => './data/upload',
                            'useUploadName' => true,
                            'useUploadExtension' => true,
                            'overwrite' => true,
                            'randomize' => false
                        ]
                    ]
                ],
            ]);
            // Add validation rules for the "file" field.
            $inputFilter->add([
                'name' => 'email',
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
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
                        'name' => 'EmailAddress',
                        'options' => [
                            'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
                            'useMxCheck' => false,
                            'messages' => [
                                \Zend\Validator\EmailAddress::INVALID_FORMAT => 'La entrada no es una dirección de correo electrónico válida. Usa el formato básico local-part @ hostname',
                                \Zend\Validator\EmailAddress::INVALID => 'La entrada no es valida',
                            ],
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name' => 'nombre_completo',
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
                'name' => 'fecha_nac',
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
                            'max' => 10,
                            'messages' => [
                                \Zend\Validator\StringLength::INVALID => 'La entrada no es valida',
                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 10, caracteres como mínimo',
                                \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 10, caracteres como máximo',
                            ],
                        ],
                    ],
                ],
            ]);

            // Add input for "password" field
            $inputFilter->add([
                'name' => 'password',
                'required' => true,
                'filters' => [
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'options' => [
                            'messages' => [
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'No puede dejar vacío el campo password',
                            ],
                        ],
                    ],
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 6,
                            'max' => 15,
                            'messages' => [
                                \Zend\Validator\StringLength::INVALID => 'No puede dejar vacío el campo password',
                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 6, caracteres como mínimo',
                                \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 15, caracteres como máximo',
                            ],
                        ],
                    ],
                ],
            ]);

            // Add input for "confirm_password" field
            $inputFilter->add([
                'name' => 'confirm_password',
                'required' => true,
                'filters' => [
                ],
                'validators' => [
                    [
                        'name' => 'Identical',
                        'options' => [
                            'token' => 'password',
                            'messages' => [
                                \Zend\Validator\Identical::MISSING_TOKEN => 'La entrada no es una dirección de correo electrónico válida. Usa el formato básico local-part @ hostname',
                                \Zend\Validator\Identical::NOT_SAME => 'El campo password no corresponde',
                            ],
                        ],
                    ],
                    [
                        'name' => 'NotEmpty',
                        'options' => [
                            'messages' => [
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'No puede dejar vacío el campo confirmar password',
                            ],
                        ],
                    ],
                ],
            ]);
        } else if ($step == 2) {

//            $inputFilter->add([
//                'name'     => 'phone',
//                'required' => true,
//                'filters'  => [
//                ],
//                'validators' => [
//                    [
//                        'name'    => 'StringLength',
//                        'options' => [
//                            'min' => 3,
//                            'max' => 32
//                        ],
//                    ],
//                    [
//                        'name' => PhoneValidator::class,
//                        'options' => [
//                            'format' => PhoneValidator::PHONE_FORMAT_INTL
//                        ]
//                    ],
//                ],
//            ]);
            // Add input for "street_address" field
            $inputFilter->add([
                'name' => 'street_address',
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'options' => [
                            'messages' => [
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La entrada no se puede dejar en blanco "Dirección"',
                            ],
                        ],
                    ],
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 15,
                            'max' => 90,
                            'messages' => [
                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 15 caracteres como minimo',
                                \Zend\Validator\StringLength::TOO_LONG => 'Dirección es muy largo 90 caracteres como maximo',
                            ],
                        ],
                    ],
                ],
            ]);

            // Add input for "city" field
            $inputFilter->add([
                'name' => 'city',
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'options' => [
                            'messages' => [
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La entrada no se puede dejar ne blanco "Ciudad"',
                            ],
                        ],
                    ],
                    ['name' => 'StringLength',
                        'options' => [
                            'min' => 4,
                            'max' => 20,
                            'messages' => [
                                \Zend\Validator\StringLength::TOO_SHORT => 'La entrada es muy corta 4 caracteres como minimo',
                                \Zend\Validator\StringLength::TOO_LONG => 'La entrada es muy larga 20 caracteres como maximo',
                            ],
                        ],
                    ],
                ],
            ]);

            // Add input for "state" field
            $inputFilter->add([
                'name' => 'state',
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    ['name' => 'StringLength', 'options' => ['min' => 1, 'max' => 32]]
                ],
            ]);

            // Add input for "post_code" field
            $inputFilter->add([
                'name' => 'post_code',
                'required' => true,
                'filters' => [
                ],
                'validators' => [
                    ['name' => 'IsInt'],
                    ['name' => 'Between', 'options' => ['min' => 0, 'max' => 999999]]
                ],
            ]);

            // Add input for "country" field
            $inputFilter->add([
                'name' => 'country',
                'required' => false,
                'filters' => [
                    ['name' => 'Alpha'],
                    ['name' => 'StringTrim'],
                    ['name' => 'StringToUpper'],
                ],
                'validators' => [
                    ['name' => 'StringLength', 'options' => ['min' => 2, 'max' => 2]]
                ],
            ]);
        } else if ($step == 3) {

            // Add input for "billing_plan" field
            $inputFilter->add([
                'name' => 'billing_plan',
//                    'required' => true,
                'filters' => [
                ],
                'validators' => [
                    [
                        'name' => 'InArray',
                        'options' => [
                            'haystack' => [
                                'Free',
                                'Bronze',
                                'Silver',
                                'Gold',
                                'Platinum'
                            ]
                        ]
                    ]
                ],
            ]);

            // Add input for "payment_method" field
            $inputFilter->add([
                'name' => 'payment_method',
//                    'required' => true,
                'filters' => [
                ],
                'validators' => [
                    [
                        'name' => 'InArray',
                        'options' => [
                            'haystack' => [
                                'PayPal',
                                'Visa',
                                'MasterCard',
                            ]
                        ]
                    ]
                ],
            ]);
        }
    }

}
