<?php
    include "inc/header.php";
?>

    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Single Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <li><a href="">Blog <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Single Right Sidebar</li>
                        </ol>
                    </nav>
                    <!-- Page Heading Breadcrumb End -->
                </div>
                  
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- ::::::::::: Page Banner Section End ::::::::: -->



    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Single Posts -->
                <div class="col-md-8">


                    <?php
                        if ( isset( $_GET['post'] ) ){
                            $thePost = $_GET['post'];

                            $sql = "SELECT * FROM post WHERE post_id = '$thePost'";
                            $allPost = mysqli_query($db, $sql);
                            while ( $row = mysqli_fetch_assoc($allPost) ){
                                $post_id        = $row['post_id'];
                                $title          = $row['title'];
                                $description    = $row['description'];
                                $image          = $row['image'];
                                $category_id    = $row['category_id'];
                                $author_id      = $row['author_id'];
                                $status         = $row['status'];
                                $meta           = $row['meta'];
                                $post_date      = $row['post_date'];
                                ?>

                                <!-- Single Item Blog Post Start -->
                            <div class="blog-post">
                                <!-- Blog Banner Image -->
                                <div class="blog-banner">
                                    <a href="single.php?post=<?php echo $post_id; ?>">
                                        <img src="admin/img/post/<?php echo $image; ?>">
                                        <!-- Post Category Names -->
                                        <div class="blog-category-name">
                                            <?php
                                                $sql = "SELECT * FROM category WHERE cat_id = '$category_id'";
                                                $readCat = mysqli_query($db, $sql);
                                                while( $row = mysqli_fetch_assoc($readCat) ){
                                                  $cat_id   = $row['cat_id'];
                                                  $cat_name = $row['cat_name'];
                                                  ?>
                                                   <h6><?php echo $cat_name; ?></h6>
                                              <?php  }
                                              ?>
                                           
                                        </div>
                                    </a>
                                </div>
                                <!-- Blog Title and Description -->
                                <div class="blog-description">
                                    <a href="single.php?post=<?php echo $post_id; ?>">
                                        <h3 class="post-title"><?php echo $title; ?></h3>
                                    </a>
                                    <p><?php  echo $description; ?></p>
                                    <!-- Blog Info, Date and Author -->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="blog-info">
                                                <ul>
                                                    <li><i class="fa fa-calendar"></i><?php echo $post_date; ?></li>
                                                    <li>
                                                        <?php
                                                            $sql = "SELECT * FROM users WHERE id = '$author_id'";
                                                            $readUser = mysqli_query($db, $sql);
                                                            while( $row = mysqli_fetch_assoc($readUser) ){
                                                              $id   = $row['id'];
                                                              $name = $row['name'];
                                                            }
                                                          ?>
                                                        <i class="fa fa-user"></i>Posted By - <?php echo $name; ?>
                                                    </li>
                                                    <!-- <li><i class="fa fa-heart"></i>(50)</li> -->
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-4 read-more-btn">
                                            <a href="single.php?post=<?php echo $post_id; ?>" class="btn-main">Read More <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Item Blog Post End -->



                            <?php
                            }
                        }
                    ?>


                    <!-- Single Comment Section Start -->
                    <div class="single-comments">
                        <!-- Comment Heading Start -->
                        <div class="row">
                            <div class="col-md-12">

                                <?php 
                                    $sql = "SELECT * FROM comments WHERE cmt_post_id = '$post_id' AND cmt_status = 1";
                                    $readComments = mysqli_query($db, $sql);
                                    $total_Comments = mysqli_num_rows($readComments);
                                ?>

                                <h4>All Latest Comments (<?php echo $total_Comments; ?>)</h4>
                                <div class="title-border"></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                            </div>
                        </div>
                        <!-- Comment Heading End -->


                        <?php 
                            $sql = "SELECT * FROM comments WHERE cmt_post_id = '$post_id' AND cmt_status = 1 ORDER BY cmt_id DESC";
                            $readComments = mysqli_query($db, $sql);

                            $result = mysqli_num_rows($readComments);

                            if( $result == 0 || empty($result) ){ ?>
                                <div class="alert alert-warning"> No Comments Found in this post!!! </div>
                            <?php }
                            else{
                                while($row = mysqli_fetch_assoc($readComments)){
                                    $cmt_id               = $row['cmt_id'];
                                    $cmt_desc             = $row['cmt_desc'];
                                    $cmt_post_id          = $row['cmt_post_id'];
                                    $cmt_author           = $row['cmt_author'];
                                    $cmt_author_email     = $row['cmt_author_email'];
                                    $cmt_status           = $row['cmt_status'];
                                    $cmt_date             = $row['cmt_date'];
                                    ?>
                                    <!-- Single Comment Post Start -->
                                    <div class="row each-comments">
                                        <!-- <div class="col-md-2">
                                            <div class="comments-person">
                                                <img src="assets/images/corporate-team/team-1.jpg">
                                            </div>
                                        </div> -->
    
                                        <div class="col-md-12 no-padding">
                                            <!-- Comment Box Start -->
                                            <div class="comment-box">
                                                <div class="comment-box-header">
                                                    <ul>
                                                        <li class="post-by-name"><?php echo $cmt_author; ?></li>
                                                        <li class="post-by-hour"><?php echo $cmt_date; ?></li>
                                                    </ul>
                                                </div>
                                                <p><?php echo $cmt_desc; ?></p>
                                            </div>
                                            <!-- Comment Box End -->
                                        </div>
                                    </div>
                                    <!-- Single Comment Post End -->
                                <?php }
                            }

                            
                        ?>   

                    </div>
                    <!-- Single Comment Section End -->


                    <!-- Post New Comment Section Start -->
                    <div class="post-comments">
                        <h4>Post Your Comments</h4>
                        <div class="title-border"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                        <!-- Form Start -->
                        <form action="" method="POST" class="contact-form">
                            <!-- Left Side Start -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- First Name Input Field -->
                                    <div class="form-group">
                                        <input type="text" name="username" placeholder="Your Name" class="form-input" autocomplete="off" required="required">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                </div>
                                <!-- Email Address Input Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email Address" class="form-input" autocomplete="off" required="required">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Left Side End -->

                            <!-- Right Side Start -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Comments Textarea Field -->
                                    <div class="form-group">
                                        <textarea name="comments" class="form-input" placeholder="Your Comments Here..."></textarea>
                                        <i class="fa fa-pencil-square-o"></i>
                                    </div>
                                    <!-- Post Comment Button -->
                                    <input type="submit" name="addComment" value="Post Your Comments" class="btn-main">
                                </div>
                            </div>
                            <!-- Right Side End -->
                        </form>
                        <!-- Form End -->
                    </div>
                    <!-- Post New Comment Section End -->              
                </div>


                <?php 
                    if(isset($_POST['addComment'])){
                        $username  = $_POST['username'];
                        $email     = $_POST['email'];
                        $comments  = $_POST['comments'];

                        $sql = "INSERT INTO comments(cmt_desc, cmt_post_id, cmt_author, cmt_author_email, cmt_status, cmt_date) VALUES('$comments', '$post_id', '$username', '$email', '0', now() )";
                        $addComment = mysqli_query($db, $sql);

                        if($addComment){
                            header("Location:single.php?post=$post_id");
                        }
                        else{
                            die("Data not inserted." . mysqli_error($db));
                        }
                    }
                ?>




                <!-- Blog Right Sidebar -->
                <?php 
                    include "inc/sidebar.php";
                ?>
                <!-- Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
    

<?php
    include "inc/footer.php";
?>    