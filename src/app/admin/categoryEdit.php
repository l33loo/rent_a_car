<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/Property.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';

use RentACar\Category;
use RentACar\Property;

if (empty($_POST['categoryId'])) {
    // TODO: send back with error
    exit;
}

$categoryId = $_POST['categoryId'];

if (isset($_POST['editCategory'])) {
    try {
        $category = Category::find($categoryId);
        // TODO: ...
        $category->save();
    } catch(e) {
        // TODO: error message
        echo 'ERROR SIGNING UP :(';
        print_r(e);
    } finally {
        header('Location: /html/admin/userEdit.php?id=' . $categoryId);
    }
    exit;
}

if (isset($_POST['archiveCategory'])) {
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
