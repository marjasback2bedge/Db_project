<?php
session_start();
include '../initialize.php';
require_once('inc/header.php')
?>

<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">

    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>
  <!-- End Logo -->

  <!-- <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div> -->
  <!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" aria-expanded="false">         
          <?php 
          $name = $_SESSION['name'];
          echo "<span class='d-none d-md-block dropdown-toggle ps-2'>$name\t</span>";
          ?>
        </a>
        <!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <!-- <li class="dropdown-header">
            <h6>Adminstrator Admin</h6>
            <span>Administrator</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li> -->

          <!-- <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li> -->
          <!-- <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="http://localhost/php-lfis/admin?page=user">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
        
          <li>
            <hr class="dropdown-divider">
          </li> -->

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= base_url ?>logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>登出</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header>

<body>
  <aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="<?= base_url ?>user">
        <i class="bi bi-house"></i>
        <span>首頁</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#" data-bs-collapse="false">
        <i class="bi bi-newspaper"></i><span>貼文</span>
                    
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="user-nav" class="nav-content collapse  " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= base_url ?>user/post/index.php" class="">
            <span>貼文瀏覽</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url ?>user/post/insert.php" class="">
            <span>新增貼文</span>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#dept-nav" data-bs-toggle="collapse" href="#" data-bs-collapse="false">
        <i class="bi bi-buildings"></i><span>場所管理</span>
                    
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="dept-nav" class="nav-content collapse  " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= base_url ?>user/dept/index.php" class="">
            <span>場所清單</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url ?>user/dept/insert.php" class="">
            <span>新增場所</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url ?>user/post">
        <i class="bi bi-newspaper"></i>
        <span>貼文</span>
      </a>
    </li> -->
    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#dept-nav" data-bs-toggle="collapse" href="#" data-bs-collapse="false">
        <i class="bi bi-buildings"></i><span>貼文</span>
                    
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="dept-nav" class="nav-content collapse  " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= base_url ?>user/post/index.php" class="">
            <span>瀏覽貼文</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url ?>user/post/insert.php" class="">
            <span>新增貼文</span>
          </a>
        </li>
      </ul>
    </li> -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url ?>user/response"> 
        <!-- TODO: response -->
        <i class="bi bi-phone"></i>
        <span>響應</span>
      </a>
    </li>
    
    <!-- <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url ?>">
        <i class="bi bi-escape"></i>
        <span>登出</span>
      </a>
    </li> -->
  </ul>

  </aside>

  <main id="main" class="main">
    <div class="pagetitle" style="margin-bottom: 25px;">
      <h1>首頁</h1>
      <hr>
    </div>
    
    <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="row">

          <!-- <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title"><strong>用戶數量</strong></h5>

                <div class="d-flex align-items-center justify-content-between">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-25 text-success">
                    <i class="bi bi-person"></i>
                  </div>
                  <div class="ps-3">
                    <?php 
                    	include '../conn.php';

                      $sql = "SELECT count(ID) AS count
                        FROM user
                        WHERE type = 0;";
                      $result = $conn->query($sql);
                      $row = $result->fetch_assoc();
                      echo "管理員\t<h6 style='display: inline'>" . $row['count'] . "</h6>";
                      $sql = "SELECT count(ID) AS count
                      FROM user
                      WHERE type = 1;";
                      $result = $conn->query($sql);
                      $row = $result->fetch_assoc();
                      echo "<span style='margin-left: 5px; margin-left: 20px;margin-right: 20px;'>|</span>使用者\t<h6 style='display: inline'>" . $row['count'] . "</h6>";
                    ?>
                  </div>
                </div>
              </div>

            </div>
          </div> -->
          <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title"><strong>貼文數量</strong></h5>

                <div class="d-flex align-items-center justify-content-between">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-dark bg-opacity-25 text-dark">
                    <i class="bi bi-newspaper"></i>
                  </div>
                  <div class="ps-3">
                    <?php 
                      include '../conn.php';
                      $userID = $_SESSION['user_id'];
                      $sql = "SELECT count(ID) AS count
                      FROM post
                      WHERE type = 0 AND userID = '$userID';";
                      $result = $conn->query($sql);
                      $row = $result->fetch_assoc();
                      echo "失物尋找\t<h6 style='display: inline'>" . $row['count'] . "</h6>";
                      $sql = "SELECT count(ID) AS count
                      FROM post
                      WHERE type = 1 AND userID = '$userID';";
                      $result = $conn->query($sql);
                      $row = $result->fetch_assoc();
                      echo "<span style='margin-left: 5px; margin-left: 20px;margin-right: 20px;'>|</span>拾獲招領\t<h6 style='display: inline'>" . $row['count'] . "</h6>";
                    ?>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title"><strong>場所數量</strong></h5>
                <div class="d-flex align-items-center justify-content-between">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-dark bg-opacity-25 text-dark">
                    <i class="bi bi-building"></i>
                  </div>
                  <div class="ps-3">
                    <?php 
                      $sql = "SELECT count(ID) AS count
                        FROM department;";
                      $result = $conn->query($sql);
                      $row = $result->fetch_assoc();
                      echo "<h6 style='display: inline'>" . $row['count'] . "</h6>";
                    ?>
                  </div>
                </div>
              </div>

            </div>
          </div> -->
          <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card info-card">
              <div class="card-body">
                <h5 class="card-title"><strong>響應</strong></h5>
                <div class="d-flex align-items-center justify-content-between">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-25 text-primary">
                    <i class="bi bi-phone"></i>
                  </div>
                  <div class="ps-3">
                    <?php 
                      $userID = $_SESSION['user_id'];
                      $sql = "SELECT count(time) AS count
                      FROM response
                      WHERE postID in (SELECT ID FROM post WHERE userID = '$userID');";
                      $result = $conn->query($sql);
                      $row = $result->fetch_assoc();
                      echo "<h6 style='display: inline'>" . $row['count'] . "</h6>";
                      // $sql = "SELECT count(ID) AS count
                      //   FROM item
                      //   WHERE state = 1;";
                      // $result = $conn->query($sql);
                      // $row = $result->fetch_assoc();
                      // echo "<span style='margin-left: 5px; margin-left: 20px;margin-right: 20px;'>|</span>　待領取\t<h6 style='display: inline'>" . $row['count'] . "</h6>";
                      // $sql = "SELECT count(ID) AS count
                      //   FROM item
                      //   WHERE state = 2;";
                      // $result = $conn->query($sql);
                      // $row = $result->fetch_assoc();
                      // echo "<span style='margin-left: 5px; margin-left: 20px;margin-right: 20px;'>|</span>　已解決\t<h6 style='display: inline'>" . $row['count'] . "</h6>";
                    ?>
                  </div>
                </div>
              </div>

            </div>
          </div>

     

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"></h5>
                                                <div id="banner-slider" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                                        <div class="carousel-item">
                      <img src="<?= base_url ?>uploads/banner/lf-wp-1.jpg" class="d-block w-100" alt="Banner Image 1">
                    </div>
                                        <div class="carousel-item active">
                      <img src="<?= base_url ?>uploads/banner/lf-wp-2.jpg" class="d-block w-100" alt="Banner Image 2">
                    </div>
                                    </div>
                

              </div>

            </div>
          </div>

        </div>
      </div><!-- End Left side columns -->

    </div>
  </div></section>      </main>

  <script>
        // JavaScript 代碼部分
        document.querySelector('.toggle-sidebar-btn').addEventListener('click', function() {
            document.body.classList.toggle('toggle-sidebar');
        });
    </script>
</body>