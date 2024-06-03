<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Category;
use RentACar\Property;
use RentACar\Revision;
use RentACar\Vehicle;

if (isset($_POST['categoryEdit'])) {
    try {
        if (empty($_POST['categoryId'])) {
            throw new Exception('No category ID.');
        }

        $categoryId = $_POST['categoryId'];

        $isCategoryFormValid = Category::validateForm();
        if (!$isCategoryFormValid) {
            throw new Exception('Invalid fields.');
        }

        $vehiclesFromCategory = Vehicle::search([
            [
                'column' => 'category_id',
                'operator' => '=',
                'value' => $categoryId
            ]
        ]);

        $category = Category::find($categoryId);
        // Archive existing category
        $category->setIsArchived(true)->save();

        // Create a new category with the edits
        $category->loadProperties()
            ->setName($_POST['name'])
            ->setDescription($_POST['description'])
            ->setDailyRate($_POST['dailyRate'])
            ->setIsArchived(false)
            ->setId(null)
            ->save();

        $categoryIdAfter = $category->getId();
        foreach ($category->getProperties() as $property) {
            $propertyId = $property->getId();
            if (!isset($_POST['property-' . $propertyId])) {
                echo 'NO PROPERTY ' . $property->getName();
                // TODO: error
                exit;
            }
    
            $formPropertyValue = trim($_POST['property-' . $propertyId]);
            $stmt = Category::rawSQL("
                INSERT INTO category_property
                VALUES ($categoryIdAfter, $propertyId, '$formPropertyValue'); 
            ");
        }
        
        foreach ($vehiclesFromCategory as $vehicle) {
            $vehicle->setCategory_id($categoryIdAfter)->save();
        }

        Revision::updateActiveRevisionsCategory($categoryId, $categoryIdAfter);

        if ($category->getIsArchived() === true) {
            header('Location: /src/html/admin/vehicles.php');
        } else {
            header('Location: /src/html/admin/categoryView.php?categoryId=' . $categoryIdAfter);
        }
    } catch(Exception $e) {
        if (empty($categoryId)) {
            $_SESSION['errors']['adminVehiclesPage'] = $e->getMessage();
            header('Location: /src/html/admin/vehicles.php');
        } else {
            $_SESSION['errors']['adminCatEditPage'] = $e->getMessage();
            header('Location: /src/html/admin/categoryEdit.php?categoryId=' . $categoryId);
        }
        exit;
    }
}

if (isset($_POST['categoryArchive'])) {
    try {
        if (empty($_POST['categoryId'])) {
            throw new Exception('No category ID.');
        }

        $category = Category::find($categoryId);
        $category->setIsArchived(true)->save();
        $stmt = Category::rawSQL("
            UPDATE vehicle
            SET category_id = NULL
            WHERE category_id=$categoryId
        ");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } catch(Exception $e) {
        $_SESSION['errors']['adminVehiclesPage'] = $e->getMessage();
        header('Location: /src/html/admin/vehicles.php');
        exit;
    }
}
