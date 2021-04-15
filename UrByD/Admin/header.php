<?php
require('../config.php');
session_start();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>UrByD - Admin</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="assets/img/brand/2.jpg" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">หน้าหลัก</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="product.php">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">สินค้า</span>
              </a>
            </li>
            

            <li class="nav-item">
              <a class="nav-link" href="purchase_order.php">
                <i class="ni ni-archive-2 text-primary"></i>
                <span class="nav-link-text">การสั่งซื้อสินค้า</span>
              </a>
            </li>
            <!--
            <li class="nav-item">
              <a class="nav-link" href="receive_order.php">
                <i class="ni ni-app text-yellow"></i>
                <span class="nav-link-text">การรับสินค้า</span>
              </a>
            </li> -->

            <li class="nav-item">
              <a class="nav-link" href="order_wait_for_payment.php">
                <i class="ni ni-app text-yellow"></i>
                <span class="nav-link-text">การขายสินค้า</span>
              </a>
            </li>

            <!--
            <li class="nav-item">
              <a class="nav-link" href="promotion.php">
                <i class="ni ni-diamond text-default"></i>
                <span class="nav-link-text">โปรโมชั่น</span>
              </a>
            </li> -->

          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">ข้อมูลพื้นฐาน</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">

          <!--
            <li class="nav-item">
              <a class="nav-link" href="prefix.php" target="_blank">
                <i class="ni ni-collection"></i>
                <span class="nav-link-text">คำนำหน้าชื่อ</span>
              </a>
            </li>
            -->

            <li class="nav-item">
              <a class="nav-link" href="prefix.php" >
                <i class="ni ni-collection"></i>
                <span class="nav-link-text">คำนำหน้าชื่อ</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="category.php" >
                <i class="ni ni-folder-17"></i>
                <span class="nav-link-text">ประเภทสินค้า</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="unit.php" >
                <i class="ni ni-map-big"></i>
                <span class="nav-link-text">หน่วยนับ</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="supplier.php" >
                <i class="ni ni-ungroup"></i>
                <span class="nav-link-text">บริษัทตัวแทนจำหน่าย</span>
              </a>
            </li>
            
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <form id="form_logout" method="post" action="\UrByD/service/authen_service.php">
      <div>
        <input type="hidden" name="action" value="logout">
      </div>
    </form>

    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
  
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="assets/img/theme/team-4.jpg">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION['authen']['staff_name'] ?></span>
                  </div>
                </div>
              </a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="javascript:$('#form_logout').submit();" >
                <div class="media align-items-center">
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <i class="fa fa-power-off"></i>
                  </div>
                </div>
              </a>
            </li>


          </ul>
        </div>
      </div>
    </nav>
   