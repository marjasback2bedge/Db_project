<?php
session_start();
include '../../initialize.php';
require_once('../inc/header.php')
?>

<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

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

<body>
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url ?>admin">
          <i class="bi bi-house"></i>
          <span>首頁</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#" data-bs-collapse="false">
          <i class="bi bi-person"></i><span>用戶管理</span>
                      
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url ?>admin/user/index.php" class="">
              <span>用戶清單</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url ?>admin/user/insert_admin.php" class="">
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
            <a href="<?= base_url ?>admin/dept/index.php" class="">
              <span>場所清單</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url ?>admin/dept/insert.php" class="">
              <span>新增場所</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url ?>admin/post">
          <i class="bi bi-newspaper"></i>
          <span>貼文管理</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url ?>admin/item">
          <i class="bi bi-phone"></i>
          <span>物品管理</span>
        </a>
      </li>

    </ul>

  </aside>

  <main id="main" class="main">

    <div class="pagetitle" style="margin-bottom: 25px;">
      <h1>新增管理員</h1>
      <hr>
    </div>
    <div class="card card-outline rounded-0 card-navy">
      <form method='POST' action='doinsert_admin.php'>
        
        <div class="card-header ">
          <div class="card-tools d-flex justify-content-end">
            <th colspan='2'><input type='submit' name='signup' class="my-button" value='新增'/></th></tr>
          </div>
        </div>

        <div class="card-body">
          <table>
            <tr><th style = "width: 50px;">名稱</th><td><input type='text' name='name' value='admin'></td></tr>
            <tr><th style = "width: 50px;">密碼</th><td><input type='text' name='password' value=''></td></tr>
            <tr><th style = "width: 50px;">資訊</th><td><input type='text' name='contact' value=''></td></tr>
          </table>
        </div>
      </form>
    </div>
  </main>
</body>

<style>
  .my-button {
      background-color: #007bff; /* 較暗的藍色背景 */
      color: white; /* 白色字體 */
      border: none; /* 移除邊框 */
      padding: 8px 24px; /* 調整內邊距 */
      border-radius: 5px; /* 圓角 */
      cursor: pointer; /* 鼠標指針樣式 */
      transition: background-color 0.3s ease; /* 平滑過渡 */
      margin-bottom: -12px; /* 減少下邊距 */
  }
  .button-container {
            text-align: right; /* 使容器內的內容靠右對齊 */
            margin-top: 20px; /* 增加頂邊距與表格分隔 */
        }
  .my-button:hover {
      background-color: #0066cc; /* 鼠標懸停時的顏色變化 */
  }
  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0px 5px; /* 調整表格單元格之間的間距 */
  }

  input[type='text'] {
    width: 67%; /* 讓輸入框更長 */
    padding: 10px; /* 調整內邊距使輸入框變大 */
    border: 1px solid #ccc; /* 添加柔和的邊框 */
    border-radius: 2px; /* 圓角 */
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.05); 
  }

</style>

<script>
  document.querySelector('.toggle-sidebar-btn').addEventListener('click', function() {
      document.body.classList.toggle('toggle-sidebar');
  });
</script>