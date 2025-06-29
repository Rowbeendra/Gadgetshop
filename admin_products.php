<?php
    require 'connection.php';
    session_start();
    
    // Check if user is admin
    if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1){
        header('location: index.php');
    }
    
    // Handle product deletion
    if(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];
        $delete_query = "DELETE FROM items WHERE id='$delete_id'";
        $delete_result = mysqli_query($con, $delete_query) or die(mysqli_error($con));
        header('location: admin_products.php');
    }
    
    // Handle product addition
    if(isset($_POST['add_product'])){
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $category = mysqli_real_escape_string($con, $_POST['category']);
        $brand = mysqli_real_escape_string($con, $_POST['brand']);
        $color = mysqli_real_escape_string($con, $_POST['color']);
        $material = mysqli_real_escape_string($con, $_POST['material']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $tags = mysqli_real_escape_string($con, $_POST['tags']);
        
        $add_query = "INSERT INTO items (name, price, category, brand, color, material, description, tags) 
                     VALUES ('$name', '$price', '$category', '$brand', '$color', '$material', '$description', '$tags')";
        $add_result = mysqli_query($con, $add_query) or die(mysqli_error($con));
        header('location: admin_products.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gadget Store - Admin Products</title>
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
                                <h3>Product Management</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4>Add New Product</h4>
                                        <form method="post" action="admin_products.php" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Name:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Price:</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="price" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Category:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="category" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Brand:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="brand" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Color:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="color" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Material:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="material" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Description:</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="description" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Tags:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="tags" placeholder="Comma separated tags">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="add_product" class="btn btn-success">Add Product</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4>Product List</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Category</th>
                                                        <th>Brand</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $products_query = "SELECT * FROM items ORDER BY id";
                                                    $products_result = mysqli_query($con, $products_query) or die(mysqli_error($con));
                                                    
                                                    while($row = mysqli_fetch_array($products_result)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td>₹<?php echo $row['price']; ?></td>
                                                        <td><?php echo $row['category']; ?></td>
                                                        <td><?php echo $row['brand']; ?></td>
                                                        <td>
                                                            <a href="admin_edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                            <a href="admin_products.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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