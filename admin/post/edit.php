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

$select_sql = "SELECT * FROM post WHERE ID = \"$ID\";";
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
        <h1>編輯貼文</h1>
        <hr>
    </div>

    <div class="card card-outline rounded-0 card-navy">
      <form method='POST' action='doedit.php'>
        
        <div class="card-header ">
          <div class="card-tools d-flex justify-content-end">
            <input class="my-button" style = "margin-right: 5px;" type='submit' name='edit' value='編輯'/>
            <a style = 'color: white; text-decoration: none;' href="<?= base_url ?>admin/post"><div class="my-button">返回</div></a>
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
							<th style = "width: 80px;">用戶ID</th>
							<td><a href='../user/edit.php?ID=<?php echo $row['userID']?>'><input type='text' name='userID' value='<?php echo $row['userID']; ?>' readonly></a>
						</tr>
						<tr>
							<th style = "width: 80px;">發布時間</th>
							<td><input type='text' name='posttime' value='<?php echo date("Y-m-d H:i:s", strtotime( $row['posttime'])); ?>'readonly>
						</tr>
						<tr>
							<th style = "width: 80px;">發生時間</th>
							<td><input type='text' name='occurtime' value='<?php echo date("Y-m-d H:i:s", strtotime( $row['occurtime'])); ?>'readonly>
						</tr>
						<tr>
							<th style = "width: 80px;">用途</th>
								<td><select name='type'>
							<?php
								$stateMap = [
									0 => "失物尋找",
									1 => "拾獲招領",
								];
								
								$state = isset($stateMap[$row['type']]) ? $stateMap[$row['type']] : "未知用途";
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
									FROM (post INNER JOIN postlocate ON post.ID = postlocate.postID)
									INNER JOIN department ON department.ID = postlocate.deptID;";
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
					</table>
        </div>
      </form>
    </div>

		<div class="card card-outline rounded-0 card-navy">        
			<div class="card-header ">
				<div class="d-flex justify-content-end">
					<td>物品</td>
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
								<style>
									#list td:nth-child(7),
									#list td:nth-child(8){
											text-align:center !important;
									}
								</style>
								<thead><tr>
									<th>#</th>
									<th>ID</th>
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
										$sqli = "SELECT *
											FROM post INNER JOIN item ON post.ID = item.postID
											WHERE item.state = '2' AND postID = '$ID'
											ORDER BY post.ID ASC;";                  
									}
									else{
										$sqli = "SELECT *
											FROM post INNER JOIN item ON post.ID = item.postID
											WHERE NOT item.state = '2' AND postID = '$ID'
											ORDER BY item.state, post.ID ASC;";
									}

									$resulti = $conn->query($sqli);
									if ($resulti === false) {
										die("error: " . $conn->error);
									}
							
									if ($resulti->num_rows > 0) {
										$i = 0;
										$defaultimg = base64_encode(file_get_contents(base_url . "admin/img/defaultimg.png"));
										while ($rowi = $resulti->fetch_assoc()) {
											echo "<tr data-index='$i'>";
											$i++;
											echo "<td>" . $i . "</td>";
											echo "<td>" . $rowi['ID'] . "</td>";
											echo "<td>" . $rowi['name'] . "</td>";
											echo "<td>" . $rowi['kind'] . "</td>";
											echo "<td>";
											if ($rowi['state'] == 0) {
												echo "尋找中";
											} 
											elseif ($rowi['state'] == 1){
												echo "待領取";
											}
											else{
												echo "已解決";
											}
											echo "</td>";
							
											$sqli2 = "SELECT department.name AS name, item.ID
												FROM (item INNER JOIN itemlocate ON item.ID = itemlocate.itemID)
												INNER JOIN department ON department.ID = itemlocate.deptID
												WHERE item.ID =\"" . $rowi['ID'] . "\";";
											$resulti2 = $conn->query($sqli2);
											if ($resulti2->num_rows > 0){
												$rowi2 = $resulti2->fetch_assoc();
												echo "<td>" . $rowi2['name'] . "</td>";
											}
											else echo "<td></td>";
											echo "<td>";
											if($rowi["photo"] == NULL){
												echo '<img src="data:image/jpeg;base64,' . $defaultimg . '" />';
											}
											else{
												$imageBase64 = base64_encode($rowi["photo"]);
												echo '<img src="data:image/jpeg;base64,' . $imageBase64 . '" />';
											}
											echo "<td><div class='oval-div' style='background-color: green;'><a style = 'color: white; text-decoration: none;' href='" . base_url . "admin/item/edit.php?ID={$rowi['ID']}'>編輯</a></div>";
											echo "<div class='oval-div' style='background-color: brown;'><a style = 'color: white; text-decoration: none;' href='" . base_url . "admin/item/delete.php?ID={$rowi['ID']}'>刪除</a></div></td>";

											echo "</tr>";
										}
									}
									else{
										echo "<tr><td colspan='9'>0 results</td></tr>";
									}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
    </div>

		<div class="card card-outline rounded-0 card-navy">        
			<div class="card-header ">
				<div class="d-flex justify-content-end">
					<td>響應</td>
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
								</style>
								<style>
									#list td:nth-child(5){
											text-align:center !important;
									}
								</style>
								<thead><tr>
									<th>#</th>
									<th>發布時間</th>
									<th>發布用戶</th>
									<th>內容</th>
									<th style='width: 160px;'>管理</th>
								</tr></thead>
								<tbody>
								<?php
									$i = 1;
									$sqlr = "SELECT *
										FROM response
													WHERE postID = '$ID';";
									$resultr = $conn->query($sqlr);

									if ($resultr === false) {
										die("error: " . $conn->error);
									}
										
									if ($resultr->num_rows > 0) {
										$i = 0;
										while ($rowr = $resultr->fetch_assoc()) {
											echo "<tr data-index='$i'>";
											$i++;
											echo "<td>" . $i . "</td>";
											echo "<td>" . date("Y-m-d H:i:s", strtotime( $rowr['time'])) . "</td>";
											echo "<td>" . $rowr['userID'] . "</td>";
											echo "<td>" . $rowr['content'] . "</td>";

											echo "<td><div class='oval-div' style='background-color: brown;'><a style = 'color: white; text-decoration: none;' href='" . base_url . "admin/post/responsedelete.php?ID={$rowr['userID']}&time={$rowr['time']}'>刪除</a></div></td>";
											echo "</tr><br>";
										}
									} else {
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
        width: 30px;
    }
</style>
<script>
  document.querySelector('.toggle-sidebar-btn').addEventListener('click', function() {
      document.body.classList.toggle('toggle-sidebar');
  });
</script>

<style>
    img {
        height: 30px;
        width: auto;
    }
</style>