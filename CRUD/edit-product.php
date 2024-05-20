<?php
require_once('inc/header.php');
require_once('inc/nav.php');
require_once('database/conn.php');
require_once('core/functions.php');


?>

<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $db = new Database(); 
        $categories = $db->getAllCategories();
        $row = $db->findData('products', $id);
        // echo "<pre>";
        // print_r($row);
        // print_r($categories);
        // foreach ($categories as $category ){
        //     if ($row['category_id'] == $category['categ_id']) {
        //         echo "select<br>";
        //     }else{
        //         echo "not<br>";
        //     }
        // }
        // die;

        if(!$row){
            $errors = "Product Not Exists !";
            sessionStore('errors', $errors);
            redirectPath("Products.php");
            die;
        }
    }
?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="p-3 col text-center mt-5 text-white bg-warning text-dark rounded "> Edit Product </h2>
            </div>


            <div class="col-sm-12">
                <?php
                    if (isset($_SESSION['errors'])) :
                        foreach ($_SESSION['errors'] as $error) : ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $error; ?>
                            </div>
                    <?php
                        endforeach;
                        sessionRemove('errors');
                    endif;
                ?>

                <?php
                    if (isset($_SESSION['success'])) :
                        foreach ($_SESSION['success'] as $success) : ?>
                            <div class="alert alert-success text-center">
                                <?php 
                                    echo $success;
                                    header("refresh:1;url=products.php"); 
                                ?>
                            </div>
                    <?php
                        endforeach;
                        sessionRemove('success');
                    endif;
                ?>
            </div>

            <div class="col-sm-12">
                <form method="post" action="handlers/editProductHandlers.php?id=<?php echo $row['id']; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" id="name">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" value="<?php echo $row['description']; ?>" class="form-control" id="description">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Category Type</label>
                        <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                            <?php foreach ($categories as $category ) : ?>
                                <option <?= ($row['category_id'] == $category['categ_id'] ? "selected" : '') ?>  value='<?= $category['categ_id'] ; ?>'><?= $category['category_name'] ; ?></option>
                            <?php endforeach ; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="Enter Price" value="<?php echo $row['price']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        <img class="rounded mt-2" src="images/<?php echo $row['image']?>" alt="" style="width: 200px;">
                    </div>

                    <button type="submit" name="submit" class="btn btn-warning px-4">Edit</button>
                </form>
            </div>
        </div>
    </div>



<?php require_once('inc/footer.php'); ?>