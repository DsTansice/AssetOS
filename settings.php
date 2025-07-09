<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'zh-CN';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($language); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="settings_page_title">个人设置 - AssetOS</title>
  <link rel="icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center pt-8 pb-12">
  <div class="w-full max-w-4xl mx-auto">
    <header class="mb-8 text-center">
      <h1 class="text-3xl font-bold text-gray-900" data-i18n="settings_title">个人设置</h1>
      <p class="text-gray-600 mt-2" data-i18n="settings_subtitle">管理您的账户信息和偏好设置</p>
    </header>

    <!-- 导航栏 -->
    <div class="navbar p-6 mb-6 rounded-lg shadow-sm bg-white">
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
        <!-- 左侧标题 -->
        <div class="mb-4 lg:mb-0 flex items-center">
          <img src="asset/logo.png" alt="AssetOS Logo" class="mr-3 rounded" style="width: 64px; height: 64px;">
          <div>
            <h1 class="text-3xl font-bold page-title" data-i18n="settings_title">个人设置</h1>
            <p class="text-gray-600 mt-2" data-i18n="settings_subtitle">管理您的账户信息和偏好设置</p>
          </div>
        </div>
        
        <!-- 右侧导航 -->
        <div class="flex items-center gap-4">
          <!-- 主题切换按钮 -->
          <button id="themeToggle" class="nav-btn bg-gray-100 text-gray-700 hover:bg-gray-200" title="切换主题">
            <svg id="sunIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <svg id="moonIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
          </button>
          
          <!-- 语言切换 -->
          <button id="languageToggle" class="nav-btn bg-blue-100 text-blue-700 hover:bg-blue-200" data-i18n="language_toggle">English</button>
          
          <!-- 赞助按钮 -->
          <a href="sponsor.php" class="nav-btn bg-purple-500 hover:bg-purple-600" data-i18n="sponsor">赞助</a>
          
          <!-- 用户下拉菜单 -->
          <div class="user-dropdown">
            <button class="user-button">
              <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
              <?php if ($_SESSION['is_admin']): ?>
              <span class="px-1.5 py-0.5 bg-red-100 text-red-800 text-xs rounded-full" data-i18n="admin_status">管理员</span>
              <?php endif; ?>
            </button>
            <div class="user-dropdown-content">
              <a href="index.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span data-i18n="view_items">查看物品</span>
              </a>
              <a href="menu.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <span data-i18n="back_to_menu">返回菜单</span>
              </a>
              <a href="manage.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                <span data-i18n="manage_items">管理物品</span>
              </a>
              <?php if ($_SESSION['is_admin']): ?>
              <a href="admin.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span data-i18n="admin_panel">管理员面板</span>
              </a>
              <?php endif; ?>
              <div class="user-dropdown-divider"></div>
              <button onclick="logout()" class="user-dropdown-item danger">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span data-i18n="logout">退出登录</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 加载动画 -->
    <div class="spinner"></div>

    <!-- 账户信息 -->
    <div class="card mb-8">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="account_info">账户信息</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="form-label" data-i18n="username_label">用户名</label>
          <input type="text" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly class="w-full border border-gray-300 rounded-md p-2 bg-gray-50">
        </div>
        <div>
          <label class="form-label" data-i18n="account_type">账户类型</label>
          <input type="text" value="<?php echo $_SESSION['is_admin'] ? '管理员' : '普通用户'; ?>" readonly class="w-full border border-gray-300 rounded-md p-2 bg-gray-50">
        </div>
      </div>
    </div>

    <!-- 修改密码 -->
    <div class="card mb-8">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="change_password">修改密码</h2>
      <div class="grid grid-cols-1 gap-4">
        <div>
          <label for="currentPassword" class="form-label" data-i18n="current_password">当前密码</label>
          <input id="currentPassword" type="password" placeholder="请输入当前密码" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2" data-i18n-placeholder="current_password_placeholder">
        </div>
        <div>
          <label for="newPassword" class="form-label" data-i18n="new_password">新密码</label>
          <input id="newPassword" type="password" placeholder="请输入新密码" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2" data-i18n-placeholder="new_password_placeholder">
        </div>
        <div>
          <label for="confirmPassword" class="form-label" data-i18n="confirm_password">确认新密码</label>
          <input id="confirmPassword" type="password" placeholder="请再次输入新密码" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2" data-i18n-placeholder="confirm_password_placeholder">
        </div>
        <div>
          <button onclick="changePassword()" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" data-i18n="change_password_button">修改密码</button>
        </div>
      </div>
    </div>

    <!-- 偏好设置 -->
    <div class="card mb-8">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="preferences">偏好设置</h2>
      <div class="grid grid-cols-1 gap-4">
        <div>
          <label for="defaultCurrency" class="form-label" data-i18n="default_currency">默认货币</label>
          <select id="defaultCurrency" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2">
            <option value="CNY">CNY (￥)</option>
            <option value="USD">USD ($)</option>
            <option value="EUR">EUR (€)</option>
          </select>
        </div>
        <div>
          <label for="dateFormat" class="form-label" data-i18n="date_format">日期格式</label>
          <select id="dateFormat" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2">
            <option value="YYYY-MM-DD">YYYY-MM-DD</option>
            <option value="DD/MM/YYYY">DD/MM/YYYY</option>
            <option value="MM/DD/YYYY">MM/DD/YYYY</option>
          </select>
        </div>
        <div>
          <button onclick="savePreferences()" class="w-full bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition" data-i18n="save_preferences">保存偏好设置</button>
        </div>
      </div>
    </div>

    <!-- 危险操作 -->
    <div class="card border-red-200">
      <h2 class="text-xl font-semibold text-red-900 mb-4" data-i18n="danger_zone">危险操作</h2>
      <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-4">
        <p class="text-red-800 text-sm" data-i18n="danger_warning">以下操作将永久删除您的账户和所有数据，请谨慎操作！</p>
      </div>
      <button onclick="deleteAccount()" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition" data-i18n="delete_account">删除账户</button>
    </div>

    <!-- 项目信息 -->
    <?php include 'includes/footer.php'; ?>
  </div>
  <script src="js/script.js"></script>
  <script src="js/user-dropdown.js"></script>
  <script src="js/theme-simple.js"></script>
  <script src="js/button-text-enhancer.js"></script>
  <script>
    // 修改密码
    async function changePassword() {
      const currentPassword = document.getElementById('currentPassword').value;
      const newPassword = document.getElementById('newPassword').value;
      const confirmPassword = document.getElementById('confirmPassword').value;

      if (!currentPassword || !newPassword || !confirmPassword) {
        alert('请填写所有密码字段');
        return;
      }

      if (newPassword !== confirmPassword) {
        alert('新密码和确认密码不匹配');
        return;
      }

      if (newPassword.length < 6) {
        alert('新密码长度不能少于6位');
        return;
      }

      try {
        showSpinner();
        const response = await fetch('api/api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            action: 'changePassword',
            currentPassword,
            newPassword
          })
        });

        const data = await response.json();
        if (data.success) {
          alert('密码修改成功');
          document.getElementById('currentPassword').value = '';
          document.getElementById('newPassword').value = '';
          document.getElementById('confirmPassword').value = '';
        } else {
          alert(data.message || '密码修改失败');
        }
      } catch (error) {
        console.error('密码修改错误:', error);
        alert('密码修改请求失败，请检查网络连接');
      } finally {
        hideSpinner();
      }
    }

    // 保存偏好设置
    async function savePreferences() {
      const defaultCurrency = document.getElementById('defaultCurrency').value;
      const dateFormat = document.getElementById('dateFormat').value;

      try {
        showSpinner();
        const response = await fetch('api/api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            action: 'savePreferences',
            defaultCurrency,
            dateFormat
          })
        });

        const data = await response.json();
        if (data.success) {
          alert('偏好设置保存成功');
        } else {
          alert(data.message || '保存失败');
        }
      } catch (error) {
        console.error('保存偏好设置错误:', error);
        alert('保存请求失败，请检查网络连接');
      } finally {
        hideSpinner();
      }
    }

    // 删除账户
    function deleteAccount() {
      if (confirm('确定要删除您的账户吗？此操作无法撤销！')) {
        if (confirm('这将永久删除您的所有数据，确定继续吗？')) {
          performDeleteAccount();
        }
      }
    }

    async function performDeleteAccount() {
      try {
        showSpinner();
        const response = await fetch('api/api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ action: 'deleteAccount' })
        });

        const data = await response.json();
        if (data.success) {
          alert('账户删除成功');
          window.location.href = 'register.php';
        } else {
          alert(data.message || '删除失败');
        }
      } catch (error) {
        console.error('删除账户错误:', error);
        alert('删除请求失败，请检查网络连接');
      } finally {
        hideSpinner();
      }
    }
  </script>
</body>
</html>
