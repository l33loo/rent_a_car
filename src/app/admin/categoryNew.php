<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

use RentACar\Category;
use RentACar\Property;

// TODO: validate form fields

try {
    $category = new Category();
    $category->setName($_POST['name']);
    $category->setDescription($_POST['description']);
    $category->setDailyRate($_POST['dailyRate']);
    $category->setIsArchived($_POST['isArchived']);
    $category->save();
    $categoryId = $category->getId();

    $propertiesForCategory = Property::search([
        [
            'column' => 'id',
            'operator' => '>=',
            'value' => 6
        ]
    ]);

    foreach ($propertiesForCategory as $property) {
        $propertyId = $property->getId();
        if (!isset($_POST['property-' . $propertyId])) {
            echo 'NO PROPERTY ' . $property->getName();
            // TODO: error
            exit;
        }

        $formPropertyValue = trim($_POST['property-' . $propertyId]);
        $stmt = Category::rawSQL("
            UPDATE category_property
            SET propertyValue = '$formPropertyValue'
            WHERE category_id=$categoryId
            AND property_id=$propertyId; 
        ");
    }
} catch(e) {
    // TODO: error message
    echo 'ERROR SIGNING UP :(';
    print_r(e);
    exit;
}
header('Location: /html/admin/categoryView.php?categoryId=' . $categoryId);
