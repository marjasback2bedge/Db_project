<?php
session_start();
include '../../initialize.php';
require_once('../inc/header.php')
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
      <h1>貼文瀏覽</h1>
      <hr>
    </div>

    <style>
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
            <button type="submit" name="lost_button" class="my-button">所有貼文</button>
            <button type="submit" name="found_button" class="my-button">由你發布</button>
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
								<th>用戶名稱</th>
                <th>發布時間</th>
								<th>發生時間</th>
								<th>位置</th>
								<th>用途</th>
                <th>物品</th>
								<th style='width: 160px;'>動作</th>
							</tr></thead>
							<tbody>
							<?php
								include '../../conn.php';
                $userID = $_SESSION['user_id'];
								if (isset($_POST['found_button'])){
                  $sql = "SELECT user.name, post.*
										FROM post INNER JOIN user ON post.userID = user.ID
										WHERE post.ID = '$userID'
										ORDER BY post.posttime ASC";            
                }
                else{
									$sql = "SELECT user.name, post.*
										FROM post INNER JOIN user ON post.userID = user.ID
										ORDER BY post.posttime ASC";  
                }

								$result = $conn->query($sql);
							
								if ($result === false) {
									die("error: " . $conn->error);
								}
            
                if ($result->num_rows > 0) {
                  $i = 0;
	                while ($row = $result->fetch_assoc()) {
                    echo "<tr data-index='$i'>";
                    $i++;
										echo "<td style='text-align: left;'>$i</td>";
										echo "<td style='text-align: left;'>" . $row['ID'] . "</td>";
										echo "<td style='text-align: left;'>" . $row['name'] . "</td>";
										echo "<td style='text-align: left;'>" . date("Y-m-d H:i:s", strtotime($row['posttime'])) . "</td>";
										echo "<td style='text-align: left;'>" . date("Y-m-d H:i:s", strtotime($row['occurtime'])) . "</td>";
            
										$sql2 = "SELECT department.name AS name, post.ID
											FROM (post INNER JOIN postlocate ON post.ID = postlocate.postID)
											INNER JOIN department ON department.ID = postlocate.deptID
											WHERE post.ID =\"" . $row['ID'] . "\";";
										$result2 = $conn->query($sql2);
										if ($result2->num_rows > 0){
											$row2 = $result2->fetch_assoc();
											echo "<td>" . $row2['name'] . "</td>";
										}
										else echo "<td></td>";
							
										echo "<td>";
										if ($row['type'] == 0) {
											echo "失物尋找";
										} else {
											echo "拾獲招領";
										}
										echo "</td>";

										$qry2 = $conn->query("SELECT *
											FROM post INNER JOIN item ON post.ID = item.postID
											WHERE post.ID = \"" . $row['ID'] . "\";");
							
										if ($qry2 === false) {
											echo "<td>error: " . $conn->error . "</td>";
										}
										else{
											echo "<td>";
											while ($row2 = $qry2->fetch_assoc()) {
												echo $row2['name'] . "\t";
											}
											echo "</td>";
										}

                    if ($row['userID'] != $userID){
										  echo "<td><div class='oval-div' style='background-color: green;'><a style = 'color: white; text-decoration: none;' href='response.php?ID={$row['ID']}'>響應</a></div></td>"; 
                    }else{
                      echo "<td><div class='oval-div' style='background-color: brown;'><a style = 'color: white; text-decoration: none;' href='delete.php?ID={$row['ID']}'>刪除</a></div></td>";
                    }
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

<table>

	<?php 
	include '../../conn.php';

	$i = 1;
	$sql = "SELECT user.name, post.*
		FROM post INNER JOIN user ON post.userID = user.ID
		ORDER BY post.type ASC, post.posttime DESC";
	$result = $conn->query($sql);

	if ($result === false) {
		die("error: " . $conn->error);
	}

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";

			$sql2 = "SELECT department.name AS name, post.ID
				FROM (post INNER JOIN postlocate ON post.ID = postlocate.postID)
				INNER JOIN department ON department.ID = postlocate.deptID
				WHERE post.ID =\"" . $row['ID'] . "\";";
			$result2 = $conn->query($sql2);
			if ($result2->num_rows > 0){
				$row2 = $result2->fetch_assoc();
				echo "<td>" . $row2['name'] . "</td>";
			}
			else echo "<td></td>";

			echo "<td>";
			if ($row['type'] == 0) {
				echo "失物尋找";
			} else {
				echo "拾獲招領";
			}
			echo "</td>";


			echo "<td><a href='edit.php?ID={$row['ID']}'>編輯</a></td>";
			echo "<td><a href='delete.php?ID={$row['ID']}'>刪除</a></td>";

			echo "</tr><br>";
		}
	} else {
		echo "<tr><td colspan='6'>0 results</td></tr>";
	}
	$conn->close();
	?>
</table>