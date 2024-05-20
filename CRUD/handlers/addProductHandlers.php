<?php
session_start();
require_once '../core/validations.php';
require_once '../core/functions.php';
require_once '../database/conn.php';

$errors = [];
$success = [];


if (checkRequestMethod('POST')) {
    $name = sanitizeValue($_POST['name']);
    $description = sanitizeValue($_POST['description']);
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $file_name = $_FILES['image']['name'];
    $file_temp_name = $_FILES['image']['tmp_name'];
    $folder = '../images/' . $file_name ;
    
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

    // Validation For Image
    if (requireValue($file_name)) {
        $errors['image'] =  "Image is reqired";
    }

    if (empty($errors)) {
        // createCategory($name, $description, $category_id, $price ,$file_name ) ;

        $db = new Database();
        $sql = "INSERT INTO products(`name`,`description` ,`price` ,`image`,`category_id`) 
                VALUES('$name','$description','$price' , '$file_name' ,'$category_id')";

        $success['success'] = $db->insertData($sql);
        sessionStore('success', $success);
        move_uploaded_file($file_temp_name, $folder);
        redirectPath('../add-product.php');

    } else {
        sessionStore('errors', $errors);
        redirectPath('../add-product.php');
    }
}
