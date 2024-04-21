<?php
session_start();
require_once '../core/functions.php';
require_once '../core/validations.php';
require_once '../database/conn.php';

$db = new Database(); 

$errors = [];
$success = [];

if (checkRequestMethod('POST')) {
    $name = sanitizeValue($_POST['name']);
    $description = sanitizeValue($_POST['description']);
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $file_name = $_FILES['image']['name'];

    // Validation For Name  
    if (requireValue($name)) {
        $errors['name'] =  "Name is reqired";
    } elseif (minLength($name,3)) {
        $errors['name'] = "Name Must Be More Than  3 Letters ";
    } elseif (maxLength($name,20)) {
        $errors['name'] = "Name Must Be Less Than  20 Letters ";
    }

    // Validation For Description  
    if (requireValue($description)) {
        $errors['description'] =  "Description is reqired";
    }  elseif (minLength($description,10)) {
        $errors['description'] = "Description Must Be More Than  10 Letters ";
    } elseif (maxLength($description,30)) {
        $errors['description'] = "Description Must Be Less Than  30 Letters ";
    }

    // Validation For Category Type
    if (!strlen($category_id > 0)) {
        $errors['category_id'] =  "Select Category Type";
    }

        // Validation For Price
    if (requireValue($price)) {
        $errors['price'] =  "price is reqired";
    }

    if (empty($errors)) {
        if ($file_name != '') {


            $sql = "UPDATE products SET `name`='$name',`description`='$description' , `category_id`='$category_id' , `price`='$price' ,`image`='$file_name'
                    WHERE `id`='$_GET[id]' ";
            $success['success'] = $db->updateData($sql);
            sessionStore('success', $success);
            redirectPath("../edit-product.php?id=$_GET[id]");
        }else{
                 // if image not update
                
            $sql = "SELECT * FROM  `products` WHERE `id`='$_GET[id]' ";
            $row = $db->findData('products', $_GET['id']);

            $sql = "UPDATE products SET `name`='$name',`description`='$description' , `category_id`='$category_id' , `price`='$price' ,`image`='$row[image]'
                    WHERE `id`='$_GET[id]' ";
            $success['success'] = $db->updateData($sql);
            sessionStore('success', $success);
            redirectPath("../edit-product.php?id=$_GET[id]");
        }
    } else {
        sessionStore('errors', $errors);
        redirectPath("../edit-product.php?id=$_GET[id]");
    }
}

