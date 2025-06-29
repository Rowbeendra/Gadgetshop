<?php
    require 'connection.php';
    session_start();
    
    // Check if user is admin
    if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1){
        header('location: index.php');
    }
    
    // Handle user deletion
    if(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];
        
        // Don't allow deleting yourself
        if($delete_id == $_SESSION['id']){
            echo "<script>alert('You cannot delete your own account!');</script>";
        } else {
            // Delete user's cart items first (foreign key constraint)
            $delete_cart_query = "DELETE FROM users_items WHERE user_id='$delete_id'";
            mysqli_query($con, $delete_cart_query) or die(mysqli_error($con));
            
            // Delete user
            $delete_query = "DELETE FROM users WHERE id='$delete_id'";
            mysqli_query($con, $delete_query) or die(mysqli_error($con));
        }
    }
    
    // Handle admin status toggle
    if(isset($_GET['toggle_admin']) && isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $admin_status = $_GET['toggle_admin'];
        
        // Don't allow removing admin status from yourself
        if($user_id == $_SESSION['id'] && $admin_status == 0){
            echo "<script>alert('You cannot remove your own admin privileges!');</script>";
        } else {
            $update_query = "UPDATE users SET is_admin='$admin_status' WHERE id='$user_id'";
            mysqli_query($con, $update_query) or die(mysqli_error($con));
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gadget Store - User Management</title>
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
                                <h3>User Management</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4>User List</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Contact</th>
                                                        <th>City</th>
                                                        <th>Admin</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $users_query = "SELECT * FROM users ORDER BY id";
                                                    $users_result = mysqli_query($con, $users_query) or die(mysqli_error($con));
                                                    
                                                    while($row = mysqli_fetch_array($users_result)){
                                                        $is_current_user = ($row['id'] == $_SESSION['id']);
                                                    ?>
                                                    <tr <?php if($is_current_user) echo 'class="success"'; ?>>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['name']; ?> <?php if($is_current_user) echo '<span class="label label-info">You</span>'; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['contact']; ?></td>
                                                        <td><?php echo $row['city']; ?></td>
                                                        <td>
                                                            <?php if($row['is_admin'] == 1): ?>
                                                                <span class="label label-success">Admin</span>
                                                                <?php if(!$is_current_user): ?>
                                                                    <a href="admin_users.php?toggle_admin=0&user_id=<?php echo $row['id']; ?>" class="btn btn-xs btn-warning" onclick="return confirm('Remove admin privileges from this user?')">Remove Admin</a>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <span class="label label-default">User</span>
                                                                <a href="admin_users.php?toggle_admin=1&user_id=<?php echo $row['id']; ?>" class="btn btn-xs btn-info" onclick="return confirm('Make this user an admin?')">Make Admin</a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <a href="admin_edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                            <?php if(!$is_current_user): ?>
                                                                <a href="admin_users.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                                            <?php endif; ?>
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