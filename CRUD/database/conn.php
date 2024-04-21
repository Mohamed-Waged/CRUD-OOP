<?php

class Database{

    private $servername="localhost";
    private $username="root";
    private $password="";
    private $dbname ="eraasoft";
    private $conn;

    private $successAdd = "Product Added Successfully";
    private $updatedSuccess = "Product Updated Successfully";
    private $deletedSuccess = "Product Deleted Successfully";



    public function __construct(){
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password ,$this->dbname);
        if(!$this->conn)
        {
            die("Error In Connection To DB". mysqli_connect_error());
        }
    
    }

    // Insert New Record In DB
    public function insertData($sql){
        if ($this->conn->query($sql)) {
            return $this->successAdd;
        } else {
            return "SQl Error : ";
        }
    }

    // Read Data From DB
    public function readData($table){
        // $sql = "SELECT * FROM $table";
        $sql = "SELECT `id`,`name`,`description`,`price`,`image`,`category_name`
                FROM `products`,`categories`
                WHERE `categories`.`categ_id`=`products`.`category_id`";
        $result = mysqli_query($this->conn, $sql);
        $array = array();
        if (mysqli_query($this->conn, $sql)) 
        {
            if (mysqli_num_rows($result) > 0) 
            {
                while ($row = mysqli_fetch_assoc($result)) 
                {
                    $array[] = $row;
                }
            } 
            return $array;
        }
        else 
        {
            return  die("Error : " . mysqli_error($this->conn));
        }
    }

    //  Get Data Of Specific Item 
    public function findData($table, $id){
        $id = filter_var($id,FILTER_VALIDATE_INT);
        $sql = "SELECT * FROM $table WHERE `id`='$id'";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_query($this->conn,$sql))
        { 
            if (mysqli_num_rows($result) > 0) 
            {
                return mysqli_fetch_assoc($result);
            }
            else 
            {
                return false;
            }
        }
        else 
        {
            return die("Error : ".mysqli_error($this->conn));
        }

    }

    // Update Data In DB 
    public function updateData($sql){
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_query($this->conn,$sql))
        { 
            return $this->updatedSuccess;
        }
        else 
        {
            return die("Error : ".mysqli_error($this->conn));
        }
    }


    // Delete Data From DB 
    public function deleteData($table, $id){
        $sql = "DELETE FROM $table WHERE `id`='$id' ";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_query($this->conn,$sql))
        { 
            return $this->deletedSuccess;
        }
        else 
        {
            return die("Error : ".mysqli_error($this->conn));
        }
    }

}

// // create connection 
// $host = "localhost";
// $user =  "root";
// $password = "";
// $dbname = "eraasoft";
// $conn = new mysqli($host, $user, $password);

// // create db 
// $sql = "CREATE DATABASE IF NOT EXISTS `$dbname`";
// $conn->query($sql);
// $conn->close();

// // create categories table 
// $conn = new mysqli($host, $user, $password, $dbname);
// $sql = 'CREATE TABLE IF NOT EXISTS `categories` (
//             `cat_id` INT(11) AUTO_INCREMENT PRIMARY KEY,
//             `category_name` VARCHAR(50) NOT NULL UNIQUE
//         );';

// $conn->query($sql);
// $conn->close();

// // create Products table 
// $conn = new mysqli($host, $user, $password, $dbname);
// $sql = 'CREATE TABLE IF NOT EXISTS `products` (
//             `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
//             `name` VARCHAR(50) NOT NULL,
//             `description` TEXT NOT NULL,
//             `price` INT(11) NOT NULL,
//             `image` VARCHAR(255) NOT NULL,
//             `category_id` INT(11),

//             FOREIGN KEY (`category_id`) REFERENCES `categories` (`cat_id`)
//         );';

// $conn->query($sql);
// $conn->close();