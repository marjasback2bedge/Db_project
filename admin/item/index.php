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
      <h1>物品管理</h1>
      <hr>
    </div>

    <style>
      #list td:nth-child(8),
      #list td:nth-child(9){
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
					<form method="post">
            <button type="submit" name="unsolved_button" class="my-button">未解決</button>
            <button type="submit" name="solved_button" class="my-button">已解決</button>
          </form>
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
                <th>ID</th>
								<th>貼文ID</th>
                <th>名稱</th>
								<th>分類</th>
								<th>狀態</th>
								<th>位置</th>
                <th>圖片</th>
								<th style='width: 160px;'>管理</th>
							</tr></thead>
							<tbody>
							<?php
								include '../../conn.php';
                if (isset($_POST['solved_button'])){
									$sql = "SELECT *
										FROM post INNER JOIN item ON post.ID = item.postID
										WHERE item.state = '2'
										ORDER BY post.ID ASC;";                  
                }
                else{
									$sql = "SELECT *
										FROM post INNER JOIN item ON post.ID = item.postID
										WHERE NOT item.state = '2'
										ORDER BY item.state, post.ID ASC;";
                }

                $result = $conn->query($sql);
                if ($result === false) {
                  die("error: " . $conn->error);
                }
            
                if ($result->num_rows > 0) {
                  $i = 0;
                  $defaultimg = base64_encode(file_get_contents(base_url . "admin/img/defaultimg.png"));
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr data-index='$i'>";
                    $i++;
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td><a href='../post/edit.php?ID={$row['postID']}'>{$row['postID']}</a></td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['kind'] . "</td>";
                    echo "<td>";
                    if ($row['state'] == 0) {
                      echo "尋找中";
                    } 
                    elseif ($row['state'] == 1){
                      echo "待領取";
                    }
                    else{
                      echo "已解決";
                    }
                    echo "</td>";
            
                    $sql2 = "SELECT department.name AS name, item.ID
                      FROM (item INNER JOIN itemlocate ON item.ID = itemlocate.itemID)
                      INNER JOIN department ON department.ID = itemlocate.deptID
                      WHERE item.ID =\"" . $row['ID'] . "\";";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0){
                      $row2 = $result2->fetch_assoc();
                      echo "<td>" . $row2['name'] . "</td>";
                    }
                    else echo "<td></td>";
                    echo "<td>";
                    if($row["photo"] == NULL){
                      echo '<img src="data:image/jpeg;base64,' . $defaultimg . '" />';
                    }
                    else{
                      $imageBase64 = base64_encode($row["photo"]);
                      echo '<img src="data:image/jpeg;base64,' . $imageBase64 . '" />';
                    }
                    echo "<td><div class='oval-div' style='background-color: green;'><a style = 'color: white; text-decoration: none;' href='edit.php?ID={$row['ID']}'>編輯</a></div>";
                    echo "<div class='oval-div' style='background-color: brown;'><a style = 'color: white; text-decoration: none;' href='delete.php?ID={$row['ID']}'>刪除</a></div></td>";

                    echo "</tr>";
                  }
                }
                else{
                  echo "<tr><td colspan='9'>0 results</td></tr>";
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
<script>
	document.getElementById('default_button').value = "unsolved_button";</script>
<style>
    img {
        height: 30px;
        width: auto;
    }
</style>