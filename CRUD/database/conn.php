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
    public function readData(){
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

     // Read All Categories From DB
    public function getAllCategories(){
        $sql = "SELECT * FROM `categories` ";
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