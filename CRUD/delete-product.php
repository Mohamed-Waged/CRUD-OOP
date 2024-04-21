<?php 
require_once('inc/header.php'); 
require_once('inc/nav.php'); 
require_once('core/functions.php'); 
require_once('database/conn.php'); 

$db = new Database(); 
$row = $db->findData('products', $_GET['id']); 

    if (isset($_GET['id']) && isset($row)) {
        $db->deleteData('products', $row['id']); 
        $success = "Product Deleted Succesfully";
        sessionStore('success', $success);
        unlink("./images/$row[image]");
    } else {
        $errors = "Product Not Exists";
        sessionStore('errors', $errors);
    }
    header("refresh:1;url=products.php"); 
?>

<?php if (isset($_GET['id']) && is_numeric($_GET['id']) && $row) :  ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="p-3 col text-center mt-5 text-white bg-primary">  Delete Product </h2>
            </div>

            <div class="col-sm-12">
                <h3 class="alert alert-success mt-5 text-center">
                    <?php   
                        echo $_SESSION['success'];
                        sessionRemove('success');
                    ?>
                    
                </h3>
            </div>
        </div>
    </div>

<?php else : ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="alert alert-danger mt-5 text-center"> Product ID Not Found </h3>
            </div>
        </div>
    </div>


<?php endif;  ?>

<?php require_once('inc/footer.php'); ?>