<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- <link rel="shortcut icon" href="img/lifestyleStore.png" /> -->
        <title>Gadget Store</title>
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
           <div id="bannerImage">
               <div class="container">
                   <center>
                   <div id="bannerContent">
                       <h1>Welcome to my Gadget Shop</h1>
                       <!-- <p>Flat 40% OFF on all premium brands.</p> -->
                       <a href="products.php" class="btn btn-danger">Shop Now</a>
                   </div>
                   </center>
               </div>
           </div>
           
           <?php
           // Display admin panel if the user is an admin
           if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1){
           ?>
           <div class="container">
               <div class="row">
                   <div class="col-xs-12">
                       <div class="panel panel-primary">
                           <div class="panel-heading">
                               <h3>Admin Dashboard</h3>
                           </div>
                           <div class="panel-body">
                               <div class="row">
                                   <div class="col-xs-4">
                                       <div class="panel panel-info">
                                           <div class="panel-heading">
                                               <h4>Product Management</h4>
                                           </div>
                                           <div class="panel-body">
                                               <a href="admin_products.php" class="btn btn-info btn-block">Manage Products</a>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-xs-4">
                                       <div class="panel panel-success">
                                           <div class="panel-heading">
                                               <h4>User Management</h4>
                                           </div>
                                           <div class="panel-body">
                                               <a href="admin_users.php" class="btn btn-success btn-block">Manage Users</a>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-xs-4">
                                       <div class="panel panel-warning">
                                           <div class="panel-heading">
                                               <h4>Order Management</h4>
                                           </div>
                                           <div class="panel-body">
                                               <a href="admin_orders.php" class="btn btn-warning btn-block">Manage Orders</a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <?php
           }
           ?>
           
           <!-- <div class="container">
               <div class="row">
                   <div class="col-xs-4">
                       <div  class="thumbnail">
                           <a href="products.php">
                                <img src="img/camera.jpg" alt="Camera">
                           </a>
                           <center>
                                <div class="caption">
                                        <p id="autoResize">Cameras</p>
                                        <p>Choose among the best available in the world.</p>
                                </div>
                           </center>
                       </div>
                   </div>
                   <div class="col-xs-4">
                       <div class="thumbnail">
                           <a href="products.php">
                               <img src="img/watch.jpg" alt="Watch">
                           </a>
                           <center>
                                <div class="caption">
                                    <p id="autoResize">Watches</p>
                                    <p>Original watches from the best brands.</p>
                                </div>
                           </center>
                       </div>
                   </div>
                   <div class="col-xs-4">
                       <div class="thumbnail">
                           <a href="products.php">
                               <img src="img/shirt.jpg" alt="Shirt">
                           </a>
                           <center>
                               <div class="caption">
                                   <p id="autoResize">Shirts</p>
                                   <p>Our exquisite collection of shirts.</p>
                               </div>
                           </center>
                       </div>
                   </div>
               </div>
           </div> -->
            <br><br> <br><br><br><br>
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