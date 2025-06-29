<?php
    require 'connection.php';
    session_start();
    
    // Check if user is admin
    if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1){
        header('location: index.php');
    }
    
    // Handle order status change
    if(isset($_GET['update_id']) && isset($_GET['status'])){
        $order_id = $_GET['update_id'];
        $status = $_GET['status'];
        
        $update_query = "UPDATE users_items SET status='$status' WHERE id='$order_id'";
        mysqli_query($con, $update_query) or die(mysqli_error($con));
    }
    
    // Handle order deletion
    if(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];
        $delete_query = "DELETE FROM users_items WHERE id='$delete_id'";
        mysqli_query($con, $delete_query) or die(mysqli_error($con));
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gadget Store - Order Management</title>
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
                                <h3>Order Management</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#all_orders">All Orders</a></li>
                                    <li><a data-toggle="tab" href="#cart_items">Cart Items</a></li>
                                    <li><a data-toggle="tab" href="#confirmed_orders">Confirmed Orders</a></li>
                                </ul>
                                
                                <div class="tab-content" style="margin-top: 20px;">
                                    <div id="all_orders" class="tab-pane fade in active">
                                        <h4>All Orders</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>User</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $orders_query = "SELECT ui.id as order_id, u.id as user_id, u.name as user_name, 
                                                                    i.id as item_id, i.name as item_name, i.price as item_price, 
                                                                    ui.status as order_status 
                                                                    FROM users_items ui 
                                                                    JOIN users u ON ui.user_id = u.id 
                                                                    JOIN items i ON ui.item_id = i.id 
                                                                    ORDER BY ui.id DESC";
                                                    $orders_result = mysqli_query($con, $orders_query) or die(mysqli_error($con));
                                                    
                                                    while($row = mysqli_fetch_array($orders_result)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['order_id']; ?></td>
                                                        <td>
                                                            <a href="admin_edit_user.php?id=<?php echo $row['user_id']; ?>">
                                                                <?php echo $row['user_name']; ?> (ID: <?php echo $row['user_id']; ?>)
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="admin_edit_product.php?id=<?php echo $row['item_id']; ?>">
                                                                <?php echo $row['item_name']; ?>
                                                            </a>
                                                        </td>
                                                        <td>₹<?php echo $row['item_price']; ?></td>
                                                        <td>
                                                            <?php if($row['order_status'] == 'Added to cart'): ?>
                                                                <span class="label label-warning">In Cart</span>
                                                            <?php else: ?>
                                                                <span class="label label-success">Confirmed</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($row['order_status'] == 'Added to cart'): ?>
                                                                <a href="admin_orders.php?update_id=<?php echo $row['order_id']; ?>&status=Confirmed" class="btn btn-success btn-sm">Confirm Order</a>
                                                            <?php else: ?>
                                                                <a href="admin_orders.php?update_id=<?php echo $row['order_id']; ?>&status=Added to cart" class="btn btn-warning btn-sm">Move to Cart</a>
                                                            <?php endif; ?>
                                                            <a href="admin_orders.php?delete_id=<?php echo $row['order_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div id="cart_items" class="tab-pane fade">
                                        <h4>Cart Items</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>User</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $cart_query = "SELECT ui.id as order_id, u.id as user_id, u.name as user_name, 
                                                                  i.id as item_id, i.name as item_name, i.price as item_price 
                                                                  FROM users_items ui 
                                                                  JOIN users u ON ui.user_id = u.id 
                                                                  JOIN items i ON ui.item_id = i.id 
                                                                  WHERE ui.status='Added to cart' 
                                                                  ORDER BY ui.id DESC";
                                                    $cart_result = mysqli_query($con, $cart_query) or die(mysqli_error($con));
                                                    
                                                    while($row = mysqli_fetch_array($cart_result)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['order_id']; ?></td>
                                                        <td>
                                                            <a href="admin_edit_user.php?id=<?php echo $row['user_id']; ?>">
                                                                <?php echo $row['user_name']; ?> (ID: <?php echo $row['user_id']; ?>)
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="admin_edit_product.php?id=<?php echo $row['item_id']; ?>">
                                                                <?php echo $row['item_name']; ?>
                                                            </a>
                                                        </td>
                                                        <td>₹<?php echo $row['item_price']; ?></td>
                                                        <td>
                                                            <a href="admin_orders.php?update_id=<?php echo $row['order_id']; ?>&status=Confirmed" class="btn btn-success btn-sm">Confirm Order</a>
                                                            <a href="admin_orders.php?delete_id=<?php echo $row['order_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div id="confirmed_orders" class="tab-pane fade">
                                        <h4>Confirmed Orders</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>User</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $confirmed_query = "SELECT ui.id as order_id, u.id as user_id, u.name as user_name, 
                                                                       i.id as item_id, i.name as item_name, i.price as item_price 
                                                                       FROM users_items ui 
                                                                       JOIN users u ON ui.user_id = u.id 
                                                                       JOIN items i ON ui.item_id = i.id 
                                                                       WHERE ui.status='Confirmed' 
                                                                       ORDER BY ui.id DESC";
                                                    $confirmed_result = mysqli_query($con, $confirmed_query) or die(mysqli_error($con));
                                                    
                                                    while($row = mysqli_fetch_array($confirmed_result)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['order_id']; ?></td>
                                                        <td>
                                                            <a href="admin_edit_user.php?id=<?php echo $row['user_id']; ?>">
                                                                <?php echo $row['user_name']; ?> (ID: <?php echo $row['user_id']; ?>)
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="admin_edit_product.php?id=<?php echo $row['item_id']; ?>">
                                                                <?php echo $row['item_name']; ?>
                                                            </a>
                                                        </td>
                                                        <td>₹<?php echo $row['item_price']; ?></td>
                                                        <td>
                                                            <a href="admin_orders.php?update_id=<?php echo $row['order_id']; ?>&status=Added to cart" class="btn btn-warning btn-sm">Move to Cart</a>
                                                            <a href="admin_orders.php?delete_id=<?php echo $row['order_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
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