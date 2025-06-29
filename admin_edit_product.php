<?php
    require 'connection.php';
    session_start();
    
    // Check if user is admin
    if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1){
        header('location: index.php');
    }
    
    // Check if product ID is provided
    if(!isset($_GET['id'])){
        header('location: admin_products.php');
    }
    
    $product_id = $_GET['id'];
    
    // Handle product update
    if(isset($_POST['update_product'])){
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $category = mysqli_real_escape_string($con, $_POST['category']);
        $brand = mysqli_real_escape_string($con, $_POST['brand']);
        $color = mysqli_real_escape_string($con, $_POST['color']);
        $material = mysqli_real_escape_string($con, $_POST['material']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $tags = mysqli_real_escape_string($con, $_POST['tags']);
        
        $update_query = "UPDATE items SET name='$name', price='$price', category='$category', 
                         brand='$brand', color='$color', material='$material', 
                         description='$description', tags='$tags' WHERE id='$product_id'";
        $update_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
        header('location: admin_products.php');
    }
    
    // Get product details
    $product_query = "SELECT * FROM items WHERE id='$product_id'";
    $product_result = mysqli_query($con, $product_query) or die(mysqli_error($con));
    
    if(mysqli_num_rows($product_result) == 0){
        header('location: admin_products.php');
    }
    
    $product = mysqli_fetch_array($product_result);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gadget Store - Edit Product</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3>Edit Product: <?php echo $product['name']; ?></h3>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="admin_edit_product.php?id=<?php echo $product_id; ?>" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" value="<?php echo $product['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Price:</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="price" value="<?php echo $product['price']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Category:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="category" value="<?php echo $product['category']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Brand:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="brand" value="<?php echo $product['brand']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Color:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="color" value="<?php echo $product['color']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Material:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="material" value="<?php echo $product['material']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Description:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="description" rows="3" required><?php echo $product['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Tags:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tags" value="<?php echo $product['tags']; ?>" placeholder="Comma separated tags">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="update_product" class="btn btn-success">Update Product</button>
                                            <a href="admin_products.php" class="btn btn-default">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
               <div class="container">
               <center>
                   <p>This website is developed by Salin Maharjan</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html> 