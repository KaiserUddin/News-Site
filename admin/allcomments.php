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
              <li class="breadcrumb-item active">Manage All comments</li>
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
            if($_SESSION['role'] == 1){?>
              <?php

$do = isset( $_GET['do'] ) ? $_GET['do'] : 'Manage';

if ( $do == 'Manage' ){ ?>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Manage All Comments</h3>
      </div>
      <div class="card-body" style="display: block;">
        
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#Sl.</th>
              <th scope="col">Post Title</th>
              <th scope="col">Full Name</th>
              <th scope="col">Email ID</th>
              <th scope="col">comments</th>
              <th scope="col">Status</th>
              <th scope="col">Date</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
              $sql = "SELECT * FROM comments WHERE cmt_status = 0 OR cmt_status = 1 ORDER BY cmt_id DESC";
              $allComments = mysqli_query($db, $sql);
              $i = 0;
              while( $row = mysqli_fetch_assoc($allComments) ){
                $cmt_id               = $row['cmt_id'];
                $cmt_desc             = $row['cmt_desc'];
                $cmt_post_id          = $row['cmt_post_id'];
                $cmt_author           = $row['cmt_author'];
                $cmt_author_email     = $row['cmt_author_email'];
                $cmt_status           = $row['cmt_status'];
                $cmt_date             = $row['cmt_date'];
                $i++;
                ?>

                <tr>
              <th scope="row"><?php echo $i; ?></th>
              <td>
                
                <?php 
                  $sql = "SELECT * FROM post WHERE post_id = '$cmt_post_id'";
                  $post_title_by_id = mysqli_query($db, $sql);
                  while($row = mysqli_fetch_assoc($post_title_by_id)){
                    $post_id    = $row['post_id'];
                    $post_title = $row['title'];

                    echo $post_title;
                  }
                ?>
                
              </td>
              <td><?php echo $cmt_author; ?></td>
              <td><?php echo $cmt_author_email; ?></td>
              <td><?php echo $cmt_desc; ?></td>
              <td>
                <?php
                  if ( $cmt_status == 0 ){ ?>
                    <span class="badge badge-warning">Draft</span>
                  <?php }
                  else if ( $cmt_status == 1 ){ ?>
                    <span class="badge badge-success">Published</span>
                  <?php }
                  else if( $cmt_status == 2 ){ ?>
                    <span class="badge badge-danger">Suspended</span>
                  <?php }
                ?>
              </td>
              
              <td><?php echo $cmt_date; ?></td>
              <td>
                <a class="btn btn-info btn-sm" href="allcomments.php?do=Edit&edit=<?php echo $cmt_id; ?>">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                </a>


                <a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target="#delete<?php echo $cmt_id; ?>">
                  <i class="fas fa-trash">
                  </i>
                  Delete
                </a>
                


              </td>
            </tr>
<!-- Delete Modal -->
<div class="modal fade" id="delete<?php echo $cmt_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this comment?</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="delete-option text-center">
<ul>
<li><a href="allcomments.php?do=Delete&delete=<?php echo $cmt_id; ?>" class="btn btn-danger">Delete</a></li>
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


/* else if ( $do == 'Insert' ){
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

      if(!empty($imageName)){
          // Change the Image Name
        $image = rand(0, 999999) . '_' .$imageName;
        // Upload the Image to its own Folder Location
        move_uploaded_file($imageTmp, "img\users\\" . $image );

        $sql = "INSERT INTO users ( name, email, password, address, phone, role, status, image, join_date ) VALUES ('$name', '$email', '$hassedPass', '$address', '$phone', '$role', '$status', '$image', now() )";

        $addUser = mysqli_query($db, $sql);

        if ( $addUser ){
          header("Location: users.php?do=Manage");
        }
        else{
          die("MySQLi Query Failed." . mysqli_error($db));
        }
      }
      else{
        $sql = "INSERT INTO users ( name, email, password, address, phone, role, status, image, join_date ) VALUES ('$name', '$email', '$hassedPass', '$address', '$phone', '$role', '$status', '$image', now() )";

        $addUser = mysqli_query($db, $sql);

        if ( $addUser ){
          header("Location: users.php?do=Manage");
        }
        else{
          die("MySQLi Query Failed." . mysqli_error($db));
        }
      }
      

      
    }

  }
} */

else if ( $do == 'Edit' ){ 
  if ( isset($_GET['edit']) ){
    $the_comment_id = $_GET['edit'];

    $sql = "SELECT * FROM comments WHERE cmt_id = '$the_comment_id'";
    $readComment = mysqli_query($db, $sql);
    while( $row = mysqli_fetch_assoc($readComment) ){
      $cmt_id               = $row['cmt_id'];
      $cmt_status           = $row['cmt_status'];
    ?>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Draft/Published Comment</h3>
          </div>
          <div class="card-body" style="display: block;">
            <div class="row">
              <div class="col-md-6">
                <form action="?do=Update" method="POST" enctype="multipart/form-data">
                  
                <div class="form-group">
                  <label>Comment Status</label>
                  <select name="cmt_status" class="form-control">
                    <option>Please Select Comment Status</option>
                    <option value="0" <?php if ( $cmt_status == 0 ){ echo 'selected'; } ?> >Draft</option>
                    <option value="1" <?php if ( $cmt_status == 1 ){ echo 'selected'; } ?> >Published</option>
                    <option value="2" <?php if ( $cmt_status == 2 ){ echo 'selected'; } ?> >Deleted</option>
                  </select>
                </div>

                <div class="form-group">
                  <input type="hidden" name="cmt_id" value="<?php echo $cmt_id; ?>">
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
    $updateCommentID   = $_POST['cmt_id'];
    $cmt_status        = $_POST['cmt_status'];
    

    $sql = "UPDATE comments SET cmt_status='$cmt_status' WHERE cmt_id = '$updateCommentID' ";

    $updateCommentStatus = mysqli_query($db, $sql);

    if ( $updateCommentStatus ){
      header("Location: allcomments.php?do=Manage");
    }
    else{
      die("MySQLi Query Failed." . mysqli_error($db));
    }
   

  }
  // Update End

}
else if ( $do == 'Delete' ){
  
  if (isset($_GET['delete'])){
    $the_Delete_Comment_ID = $_GET['delete'];
    
    $sql = "UPDATE comments SET cmt_status= 2 WHERE cmt_id = '$the_Delete_Comment_ID' ";
    $updateCommentStatus = mysqli_query($db, $sql);

    
    if ( $updateCommentStatus ){
      header("Location: allcomments.php?do=Manage");
    }
    else{
      die("MySQLi Query Failed." . mysqli_error($db));
    }

  }

}

?>
            <?php }
            else{
              echo '<div class="alert alert-warning">Sorry!! You have no access in this page.</div>';
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