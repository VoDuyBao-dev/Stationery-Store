<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danh sách User</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/customers/Taikhoan.css">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT;?>//public/assets/clients/css/blocks/menu.css">
    <link type="text/css" rel="stylesheet" 
        href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/blocks/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/assets/clients/js/blocks/header.js"></script>
    <style>
        menu {
            float: left;
        }
        main{
            margin-top: 120px;
            margin-left: 280px;
        }
    </style>
  </head>
  <body>
  <header>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/header-admin.php";?>
  </header>  

  <menu>
    <?php  require_once _DIR_ROOT . "/app/views/blocks/menu-admin.php";?>
  </menu> 
<main>

    <h1>Danh sách User</h1>

    <div class="search-container">
      <input
        type="text"
        id="searchInput"
        placeholder="Tìm kiếm người dùng..."
      />
    </div>

    <table>
      <thead>
        <tr>
          <th>STT</th>
          <th>Tên</th>
          <th>SDT</th>
          <th>Email</th>
          <th>Địa chỉ</th>
          <th>Trạng thái</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>User Three</td>
          <td>1234567892</td>
          <td>user3@example.com</td>
          <td>Address Three</td>
          <td><span class="status status-active"></span> Hoạt động</td>
          <td><button class="action-button">Khóa</button></td>
        </tr>
        <tr>
          <td>2</td>
          <td>User Five</td>
          <td>1234567894</td>
          <td>user5@example.com</td>
          <td>Address Five</td>
          <td><span class="status status-active"></span> Hoạt động</td>
          <td><button class="action-button">Khóa</button></td>
        </tr>
        <tr>
          <td>3</td>
          <td>User Six</td>
          <td>1234567895</td>
          <td>user6@example.com</td>
          <td>Address Six</td>
          <td><span class="status status-active"></span> Hoạt động</td>
          <td><button class="action-button">Khóa</button></td>
        </tr>
        <tr>
          <td>4</td>
          <td>User Seven</td>
          <td>1234567896</td>
          <td>user7@example.com</td>
          <td>Address Seven</td>
          <td><span class="status status-active"></span> Hoạt động</td>
          <td><button class="action-button">Khóa</button></td>
        </tr>
        <tr>
          <td>5</td>
          <td>User Eight</td>
          <td>1234567897</td>
          <td>user8@example.com</td>
          <td>Address Eight</td>
          <td><span class="status status-active"></span> Hoạt động</td>
          <td><button class="action-button">Khóa</button></td>
        </tr>
        <tr>
          <td>6</td>
          <td>User Nine</td>
          <td>1234567898</td>
          <td>user9@example.com</td>
          <td>Address Nine</td>
          <td><span class="status status-active"></span> Hoạt động</td>
          <td><button class="action-button">Khóa</button></td>
        </tr>
        <tr>
          <td>7</td>
          <td>User Ten</td>
          <td>1234567899</td>
          <td>user10@example.com</td>
          <td>Address Ten</td>
          <td><span class="status status-active"></span> Hoạt động</td>
          <td><button class="action-button">Khóa</button></td>
        </tr>
        <tr>
          <td>8</td>
          <td>User One</td>
          <td>1234567890</td>
          <td>user1@example.com</td>
          <td>Address One</td>
          <td><span class="status status-locked"></span> Bị khóa</td>
          <td><button class="action-button">Mở khóa</button></td>
        </tr>
        <tr>
          <td>9</td>
          <td>User Two</td>
          <td>1234567891</td>
          <td>user2@example.com</td>
          <td>Address Two</td>
          <td><span class="status status-locked"></span> Bị khóa</td>
          <td><button class="action-button">Mở khóa</button></td>
        </tr>
        <tr>
          <td>10</td>
          <td>User Four</td>
          <td>1234567893</td>
          <td>user4@example.com</td>
          <td>Address Four</td>
          <td><span class="status status-locked"></span> Bị khóa</td>
          <td><button class="action-button">Mở khóa</button></td>
        </tr>
      </tbody>
    </table>
  
    <?php  require_once _DIR_ROOT . "/app/views/blocks/footer.php";?>

</main>
  </body>
</html>
