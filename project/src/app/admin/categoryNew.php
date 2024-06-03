<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Property;

try {
    $isCategoryFormValid = Category::validateForm();
    if (!$isCategoryFormValid) {
        throw new Exception('Invalid fields.');
    }

    $category = new Category();
    $category->setName($_POST['name']);
    $category->setDescription($_POST['description']);
    $category->setDailyRate($_POST['dailyRate']);
    $category->setIsArchived(false);
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
            INSERT INTO category_property (propertyValue, category_id, property_id)
            VALUES ('$formPropertyValue', $categoryId, $propertyId);
        ");

        header('Location: /src/html/admin/categoryView.php?categoryId=' . $categoryId);
    }
} catch(Exception $e) {
    $_SESSION['errors']['adminCatNewPage'] = $e->getMessage();
    header('Location: /src/html/admin/categoryNew.php');
    exit;
}

