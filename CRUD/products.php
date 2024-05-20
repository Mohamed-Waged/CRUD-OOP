<?php 
require_once('inc/header.php');  
require_once('inc/nav.php'); 
require_once("core/functions.php") ;
require_once("database/conn.php") ;

// $result = getAllCategories();
?>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary"> All Products </h2>
        </div>
        

        <?php $db = new Database(); ?>
        <?php if (count($db->readData())) : ?>
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Decription</th>
                            <th>Category Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php // while ($row = mysqli_fetch_assoc($result)) : ?>
                        <?php foreach ($db->readData() as $row) : ?>
                            <tr>
                                <td><?php echo $row['id'];  ?></td>
                                <td><?php echo $row['name'];  ?></td>
                                <td><?php echo $row['description'];  ?></td>
                                <td><?php echo $row['category_name'];  ?></td>
                                <td><?php echo '330 L.E';  ?></td>
                                <td>
                                    <img src="images/<?php echo $row['image']?>" alt="" style="width: 100px; height: 100px;">
                                </td>
                                <td>
                                    <a href="edit-product.php?id=<?php echo $row['id'] ?>" class="text-primary">
                                        <i class="fa fa-pencil-square-o fa-2x"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="delete-product.php?id=<?php echo $row['id'] ?>" class="text-danger">
                                        <i class="fa fa-times fa-2x"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="col-sm-12">
                <h3 class="alert alert-danger mt-5 text-center"> No Products Found </h3>
            </div>
        <?php endif ; ?>
    </div>
</div>



<?php require_once('inc/footer.php'); ?>