<?php include "inc/header.php"; ?>

  <!-- Navbar -->
  <?php include "inc/topbar.php"; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "inc/menu.php"; ?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php
            if ( $_SESSION['role']  == 1 ){ ?>
              <?php

                  $do = isset( $_GET['do'] ) ? $_GET['do'] : 'Manage';

                  if ( $do == 'Manage' ){ ?>
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Manage All Users</h3>
                        </div>
                        <div class="card-body" style="display: block;">
                          
                          <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">#Sl.</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone</th>
                                <th scope="col">User Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">Join Date</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                                $sql = "SELECT * FROM users";
                                $allUsers = mysqli_query($db, $sql);
                                $i = 0;
                                while( $row = mysqli_fetch_assoc($allUsers) ){
                                  $id         = $row['id'];
                                  $name       = $row['name'];
                                  $email      = $row['email'];
                                  $password   = $row['password'];
                                  $address    = $row['address'];
                                  $phone      = $row['phone'];
                                  $role       = $row['role'];
                                  $status     = $row['status'];
                                  $image      = $row['image'];
                                  $join_date  = $row['join_date'];
                                  $i++;
                                  ?>

                                  <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td>
                                  <?php
                                    if ( !empty($image) ){ ?>
                                      <img src="img/users/<?php echo $image; ?>" class="table-img">
                                    <?php }
                                    else{ ?>
                                      <img src="img/users/default.png" class="table-img">
                                    <?php }
                                  ?>

                                  
                                </td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $address; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td>
                                  <?php
                                    if ( $role == 1 ){ ?>
                                      <span class="badge badge-success">Super Admin</span>
                                    <?php }
                                    else if ( $role == 2 ){ ?>
                                      <span class="badge badge-primary">Editor</span>
                                    <?php }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                    if ( $status == 0 ){ ?>
                                      <span class="badge badge-danger">Inactive</span>
                                    <?php }
                                    else if ( $status == 1 ){ ?>
                                      <span class="badge badge-success">Active</span>
                                    <?php }
                                  ?>
                                </td>
                                <td><?php echo $join_date; ?></td>
                                <td>
                                  <a class="btn btn-info btn-sm" href="users.php?do=Edit&edit=<?php echo $id; ?>">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      Edit
                                  </a>


                                  <?php
                                    if ( $role == 1 ){

                                    }
                                    else if ( $role == 2 ){ ?>
                                      <a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target="#delete<?php echo $id; ?>">
                                      <i class="fas fa-trash">
                                      </i>
                                      Delete
                                  </a>
                                    <?php }
                                  ?>
                                  


                                </td>
                              </tr>
              <!-- Delete Modal -->
              <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this User?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="delete-option text-center">
                        <ul>
                          <li><a href="users.php?do=Delete&delete=<?php echo $id; ?>" class="btn btn-danger">Delete</a></li>
                          <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                              <?php  }
                              ?>
                              
                              
                            </tbody>
                          </table>

                        </div>
                      </div>
                    </div>
                    
                  <?php }
                  else if ( $do == 'Add' ){ ?>
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Add New Users</h3>
                        </div>
                        <div class="card-body" style="display: block;">
                          <div class="row">
                            <div class="col-lg-6">
                              <form action="users.php?do=Insert" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label>Full Name</label>
                                  <input type="text" name="name" class="form-control" required="required">
                                </div>

                                <div class="form-group">
                                  <label>Email Address</label>
                                  <input type="email" name="email" class="form-control" required="required">
                                </div>

                                <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" name="password" class="form-control" required="required">
                                </div>

                                <div class="form-group">
                                  <label>Retype Password</label>
                                  <input type="password" name="repassword" class="form-control" required="required">
                                </div>

                                <div class="form-group">
                                  <label>Address</label>
                                  <input type="text" name="address" class="form-control" required="required">
                                </div>                     

                            </div>

                            <div class="col-lg-6">

                                

                                <div class="form-group">
                                  <label>Phone No.</label>
                                  <input type="text" name="phone" class="form-control" required="required">
                                </div>

                                <div class="form-group">
                                  <label>User Role</label>
                                  <select name="role" class="form-control">
                                    <option>Please Select User Role</option>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Editor</option>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label>Account Status</label>
                                  <select name="status" class="form-control">
                                    <option>Please Select User Account Status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label>Upload Image</label>
                                  <input type="file" name="image" class="form-control-file">
                                </div>

                                <div class="form-group">
                                  <input type="submit" name="addUser" class="btn btn-block btn-primary btn-flat" value="Register User">
                                </div>
                              </form>
                            </div>
                          </div>

                          

                          

                        </div>
                      </div>
                    </div>
                  <?php }

                  else if ( $do == 'Insert' ){
                    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                      $name         = $_POST['name'];
                      $email        = $_POST['email'];
                      $password     = $_POST['password'];
                      $repassword   = $_POST['repassword'];
                      $address      = $_POST['address'];
                      $phone        = $_POST['phone'];
                      $role         = $_POST['role'];
                      $status       = $_POST['status'];

                      // Preapre the Image
                      $imageName    = $_FILES['image']['name'];
                      $imageSize    = $_FILES['image']['size'];
                      $imageTmp     = $_FILES['image']['tmp_name'];

                      $imageAllowedExtension = array("jpg", "jpeg", "png");
                      $imageExtension = strtolower( end( explode('.', $imageName) ) );
                      
                      $formErrors = array();

                      if ( strlen($name) < 3 ){
                        $formErrors = 'Username is too short!!!';
                      }
                      if ( $password != $repassword ){
                        $formErrors = 'Password Doesn\'t match!!!';
                      }
                      if ( !empty($imageName) ){
                        if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                          $formErrors = 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image';
                        }
                        if ( !empty($imageSize) && $imageSize > 2097152 ){
                          $formErrors = 'Image Size is Too Large! Allowed Image size Max is 2 MB.';
                        }
                      }

                      // Print the Errors 
                      foreach( $formErrors as $error ){
                        echo '<div class="alert alert-warning">' . $error . '</div>';
                      }

                      if ( empty($formErrors) ){
                        // Encrypted Password
                        $hassedPass = sha1($password);


                        if ( !empty( $imageName ) ){
                            // Change the Image Name
                            $image = rand(0, 999999) . '_' .$imageName;
                            // Upload the Image to its own Folder Location
                            move_uploaded_file($imageTmp, "img\users\\" . $image );

                            $sql = "INSERT INTO users ( name, email, password, address, phone, role, status, image, join_date ) VALUES ('$name', '$email', '$hassedPass', '$address', '$phone', '$role', '$status', '$image', now() )";

                            $addUser = mysqli_query($db, $sql);

                            if ( $addUser ){
                              $_SESSION['toastr']['messege']    = array("User added successfully");
                              $_SESSION['toastr']['alertType']  = "success";
                              header("Location: users.php?do=Manage");
                              exit();
                            }
                            else{
                              die("MySQLi Query Failed." . mysqli_error($db));
                            }
                        }
                        else{
                          $sql = "INSERT INTO users ( name, email, password, address, phone, role, status, join_date ) VALUES ('$name', '$email', '$hassedPass', '$address', '$phone', '$role', '$status', now() )";

                            $addUser = mysqli_query($db, $sql);

                            if ( $addUser ){
                              $_SESSION['toastr']['messege']    = array("User added successfully");
                              $_SESSION['toastr']['alertType']  = "success";
                              header("Location: users.php?do=Manage");
                              exit();
                            }
                            else{
                              die("MySQLi Query Failed." . mysqli_error($db));
                            }

                        }


                        
                      }

                    }
                  }

                  else if ( $do == 'Edit' ){ 
                    if ( isset($_GET['edit']) ){
                      $editID = $_GET['edit'];

                      $sql = "SELECT * FROM users WHERE id = '$editID'";
                      $readUser = mysqli_query($db, $sql);
                      while( $row = mysqli_fetch_assoc($readUser) ){
                        $id         = $row['id'];
                        $name       = $row['name'];
                        $email      = $row['email'];
                        $password   = $row['password'];
                        $address    = $row['address'];
                        $phone      = $row['phone'];
                        $role       = $row['role'];
                        $status     = $row['status'];
                        $image      = $row['image'];
                        $join_date  = $row['join_date'];
                        ?>

                        <div class="col-lg-12">
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Update User Information</h3>
                            </div>
                            <div class="card-body" style="display: block;">
                              <div class="row">
                                <div class="col-lg-6">
                                  <form action="users.php?do=Update" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label>Full Name</label>
                                      <input type="text" name="name" class="form-control" required="required" value="<?php echo $name; ?>">
                                    </div>

                                    <div class="form-group">
                                      <label>Email Address</label>
                                      <input type="email" name="email" class="form-control" required="required" value="<?php echo $email; ?>">
                                    </div>

                                    <div class="form-group">
                                      <label>Password</label>
                                      <input type="password" name="password" class="form-control" placeholder="Change The Password">
                                    </div>

                                    <div class="form-group">
                                      <label>Retype Password</label>
                                      <input type="password" name="repassword" class="form-control" placeholder="Retype The Password">
                                    </div>

                                    <div class="form-group">
                                      <label>Address</label>
                                      <input type="text" name="address" class="form-control" required="required" value="<?php echo $address; ?>">
                                    </div>

                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label>Phone No.</label>
                                      <input type="text" name="phone" class="form-control" required="required" value="<?php echo $phone; ?>">
                                    </div>

                                    <div class="form-group">
                                      <label>User Role</label>
                                      <select name="role" class="form-control">
                                        <option>Please Select User Role</option>
                                        <option value="1" <?php if ( $role == 1 ){ echo 'selected'; } ?> >Super Admin</option>
                                        <option value="2" <?php if ( $role == 2 ){ echo 'selected'; } ?> >Editor</option>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label>Account Status</label>
                                      <select name="status" class="form-control">
                                        <option>Please Select User Account Status</option>
                                        <option value="0" <?php if ( $status == 0 ){ echo 'selected'; } ?> >Inactive</option>
                                        <option value="1" <?php if ( $status == 1 ){ echo 'selected'; } ?> >Active</option>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label>Upload Image</label>
                                      <?php
                                        if ( !empty($image) ){ ?>
                                          <img src="img/users/<?php echo $image; ?>" class="form-img">
                                        <?php }
                                        else{
                                          echo "No Image uploaded";
                                        }
                                      ?>
                                      <input type="file" name="image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                      <input type="hidden" name="updateUserID" value="<?php echo $id; ?>">
                                      <input type="submit" name="updateUser" class="btn btn-block btn-primary btn-flat" value="Save Changes">
                                    </div>
                                  </form>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>



                    <?php    
                      }// End while
                    }// End isset if
                  } // End Main if
                  else if ( $do == 'Update' ){
                    
                    // Update Start
                    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                      $updateUserID = $_POST['updateUserID'];
                      $name         = $_POST['name'];
                      $email        = $_POST['email'];
                      $password     = $_POST['password'];
                      $repassword   = $_POST['repassword'];
                      $address      = $_POST['address'];
                      $phone        = $_POST['phone'];
                      $role         = $_POST['role'];
                      $status       = $_POST['status'];
                      $imageName    = $_FILES['image']['name'];

                      if ( !empty($imageName) ){
                        // Preapre the Image
                      // $imageName    = $_FILES['image']['name'];
                      $imageSize    = $_FILES['image']['size'];
                      $imageTmp     = $_FILES['image']['tmp_name'];

                      $imageAllowedExtension = array("jpg", "jpeg", "png");
                      $imageExtension = strtolower( end( explode('.', $imageName) ) );
                      
                      $formErrors = array();

                      if ( strlen($name) < 3 ){
                        $formErrors = 'Username is too short!!!';
                      }
                      if ( $password != $repassword ){
                        $formErrors = 'Password Doesn\'t match!!!';
                      }
                      if ( !empty($imageName) ){
                        if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                          $formErrors = 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image';
                        }
                        if ( !empty($imageSize) && $imageSize > 2097152 ){
                          $formErrors = 'Image Size is Too Large! Allowed Image size Max is 2 MB.';
                        }
                      }
                      }

                      // Print the Errors 
                      foreach( $formErrors as $error ){
                        echo '<div class="alert alert-warning">' . $error . '</div>';
                      }

                      if ( empty($formErrors) ){


                        // Upload Image and Change the Password
                        if ( !empty($password) && !empty($imageName) ){
                          // Encrypted Password
                          $hassedPass = sha1($password);

                          // Delete the Existing Image while update the new image
                          $deleteImageSQL = "SELECT * FROM users WHERE id = '$updateUserID'";
                          $data = mysqli_query($db, $deleteImageSQL);
                          while( $row = mysqli_fetch_assoc($data) ){
                            $existingImage = $row['image'];
                          }
                          unlink('img/users/'. $existingImage);
                           
                          // Change the Image Name
                          $image = rand(0, 999999) . '_' .$imageName;
                          // Upload the Image to its own Folder Location
                          move_uploaded_file($imageTmp, "img\users\\" . $image );

                          $sql = "UPDATE users SET name='$name', email='$email', password='$hassedPass', address='$address', phone='$phone', role='$role', status='$status', image='$image' WHERE id = '$updateUserID' ";

                          $addUser = mysqli_query($db, $sql);

                          if ( $addUser ){
                            header("Location: users.php?do=Manage");
                          }
                          else{
                            die("MySQLi Query Failed." . mysqli_error($db));
                          }
                        }

                        // Change the Image Only
                        else if ( !empty($imageName) && empty($password) ){
                          // Delete the Existing Image while update the new image
                          $deleteImageSQL = "SELECT * FROM users WHERE id = '$updateUserID'";
                          $data = mysqli_query($db, $deleteImageSQL);
                          while( $row = mysqli_fetch_assoc($data) ){
                            $existingImage = $row['image'];
                          }
                          unlink('img/users/'. $existingImage);
                           
                          // Change the Image Name
                          $image = rand(0, 999999) . '_' .$imageName;
                          // Upload the Image to its own Folder Location
                          move_uploaded_file($imageTmp, "img\users\\" . $image );

                          $sql = "UPDATE users SET name='$name', email='$email', address='$address', phone='$phone', role='$role', status='$status', image='$image' WHERE id = '$updateUserID' ";

                          $addUser = mysqli_query($db, $sql);

                          if ( $addUser ){
                            header("Location: users.php?do=Manage");
                          }
                          else{
                            die("MySQLi Query Failed." . mysqli_error($db));
                          }
                        }
                        // Change the Password Only
                        else if ( !empty($password) && empty($imageName) ){
                          // Encrypted Password
                          $hassedPass = sha1($password);

                          $sql = "UPDATE users SET name='$name', email='$email', password='$hassedPass', address='$address', phone='$phone', role='$role', status='$status' WHERE id = '$updateUserID' ";

                          $addUser = mysqli_query($db, $sql);

                          if ( $addUser ){
                            header("Location: users.php?do=Manage");
                          }
                          else{
                            die("MySQLi Query Failed." . mysqli_error($db));
                          }
                        }
                        // No Password and Image Update
                        else{
                          $sql = "UPDATE users SET name='$name', email='$email', address='$address', phone='$phone', role='$role', status='$status' WHERE id = '$updateUserID' ";

                          $addUser = mysqli_query($db, $sql);

                          if ( $addUser ){
                            $_SESSION['toastr']['messege']    = array("User updated");
                            $_SESSION['toastr']['alertType']  = "success";
                            header("Location: users.php?do=Manage");
                            exit();
                          }
                          else{
                            die("MySQLi Query Failed." . mysqli_error($db));
                          }
                        }
                        
                      }

                    }
                    // Update End

                  }
                  else if ( $do == 'Delete' ){
                    
                    if (isset($_GET['delete'])){
                      $deleteID = $_GET['delete'];

                      // Delete the Existing Image while Delete the user account
                      $deleteImageSQL = "SELECT * FROM users WHERE id = '$deleteID'";
                      $data = mysqli_query($db, $deleteImageSQL);
                      while( $row = mysqli_fetch_assoc($data) ){
                        $existingImage = $row['image'];
                      }
                      if ( !empty($existingImage) ){
                        unlink('img/users/'. $existingImage);
                      }                      

                      // Delete the user data from db
                      $sql = "DELETE FROM users WHERE id = '$deleteID' AND role = 2";
                      $deleteUserData = mysqli_query($db, $sql);

                      if ( $deleteUserData ){
                        $_SESSION['toastr']['messege']    = array("User deleted successfully");
                        $_SESSION['toastr']['alertType']  = "success";
                        header("Location: users.php?do=Manage");
                        exit();
                      }
                      else{
                        die("MySQLi Query Failed." . mysqli_error($db));
                      }

                    }

                  }
                ?>
            <?php }
            else{
              echo '<div class="alert alert-warning">Sorry!!! You have no access in this page.</div>';
            }
          ?>

            

          
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Footer -->
  <?php include "inc/footer.php"; ?>

  <!-- Control Sidebar -->
  <?php include "inc/sidebar.php"; ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include "inc/script.php"; ?>


<!-- <div class="card">
  <div class="card-header">
    <h3 class="card-title">Manage All Users</h3>
  </div>
  <div class="card-body" style="display: block;">
  </div>
</div> -->