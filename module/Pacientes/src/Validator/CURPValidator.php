<?php

namespace Pacientes\Validator;

use Zend\Validator\AbstractValidator;

// This validator class is designed for checking a phone number for
// conformance to the local or to the international format.
class CURPValidator extends AbstractValidator {

    // Phone format constants.
    const CURP_FORMAT = 'curp';
    const PHONE_FORMAT_LOCAL = 'local'; // Local phone format.
    const PHONE_FORMAT_INTL = 'intl';  // International phone format.

    // Available validator options.

    protected $options = [
        'format' => self::CURP_FORMAT
    ];

    // Validation failure message IDs.
    const NOT_SCALAR = 'notScalar';
    const INVALID_FORMAT_CURP = 'invalidFormatCURP';
    const INVALID_FORMAT_INTL = 'invalidFormatIntl';
    const INVALID_FORMAT_LOCAL = 'invalidFormatLocal';

    // Validation failure messages.
    protected $messageTemplates = [
        self::INVALID_FORMAT_CURP => "El formato del RFC no es correcto",
        self::NOT_SCALAR => "The phone number must be a scalar value",
        self::INVALID_FORMAT_INTL => "The phone number must be in international format",
        self::INVALID_FORMAT_LOCAL => "The phone number must be in local format",
    ];

    // Constructor.
    public function __construct($options = null) {
        // Set filter options (if provided).
        if (is_array($options)) {

            if (isset($options['format']))
                $this->setFormat($options['format']);
        }

        // Call the parent class constructor.
        parent::__construct($options);
    }

    // Sets phone format.
    public function setFormat($format) {
        
        // Check input argument.
        if ($format != self::PHONE_FORMAT_LOCAL &&
                $format != self::PHONE_FORMAT_INTL &&
                    $format != self::CURP_FORMAT) {
            throw new \Exception('Invalid format argument passed.');
        }

        $this->options['format'] = $format;
    }

    // Validates a phone number.
    public function isValid($value) {
        
        if (!is_scalar($value)) {
            $this->error(self::NOT_SCALAR);
            return false; // Phone number must be a scalar.
        }

        // Convert the value to string.
        $value = (string) $value;

        $format = $this->options['format'];

        // Determine the correct length and pattern of the phone number,
        // depending on the format.
        if ($format == self::CURP_FORMAT) {
            $correctLength = 10;
            $pattern = '/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))$/';
        } else { // self::PHONE_FORMAT_LOCAL
            $correctLength = 8;
            $pattern = '/^\d{3}-\d{4}$/';
        }

        // First check phone number length
        $isValid = false;
        if (strlen($value) == $correctLength) {
            // Check if the value matches the pattern.
            if (preg_match($pattern, $value))
                $isValid = true;
        }

        // If there was an error, set error message.
        if (!$isValid) {
            if ($format == self::CURP_FORMAT)
                $this->error(self::INVALID_FORMAT_CURP);
            else
                $this->error(self::INVALID_FORMAT_LOCAL);
        }

        // Return validation result.
        return $isValid;
    }

}
