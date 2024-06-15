<?php
session_start();
include '../../initialize.php';
require_once('../inc/header.php')
?>

<?php
include '../../conn.php';

if ($conn->connect_error) {
    die("error: " . $conn->connect_error);
} 

$ID = $_GET['ID'];

$select_sql = "SELECT * FROM department WHERE ID = \"$ID\";";
$result = $conn->query($select_sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
else{
    echo "edit fault";
    header('Location: index.php');
}
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
			<h1>場所編輯</h1>
			<hr>
    </div>

    <div class="card card-outline rounded-0 card-navy">
      <form method='POST' action='doedit.php'>
        <div class="card-header ">
          <div class="card-tools d-flex justify-content-end">
						<input class="my-button" style = "margin-right: 5px;" type='submit' name='edit' value='編輯'/>
            <a style = 'color: white; text-decoration: none;' href="<?= base_url ?>user/dept"><div class="my-button">返回</div></a>
					</div>
        </div>

        <div class="card-body">
					<table>
						<tr>
							<th style = "width: 50px;">ID</th>
							<td><input type='text' name='ID' value='<?php echo $row['ID']; ?>' readonly></td>
						</tr>
						<tr>
							<th style = "width: 50px;">校區</th>
							<td><input type='text' name='campus' value='<?php echo $row['campus']; ?>'></td>
						</tr>
						<tr>
							<th style = "width: 50px;">建築</th>
							<td><input type='text' name='building' value='<?php echo $row['building']; ?>'></td>
						<tr>
							<th style = "width: 50px;">名稱</th>
							<td><input type='text' name='name' value='<?php echo $row['name']; ?>'></td>	
						</tr>
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
