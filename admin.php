<?php
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
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
  <title data-i18n="admin_title">管理员面板 - AssetOS</title>
  <link rel="icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center pt-8 pb-12">
  <div class="w-full max-w-6xl mx-auto">
    <!-- 导航栏 -->
    <div class="navbar p-6 mb-6 rounded-lg shadow-sm bg-white">
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
        <!-- 左侧标题 -->
        <div class="mb-4 lg:mb-0 flex items-center">
          <img src="asset/logo.png" alt="AssetOS Logo" class="mr-3 rounded" style="width: 64px; height: 64px;">
          <div>
            <h1 class="text-3xl font-bold page-title" data-i18n="admin_title">管理员面板</h1>
            <p class="text-gray-600 mt-2" data-i18n="admin_subtitle">管理用户、分类和系统设置</p>
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
              <span class="px-1.5 py-0.5 bg-red-100 text-red-800 text-xs rounded-full">管理员</span>
            </button>
            <div class="user-dropdown-content">
              <a href="menu.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                返回菜单
              </a>
              <a href="index.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                返回主页
              </a>
              <a href="manage.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                管理物品
              </a>
              <a href="settings.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                个人设置
              </a>
              <div class="user-dropdown-divider"></div>
              <button onclick="logout()" class="user-dropdown-item danger">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                退出登录
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 加载动画 -->
    <div class="spinner"></div>

    <!-- 用户管理 -->
    <div class="card mb-8">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="user_management">用户管理</h2>
      <div id="userList" class="grid grid-cols-1 gap-4"></div>
    </div>

    <!-- 自定义分类 -->
    <div class="card mb-8">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="category_management">自定义分类</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label for="newCategory" class="form-label" data-i18n="new_category">新分类名称</label>
          <input id="newCategory" type="text" data-i18n-placeholder="new_category_placeholder" placeholder="请输入分类名称" class="input-field">
        </div>
        <div class="flex items-end">
          <button onclick="addCategory()" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" data-i18n="add_category">添加分类</button>
        </div>
      </div>
      <div id="categoryList" class="grid grid-cols-1 gap-4"></div>
    </div>

    <!-- SMTP 设置 -->
    <div class="card mb-8">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="smtp_settings">SMTP 设置</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="smtpHost" class="form-label" data-i18n="smtp_host">SMTP 主机</label>
          <input id="smtpHost" type="text" data-i18n-placeholder="smtp_host_placeholder" placeholder="如 smtp.gmail.com" class="input-field">
        </div>
        <div>
          <label for="smtpUsername" class="form-label" data-i18n="smtp_username">SMTP 用户名</label>
          <input id="smtpUsername" type="text" data-i18n-placeholder="smtp_username_placeholder" placeholder="请输入用户名" class="input-field">
        </div>
        <div>
          <label for="smtpPassword" class="form-label" data-i18n="smtp_password">SMTP 密码</label>
          <input id="smtpPassword" type="password" data-i18n-placeholder="smtp_password_placeholder" placeholder="留空保持不变" class="input-field">
        </div>
        <div>
          <label for="smtpPort" class="form-label" data-i18n="smtp_port">SMTP 端口</label>
          <input id="smtpPort" type="number" data-i18n-placeholder="smtp_port_placeholder" placeholder="如 465" class="input-field">
        </div>
        <div>
          <label for="smtpEncryption" class="form-label" data-i18n="smtp_encryption">加密方式</label>
          <select id="smtpEncryption" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2">
            <option value="ssl">SSL</option>
            <option value="tls">TLS</option>
          </select>
        </div>
        <div class="md:col-span-2">
          <button onclick="saveSmtpSettings()" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" data-i18n="save_smtp">保存 SMTP 设置</button>
        </div>
      </div>
    </div>

    <!-- 数据备份与恢复 -->
    <div class="card mb-8">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="data_backup_restore">数据备份与恢复</h2>
      
      <!-- 数据备份 -->
      <div class="mb-6">
        <h3 class="text-lg font-medium text-gray-800 mb-2" data-i18n="data_backup">数据备份</h3>
        <p class="text-gray-600 text-sm mb-3" data-i18n="backup_description">下载当前数据库的完整备份文件</p>
        <button onclick="backupDatabase()" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition" data-i18n="download_backup">下载备份</button>
      </div>
      
      <!-- 数据恢复 -->
      <div class="border-t pt-6">
        <h3 class="text-lg font-medium text-gray-800 mb-2" data-i18n="data_restore">数据恢复</h3>
        <p class="text-gray-600 text-sm mb-4" data-i18n="restore_description">上传备份文件恢复数据库（此操作将覆盖现有数据）</p>
        
        <!-- 选择文件 -->
        <div class="mb-4">
          <input type="file" id="restoreFile" accept=".sqlite,.db" class="hidden">
          <label for="restoreFile" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition cursor-pointer" data-i18n="select_backup_file">选择备份文件</label>
          <div class="mt-2">
            <span id="selectedFileName" class="text-sm text-gray-500"></span>
          </div>
        </div>
        
        <!-- 恢复按钮 -->
        <div>
          <button onclick="restoreDatabase()" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition disabled:bg-gray-400 disabled:cursor-not-allowed" data-i18n="restore_database" disabled id="restoreBtn">恢复数据库</button>
          <p class="text-red-600 text-xs mt-1" data-i18n="restore_warning">⚠️ 警告：此操作将完全覆盖现有数据，请确保已做好当前数据备份</p>
        </div>
      </div>
    </div>

    <!-- Webhook 设置 -->
    <div class="card">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="webhook_settings">Webhook 通知设置</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="webhookUrl" class="form-label" data-i18n="webhook_url">Webhook URL</label>
          <input id="webhookUrl" type="url" data-i18n-placeholder="webhook_url_placeholder" placeholder="https://..." class="input-field">
        </div>
        <div>
          <label for="webhookSecret" class="form-label" data-i18n="webhook_secret">Webhook 密钥</label>
          <input id="webhookSecret" type="text" data-i18n-placeholder="webhook_secret_placeholder" placeholder="请输入密钥" class="input-field">
        </div>
        <div class="md:col-span-2">
          <label for="webhookEvents" class="form-label" data-i18n="webhook_events">通知事件</label>
          <select id="webhookEvents" multiple class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2">
            <option value="item_added" data-i18n="event_item_added">物品添加</option>
            <option value="user_registered" data-i18n="event_user_registered">用户注册</option>
          </select>
        </div>
        <div class="md:col-span-2">
          <button onclick="saveWebhook()" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition" data-i18n="save_webhook">保存 Webhook</button>
        </div>
      </div>
    </div>

    <!-- 项目信息 -->
    <?php include 'includes/footer.php'; ?>
  </div>
  
  <script>
    // 文件选择处理
    document.getElementById('restoreFile').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const fileNameSpan = document.getElementById('selectedFileName');
      const restoreBtn = document.getElementById('restoreBtn');
      
      if (file) {
        fileNameSpan.textContent = `已选择: ${file.name}`;
        restoreBtn.disabled = false;
      } else {
        fileNameSpan.textContent = '';
        restoreBtn.disabled = true;
      }
    });
    
    // 恢复数据库函数
    function restoreDatabase() {
      const fileInput = document.getElementById('restoreFile');
      const file = fileInput.files[0];
      
      if (!file) {
        alert('请先选择备份文件');
        return;
      }
      
      // 确认对话框
      if (!confirm('确定要恢复数据库吗？此操作将覆盖所有现有数据，且无法撤销！')) {
        return;
      }
      
      const formData = new FormData();
      formData.append('action', 'restore_database');
      formData.append('backup_file', file);
      
      // 显示上传进度
      const restoreBtn = document.getElementById('restoreBtn');
      const originalText = restoreBtn.textContent;
      restoreBtn.disabled = true;
      restoreBtn.textContent = '恢复中...';
      
      fetch('api/api.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('数据库恢复成功！页面将重新加载。');
          window.location.reload();
        } else {
          alert('恢复失败: ' + (data.message || '未知错误'));
        }
      })
      .catch(error => {
        console.error('恢复出错:', error);
        alert('恢复过程中发生错误，请检查文件格式是否正确');
      })
      .finally(() => {
        restoreBtn.disabled = false;
        restoreBtn.textContent = originalText;
      });
    }
  </script>
  
  <script src="js/script.js"></script>
  <script src="js/user-dropdown.js"></script>
  <script src="js/theme-simple.js"></script>
  <script src="js/button-text-enhancer.js"></script>
</body>
</html>