<?php
use core\Helpers;
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danh sách User</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/clients/css/admin/Taikhoan.css">
    <script src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/admin/taikhoan.js"></script>
  </head>
  <body>
    <h2>Danh sách User</h2>
    <?php if ($message = Helpers::getFlash('error')): ?>
                <div class="error-message"><?php echo $message; ?></div>
               
            <?php endif; ?>
            <?php if ($message = Helpers::getFlash('message')): ?>
                <div class="success-message"><?php echo $message; ?></div>
               
            <?php endif; ?>

    <div class="search-container">
      <input
        type="text"
        id="searchInput"
        onkeyup="searchUser()"
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
        <?php $i = 1;?>
      <?php 
        if($users === false){
            echo '<tr><td colspan="7">Không có tài khoản nào trong trạng thái hoạt động!</td></tr>';
        } else {
            
            // Hiển thị danh sách tài khoản đang hoạt động
            foreach ($users as $user) {
        ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['address']); ?></td>
                    <td><span class="status status-active"></span> Hoạt động</td>
                    <td>
                    <form action="<?= _WEB_ROOT; ?>/AdminManageUser/lockUser" method="POST" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $user['user_id']; ?>">
                        <button type="submit" class="action-button" onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này không?')">Khóa</button>
                    </form>
                    </td>
                    
                </tr>
        <?php
            }
        }
        ?>
        
        <?php 
        if($usersLock === false){
            echo '<tr><td colspan="7">Không có tài khoản nào trong trạng thái bị khóa!</td></tr>';
        } else {
          
            // Hiển thị danh sách tài khoản đang hoạt động
            foreach ($usersLock as $userLock) {
        ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($userLock['fullname']); ?></td>
                    <td><?php echo htmlspecialchars($userLock['phone']); ?></td>
                    <td><?php echo htmlspecialchars($userLock['email']); ?></td>
                    <td><?php echo htmlspecialchars($userLock['address']); ?></td>
                    <td><span class="status status-locked"></span> Bị khóa</td>
                    <td>
                    <form action="<?= _WEB_ROOT; ?>/AdminManageUser/unlockUser" method="POST" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $userLock['user_id']; ?>">
                        <button type="submit" class="action-button" onclick="return confirm('Bạn có chắc chắn muốn mở khóa tài khoản này không?')">Mở khóa</button>
                    </form>
                    </td>
                    
                </tr>
        <?php
            }
        }
        ?>
        
        
      </tbody>
    </table>
  </body>
</html>
