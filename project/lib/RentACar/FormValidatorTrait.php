<?php
namespace RentACar;

trait FormValidatorTrait
{
    // abstract public static function getValidationRules(): array;

    private static function validateField(array $field): bool
    {
        try {
            if ($field['required'] && empty($_POST[$field['name']])) {
                throw new \Exception('This field is required.');
            }

            $formFieldValue = $_POST[$field['name']];
            if (!empty($field['type'])) {
                switch ($field['type']) {
                    case 'integer':
                        if (!ctype_digit($formFieldValue)) {
                            throw new \Exception('This field must be an integer ID of a vehicle.');
                        }
                        break;
                    case 'dateString':
                        if (date('Y-m-d', strtotime($formFieldValue)) !== $formFieldValue) {
                            throw new \Exception('This field must be a valid date.');
                        }
                        break;
                    case 'timeString':
                        if (date('H:i:s', strtotime($formFieldValue)) !== $formFieldValue) {
                            throw new \Exception('This field must be a valid time.');
                        }
                        break;
                }
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

        // private static function getValidationRules(): array
        // {
        //     return [
        //         'vehicleId' => [
        //             'type' => 'integer'
        //         ],
        //         'pickupLocationId' => [
        //             'type' => 'integer',
        //             'mustBeEqual' => [
        //                 'comparedTo' => 'dropoffLocationId',
        //                 'value' => 'island_id'
        //             ]
        //         ],
        //         'pickupDate' => [
        //             'type' => 'dateString',
        //             'mustBeBefore' => 'dropoffDate',
        //             'mustBeAfter' => [
        //                 time()
        //             ]
        //         ],
        //         'pickupTime' => [
        //             'type' => 'timeString',
        //             'mustBeAfter' => '09:30:00',
        //             'mustBeBefore' => '17:30:00'
        //         ],
        //         'dropoffLocationId' => [
        //             'type' => 'integer',
        //             'mustBeEqual' => [
        //                 'comparedTo' => 'dropoffLocationId',
        //                 'value' => 'island_id'
        //             ]
        //         ],
        //         'dropoffDate' => [
        //             'type' => 'dateString',
        //             'mustBeAfter' => [
        //                 'dropoffDate',
        //                 time()
        //             ]
        //         ],
        //         'dropoffTime' => [
        //             'type' => 'timeString',
        //             'mustBeAfter' => '09:30:00',
        //             'mustBeBefore' => '17:30:00'
        //         ]
        //     ];
        // }
    }
}