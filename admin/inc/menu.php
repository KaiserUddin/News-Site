<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/users/<?php echo $_SESSION['image']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['name']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"   data-accordion="false">

          <li class="nav-item">
            <a href="Dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">Application Features</li>

           <!-- manage users nav start -->
           <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  All Category
                  <i class="fas fa-angle-left right"></i>
                 <!--   <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="category.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Category</p>
                  </a>
                </li>
              </ul>
           </li>
          <!-- manage users nav end -->

          <?php
            if($_SESSION['role'] == 1) {?>
                  <!-- manage users nav start -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                  Manage Users
                    <i class="fas fa-angle-left right"></i>
                  <!--   <span class="badge badge-info right">6</span> -->
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="users.php?do=Add" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add New User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="users.php?do=Manage" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Users</p>
                    </a>
                  </li>  
                </ul>
              </li>
              <!-- manage users nav end -->
            <?php }
          ?>

          

          <!-- manage users nav start -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
               Manage Post
                <i class="fas fa-angle-left right"></i>
              <!--   <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="post.php?do=Add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="post.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Post</p>
                </a>
              </li>  
            </ul>
          </li>
          <!-- manage users nav end -->

          <!-- manage users nav start -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
               All Comments
                <i class="fas fa-angle-left right"></i>
              <!--   <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="allcomments.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Comment</p>
                </a>
              </li>  
            </ul>
          </li>
          <!-- manage users nav end -->

          <li class="nav-item">
            <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>