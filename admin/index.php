<?php
include '../initialize.php';
require_once('inc/header.php')
?>

<header id="header" class="header fixed-top d-flex align-items-center">

<!-- <div class="d-flex align-items-center justify-content-between">
  <a href="http://localhost/php-lfis/admin" class="logo d-flex align-items-center">
    <img src="http://localhost/php-lfis/uploads/logo.png?v=1682908055" alt="System Logo">
    <span class="d-none d-lg-block">PHP - LFIS</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div> -->
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
        <!-- <img src="http://localhost/php-lfis/uploads/avatars/1.png?v=1678760026" alt="Profile" class="rounded-circle"> -->
        
        <?php 
        include '../conn.php';
        $sql = "SELECT name FROM user;"; // TODO
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo "<span class='d-none d-md-block dropdown-toggle ps-2'>" . $row['name'] . "\t</span>";
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
          <a class="dropdown-item d-flex align-items-center" href="<?= base_url ?>">
            <i class="bi bi-box-arrow-right"></i>
            <span>登出</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header>

<aside id="sidebar" class="sidebar">
<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="<?= base_url ?>/admin">
      <i class="bi bi-house"></i>
      <span>首頁</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#" data-bs-collapse="false">
      <i class="bi bi-person"></i><span>用戶管理</span>
                  
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="user-nav" class="nav-content collapse  " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= base_url ?>/admin/user/index.php" class="">
          <span>用戶清單</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url ?>/admin/user/insert_admin.php" class="">
          <span>新增管理員</span>
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
        <a href="<?= base_url ?>/admin/dept/index.php" class="">
          <span>場所清單</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url ?>/admin/dept/insert.php" class="">
          <span>新增場所</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url ?>/admin/post">
      <i class="bi bi-newspaper"></i>
      <span>貼文管理</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url ?>/admin/item">
      <i class="bi bi-phone"></i>
      <span>物品管理</span>
    </a>
  </li>

    <!-- <li class="nav-heading">Maintenance</li>

  <li class="nav-item">
    <a class="nav-link collapsed nav-users" href="http://localhost/php-lfis/admin?page=user/list">
      <i class="bi bi-people"></i>
      <span>Users</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed  nav-system_info" href="http://localhost/php-lfis/admin?page=system_info/contact_information">
      <i class="bi bi-telephone"></i>
      <span>Contact Information</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed  nav-system_info" href="http://localhost/php-lfis/admin?page=system_info">
      <i class="bi bi-gear"></i>
      <span>System Information</span>
    </a>
  </li> -->
  
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url ?>">
      <i class="bi bi-escape"></i>
      <span>登出</span>
    </a>
  </li>
</ul> -->

</aside>