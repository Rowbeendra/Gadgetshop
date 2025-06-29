<?php
    require 'connection.php';
    session_start();
    
    // Check if user is admin
    if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1){
        header('location: index.php');
    }
    
    // Check if user ID is provided
    if(!isset($_GET['id'])){
        header('location: admin_users.php');
    }
    
    $user_id = $_GET['id'];
    
    // Handle user update
    if(isset($_POST['update_user'])){
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        
        // Update user
        $update_query = "UPDATE users SET name='$name', email='$email', contact='$contact', 
                        city='$city', address='$address' WHERE id='$user_id'";
        $update_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
        
        // If changing password
        if(!empty($_POST['password']) && strlen($_POST['password']) >= 6){
            $password = md5(md5(mysqli_real_escape_string($con, $_POST['password'])));
            $password_query = "UPDATE users SET password='$password' WHERE id='$user_id'";
            mysqli_query($con, $password_query) or die(mysqli_error($con));
        }
        
        // If current user is updating their own info, update session data
        if($user_id == $_SESSION['id']){
            $_SESSION['email'] = $email;
        }
        
        header('location: admin_users.php');
    }
    
    // Get user details
    $user_query = "SELECT * FROM users WHERE id='$user_id'";
    $user_result = mysqli_query($con, $user_query) or die(mysqli_error($con));
    
    if(mysqli_num_rows($user_result) == 0){
        header('location: admin_users.php');
    }
    
    $user = mysqli_fetch_array($user_result);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gadget Store - Edit User</title>
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
                                <h3>Edit User: <?php echo $user['name']; ?></h3>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="admin_edit_user.php?id=<?php echo $user_id; ?>" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Email:</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Contact:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="contact" value="<?php echo $user['contact']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">City:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="city" value="<?php echo $user['city']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Address:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="address" rows="3" required><?php echo $user['address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">New Password:</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                                            <span class="help-block">Minimum 6 characters. Leave blank to keep current password.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="update_user" class="btn btn-success">Update User</button>
                                            <a href="admin_users.php" class="btn btn-default">Cancel</a>
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