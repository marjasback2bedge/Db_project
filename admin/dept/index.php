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
      <h1>場所清單</h1>
      <hr>
    </div>

    <style>
      #list td:nth-child(5){
          text-align:center !important;
      }
    </style>
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

      .my-button:hover {
          background-color: #0066cc; /* 鼠標懸停時的顏色變化 */
      }
    </style>
    
    <div class="card card-outline rounded-0 card-navy">
      <div class="card-header ">
        <div class="card-tools d-flex justify-content-end">
			<a style = 'color: white; text-decoration: none;' href="<?= base_url ?>admin/dept/insert.php"><div class="my-button">新增</div></a>
        </div>
    </div>
    <div class="card-body">
      <div class="container-fluid">
        <div class="table-responsive">
          
          <div class="datatable-container">
            <table class="table table-sm table-hover table-striped table-bordered datatable-table" id="list">           
              <style>
                td {
                  word-wrap: break-word; /* 為長單詞啟用自動換行 */
                  word-break: break-all; /* 在任何字符點進行換行 */
                }
                .oval-div {
                  color: white; /* 白色字體 */
                  padding: 1px 10px; /* 內邊距，讓橢圓更寬一些 */
                  border-radius: 10px; /* 圓角半徑 */
                  display: inline-block; /* 使 div 適應內容大小 */
                  text-align: center; /* 文字居中 */
                  margin-left: 4px;
                  margin-right: 4px;
                }
              </style>

              <thead><tr>
                <th>#</th>
                <th>校區</th>
                <th>建築</th>
                <th>名稱</th>
								<th style='width: 160px;'>管理</th>
							</tr></thead>
			
							<tbody>
                <?php
                  include '../../conn.php';
									$sql = "SELECT * FROM department
                    ORDER BY campus ASC, building ASC, name ASC;";
									$result = $conn->query($sql);
							
									if ($result === false) {
											die("error: " . $conn->error);
									}
							
									if ($result->num_rows > 0) {
										$i = 0;
										while ($row = $result->fetch_assoc()) {
											echo "<tr data-index='$i'>";
											$i++;
											echo "<td>$i</td>";
											echo "<td>" . $row['campus'] . "</td>";
											echo "<td>" . $row['building'] . "</td>";
											echo "<td>" . $row['name'] . "</td>";
											echo "<td><div class='oval-div' style='background-color: green;'><a style = 'color: white; text-decoration: none;' href='edit.php?ID={$row['ID']}'>編輯</a></div>";
											echo "<div class='oval-div' style='background-color: brown;'><a style = 'color: white; text-decoration: none;' href='delete.php?ID={$row['ID']}'>刪除</a></div></td>";

											echo "</tr>";
										}
									}
									else{
										echo "<tr><td colspan='5'>0 results</td></tr>";
									}                 
                  $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

<script>
  document.querySelector('.toggle-sidebar-btn').addEventListener('click', function() {
      document.body.classList.toggle('toggle-sidebar');
  });
</script>