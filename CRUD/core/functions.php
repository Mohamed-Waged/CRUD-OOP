<?php

function checkRequestMethod(string $method): bool 
{
    return $_SERVER['REQUEST_METHOD'] === $method;
}

function redirectPath(string $url): void
{
    header("Location: $url");
    exit();
}


function sessionStore($key, $value)
{
    $_SESSION[$key] = $value;
}

function sessionRemove($name)
{
    if (isset($_SESSION[$name])) {
        unset($_SESSION[$name]);
    }
}


// function connectDB()
// {
//     $host = "localhost";
//     $user =  "root";
//     $password = "";
//     $dbname = "eraasoft";

//     $conn = new mysqli($host, $user, $password, $dbname); 
//     return $conn;
// }

// function createCategory($name, $description,$category_id, $price , $file_name)
// {
//     $conn = connectDB();
//     $sql = "INSERT INTO products(`name`,`description` ,`price` ,`image`,`category_id`) 
//                 VALUES('$name','$description','$price' , '$file_name' ,'$category_id')";
//     $conn->query($sql);
//     $conn->close();
// }

// function getAllCategories()
// {
//     $conn = connectDB();
//     $sql = "SELECT `id`,`name`,`description`,`price`,`image`,`category_name`
//             FROM `products`,`categories`
//             WHERE `categories`.`categ_id`=`products`.`category_id`";
//     $result = mysqli_query($conn, $sql);

//     $conn->close();
//     return $result;
// }

// function findCategory($id){
//     $conn = connectDB();
//     $sql = "SELECT * FROM `products`  WHERE `id` = '$id' ";
//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_row($result);
//     $conn->close();
//     return $row;
// }

// function deleteCategory($id)
// {
//     $conn = connectDB();
//     $sql = "DELETE FROM products WHERE id = $id";
//     $conn->query($sql);
//     $conn->close();
// }
