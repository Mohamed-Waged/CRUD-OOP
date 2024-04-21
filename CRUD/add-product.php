<?php 
require_once('inc/header.php'); 
require_once('inc/nav.php'); 
require_once("core/functions.php") ; 
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary"> Add New Product </h2>
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
                            <?php echo $success; ?>
                        </div>
                <?php
                    endforeach;
                    sessionRemove('success');
                    endif;
            ?>

        </div>

        <div class="col-sm-12">
            <form method="POST" action="handlers/addCategoryHandlers.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="<?php if (isset($name)) echo $name ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control" id="description" placeholder="Enter Description" value="<?php if (isset($description)) echo $description ?>">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Category Type</label>
                    <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                        <option value=''>Choose Category</option>
                        <option value="1">Main Category</option>
                        <option value="2">Sub Category</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="Enter Price" value="<?php if (isset($price)) echo $price ?>">
                </div>
                    
                <div class="form-group">
					<label>Image</label>
					<input type="file" name="image" class="form-control">
				</div>

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>


<?php require_once('inc/footer.php'); ?>