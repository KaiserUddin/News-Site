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
        <div class="row md-12">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Category</li>
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
            <!-- Left side -->
            <div class="col-lg-6">
             <!-- Add New category start -->
              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Add New Category</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                  </div>
                      <div class="card-body" style="display: block">
                        <form action="" method="POST">
                          <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" autocomplete="off" required="required">
                          </div>
                          <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="desc" class="form-control"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="">Primary Category</label>
                            <select name="is_parent" class="form-control">
                              <option value="0">Please select the Primary category</option>
                              <?php 
                                $query = "SELECT * FROM category WHERE is_parent = 0";
                                $primary_category = mysqli_query($db, $query);
                                while($row=mysqli_fetch_assoc($primary_category)){
                                  $cat_id   = $row['cat_id'];
                                  $cat_name = $row['cat_name'];
                                  ?>
                                    <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?> </option>
                                <?php }
                              ?>  
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" class="form-control">
                              <option value="1">Please select the category status</option>
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <input type="submit" name="addCategory" class="btn btn-block btn-primary btn-flat" value="Add New Category">
                          </div>
                        </form>
                      </div>
                    <!-- /.card-body -->
              </div>
              <!-- Add New category end -->

              <?php
              
                // Register New Category
                if(isset($_POST['addCategory'])) {
                  $name        = $_POST['name'];
                  $desc        = $_POST['desc'];
                  $is_parent   = $_POST['is_parent'];
                  $status      = $_POST['status'];

                  $sql="INSERT INTO category (cat_name, cat_desc, is_parent, cat_status) value('$name', '$desc', '$is_parent', '$status')";

                  $AddSuccess = mysqli_query($db,$sql);

                  if($AddSuccess) {
                    $_SESSION['toastr']['messege']    = array("category added successfully");
                    $_SESSION['toastr']['alertType']  = "success";
                    header("Location: category.php");
                    exit();
                  }
                  else{
                    die("MySQL connection failed." . mysqli_error($db));
                
                  }
                }
              
              ?>


            </div>

            <!-- Right side -->
            <div class="col-lg-6">
                
                <!-- Edit form start -->
                    <?php
                      
                      if (isset ( $_GET['edit'] )) {
                        $editId= $_GET['edit'];

                        $sql= "SELECT * FROM category WHERE cat_id='$editId'";
                        $editCat= mysqli_query($db, $sql);
                        while ( $row= mysqli_fetch_assoc($editCat) ) {
                          $cat_id      = $row['cat_id'];
                          $cat_name    = $row['cat_name'];
                          $cat_desc    = $row['cat_desc'];
                          $is_parent   = $row['is_parent'];
                          $status      = $row['cat_status'];
                          ?>
                        
                        <div class="card">
                         <div class="card-header">
                            <h3 class="card-title">Update Category Information</h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                              </button>
                            </div>
                         </div>
                          <div class="card-body" style="display: block">
                            <form action="" method="POST">
                              <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" autocomplete="off" required="required" value= "<?php echo $cat_name; ?>">
                              </div>
                              <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="desc" class="form-control"><?php echo $cat_desc; 
                                ?></textarea>
                              </div>
                              <div class="form-group">
                                <label for="">Primary Category</label>
                                <select name="is_parent" class="form-control">
                                  <option value="0">Please select the Primary category</option>
                                  <?php 
                                    $query = "SELECT * FROM category WHERE is_parent = '0'";
                                    $primary_category = mysqli_query($db, $query);
                                    while($row=mysqli_fetch_assoc($primary_category)){
                                      $editPrimaryCategoryID   = $row['cat_id'];
                                      $cat_name = $row['cat_name'];
                                      ?>
                                        <option value="<?php echo $editPrimaryCategoryID; ?>"<?php if( $editPrimaryCategoryID == $is_parent ){ echo 'selected'; } ?>><?php echo $cat_name; ?> </option>
                                    <?php }
                                  ?>  
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                  <option value="1">Please select the category status</option>
                                  <option value="1" <?php if( $status==1 ) { echo 'selected'; } ?> >Active</option>
                                  <option value="0" <?php if( $status==0 ) { echo 'selected'; } ?> >Inactive</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <input type="hidden" name="updateID" value="<?php echo $cat_id; 
                                ?>">
                                <input type="submit" name="updateCategory" class="btn btn-block btn-primary btn-flat" value="Save Changes">
                              </div>
                            </form>
                          </div>
                         <!-- /.card-body -->
                        </div>

                        
                          <?php }
                          }
                        ?>

                        <?php
                        // Update ctegory info
                        if(isset ($_POST['updateCategory'])){
                          $name        = $_POST['name'];
                          $desc        = $_POST['desc'];
                          $is_parent   = $_POST['is_parent'];
                          $status      = $_POST['status'];
                          $updateID    = $_POST['updateID'];

                          $sql= "UPDATE category SET cat_name='$name', cat_desc='$desc', is_parent='$is_parent', cat_status='$status' WHERE cat_id='$updateID' ";

                          $updateSuccess = mysqli_query($db,$sql);

                            if($updateSuccess) {
                              header("Location: category.php");
                            }
                            else{
                              die("MySQL connection failed." . mysqli_error($db));
                          
                            }

                         }
                        ?>

                <!-- Edit form end -->



                <!-- All category start -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Manage All Category</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                    <div class="card-body p-0" style="display:block;">

                      <table class="table table-striped projects">
                          <thead>
                              <tr>
                                  <th style="width: 10%">
                                    #SL.
                                  </th>
                                  <th style="width: 20%">
                                    Category Name
                                  </th>
                                  <th style="width: 20%">
                                    Primary Category
                                  </th>
                                  <th style="width: 20%">
                                    Status
                                  </th>
                                  <th style="width: 30%">
                                    Action
                                  </th>
                              </tr>
                          </thead>
                          <tbody>

                            <?php
                            
                              $sql= "SELECT * FROM category";
                              $allCat= mysqli_query($db,$sql);
                              $i= 0;
                              while ( $row= mysqli_fetch_assoc($allCat) ) {
                                $cat_id     =$row['cat_id'];
                                $cat_name   =$row['cat_name'];
                                $cat_desc   =$row['cat_desc'];
                                $is_parent  =$row['is_parent'];
                                $status     =$row['cat_status'];
                                $i++;
                                ?>
                              

                              <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $cat_name; ?></td>
                                  <td>
                                    <?php 
                                      if( $is_parent == 0 ){?>
                                        <div class="badge badge-primary"> Primary Category </div>
                                      <?php }
                                      else{
                                        $query = "SELECT * FROM category WHERE cat_id = '$is_parent'";
                                        $primary_cat = mysqli_query($db, $query);
                                        while($row=mysqli_fetch_assoc($primary_cat)){
                                          $p_cat_id   = $row['cat_id'];
                                          $cat_name = $row['cat_name'];
                                          ?>
                                            <div class="badge badge-info" > <?php echo $cat_name;?> </div>

                                        <?php }
                                      }
                                    ?> 
                                  </td>
                                  <td>
                                    <?php
                                      
                                      if( $status == 0 ) { ?>
                                        <span class="badge badge-danger">Inactive</span>
                                      <?php }
                                      else if( $status == 1 ) { ?>
                                        <span class="badge badge-success">Active</span>
                                      <?php }

                                    ?>
                                  </td>

                                  <td class="project-actions">
                                      <!-- <a class="btn btn-primary btn-sm" href="#">
                                          <i class="fas fa-folder">
                                          </i>
                                          View
                                      </a> -->
                                      <a class="btn btn-info btn-sm" href="category.php?edit=<?php
                                       echo $cat_id;?>">
                                          <i class="fas fa-pencil-alt">
                                          </i>
                                          Edit
                                      </a>
                                      <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete<?php echo $cat_id; ?>">
                                            <i class="fas fa-trash">
                                            </i>
                                          Delete
                                      </a>
                                  </td>
                              </tr>


<!-- Delete Modal -->
<div class="modal fade" id="delete<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you confirm to delete this category?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="delete-option text-center">
          <ul style="list-style:none">
           <li style="display:inline"><a href="category.php?delete=<?php echo $cat_id; ?>" class="btn btn-danger">Delete</a></li>
           <li style="display:inline"><button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button></li>
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
                  <!-- /.card-body -->
              </div>
                <!-- All category end -->
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Delete Category Query -->
  <?php
  
  if (isset($_GET['delete'])) {
    $delete_id  = $_GET['delete'];

    $DeleteSql = "DELETE FROM category WHERE cat_id ='$delete_id' ";
     
    $delete_query = mysqli_query($db, $DeleteSql);

    if($delete_query){
      $_SESSION['toastr']['messege']    = array("category deleted successfully");
      $_SESSION['toastr']['alertType']  = "success";
      header("location:category.php");
      exit();
    }
    else{
      die("mySQL query failed." . mysqli_error($db));
    }
  }
  
  ?>


  <!-- footer part -->
  <?php include "inc/footer.php"; ?>


  <!-- Control Sidebar -->
  <?php include "inc/sidebar.php"; ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include "inc/script.php"; ?>