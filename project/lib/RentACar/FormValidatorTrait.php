<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Location;

trait FormValidatorTrait
{
    // abstract public static function getValidationRules(): array;

    private static function validateField(array $field): bool
    {
        try {
            if ($field['required'] && empty($_POST[$field['name']])) {
                throw new \Exception('This field is required.');
            }

            $value = $_POST[$field['name']];

            if (!empty($field['type'])) {
                switch ($field['type']) {
                    // case 'integer':
                    //     if (filter_var($value, FILTER_VALIDATE_INT)) {
                    //         throw new \Exception('This field must be an integer ID of a vehicle.');
                    //     }
                    //     break;
                    case 'dateString':
                        if (date('Y-m-d', strtotime($value)) !== $value) {
                            throw new \Exception('This field must be a valid date.');
                        }
                        if (!empty($field['mustBeBefore'])) {
                            $beBefore = $field['mustBeBefore'];
                        }
                        break;
                    // TODO: fix
                    // case 'timeString':
                    //     if (date('H:i:s', strtotime($value)) !== $value) {
                    //         throw new \Exception('This field must be a valid time.');
                    //     }
                    //     break;
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

            return true;
        } catch(\Exception $e) {
            $_SESSION['errors'][$field['name']] = $e->getMessage();
            return false;
        }
    }

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