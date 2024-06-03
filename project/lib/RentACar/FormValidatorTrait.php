<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/util/helpers.php';

use RentACar\Location;

trait FormValidatorTrait
{
    abstract public static function getValidationRules(): array;

    /**
     * Validate a given form field
     *
     * @return bool
     */ 
    private static function validateField(array $field): bool
    {
        try {
            if ($field['required'] && empty($_POST[$field['name']])) {
                throw new \Exception('This field is required.');
            }

            $value = $_POST[$field['name']];

            if (!empty($field['type'])) {
                switch ($field['type']) {
                    case 'integer':
                        if (!filter_var((int)$value, FILTER_VALIDATE_INT)) {
                            throw new \Exception('This field must be an integer.');
                        }
                        break;
                    case 'number':
                        if (!filter_var((int)$value, FILTER_VALIDATE_INT) && !filter_var((int)$value, FILTER_VALIDATE_FLOAT)) {
                            throw new \Exception('This field must be an integer or float.');
                        }
                        break;
                    case 'dateString':
                        if (date('Y-m-d', strtotime($value)) !== $value) {
                            throw new \Exception('This field must be a valid date.');
                        }
                        if (!empty($field['mustBeAfter']) && !empty($_POST[$field['mustBeAfter']])) {
                            if (calculateDiffDays($_POST[$field['mustBeAfter']], $value) > 1) {
                                throw new \Exception($field['name'] . ' must be after ' . $field['mustBeAfter']);
                            }
                        }
                        if (!empty($field['diffYears'])) {
                            if (calculateAge($value) < $field['diffYears']) {
                                throw new \Exception('Customer must be at least 18 years old.');
                            }
                        }
                        if (!empty($field['diffDays'])) {
                            if (calculateDiffDaysFromNow($value) > $field['diffDays']) {
                                throw new \Exception('Customer must be at least 18 years old.');
                            }
                        }
                        break;
                    case 'timeString':
                        if (date('H:i', strtotime($value)) !== $value) {
                            throw new \Exception('This field must be a valid time.');
                        }
                        break;
                    case 'email':
                        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            throw new \Exception("Email '$value' is invalid.");
                        }
                       break;
                }
            }

            if (!empty($field['mustBeEqualIslands'])) {
                $equalityRules = $field['mustBeEqualIslands'];
                $self = ($equalityRules['class'])::find((int)$value)->getIsland_id();
                $other = ($equalityRules['class'])::find((int)$_POST[$equalityRules['comparedTo']])->getIsland_id();

                if ($self !== $other) {
                    throw new \Exception($field['mustBeEqualIslands']['errorMsg']);
                }
            }

            if (!empty($field['maxLength']) && strlen($value) > $field['maxLength']) {
                throw new \Exception('Up to ' . $field['maxLength'] . ' characters allowed.');
            }

            if (!empty($field['setLength']) && strlen($value) !== $field['setLength']) {
                throw new \Exception('Must be ' . $field['setLength'] . ' characters long.');
            }

            if (!empty($field['mustMatch']) && !empty($_POST[$field['mustMatch']]) && trim($value) !== trim($_POST[$field['mustMatch']])) {
                throw new \Exception('Passwords must match.');
            }

            return true;
        } catch(\Exception $e) {
            if (!empty($field['error']) || !empty($field['errorMsg'])) {
                $_SESSION['errors'][$field['error']] = $field['errorMsg'];
            } else if (!empty($field['name'])) {
                $_SESSION['errors'][$field['name']] = $e->getMessage();
            }
            return false;
        }
    }

    /**
     * Validate form fields.
     * If the argument is null, all fields are required.
     *
     * @return bool
     */ 
    public static function validateForm(?array $fieldsToValidate = null): bool
    {
        $rules = self::getValidationRules();
        $isValid = true;

        if ($fieldsToValidate === null) {
            foreach ($rules as $field) {
                if (!self::validateField($field)) {
                    $isValid = false;
                }
            }

            return $isValid;
        }

        foreach ($fieldsToValidate as $field) {
            if (!empty($field)) {
                if (!self::validateField($rules[$field])) {
                    $isValid = false;
                }
            }
        }

        return $isValid;
    }
}