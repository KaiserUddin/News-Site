<?php 
    ob_start();
    include "admin/inc/db.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Description -->
    <meta name="description" content="Blue Chip: Corporate Multi Purpose Business Template" />
    <meta name="author" content="Blue Chip" />

    <!--  Favicons / Title Bar Icon  -->
    <link rel="shortcut icon" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon/favicon.png" />

    <title>Blue Chip | Blog Right Sidebar</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">

    <!-- Flat Icon CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/flaticon.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css">

    <!-- Fency Box CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.min.css">

    <!-- Theme Main Style CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  </head>

  <body>
    <!-- :::::::::: Header Section Start :::::::: -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.php">Todays News</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">

                                <?php 
                                    // parent category query
                                    $sql = "SELECT cat_id AS 'pCatID', cat_name AS 'pCatName' FROM category WHERE is_parent = 0 AND cat_status = 1 ORDER BY cat_name ASC";
                                    $parentMenu = mysqli_query($db, $sql);
                                    while($row= mysqli_fetch_assoc($parentMenu)){
                                        extract($row);

                                        $subCat = "SELECT cat_id AS 'sCatID', cat_name AS 'sCatName' FROM category WHERE is_parent = '$pCatID' AND cat_status = 1 ORDER BY cat_name ASC";
                                        $subMenu = mysqli_query($db, $subCat);
                                        $countSubMenu = mysqli_num_rows($subMenu);

                                        if( $countSubMenu == 0 ){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="category.php?category=<?php echo $pCatName; ?>"><?php echo $pCatName; ?></a>
                                            </li>
                                        <?php }
                                        else{ ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="category.php?category=<?php echo $pCatName; ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php echo $pCatName; ?>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                                <a class="dropdown-item" href="category.php?category=<?php echo $pCatName; ?>">See all From <?php echo $pCatName; ?>
                                                </a>

                                                <?php 
                                                    while($row= mysqli_fetch_assoc($subMenu)){
                                                        extract($row); ?>
                                                        <a class="dropdown-item" href="category.php?category=<?php echo $sCatName; ?>"><?php echo $sCatName; ?>
                                                        </a>
                                                    <?php }
                                                ?> 
                                                </div>
                                            </li>
                                        <?php }
                                    }
                                ?>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ::::::::::: Header Section End ::::::::: -->







      