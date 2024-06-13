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

$select_sql = "SELECT * FROM item WHERE ID = \"$ID\";";
$result = $conn->query($select_sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$defaultimg = base64_encode(file_get_contents(base_url . "admin/img/defaultimg.png"));
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
          <i class="bi bi-person"></i><span>用戶清單</span>
                      
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
        <h1>編輯物品</h1>
        <hr>
    </div>

    <div class="card card-outline rounded-0 card-navy">
      <form method='POST' action='doedit.php'>
        
        <div class="card-header ">
          <div class="card-tools d-flex justify-content-end">
            <input class="my-button" style = "margin-right: 5px;" type='submit' name='edit' value='編輯'/>
            <a style = 'color: white; text-decoration: none;' href="<?= base_url ?>admin/item"><div class="my-button">返回</div></a>
          </div>
        </div>

        <div class="card-body">
					<table>
						<input type='hidden' name='ID' value='<?php echo $row['ID']; ?>'>
						<tr>
							<th style = "width: 80px;">ID</th>
							<td><input type='text' name='ID' value='<?php echo $row['ID']; ?>' readonly></td>
						</tr>
						<tr>
							<th style = "width: 80px;">貼文ID</th>
							<td><a href='../post/edit.php?ID=<?php echo $row['postID']?>'><input type='text' name='postID' value='<?php echo $row['postID']; ?>' readonly></a>
						</tr>
						<tr>
							<th style = "width: 80px;">名稱</th>
							<td><input type='text' name='name' value='<?php echo $row['name']; ?>'>
						</tr>
						<tr>
							<th style = "width: 80px;">類別</th>
							<td><input type='text' name='Category' value='<?php echo $row['kind']; ?>'>
						</tr>
						<tr>
							<th style = "width: 80px;">狀態</th>
								<td><select name='state'>
							<?php
								$stateMap = [
									0 => "尋找中",
									1 => "待領取",
									2 => "已解決"
								];
								
								$state = isset($stateMap[$row['state']]) ? $stateMap[$row['state']] : "未知狀態";
								$options = array_values($stateMap);
								$currentValue = $state;

								foreach ($options as $option) {
									echo "<option value='$option'";
									if ($option == $currentValue) echo " selected";
									echo ">$option</option>";
								}

							?>
							</select></td>
						</tr>
						<tr>
							<th style = "width: 80px;">位置</th>
								<td><select name='location'>
							<?php
								$sql2 = "SELECT department.campus AS campus, department.building AS building, department.name AS name
									FROM (item INNER JOIN itemlocate ON item.ID = itemlocate.itemID)
									INNER JOIN department ON department.ID = itemlocate.deptID
									WHERE item.ID =\"" . $row['ID'] . "\";";
								$result2 = $conn->query($sql2);
								if ($result2->num_rows > 0){
										$row2 = $result2->fetch_assoc();
										$loc = "{$row2['campus']} - {$row2['building']} - {$row2['name']}";
								}
								else $loc = "";
					
								$loc_options = [""];
								$sql3 = "SELECT * FROM department
									ORDER BY campus ASC, building DESC, name ASC;";
								$result3 = $conn->query($sql3);
							
								if ($result3->num_rows > 0){
									while ($row3 = $result3->fetch_assoc()) {
										array_push($loc_options, "{$row3['campus']} - {$row3['building']} - {$row3['name']}");
									}
								}
								foreach ($loc_options as $option) {
									echo "<option value='$option'";
									if ($option == $loc) echo " selected";
									echo ">$option</option>";
								}

							?>
							</select></td>
						</tr>
						<tr>
							<td></td><td style='display: flex; align-items: center;'>
							<?php
								if($row["photo"] == NULL){
									echo '<img src="data:image/jpeg;base64,' . $defaultimg . '" />';
								}
								else{
									$imageBase64 = base64_encode($row["photo"]);
									echo '<img src="data:image/jpeg;base64,' . $imageBase64 . '" />';
								}
							?>
							<input type='submit' name='removeimg' value='審核'/></td>
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

  input[type='text'], select {
    width: 67%; /* 讓輸入框更長 */
    padding: 10px; /* 調整內邊距使輸入框變大 */
    border: 1px solid #ccc; /* 添加柔和的邊框 */
    border-radius: 2px; /* 圓角 */
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.05); 
  }

</style>
<style>
    img {
        height: auto;
        width: 200px;
    }
</style>
<script>
  document.querySelector('.toggle-sidebar-btn').addEventListener('click', function() {
      document.body.classList.toggle('toggle-sidebar');
  });
</script>