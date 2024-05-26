<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';

use RentACar\Category;
use RentACar\Property;

if (empty($_POST['categoryId'])) {
    // TODO: send back with error
    exit;
}

$categoryId = $_POST['categoryId'];

if (isset($_POST['categoryEdit'])) {
    try {
        $category = Category::find($categoryId);
        $category->loadProperties();
        $category->setName($_POST['name']);
        $category->setDescription($_POST['description']);
        $category->setDailyRate($_POST['dailyRate']);
        $category->setIsArchived($_POST['isArchived']);
        $category->save();

        foreach ($category->getProperties() as $property) {
            $propertyId = $property->getId();
            if (!isset($_POST['property-' . $propertyId])) {
                echo 'NO PROPERTY ' . $property->getName();
                // TODO: error
                exit;
            }
    
            $formPropertyValue = trim($_POST['property-' . $propertyId]);
            if ($formPropertyValue !== $property->getPropertyValue()) {
                $stmt = Category::rawSQL("
                    UPDATE category_property
                    SET propertyValue = '$formPropertyValue'
                    WHERE category_id=$categoryId
                    AND property_id=$propertyId; 
                ");
            }
        }
    } catch(e) {
        // TODO: error message
        echo 'ERROR SIGNING UP :(';
        print_r(e);
        exit;
    }
    header('Location: /src/html/admin/categoryView.php?categoryId=' . $categoryId);
    exit;
}

if (isset($_POST['categoryArchive'])) {
    try {
        $category = Category::find($categoryId);
        $category->setIsArchived(true)->save();
        $stmt = Category::rawSQL("
            UPDATE vehicle
            SET category_id = NULL
            WHERE category_id=$categoryId
        ");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } catch(e) {
        // TODO: handle error
        exit;
    }
}
